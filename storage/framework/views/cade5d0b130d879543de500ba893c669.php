

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="dashboard-title" data-en="Welcome to JurisLocator" data-fr="Bienvenue sur JurisLocator">Welcome to JurisLocator</h1>
            <p class="dashboard-subtitle" data-en="Your comprehensive legal research platform" data-fr="Votre plateforme de recherche juridique complète">Your comprehensive legal research platform</p>
        </div>

        <!-- Main Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Legislation Card -->
            <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('user.legal-tables')); ?>'">
                <div class="card-icon legislation-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="Legislation" data-fr="Législation">Legislation</h3>
                    <p data-en="Access Acts, Regulations, and Legal Statutes" data-fr="Accédez aux lois, règlements et statuts juridiques">Access Acts, Regulations, and Legal Statutes</p>
                    <button class="card-button" data-en="Browse Laws" data-fr="Parcourir les lois">Browse Laws</button>
                </div>
            </div>

            <!-- CaseLaw Card -->
            <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('documents.index')); ?>'">
                <div class="card-icon caselaw-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="CaseLaw" data-fr="Jurisprudence">CaseLaw</h3>
                    <p data-en="Search Court Decisions and Legal Precedents" data-fr="Recherchez les décisions de justice et les précédents juridiques">Search Court Decisions and Legal Precedents</p>
                    <button class="card-button" data-en="View Cases" data-fr="Voir les cas">View Cases</button>
                </div>
            </div>

            <!-- My Notes & Annotations Card -->
            <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('user.templates.index')); ?>'">
                <div class="card-icon notes-icon">
                    <i class="fas fa-sticky-note"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="My Notes & Annotations" data-fr="Mes notes et annotations">My Notes & Annotations</h3>
                    <p data-en="Manage your personal research notes and document annotations" data-fr="Gérez vos notes de recherche personnelles et annotations de documents">Manage your personal research notes and document annotations</p>
                    <button class="card-button" data-en="View Notes" data-fr="Voir les notes">View Notes</button>
                </div>
            </div>

            <!-- Immigration Programs Card -->
            <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('user.government-links')); ?>'">
                <div class="card-icon immigration-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="Immigration Programs" data-fr="Programmes d'immigration">Immigration Programs</h3>
                    <p data-en="Explore Immigration Programs and Requirements" data-fr="Explorez les programmes d'immigration et les exigences">Explore Immigration Programs and Requirements</p>
                    <button class="card-button" data-en="View Programs" data-fr="Voir les programmes">View Programs</button>
                </div>
            </div>

            <!-- Resources Card -->
            <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('user.government-links')); ?>'">
                <div class="card-icon resources-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="Resources" data-fr="Ressources">Resources</h3>
                    <p data-en="Access Government Links, Templates, and Legal Tools" data-fr="Accédez aux liens gouvernementaux, modèles et outils juridiques">Access Government Links, Templates, and Legal Tools</p>
                    <button class="card-button" data-en="Browse Resources" data-fr="Parcourir les ressources">Browse Resources</button>
                </div>
            </div>

            <!-- Support Card -->
            <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('profile.edit')); ?>'">
                <div class="card-icon support-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="Support" data-fr="Soutien">Support</h3>
                    <p data-en="Get help with using JurisLocator and legal research" data-fr="Obtenez de l'aide pour utiliser JurisLocator et la recherche juridique">Get help with using JurisLocator and legal research</p>
                    <button class="card-button" data-en="Get Support" data-fr="Obtenir de l'aide">Get Support</button>
                </div>
            </div>

            <!-- Tools Card -->
            <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('user.tools')); ?>'">
                <div class="card-icon tools-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="Tools" data-fr="Outils">Tools</h3>
                    <p data-en="Access useful calculators and time zone tools" data-fr="Accédez aux calculatrices utiles et aux outils de fuseau horaire">Access useful calculators and time zone tools</p>
                    <button class="card-button" data-en="View Tools" data-fr="Voir les outils">View Tools</button>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="quick-actions">
            <h2 data-en="Quick Actions" data-fr="Actions rapides">Quick Actions</h2>
            <div class="action-buttons">
                <a href="<?php echo e(route('user.legal-tables')); ?>" class="action-btn quick-search">
                    <i class="fas fa-search"></i>
                    <span data-en="Quick Search" data-fr="Recherche rapide">Quick Search</span>
                </a>
                <a href="<?php echo e(route('user.templates.index')); ?>" class="action-btn my-templates">
                    <i class="fas fa-file-alt"></i>
                    <span data-en="My Templates" data-fr="Mes modèles">My Templates</span>
                </a>
                <a href="<?php echo e(route('user.legal-key-terms.index')); ?>" class="action-btn legal-terms">
                    <i class="fas fa-bookmark"></i>
                    <span data-en="Legal Terms" data-fr="Termes juridiques">Legal Terms</span>
                </a>
                <a href="<?php echo e(route('user.rcic-deadlines.index')); ?>" class="action-btn deadlines">
                    <i class="fas fa-calendar-alt"></i>
                    <span data-en="Deadlines" data-fr="Délais">Deadlines</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="recent-activity">
            <h2 data-en="Recent Activity" data-fr="Activité récente">Recent Activity</h2>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <div class="activity-content">
                        <h4 data-en="Viewed Immigration and Refugee Protection Act" data-fr="Consulté la Loi sur l'immigration et la protection des réfugiés">Viewed Immigration and Refugee Protection Act</h4>
                        <p data-en="2 hours ago" data-fr="Il y a 2 heures">2 hours ago</p>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <div class="activity-content">
                        <h4 data-en="Added personal note on refugee status determination" data-fr="Ajouté une note personnelle sur la détermination du statut de réfugié">Added personal note on refugee status determination</h4>
                        <p data-en="6 hours ago" data-fr="Il y a 6 heures">6 hours ago</p>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="activity-content">
                        <h4 data-en="Searched for family class immigration regulations" data-fr="Recherché les règlements d'immigration de la classe familiale">Searched for family class immigration regulations</h4>
                        <p data-en="1 day ago" data-fr="Il y a 1 jour">1 day ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.welcome-section {
    text-align: center;
    margin-bottom: 3rem;
}

