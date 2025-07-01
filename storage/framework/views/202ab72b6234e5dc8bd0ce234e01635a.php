<?php
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
?>

<?php $__env->startSection('content'); ?>
<div class="client-section">
    <div class="container">        <!-- Add Client Form -->
        <div class="btn-shadow bg_custom p-4 rounded shadow-sm">
            <form method="POST" action="<?php echo e(route('clients.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="add_client" value="1">
                <div class="row">    
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" data-en="Add New Client" data-fr="Ajouter un nouveau client">Add New Client</h5>
                        <!-- Move button inside form and make it a submit button -->
                        <button type="submit" class="btn add-client-btn btn-custom" data-en="Add New Client" data-fr="Ajouter un nouveau client">Add New Client</button>
                    </div>
                </div>
                <div>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php elseif(session('error')): ?>
                        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="client_name" data-en="Client Name" data-fr="Nom du client">Client Name</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="client_email" data-en="Email" data-fr="Courriel">Email</label>
                                <input type="email" class="form-control" id="client_email" name="client_email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="client_status" data-en="Status" data-fr="Statut">Status</label>
                                <select class="form-control" id="client_status" name="client_status" required>
                                    <option value="Active" data-en="Active" data-fr="Actif">Active</option>
                                    <option value="Inactive" data-en="Inactive" data-fr="Inactif">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Client Cards Section -->
        <div class="gap_top btn-shadow bg_custom p-4 rounded shadow-sm">
            <div class="card-header">
                <div class="clients-header">
                    <h5 data-en="Your Clients" data-fr="Vos clients">Your Clients</h5>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="clientSearch" placeholder="Search clients..." data-placeholder-en="Search clients..." data-placeholder-fr="Rechercher des clients...">
                    </div>
                </div>
            </div>
            <div class="card-body">                <div class="client-grid" id="clientGrid">
                    <?php
                    $user_id = Auth::id();
                    $clients = [];
                    $most_recent = null;
                    $total_pages = 1;
                    $page = request()->get('page', 1);
                    
                    // Get clients and most recent access time
                    try {
                        $clients_per_page = 8;
                        $offset = ($page - 1) * $clients_per_page;
                        
                        // Debug log to verify user_id
                        Log::info('Fetching clients for user_id: ' . $user_id);
                        
                        // Direct query to check if table exists
                        $tableExists = DB::select("SHOW TABLES LIKE 'client_table'");
                        if(empty($tableExists)) {
                            Log::error('client_table does not exist in the database');
                        } else {
                            // Get table structure
                            $columns = DB::select("SHOW COLUMNS FROM client_table");
                            $columnNames = array_map(function($col) { return $col->Field; }, $columns);
                            Log::info('client_table columns: ' . implode(', ', $columnNames));
                            
                            // Fetch clients for this page - using basic query to avoid issues
                            $clients = DB::table('client_table')
                                ->where('user_id', $user_id)
                                ->orderBy('id', 'desc')
                                ->get();
                            
                            $total_clients = count($clients);
                            $total_pages = ceil($total_clients / $clients_per_page);
                            
                            // Paginate manually
                            $clients = $clients->slice($offset, $clients_per_page);
                            
                            // Debug log to check results
                            Log::info('Found ' . count($clients) . ' clients for user_id ' . $user_id);
                        }
                    } catch (\Exception $e) {
                        // Log error
                        Log::error('Error fetching clients: ' . $e->getMessage());
                    }
                    ?>
                      <?php if(!$clients || count($clients) == 0): ?>
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h4 data-en="No Clients Found" data-fr="Aucun client trouvé">No Clients Found</h4>
                            <p data-en="Add your first client to get started" data-fr="Ajoutez votre premier client pour commencer">Add your first client to get started</p>
                        </div>
                    <?php else: ?>                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                <?php
                                $initial = strtoupper(substr($client->client_name ?? 'U', 0, 1));
                                $status = isset($client->client_status) ? strtolower($client->client_status) : 'unknown';
                                $is_recent = false;
                                $time_ago = '';
                                
                                // Check if the last_accessed column exists before using it
                                if (isset($client->last_accessed) && !empty($client->last_accessed) && $client->last_accessed !== null) {
                                    // Check if this is the most recently accessed client
                                    if($most_recent && $client->last_accessed == $most_recent) {
                                        $is_recent = true;
                                    }
                                    
                                    try {
                                        $last_accessed = new DateTime($client->last_accessed);
                                        $now = new DateTime();
                                        $interval = $now->diff($last_accessed);
                                        
                                        // Create time ago string with data attributes for translation
                                        $time_value = '';
                                        $time_unit_en = '';
                                        $time_unit_fr = '';
                                        
                                        if ($interval->y > 0) {
                                            $time_value = $interval->y;
                                            $time_unit_en = ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                                            $time_unit_fr = ' an' . ($interval->y > 1 ? 's' : '') . ' il y a';
                                        } elseif ($interval->m > 0) {
                                            $time_value = $interval->m;
                                            $time_unit_en = ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                                            $time_unit_fr = ' mois il y a';
                                        } elseif ($interval->d > 0) {
                                            $time_value = $interval->d;
                                            $time_unit_en = ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                                            $time_unit_fr = ' jour' . ($interval->d > 1 ? 's' : '') . ' il y a';
                                        } elseif ($interval->h > 0) {
                                            $time_value = $interval->h;
                                            $time_unit_en = ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                                            $time_unit_fr = ' heure' . ($interval->h > 1 ? 's' : '') . ' il y a';
                                        } elseif ($interval->i > 0) {
                                            $time_value = $interval->i;
                                            $time_unit_en = ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                                            $time_unit_fr = ' minute' . ($interval->i > 1 ? 's' : '') . ' il y a';
                                        } else {
                                            $time_value = '';
                                            $time_unit_en = 'just now';
                                            $time_unit_fr = 'à l\'instant';
                                        }
                                        
                                        $time_ago = $time_value . $time_unit_en;
                                        
                                    } catch (\Exception $e) {
                                        Log::error('Error formatting date: ' . $e->getMessage());
                                    }
                                }
                            ?><div class="client-card">
                                <div class="client-avatar"><?php echo e($initial); ?></div>
                                <div class="client-info">
                                    <div class="client-name"><?php echo e($client->client_name); ?></div>
                                    <?php if(isset($client->client_email)): ?>
                                    <div class="client-email"><?php echo e($client->client_email); ?></div>
                                    <?php endif; ?> 
                                    <div class="client-status d-flex align-items-center justify-content-center gap-2 mt-2">
                                        <?php if(isset($client->client_status)): ?>
                                        <span class="badge bg-<?php echo e($client->client_status == 'Active' ? 'success' : 'secondary'); ?>">
                                            <?php echo e($client->client_status); ?>

                                        </span>
                                        <?php endif; ?>
                                        <?php if($is_recent): ?>
                                            <div class="recent-badge" data-en="Recent" data-fr="Récent">Recent <i class="fa-solid fa-clock-rotate-left"></i></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($time_ago)): ?>
                                        <div class="last-accessed mt-2">
                                            <small>
                                                <span data-en="Last accessed:" data-fr="Dernier accès :">Last accessed:</span> 
                                                <?php if(!empty($time_value)): ?>
                                                    <?php echo e($time_value); ?><span data-en="<?php echo e($time_unit_en); ?>" data-fr="<?php echo e($time_unit_fr); ?>"><?php echo e($time_unit_en); ?></span>
                                                <?php else: ?>
                                                    <span data-en="<?php echo e($time_unit_en); ?>" data-fr="<?php echo e($time_unit_fr); ?>"><?php echo e($time_unit_en); ?></span>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                    <?php endif; ?>                                     
                                </div>
                                <div class="client-actions">
                                    <form action="<?php echo e(route('user.client.legal-tables', $client->id)); ?>" method="GET" style="display:inline;">
                                        <button type="submit" class="btn-custom2 select-client-btn" data-en="Select Client" data-fr="Sélectionner le client">
                                            Select Client
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                  <?php if(isset($total_pages) && $total_pages > 1): ?>
                <div class="pagination" id="pagination">
                    <button onclick="changePage(1)" <?php echo e($page == 1 ? 'disabled' : ''); ?>>&laquo;</button>
                    <button onclick="changePage(<?php echo e(max(1, $page - 1)); ?>)" <?php echo e($page == 1 ? 'disabled' : ''); ?>>&lsaquo;</button>
                    
                    <?php for($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                        <button onclick="changePage(<?php echo e($i); ?>)" <?php echo e($page == $i ? 'class="active"' : ''); ?>><?php echo e($i); ?></button>
                    <?php endfor; ?>
                    
                    <button onclick="changePage(<?php echo e(min($total_pages, $page + 1)); ?>)" <?php echo e($page == $total_pages ? 'disabled' : ''); ?>>&rsaquo;</button>
                    <button onclick="changePage(<?php echo e($total_pages); ?>)" <?php echo e($page == $total_pages ? 'disabled' : ''); ?>>&raquo;</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    body {
        background-color: var(--bg-color);
        color: var(--text-color);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .client-section {
        padding: 2rem 0;
    }

    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 2rem;
        overflow: hidden;
        transition: var(--transition);
    }

    .card:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        position: relative;
    }

    .card-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .card-header h5 {
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
        color: var(--text-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    /* Client Cards Section */
    .clients-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .search-box {
        position: relative;
        width: 300px;
    }

    .search-box input {
        width: 100%;
        padding: 0.75rem 1.25rem 0.75rem 3rem;
        border-radius: 50px;
        border: 1px solid #e0e0e0;
        transition: var(--transition);
    }

    .search-box input:focus {
        border-color: var(--primary-color);
    }

    .search-box i {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--light-text);
    }

    .client-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .client-card {
        background: var(--color-card-bg);
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(30, 28, 28, 0.64);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
    }

    .client-card .recent-badge {
        background-color: var(--color-danger);
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        opacity: 0.9;
    }

    .client-card .last-accessed {
        color: var(--light-text);
        font-size: 0.8rem;
        margin-top: 0.5rem;
        text-align: center;
    }

    .client-avatar {
        width: 70px;
        height: 70px;
        background: var(--color-theme-3);
        border-radius: 50%;
        margin: 0 auto 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: #fff;
        font-weight: 600;
    }

    .client-info {
        text-align: center;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .client-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    .client-email {
        color: var(--light-text);
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
        word-break: break-all;
    }

    .client-status {
        justify-content: center;
        display: flex;
    }

    .client-actions {
        margin-top: auto;
    }

    .select-client-btn {
        width: 100%;
        padding: 0.75rem;
        background-color: var(--color-theme-3);
        color: white;
        border-radius: 8px;
        font-weight: 500;
        transition: var(--transition);
        cursor: pointer;
    }

    .add-client-btn {
        width: 20%;
        padding: 0.75rem;
        background-color: var(--color-theme-3);
        color: white;
        border-radius: 8px;
        font-weight: 500;
        transition: var(--transition);
        cursor: pointer;
        max-width: 180px !important;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--light-text);
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #e0e0e0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .client-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }
        
        .clients-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .search-box {
            width: 100%;
            margin-top: 1rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Dashboard translation functionality
    function translateDashboard() {
        const currentLang = localStorage.getItem('selectedLanguage') || 'en';
        
        // Translate all elements with data attributes
        document.querySelectorAll('[data-en][data-fr]').forEach(element => {
            const translation = element.getAttribute(`data-${currentLang}`);
            if (translation) {
                // Handle different element types
                if (element.tagName === 'INPUT' && element.type === 'text') {
                    // For input placeholders
                    const placeholderAttr = `data-placeholder-${currentLang}`;
                    if (element.hasAttribute(placeholderAttr)) {
                        element.placeholder = element.getAttribute(placeholderAttr);
                    }
                } else if (element.tagName === 'OPTION') {
                    // For select options
                    element.textContent = translation;
                } else {
                    // For regular text elements, preserve icons if they exist
                    const icon = element.querySelector('i');
                    if (icon) {
                        element.innerHTML = translation + ' ' + icon.outerHTML;
                    } else {
                        element.textContent = translation;
                    }
                }
            }
        });
        
        // Handle placeholder specifically for search input
        const searchInput = document.getElementById('clientSearch');
        if (searchInput) {
            const placeholderAttr = `data-placeholder-${currentLang}`;
            if (searchInput.hasAttribute(placeholderAttr)) {
                searchInput.placeholder = searchInput.getAttribute(placeholderAttr);
            }
        }
        
        // Update empty state messages if they exist
        updateEmptyStateMessages(currentLang);
    }
    
    // Function to update empty state messages
    function updateEmptyStateMessages(lang) {
        const emptyState = document.querySelector('.empty-state');
        if (emptyState) {
            const h4 = emptyState.querySelector('h4');
            const p = emptyState.querySelector('p');
            
            if (h4 && h4.hasAttribute('data-en') && h4.hasAttribute('data-fr')) {
                h4.textContent = h4.getAttribute(`data-${lang}`);
            }
            if (p && p.hasAttribute('data-en') && p.hasAttribute('data-fr')) {
                p.textContent = p.getAttribute(`data-${lang}`);
            }
        }
    }
    
    // Function to create translated empty state for search results
    function createTranslatedSearchEmptyState(lang) {
        const translations = {
            en: {
                title: 'No Matching Clients',
                message: 'Try a different search term'
            },
            fr: {
                title: 'Aucun client correspondant',
                message: 'Essayez un autre terme de recherche'
            }
        };
        
        return `
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <h4>${translations[lang].title}</h4>
                <p>${translations[lang].message}</p>
            </div>
        `;
    }
    
    // Initialize translation on page load
    document.addEventListener('DOMContentLoaded', function() {
        translateDashboard();
        
        // Listen for language changes from the header
        window.addEventListener('languageChanged', function() {
            translateDashboard();
        });
    });

    // Pagination functionality
    function changePage(page) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('page', page);
        window.location.href = currentUrl.toString();
    }    // Client search functionality
    document.getElementById('clientSearch').addEventListener('input', function(e) {
        const searchText = e.target.value.toLowerCase();
        const clientCards = document.querySelectorAll('.client-card');

        let hasVisibleCards = false;
        
        clientCards.forEach(card => {
            const name = card.querySelector('.client-name') ? card.querySelector('.client-name').textContent.toLowerCase() : '';
            const email = card.querySelector('.client-email') ? card.querySelector('.client-email').textContent.toLowerCase() : '';
            const status = card.querySelector('.badge') ? card.querySelector('.badge').textContent.toLowerCase() : '';

            if (name.includes(searchText) || email.includes(searchText) || status.includes(searchText)) {
                card.style.display = '';
                hasVisibleCards = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Show empty state if no cards match search
        const emptyState = document.querySelector('.empty-state');
        const currentLang = localStorage.getItem('selectedLanguage') || 'en';
        
        if (!hasVisibleCards && !emptyState) {
            document.querySelector('.client-grid').innerHTML = createTranslatedSearchEmptyState(currentLang);
        } else if (hasVisibleCards && emptyState && emptyState.querySelector('h4').textContent.includes('Matching') || emptyState.querySelector('h4').textContent.includes('correspondant')) {
            location.reload(); // Reload to show original cards when search is cleared
        }
    });    // Client selection functionality
    /*
    document.querySelectorAll('.select-client-btn').forEach(button => {
        button.addEventListener('click', function() {
            const clientId = this.dataset.clientId;
            const clientName = this.dataset.clientName;
            
            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Selecting...';
            this.disabled = true;
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            // Check if CSRF token exists
            if (!csrfToken) {
                console.error('CSRF token not found');
                alert('CSRF token not found. Please refresh the page.');
                this.innerHTML = 'Select Client';
                this.disabled = false;
                return;
            }

            console.log('Sending select-client request with client ID:', clientId);

            fetch('/select-client', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: `client_id=${encodeURIComponent(clientId)}&client_name=${encodeURIComponent(clientName)}`
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                
                if (data.success) {
                    // Update the client display in the navigation bar
                    const currentClientSpan = document.getElementById('current-client');
                    if (currentClientSpan) {
                        currentClientSpan.textContent = clientName;
                    }
                    
                    // Show success message
                    alert('Client selected successfully. Redirecting to documents page...');
                    
                    // Redirect after successful selection
                    if (data.redirect) {
                        console.log('Redirecting to:', data.redirect);
                        window.location.href = data.redirect;
                    } else {
                        // Default fallback redirect
                        console.log('Using default redirect to /documents');
                        window.location.href = '/documents';
                    }
                } else {
                    this.innerHTML = 'Select Client';
                    this.disabled = false;
                    alert('Failed to select client: ' + (data.message || 'Unknown error'));
                }
            })            .catch(error => {
                console.error('Error:', error);
                this.innerHTML = 'Select Client';
                this.disabled = false;
                alert('An error occurred while selecting the client. Check the console for details.');
            });
        });
    });
    */

    // Translation functionality for user dashboard
    function translateDashboardPage(language) {
        // Translate all elements with data attributes
        const elements = document.querySelectorAll('[data-en][data-fr]');
        elements.forEach(element => {
            const translation = element.getAttribute('data-' + language);
            if (translation) {
                element.textContent = translation;
            }
        });

        // Translate placeholder texts
        const placeholderElements = document.querySelectorAll('[data-placeholder-en][data-placeholder-fr]');
        placeholderElements.forEach(element => {
            const placeholder = element.getAttribute('data-placeholder-' + language);
            if (placeholder) {
                element.placeholder = placeholder;
            }
        });

        // Translate select options  
        const options = document.querySelectorAll('option[data-en][data-fr]');
        options.forEach(option => {
            const translation = option.getAttribute('data-' + language);
            if (translation) {
                option.textContent = translation;
            }
        });

        // Translate button text and values
        const buttons = document.querySelectorAll('button[data-en][data-fr]');
        buttons.forEach(button => {
            const translation = button.getAttribute('data-' + language);
            if (translation) {
                button.textContent = translation;
                // Also update the value attribute if it exists
                if (button.hasAttribute('value')) {
                    button.value = translation;
                }
            }
        });
    }

    // Listen for language change events from the main layout
    window.addEventListener('languageChanged', function(event) {
        const selectedLanguage = event.detail.language;
        translateDashboardPage(selectedLanguage);
    });

    // Apply saved language on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
        translateDashboardPage(savedLanguage);
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/immif732/jurislocator/resources/views/user-dashboard.blade.php ENDPATH**/ ?>