<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Exception;
use SimpleXMLElement;

class LegalDocumentController extends Controller
{
    /**
     * Display the standard upload form
     */
    public function standardUpload()
    {
        // Get existing tables for display
        $tables = DB::table('legal_tables_master')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.legal-documents.standard-upload', compact('tables'));
    }
    
    /**
     * Display the alternative upload form
     */
    public function alternativeUpload()
    {
        // Get existing tables for display
        $tables = DB::table('legal_tables_master')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.legal-documents.alternative-upload', compact('tables'));
    }
    
    /**
     * Process the uploaded XML file (standard method)
     */    public function processStandardUpload(Request $request)
    {
        // Validate the uploaded file
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'xmlfile' => 'required|file|max:10240', // Max 10MB
            'law_id' => 'required|integer|min:1',
            'act_id' => 'required|integer|min:1',
            'act_name' => 'required|string|max:255',
            'jurisdiction_id' => 'required|integer|min:1',
            'language' => 'required|string|max:50',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
          $file = $request->file('xmlfile');
        
        // Additional XML file validation
        $fileExtension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $originalName = $file->getClientOriginalName();
        
        \Illuminate\Support\Facades\Log::info('XML Upload Debug', [
            'originalName' => $originalName,
            'extension' => $fileExtension,
            'mimeType' => $mimeType,
            'size' => $file->getSize()
        ]);
        
        if (strtolower($fileExtension) !== 'xml') {
            return redirect()->back()
                ->withErrors(['xmlfile' => 'The file must be an XML document.'])
                ->withInput();
        }        
        $original_filename = $file->getClientOriginalName();
        
        DB::beginTransaction();
        try {
            // Get XML content directly from the uploaded file without saving to disk
            $xmlContent = file_get_contents($file->getRealPath());
            if ($xmlContent === false) {
                throw new Exception("Failed to read XML file contents from upload");
            }
            
            // Check if the XML content appears to be valid
            if (strlen($xmlContent) < 50) {
                throw new Exception("XML file appears to be too small or empty (" . strlen($xmlContent) . " bytes)");
            }              // Log the first 200 characters of the XML to help with debugging
            \Illuminate\Support\Facades\Log::info('XML Content Preview', [
                'preview' => substr($xmlContent, 0, 200),
                'size' => strlen($xmlContent)
            ]);
              // Check if XML content has DOCTYPE declaration that might cause issues
            if (strpos($xmlContent, '<!DOCTYPE') !== false) {
                \Illuminate\Support\Facades\Log::warning('XML contains DOCTYPE declaration which might cause parsing issues');
            }
            
            // Configure libxml to handle errors
            libxml_use_internal_errors(true);
            
            // Security: Disable external entity loading
            $previousValue = libxml_disable_entity_loader(true);
            
            // Load XML with namespace support
            $xmlCheck = $this->loadXmlWithNamespaces($xmlContent);
            
            // Restore previous libxml settings
            libxml_disable_entity_loader($previousValue);
            
            if ($xmlCheck === false) {
                $errors = libxml_get_errors();
                $errorMsg = empty($errors) ? "Unknown XML parsing error" : $errors[0]->message;
                libxml_clear_errors();
                throw new Exception("Invalid XML file: " . $errorMsg);
            }
            
            // Generate table name and create it
            $table_name = $this->generateTableName();
            $this->createLegalTable($table_name);
            $this->recordTableCreation(
                $table_name, 
                $original_filename, 
                $request->law_id, 
                $request->act_id, 
                $request->act_name, 
                $request->jurisdiction_id,
                $request->language
            );            
            $category_id = $this->getNextCategoryId();
            
            // Process XML file using the temp file we've already validated
            $xml = $xmlCheck; // We already loaded and validated this XML
            
            // Check if Body element exists in the XML
            if (!isset($xml->Body)) {
                throw new Exception("XML file is missing the required Body element");
            }
            
            $last_inserted_id = null;
            
            // Insert data
            $this->insertData(
                $xml->Body,
                $table_name,
                $category_id,
                $request->law_id,
                $request->act_id,
                $request->jurisdiction_id,
                null,
                null,
                null,
                null,
                $last_inserted_id
            );
            
            DB::commit();
            
            return redirect()->back()->with('success', "XML data has been successfully inserted into table '$table_name' with category ID: $category_id!");
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Error: " . $e->getMessage());
        }
    }    /**
     * Process the uploaded XML file (alternative method)
     */    public function processAlternativeUpload(Request $request)
    {
        // Validate the uploaded file
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'xmlfile' => 'required|file|max:10240', // Max 10MB
            'law_id' => 'required|integer|min:1',
            'act_id' => 'required|integer|min:1',
            'act_name' => 'required|string|max:255',
            'jurisdiction_id' => 'required|integer|min:1',
            'language' => 'required|string|max:50',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $file = $request->file('xmlfile');
        
        // Additional XML file validation
        $fileExtension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $originalName = $file->getClientOriginalName();
        
        \Illuminate\Support\Facades\Log::info('XML Upload Debug (Alternative)', [
            'originalName' => $originalName,
            'extension' => $fileExtension,
            'mimeType' => $mimeType,
            'size' => $file->getSize()
        ]);
        
        if (strtolower($fileExtension) !== 'xml') {
            return redirect()->back()
                ->withErrors(['xmlfile' => 'The file must be an XML document.'])
                ->withInput();
        }
        
        $original_filename = $file->getClientOriginalName();
        
        DB::beginTransaction();
        try {
            // Get XML content directly from the uploaded file without saving to disk
            $xmlContent = file_get_contents($file->getRealPath());
            if ($xmlContent === false) {
                throw new Exception("Failed to read XML file contents from upload");
            }
            
            // Check if the XML content appears to be valid
            if (strlen($xmlContent) < 50) {
                throw new Exception("XML file appears to be too small or empty (" . strlen($xmlContent) . " bytes)");
            }
              // Log the first 200 characters of the XML to help with debugging
            \Illuminate\Support\Facades\Log::info('XML Content Preview (Alternative)', [
                'preview' => substr($xmlContent, 0, 200),
                'size' => strlen($xmlContent)
            ]);
            
            // Check if XML content has DOCTYPE declaration that might cause issues
            if (strpos($xmlContent, '<!DOCTYPE') !== false) {
                \Illuminate\Support\Facades\Log::warning('XML contains DOCTYPE declaration which might cause parsing issues');
            }
            
            // Configure libxml to handle errors
            libxml_use_internal_errors(true);
            
            // Security: Disable external entity loading
            $previousValue = libxml_disable_entity_loader(true);
            
            // Load XML with namespace support
            $xmlCheck = $this->loadXmlWithNamespaces($xmlContent);
            
            // Restore previous libxml settings
            libxml_disable_entity_loader($previousValue);
            
            if ($xmlCheck === false) {
                $errors = libxml_get_errors();
                $errorMsg = empty($errors) ? "Unknown XML parsing error" : $errors[0]->message;
                libxml_clear_errors();
                throw new Exception("Invalid XML file: " . $errorMsg);
            }
            
            // Generate table name and create it
            $table_name = $this->generateTableName();
            $this->createLegalTable($table_name);
            $this->recordTableCreation(
                $table_name, 
                $original_filename, 
                $request->law_id, 
                $request->act_id, 
                $request->act_name, 
                $request->jurisdiction_id,
                $request->language
            );
            
            $category_id = $this->getNextCategoryId();
            
            // Process XML file using the validated XML
            $xml = $xmlCheck; // We already loaded and validated this XML
            
            // Check if Body element exists in the XML
            if (!isset($xml->Body)) {
                throw new Exception("XML file is missing the required Body element");
            }
            
            $last_inserted_id = null;
            
            // Insert data - the implementation for alternative method would go here
            // For now, we'll use the same method as standard process
            $this->insertData(
                $xml->Body,
                $table_name,
                $category_id,
                $request->law_id,
                $request->act_id,
                $request->jurisdiction_id,
                null,
                null,
                null,
                null,
                $last_inserted_id
            );
            
            DB::commit();
            
            return redirect()->back()->with('success', "XML data has been successfully inserted into table '$table_name' with category ID: $category_id!");
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Error: " . $e->getMessage());
        }
    }
    
