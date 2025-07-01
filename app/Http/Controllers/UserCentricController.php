<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserTextData;
use App\Models\UserTemplate;
use App\Models\LegalDocument;
use App\Models\GovernmentLink;

class UserCentricController extends Controller
{
    /**
     * Show the user-centric home page
     */
    public function home()
    {
        return view('user-home');
    }

    /**
     * Show legal tables selection for user-centric session (without client association)
     */
    public function legalTables(Request $request)
    {
        $user = Auth::user();
        
        // Get all legal documents tables for search
        $tables = [
            'immigration_acts', 'immigration_appeal_review_processes', 'immigration_case_laws',
            'immigration_codes', 'immigration_enforcements', 'immigration_forms',
            'immigration_guidelines', 'immigration_agreements', 'immigration_ministerial_instructions',
            'immigration_operational_bulletins', 'immigration_policies', 'immigration_procedures',
            'immigration_regulations', 'citizenship_acts', 'citizenship_appeal_review_processes',
            'citizenship_case_laws', 'citizenship_codes', 'citizenship_enforcements',
            'citizenship_forms', 'citizenship_guidelines', 'citizenship_agreements',
            'citizenship_ministerial_instructions', 'citizenship_operational_bulletins',
            'citizenship_policies', 'citizenship_procedures', 'citizenship_regulations',
            'criminal_acts', 'criminal_appeal_review_processes', 'criminal_case_laws',
            'criminal_codes', 'criminal_enforcements', 'criminal_forms',
            'criminal_guidelines', 'criminal_agreements', 'criminal_ministerial_instructions',
            'criminal_operational_bulletins', 'criminal_policies', 'criminal_procedures',
            'criminal_regulations'
        ];

        $legalTables = collect();

        // Build search query
        $searchTerm = $request->get('search');
        $lawId = $request->get('law_id');
        $jurisdictionId = $request->get('jurisdiction_id');
        $actId = $request->get('act_id');
        $languageId = $request->get('language_id');

        foreach ($tables as $table) {
            if (DB::getSchemaBuilder()->hasTable($table)) {
                $query = DB::table($table)->select('*', DB::raw("'$table' as table_name"));

                // Apply filters
                if ($searchTerm) {
                    $query->where('act_name', 'LIKE', "%{$searchTerm}%");
                }

                if ($lawId) {
                    $query->where('law_id', $lawId);
                }

                if ($jurisdictionId) {
                    $query->where('jurisdiction_id', $jurisdictionId);
                }

                if ($actId) {
                    $query->where('act_id', $actId);
                }

                if ($languageId) {
                    $query->where(function($q) use ($languageId) {
                        $q->where('language_id', $languageId)
                          ->orWhere('language', $this->getLanguageCode($languageId));
                    });
                }

                $legalTables = $legalTables->merge($query->get());
            }
        }

        // Sort results and limit if there are results
        if ($legalTables->isNotEmpty()) {
            $legalTables = $legalTables->sortBy('act_name')->take(50);
        }

        return view('user-legal-tables', compact('legalTables'));
    }

    /**
     * Show user notes and annotations
     */
    public function notes()
    {
        $user = Auth::user();
        
        // Get user's personal notes (not associated with any client)
        $notes = UserTextData::where('user_id', $user->id)
            ->whereNull('client_id') // Personal notes have no client association
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('user-notes', compact('notes'));
    }

    /**
     * Show user templates (personal templates)
     */
    public function templates()
    {
        $user = Auth::user();
        
        // Get user's personal templates (not associated with any client)
        $templates = UserTemplate::where('user_id', $user->id)
            ->whereNull('client_id') // Personal templates have no client association
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('user-templates', compact('templates'));
    }

    /**
     * Show immigration programs
     */
    public function immigrationPrograms()
    {
        // This would be a new feature - immigration programs information
        $programs = [
            [
                'name' => 'Express Entry',
                'description' => 'Federal program for skilled workers',
                'category' => 'Economic Immigration',
                'processing_time' => '6 months'
            ],
            [
                'name' => 'Provincial Nominee Program (PNP)',
                'description' => 'Provincial programs for specific skills',
                'category' => 'Economic Immigration',
                'processing_time' => '8-12 months'
            ],
            [
                'name' => 'Family Class',
                'description' => 'Sponsorship of family members',
                'category' => 'Family Immigration',
                'processing_time' => '12-24 months'
            ],
            [
                'name' => 'Quebec Immigration',
                'description' => 'Quebec-specific immigration programs',
                'category' => 'Provincial Immigration',
                'processing_time' => '6-18 months'
            ]
        ];

        return view('user-immigration-programs', compact('programs'));
    }

    /**
     * Show support page
     */
    public function support()
    {
        return view('user-support');
    }

    /**
     * Store user note (personal note)
     */
    public function storeNote(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'document_id' => 'nullable|string',
            'table_name' => 'nullable|string',
            'title' => 'nullable|string|max:255'
        ]);

        $note = UserTextData::create([
            'user_id' => Auth::id(),
            'client_id' => null, // Personal note - no client association
            'document_id' => $request->document_id,
            'table_name' => $request->table_name,
            'title' => $request->title ?: 'Personal Note',
            'content' => $request->content,
            'type' => 'personal_note'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Personal note saved successfully',
            'note' => $note
        ]);
    }

    /**
     * Store user template (personal template)
     */
    public function storeTemplate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100'
        ]);

        $template = UserTemplate::create([
            'user_id' => Auth::id(),
            'client_id' => null, // Personal template - no client association
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category ?: 'General',
            'type' => 'personal_template'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Personal template saved successfully',
            'template' => $template
        ]);
    }

    /**
     * Update user note
     */
    public function updateNote(Request $request, $id)
    {
        $note = UserTextData::where('user_id', Auth::id())
            ->whereNull('client_id')
            ->findOrFail($id);

        $request->validate([
            'content' => 'required|string',
            'title' => 'nullable|string|max:255'
        ]);

        $note->update([
            'title' => $request->title ?: $note->title,
            'content' => $request->content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Note updated successfully',
            'note' => $note
        ]);
    }

    /**
     * Delete user note
     */
    public function deleteNote($id)
    {
        $note = UserTextData::where('user_id', Auth::id())
            ->whereNull('client_id')
            ->findOrFail($id);

        $note->delete();

        return response()->json([
            'success' => true,
            'message' => 'Note deleted successfully'
        ]);
    }

    /**
     * Helper method to get language code
     */
    private function getLanguageCode($languageId)
    {
        $codes = [
            1 => 'en',
            2 => 'fr',
            3 => 'Both'
        ];

        return $codes[$languageId] ?? null;
    }
}
