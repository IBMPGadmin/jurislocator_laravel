

<?php $__env->startSection('content'); ?>


   
    <div class="main-content container-fluid">
        <div class="row sec-title title-default px-4">
            <div class="col-12">
                <h2>Dashboard</h2>
            </div>
        </div>
        <div class="row  p-4">
            <div class="tile-warpper sp-top col-lg-3 col-md-4 col-sm-6">
                <div class="tile-body tile shadow-sm">
                    <div class="tile-icon">
                        <i class="fas fa-scroll"></i>
                    </div>
                    <div class="tile-content">
                        <h5 class="tile-title">Legislation</h5>
                        <p class="tile-desc">Access comprehensive and up-to-date compilations of Acts, Regulations, and legal amendments. JurisLocator enables you to browse or search legal statutes easily and efficiently.</p>
                        <a href="<?php echo e(route('client.management')); ?>" class="btn btn-neutral">Access Now</a>
                    </div>
                </div>
            </div>
            <div class="tile-warpper sp-top col-lg-3 col-md-4 col-sm-6">
                <div class="tile-body tile shadow-sm">
                    <div class="tile-icon">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <div class="tile-content">
                        <h5 class="tile-title">CaseLaw </h5>
                        <p class="tile-desc">Explore court decisions and legal precedents with our powerful CaseLaw tool. Quickly find detailed case summaries and registry data using keyword or citation-based search.</p>
                        <a href="#" class="btn btn-neutral">Browse Laws</a>
                    </div>
                </div>
            </div>
            <div class="tile-warpper sp-top col-lg-3 col-md-4 col-sm-6">
                <div class="tile-body tile shadow-sm">
                    <div class="tile-icon">
                        <i class="fas fa-note-sticky"></i>
                    </div>
                    <div class="tile-content">
                        <h5 class="tile-title">My Notes & Annotations</h5>
                        <p class="tile-desc">Organize your legal research with personal notes and document annotations. Save, edit, and retrieve key insights across cases, laws, or regulatory texts.</p>
                        <a href="#" class="btn btn-neutral">View Notes</a>
                    </div>
                </div>
            </div>
            <div class="tile-warpper sp-top col-lg-3 col-md-4 col-sm-6">
                <div class="tile-body tile shadow-sm">
                    <div class="tile-icon">
                        <i class="fas fa-passport"></i>
                    </div>
                    <div class="tile-content">
                        <h5 class="tile-title">Immigration Programs</h5>
                        <p class="tile-desc">Discover and compare Canadian immigration pathways including Express Entry, Provincial Nominee Programs (PNP), and more. Filter by eligibility, requirements, or program type.</p>
                        <a href="#" class="btn btn-neutral">View Programs</a>
                    </div>
                </div>
            </div>
            <div class="tile-warpper sp-top col-lg-3 col-md-4 col-sm-6">
                <div class="tile-body tile shadow-sm">
                    <div class="tile-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <div class="tile-content">
                        <h5 class="tile-title">Resources</h5>
                        <p class="tile-desc">Get access to downloadable templates, legal forms, and government reference links. JurisLocator's resource center helps you stay equipped with tools for legal efficiency.</p>
                        <a href="#" class="btn btn-neutral">Browse Resources</a>
                    </div>
                </div>
            </div>
            <div class="tile-warpper sp-top col-lg-3 col-md-4 col-sm-6">
                <div class="tile-body tile shadow-sm">
                    <div class="tile-icon">
                        <i class="fas fa-toolbox"></i>
                    </div>
                    <div class="tile-content">
                        <h5 class="tile-title">Tools</h5>
                        <p class="tile-desc">
                            Access practical tools designed for immigration consultants and legal professionals — including age calculators, time zone planners, currency converters, and more.
                        </p>
                        <a href="/tools" class="btn btn-neutral">Browse Tools</a>
                    </div>
                </div>
            </div>

            <div class="tile-warpper sp-top col-lg-3 col-md-4 col-sm-6">
                <div class="tile-body tile shadow-sm">
                    <div class="tile-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="tile-content">
                        <h5 class="tile-title">Support</h5>
                        <p class="tile-desc">Need help using JurisLocator or managing your legal content? Access our client support portal for ticket submissions, real-time chat assistance, and personalized help from our team.</p>
                        <a href="#" class="btn btn-neutral">Get Support</a>
                    </div>
                </div>
            </div>

            <!-- Tools Card -->
            <!-- <div class="dashboard-card" onclick="window.location.href='<?php echo e(route('user.tools')); ?>'">
                <div class="card-icon tools-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="card-content">
                    <h3 data-en="Tools" data-fr="Outils">Tools</h3>
                    <p data-en="Access useful calculators and time zone tools" data-fr="Accédez aux calculatrices utiles et aux outils de fuseau horaire">Access useful calculators and time zone tools</p>
                    <button class="card-button" data-en="View Tools" data-fr="Voir les outils">View Tools</button>
                </div>
            </div> -->
        </div>
        <div class="row sec-title title-default px-4">
            <div class="col-12">
                <h2>Quick Access</h2>
            </div>
        </div>
        <div class="row p-4 rounded shadow-sm">
            <div class="col-lg-4 col-md-6">
                <div class="widget sp-top widget-default widget-form widget-vertical shadow-sm">
                    <div class="widget-title">
                        <h5>Take a Note</h5>
                    </div>
                    <div class="widget-body">
                        <form id="takeQuickNote" class="form widget-form-body">
                            <div class="form-group mb-3">
                                <label for="clientNameVertical" class="form-label">Note Title</label>
                                <input type="text" class="form-control" id="quickNoteTitle" name="quickNoteTitle" placeholder="Enter client name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="takeQuickNote" class="form-label">Note Content</label>
                                <textarea class="form-control"  id="quickNoteContent" name="noteContent" rows="4" placeholder="Enter the note content"></textarea>
                            </div>
                            <div class="form-group d-flex gap-2">
                              <button type="submit" class="btn btn-action">Add Note</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="widget sp-top widget-default widget-form widget-vertical shadow-sm">
                    <div class="widget-title">
                        <h5>Jurislocator Events and News</h5>
                    </div>
                    <div class="widget-body">
                        <div class="juris-news-list mt-3">
                            <div class="news-item">
                                <div class="news-title">📢 Scheduled Maintenance – July 6</div>
                                <div class="news-content">JurisLocator services will be temporarily unavailable on Saturday, July 6 from 1 AM to 3 AM EST for scheduled upgrades.</div>
                            </div>

                            <div class="news-item">
                                <div class="news-title">📌 New Immigration Templates Released</div>
                                <div class="news-content">We've added 4 new legal document templates to the Resources section including PNP invitation replies and post-ITA checklists.</div>
                            </div>

                            <div class="news-item">
                                <div class="news-title">📊 Quarterly Webinar – Register Now</div>
                                <div class="news-content">Join our July webinar on advanced legal search strategies inside JurisLocator. Spaces are limited—reserve now!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="activity-content">
                        <h4 data-en="Searched for family class immigration regulations" data-fr="Recherché les règlements d'immigration de la classe familiale">Searched for family class immigration regulations</h4>
                        <p data-en="1 day ago" data-fr="Il y a 1 jour">1 day ago</p>
                    </div>
                </div> -->
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

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\13\jurislocator_laravel\resources\views/home-dashboard.blade.php ENDPATH**/ ?>