    /**
     * Create a new table for legal documents
     */
    private function createLegalTable($table_name)
    {
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) {
                $table->id();
                $table->integer('category_id')->index();
                $table->integer('parent_id')->nullable()->index();
                $table->string('part', 50)->nullable();
                $table->string('division', 50)->nullable();
                $table->string('sub_division', 50)->nullable();
                $table->string('section', 50)->nullable();
                $table->string('sub_section', 50)->nullable();
                $table->string('paragraph', 50)->nullable();
                $table->string('sub_paragraph', 50)->nullable();
                $table->string('section_id', 100)->nullable()->index();
                $table->text('title')->nullable();
                $table->longText('text_content')->nullable();
                $table->text('footnote')->nullable();
                $table->string('paging', 100)->nullable();
                $table->integer('law_id')->index();
                $table->integer('act_id')->index();
                $table->integer('jurisdiction_id')->index();
                $table->timestamp('created_at')->useCurrent();
            });
        }
        
        return true;
    }
    
    /**
     * Generate a sequential table name
     */
    private function generateTableName()
    {
        // Ensure master table exists
        $this->ensureMasterTableExists();
        
        // Get count of existing tables
        $count = DB::table('legal_tables_master')->count();
        $next_number = $count + 1;
        
        return "legaldocument" . $next_number;
    }
    
    /**
     * Ensure the master table exists
     */
    private function ensureMasterTableExists()
    {
        if (!Schema::hasTable('legal_tables_master')) {
            Schema::create('legal_tables_master', function (Blueprint $table) {
                $table->id();
                $table->string('table_name', 255);
                $table->string('original_filename', 255);
                $table->integer('law_id');
                $table->integer('act_id');
                $table->string('act_name', 255);
                $table->integer('jurisdiction_id');
                $table->string('language', 50)->nullable();
                $table->integer('legaldocument_id')->nullable();
                $table->timestamp('created_at')->useCurrent();
                
                $table->index('table_name');
                $table->index('law_id');
                $table->index('act_id');
                $table->index('jurisdiction_id');
            });
        } else if (!Schema::hasColumn('legal_tables_master', 'language')) {
            // Add the language column if the table exists but doesn't have this column
            Schema::table('legal_tables_master', function (Blueprint $table) {
                $table->string('language', 50)->nullable();
            });
        }
        
        return true;
    }
    
    /**
     * Record table creation in the master table
     */
    private function recordTableCreation($table_name, $original_filename, $law_id, $act_id, $act_name, $jurisdiction_id, $language = null)
    {
        $this->ensureMasterTableExists();
        
        // Insert record
        $id = DB::table('legal_tables_master')->insertGetId([
            'table_name' => $table_name,
            'original_filename' => $original_filename,
            'law_id' => $law_id,
            'act_id' => $act_id,
            'act_name' => $act_name,
            'jurisdiction_id' => $jurisdiction_id,
            'language' => $language,
        ]);
        
        // Update legaldocument_id to match id
        DB::table('legal_tables_master')
            ->where('id', $id)
            ->update(['legaldocument_id' => $id]);
            
        return true;
    }
    
    /**
     * Get the next category ID
     */
    private function getNextCategoryId()
    {
        // Get all table names from legal_tables_master
        $tableNames = DB::table('legal_tables_master')
            ->pluck('table_name')
            ->toArray();
            
        if (empty($tableNames)) {
            return 1;
        }
        
        // Find the maximum category_id across all tables
        $max_category_id = 0;
        
        foreach ($tableNames as $tableName) {
            if (Schema::hasTable($tableName)) {
                $result = DB::table($tableName)->max('category_id');
                if ($result && $result > $max_category_id) {
                    $max_category_id = $result;
                }
            }
        }
        
        // Return next available category_id
        return $max_category_id + 1;
    }
    
    /**
     * Build section ID based on hierarchical structure
     */
    private function buildSectionId($section, $sub_section, $paragraph, $sub_paragraph)
    {
        $components = [];

        if (!empty($section)) {
            $components[] = $section;
        }
        if (!empty($sub_section)) {
            $components[] = $sub_section;
        }
        if (!empty($paragraph)) {
            $components[] = $paragraph;
        }
        if (!empty($sub_paragraph)) {
            $components[] = $sub_paragraph;
        }

        return implode('', $components);
    }
    
    /**
     * Get parent's components
     */
    private function getParentComponents($table_name, $parent_id, $current_part, $current_division, $current_sub_division)
    {
        if ($parent_id === null) {
            return [
                'part' => $current_part,
                'division' => $current_division,
                'sub_division' => $current_sub_division,
                'section' => '',
                'sub_section' => '',
                'paragraph' => '',
                'sub_paragraph' => ''
            ];
        }
        
        $row = DB::table($table_name)
            ->where('id', $parent_id)
            ->select('part', 'division', 'sub_division', 'section', 'sub_section', 'paragraph', 'sub_paragraph')
            ->first();
            
        return [
            'part' => !empty($row->part) ? $row->part : $current_part,
            'division' => !empty($row->division) ? $row->division : $current_division,
            'sub_division' => !empty($row->sub_division) ? $row->sub_division : $current_sub_division,
            'section' => $row->section ?? '',
            'sub_section' => $row->sub_section ?? '',
            'paragraph' => $row->paragraph ?? '',
            'sub_paragraph' => $row->sub_paragraph ?? ''
        ];
    }
    
    /**
     * Extract number from label
     */
    private function extractNumber($label)
    {
        if (preg_match('/\d+(\.\d+)*/', $label, $matches)) {
            return $matches[0];
        }
        return null;
    }
    
    /**
     * Format defined terms
     */
    private function formatDefinedTerms($element)
    {
        $xml_string = $element->asXML();
        $xml_string = preg_replace('/<\/?Text[^>]*>/', '', $xml_string);
        
        $dom = new \DOMDocument();
        $dom->loadXML('<root>' . $xml_string . '</root>', LIBXML_NOERROR);
        
        $formatted_text = '';
        $previous_was_term = false;
        
        foreach ($dom->documentElement->childNodes as $node) {
            if ($node->nodeType === XML_ELEMENT_NODE) {
                if ($node->nodeName === 'DefinedTermEn') {
                    $formatted_text .= '<b>' . $node->nodeValue . '</b>';
                    $previous_was_term = true;
                } elseif ($node->nodeName === 'DefinedTermFr') {
                    $formatted_text .= '<i>' . $node->nodeValue . '</i>';
                    $previous_was_term = true;
                }
            } elseif ($node->nodeType === XML_TEXT_NODE) {
                $text = trim($node->nodeValue);
                if (!empty($text)) {
                    if ($previous_was_term) {
                        $formatted_text .= ' ';
                    }
                    $formatted_text .= $text;
                    $previous_was_term = false;
                }
            }
        }
        
        return trim($formatted_text) . '<br><br>';
    }
    
    /**
     * Format cross references
     */
    private function formatCrossReferences($element)
    {
        $dom = new \DOMDocument();
        $dom->loadXML('<root>' . $element->asXML() . '</root>', LIBXML_NOERROR);
        
        $xpath = new \DOMXPath($dom);
        
        // Process <Repealed> elements
        $repealed_nodes = $xpath->query('//Repealed');
        foreach ($repealed_nodes as $node) {
            $text = $node->nodeValue;
            $node->nodeValue = '';
            $repealed_element = $dom->createElement('span', $text);
            $repealed_element->setAttribute('class', 'repealed');
            $node->appendChild($repealed_element);
        }
        
        $formatted_text = '';
        foreach ($dom->documentElement->childNodes as $node) {
            $formatted_text .= $dom->saveHTML($node);
        }
        
        return trim($formatted_text);
    }
    
    /**
     * Update footnote for the last inserted entry
     */
    private function updateFootnote($table_name, $entry_id, $footnote)
    {
        DB::table($table_name)
            ->where('id', $entry_id)
            ->update(['footnote' => $footnote]);
            
        return true;
    }
    
    /**
     * Get footnote text from HistoricalNote elements
     */
    private function getFootnoteText($element)
    {
        $footnote = '';
        if ($element->getName() == 'HistoricalNote') {
            foreach ($element->HistoricalNoteSubItem as $subItem) {
                $footnote .= trim((string)$subItem) . ' ';
            }
        }
        return trim($footnote);
    }
    
    /**
     * Process definitions
     */
    private function processDefinitions($subsection)
    {
        $definitions = [];
        
        // Process introductory text
        $intro_text = '';
        foreach ($subsection->children() as $child) {
            if ($child->getName() === 'Text') {
                $intro_text = $this->formatDefinedTerms($child);
                break;
            }
        }
        
        // Process each Definition
        foreach ($subsection->Definition as $definition) {
            if ($definition->Text) {
                $definitions[] = $this->formatDefinedTerms($definition->Text);
            }
        }
        
        // Combine intro text with definitions
        $full_text = $intro_text;
        if (!empty($definitions)) {
            $full_text .= "\n\n" . implode("\n\n", $definitions);
        }
        
        return trim($full_text);
    }
    
    /**
     * Load XML content with namespace handling
     */
    private function loadXmlWithNamespaces($xmlContent)
    {
        // Enable user error handling
        libxml_use_internal_errors(true);
        
        // Try parsing the XML with namespace handling
        $xml = new \SimpleXMLElement($xmlContent, LIBXML_NOENT | LIBXML_NOWARNING | LIBXML_NSCLEAN);
        
        // Register common namespaces
        $namespaces = $xml->getNamespaces(true);
        
        // Add additional namespaces that might be used but not properly declared
        // Add the lims namespace if it's being used but not declared
        if (!isset($namespaces['lims']) && strpos($xmlContent, 'lims:') !== false) {
            $xml->registerXPathNamespace('lims', 'http://schemas.justice.gc.ca/lims');
        }
        
        // Add any other namespaces that might be used
        $commonNamespaces = [
            'xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xml' => 'http://www.w3.org/XML/1998/namespace',
            'leg' => 'http://schemas.justice.gc.ca/leg',
            'dc' => 'http://purl.org/dc/elements/1.1/'
        ];
        
        foreach ($commonNamespaces as $prefix => $uri) {
            if (!isset($namespaces[$prefix]) && strpos($xmlContent, $prefix . ':') !== false) {
                $xml->registerXPathNamespace($prefix, $uri);
            }
        }
        
        return $xml;
    }
    
    /**
     * Insert data from XML into database
     */
    private function insertData($xml_element, $table_name, $category_id, $law_id, $act_id, $jurisdiction_id, $parent_id = null, $current_part = null, $current_division = null, $current_sub_division = null, &$last_inserted_id = null)
    {
        $sub_division_counter = 1;

        foreach ($xml_element as $element) {
            // Initialize variables for the current element
            $part = $current_part;
            $division = $current_division;
            $sub_division = $current_sub_division;
            $section = null;
            $sub_section = null;
            $paragraph = null;
            $sub_paragraph = null;
            $title = null;
            $text_content = null;
            $footnote = null;
            $paging = null;

            // Skip processing the "Body" element itself
            if ($element->getName() == 'Body') {
                $temp_last_id = $last_inserted_id;
                $this->insertData($element->children(), $table_name, $category_id, $law_id, $act_id, $jurisdiction_id, $parent_id, $current_part, $current_division, $current_sub_division, $temp_last_id);
                $last_inserted_id = $temp_last_id;
                continue;
            }

            // If a HistoricalNote element is encountered, update the previous entry's footnote
            if ($element->getName() == 'HistoricalNote' && $last_inserted_id !== null) {
                $footnote = $this->getFootnoteText($element);
                $this->updateFootnote($table_name, $last_inserted_id, $footnote);
                continue;
            }

            // Get parent's components with current context
            $parent_components = $this->getParentComponents($table_name, $parent_id, $current_part, $current_division, $current_sub_division);

            // Process different elements based on their tags and attributes
            switch ($element->getName()) {
                case 'Heading':
                    if ((string)$element['level'] == '1') {
                        $part = $this->extractNumber((string)$element->Label);
                        $sub_division_counter = 1;
                    } elseif ((string)$element['level'] == '2') {
                        $sub_division_counter = 1;
                    }
                    break;
                    
                case 'Section':
                    $part = $current_part;
                    $division = $current_division;
                    $sub_division = $current_sub_division;
                    $section = (string)$element->Label;
                    $title = (string)$element->MarginalNote;
                    $text_content = trim($this->formatCrossReferences($element->Text));
                    break;
                    
                case 'Subsection':
                    $part = $current_part;
                    $division = $current_division;
                    $sub_division = $current_sub_division;
                    $section = $parent_components['section'];
                    $sub_section = (string)$element->Label;
                    
                    // Check if this is a definitions subsection
                    if (strpos(strtolower((string)$element->MarginalNote), 'definition') !== false) {
                        $text_content = $this->processDefinitions($element);
                    } else {
                        $text_content = trim($this->formatCrossReferences($element->Text));
                    }
                    break;
                    
                case 'Paragraph':
                    $part = $current_part;
                    $division = $current_division;
                    $sub_division = $current_sub_division;
                    $section = $parent_components['section'];
                    $sub_section = $parent_components['sub_section'];
                    $paragraph = (string)$element->Label;
                    $text_content = trim($this->formatCrossReferences($element->Text));
                    break;
                    
                case 'Subparagraph':
                    $part = $current_part;
                    $division = $current_division;
                    $sub_division = $current_sub_division;
                    $section = $parent_components['section'];
                    $sub_section = $parent_components['sub_section'];
                    $paragraph = $parent_components['paragraph'];
                    $sub_paragraph = (string)$element->Label;
                    $text_content = trim($this->formatCrossReferences($element->Text));
                    break;
            }

            if (empty($section) && empty($sub_section) && empty($paragraph) && empty($sub_paragraph) && empty($title) && empty($text_content)) {
                continue;
            }

            $section_id = $this->buildSectionId($section, $sub_section, $paragraph, $sub_paragraph);

            // Insert the data into the database
            $id = DB::table($table_name)->insertGetId([
                'category_id' => $category_id,
                'parent_id' => $parent_id,
                'part' => $part,
                'division' => $division,
                'sub_division' => $sub_division,
                'section' => $section,
                'sub_section' => $sub_section,
                'paragraph' => $paragraph,
                'sub_paragraph' => $sub_paragraph,
                'section_id' => $section_id,
                'title' => $title,
                'text_content' => $text_content,
                'footnote' => $footnote,
                'paging' => $paging,
                'law_id' => $law_id,
                'act_id' => $act_id,
                'jurisdiction_id' => $jurisdiction_id,
            ]);

            $last_inserted_id = $id;

            // Recursively process children
            if ($element->children()->count() > 0) {
                $temp_last_id = $last_inserted_id;
                $this->insertData(
                    $element->children(),
                    $table_name,
                    $category_id,
                    $law_id,
                    $act_id,
                    $jurisdiction_id,
                    $last_inserted_id,
                    $current_part,
                    $current_division,
                    $current_sub_division,
                    $temp_last_id
                );
                $last_inserted_id = $temp_last_id;
            }
        }
    }
    
    /**
     * Display a listing of all legal documents in a grid format.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $documents = DB::table('legal_tables_master')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get reference data for mapping IDs to names
        $jurisdictions = $this->getJurisdictionMappings();
        $lawSubjects = $this->getLawSubjectMappings();
        $acts = $this->getActMappings();
        $languages = $this->getLanguageMappings();
            
        return view('admin.legal-documents.index', compact('documents', 'jurisdictions', 'lawSubjects', 'acts', 'languages'));
    }
    
    /**
     * Get jurisdiction ID to name mappings
     */
    private function getJurisdictionMappings()
    {
        try {
            return DB::table('jurisdiction')
                ->pluck('jurisdiction_name', 'jurisdiction_id')
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    
    /**
     * Get law subject ID to name mappings
     */
    private function getLawSubjectMappings()
    {
        try {
            return DB::table('law_subject')
                ->pluck('law_subject_name', 'law_id')
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    
    /**
     * Get act ID to name mappings
     */
    private function getActMappings()
    {
        try {
            return DB::table('acts')
                ->pluck('act_name', 'act_id')
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    
    /**
     * Get language mappings
     */
    private function getLanguageMappings()
    {
        return [
            1 => 'English',
            2 => 'French',
            3 => 'Both'
        ];
    }
    
    /**
     * Show the form for editing the specified legal document.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $document = DB::table('legal_tables_master')->where('id', $id)->first();
        
        if (!$document) {
            return redirect()->route('admin.legal-documents.index')
                ->with('error', 'Document not found');
        }
        
        // Get the document content from its specific table
        $documentContent = null;
        if (Schema::hasTable($document->table_name)) {
            $documentContent = DB::table($document->table_name)
                ->orderBy('id')
                ->get();
        }
        
        return view('admin.legal-documents.edit', compact('document', 'documentContent'));
    }
    
    /**
     * Update the specified legal document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $document = DB::table('legal_tables_master')->where('id', $id)->first();
        
        if (!$document) {
            return redirect()->route('admin.legal-documents.index')
                ->with('error', 'Document not found');
        }
        
        // If we're updating document metadata
        if ($request->has('act_name')) {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'act_name' => 'required|string|max:255',
                'law_id' => 'required|integer|min:1',
                'act_id' => 'required|integer|min:1',
                'jurisdiction_id' => 'required|integer|min:1',
                'language' => 'required|string|max:50',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Update the document details
            DB::table('legal_tables_master')
                ->where('id', $id)
                ->update([
                    'act_name' => $request->act_name,
                    'law_id' => $request->law_id,
                    'act_id' => $request->act_id,
                    'jurisdiction_id' => $request->jurisdiction_id,
                    'language' => $request->language,
                    'updated_at' => now(),
                ]);
        }
            
        // If there are content updates, process them
        if ($request->has('content') && is_array($request->content)) {
            $table = $document->table_name;
            
            foreach ($request->content as $contentId => $content) {
                DB::table($table)
                    ->where('id', $contentId)
                    ->update([
                        'title' => $content['title'] ?? null,
                        'text_content' => $content['text_content'] ?? null,
                        'updated_at' => now(),
                    ]);
            }
        }
        
        return redirect()->route('admin.legal-documents.edit', $id)
            ->with('success', 'Content updated successfully');
    }
    
    /**
     * Remove the specified legal document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = DB::table('legal_tables_master')->where('id', $id)->first();
        
        if (!$document) {
            return redirect()->route('admin.legal-documents.index')
                ->with('error', 'Document not found');
        }
        
        DB::beginTransaction();
        try {
            // Drop the document table if it exists
            $tableName = $document->table_name;
            if (Schema::hasTable($tableName)) {
                Schema::dropIfExists($tableName);
            }
            
            // Delete the record from the master table
            DB::table('legal_tables_master')->where('id', $id)->delete();
            
            DB::commit();
            return redirect()->route('admin.legal-documents.index')
                ->with('success', 'Document deleted successfully');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.legal-documents.index')
                ->with('error', 'Error deleting document: ' . $e->getMessage());
        }
    }
    
    /**
     * Toggle the status of the specified document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($id)
    {
        $document = DB::table('legal_tables_master')->where('id', $id)->first();
        
        if (!$document) {
            return response()->json(['success' => false, 'message' => 'Document not found'], 404);
        }
        
        $currentStatus = $document->status ?? 'active';
        $newStatus = ($currentStatus == 'active') ? 'inactive' : 'active';
        
        DB::table('legal_tables_master')
            ->where('id', $id)
            ->update([
                'status' => $newStatus,
                'updated_at' => now(),
            ]);
            
        return response()->json([
            'success' => true, 
            'message' => 'Status updated successfully', 
            'newStatus' => $newStatus
        ]);
    }
}