.dashboard-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.dashboard-subtitle {
    font-size: 1.2rem;
    color: #7f8c8d;
    margin-bottom: 0;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.dashboard-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: 1px solid #e9ecef;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #007bff;
}

.card-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
}

.legislation-icon { background: linear-gradient(135deg, #3498db, #2980b9); }
.caselaw-icon { background: linear-gradient(135deg, #f1c40f, #f39c12); }
.notes-icon { background: linear-gradient(135deg, #2ecc71, #27ae60); }
.immigration-icon { background: linear-gradient(135deg, #00bcd4, #0097a7); }
.resources-icon { background: linear-gradient(135deg, #9b59b6, #8e44ad); }
.support-icon { background: linear-gradient(135deg, #95a5a6, #7f8c8d); }
.tools-icon { background: linear-gradient(135deg, #e67e22, #d35400); }

.card-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.card-content p {
    color: #7f8c8d;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.card-button {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.card-button:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: scale(1.05);
}

.quick-actions {
    margin-bottom: 3rem;
}

.quick-actions h2 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    text-decoration: none;
    color: #495057;
    transition: all 0.3s ease;
}

.action-btn:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
    text-decoration: none;
}

.recent-activity h2 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.activity-list {
    background: white;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    overflow: hidden;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f8f9fa;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #007bff, #0056b3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
}

.activity-content h4 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    color: #2c3e50;
}

.activity-content p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .dashboard-card {
        padding: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-btn {
        justify-content: center;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/home-dashboard.blade.php ENDPATH**/ ?>