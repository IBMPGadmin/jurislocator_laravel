@extends('layouts.user-layout')

@section('content')
<div class="container">
    <!-- Session Info Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="session-avatar me-3 d-flex justify-content-center align-items-center rounded-circle bg-secondary text-white" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="session-info">
                            <h4 class="mb-1" data-en="Support Center" data-fr="Centre de support">Support Center</h4>
                            <small class="text-muted" data-en="Get help with JurisLocator and legal research tools" data-fr="Obtenez de l'aide avec JurisLocator et les outils de recherche juridique">
                                Get help with JurisLocator and legal research tools
                            </small>
                        </div>
                    </div>
                    <div class="session-actions">
                        <a href="{{ route('user.home') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-home me-1"></i>
                            <span data-en="Home" data-fr="Accueil">Home</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Help Options -->
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="support-card text-center" onclick="showHelpSection('getting-started')">
                <div class="support-icon mb-3">
                    <i class="fas fa-play-circle text-primary" style="font-size: 3rem;"></i>
                </div>
                <h5 data-en="Getting Started" data-fr="Commencer">Getting Started</h5>
                <p class="text-muted" data-en="Learn the basics of using JurisLocator" data-fr="Apprenez les bases de l'utilisation de JurisLocator">Learn the basics of using JurisLocator</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="support-card text-center" onclick="showHelpSection('faq')">
                <div class="support-icon mb-3">
                    <i class="fas fa-question-circle text-info" style="font-size: 3rem;"></i>
                </div>
                <h5 data-en="FAQ" data-fr="FAQ">FAQ</h5>
                <p class="text-muted" data-en="Frequently asked questions and answers" data-fr="Questions fréquemment posées et réponses">Frequently asked questions and answers</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="support-card text-center" onclick="showHelpSection('contact')">
                <div class="support-icon mb-3">
                    <i class="fas fa-envelope text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 data-en="Contact Us" data-fr="Nous contacter">Contact Us</h5>
                <p class="text-muted" data-en="Get in touch with our support team" data-fr="Contactez notre équipe de support">Get in touch with our support team</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="support-card text-center" onclick="showHelpSection('tutorials')">
                <div class="support-icon mb-3">
                    <i class="fas fa-video text-warning" style="font-size: 3rem;"></i>
                </div>
                <h5 data-en="Video Tutorials" data-fr="Tutoriels vidéo">Video Tutorials</h5>
                <p class="text-muted" data-en="Watch step-by-step video guides" data-fr="Regardez des guides vidéo étape par étape">Watch step-by-step video guides</p>
            </div>
        </div>
    </div>

    <!-- Help Content Sections -->
    <div class="row">
        <div class="col-12">
            <!-- Getting Started Section -->
            <div id="getting-started" class="help-section" style="display: none;">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0" data-en="Getting Started with JurisLocator" data-fr="Commencer avec JurisLocator">Getting Started with JurisLocator</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 data-en="Session Modes" data-fr="Modes de session">Session Modes</h6>
                                <ul>
                                    <li data-en="Personal Session: Work with documents without client association" data-fr="Session personnelle : Travaillez avec des documents sans association client">Personal Session: Work with documents without client association</li>
                                    <li data-en="Client Session: Manage client-specific cases and documents" data-fr="Session client : Gérez les cas et documents spécifiques aux clients">Client Session: Manage client-specific cases and documents</li>
                                </ul>
                                
                                <h6 data-en="Navigation Tips" data-fr="Conseils de navigation">Navigation Tips</h6>
                                <ul>
                                    <li data-en="Use the search bar to find specific legal documents" data-fr="Utilisez la barre de recherche pour trouver des documents juridiques spécifiques">Use the search bar to find specific legal documents</li>
                                    <li data-en="Filter by jurisdiction, language, and document type" data-fr="Filtrez par juridiction, langue et type de document">Filter by jurisdiction, language, and document type</li>
                                    <li data-en="Save notes and annotations for future reference" data-fr="Sauvegardez des notes et annotations pour référence future">Save notes and annotations for future reference</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 data-en="Key Features" data-fr="Fonctionnalités clés">Key Features</h6>
                                <ul>
                                    <li data-en="Legal document search and browsing" data-fr="Recherche et navigation de documents juridiques">Legal document search and browsing</li>
                                    <li data-en="Personal notes and annotations" data-fr="Notes personnelles et annotations">Personal notes and annotations</li>
                                    <li data-en="Template management" data-fr="Gestion de modèles">Template management</li>
                                    <li data-en="Immigration program information" data-fr="Informations sur les programmes d'immigration">Immigration program information</li>
                                    <li data-en="Government links and resources" data-fr="Liens et ressources gouvernementaux">Government links and resources</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div id="faq" class="help-section" style="display: none;">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0" data-en="Frequently Asked Questions" data-fr="Questions fréquemment posées">Frequently Asked Questions</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        <span data-en="How do I switch between session modes?" data-fr="Comment passer d'un mode de session à l'autre ?">How do I switch between session modes?</span>
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p data-en="You can switch between Personal Session and Client Session by clicking the 'Switch Mode' button or by visiting the session selection page from the main menu." data-fr="Vous pouvez passer de la Session personnelle à la Session client en cliquant sur le bouton 'Changer de mode' ou en visitant la page de sélection de session depuis le menu principal.">
                                            You can switch between Personal Session and Client Session by clicking the 'Switch Mode' button or by visiting the session selection page from the main menu.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        <span data-en="How do I save notes on legal documents?" data-fr="Comment sauvegarder des notes sur les documents juridiques ?">How do I save notes on legal documents?</span>
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p data-en="While viewing a legal document, you can add notes by selecting text and clicking the annotation tool, or by using the notes panel on the side of the document viewer." data-fr="Lors de la visualisation d'un document juridique, vous pouvez ajouter des notes en sélectionnant du texte et en cliquant sur l'outil d'annotation, ou en utilisant le panneau de notes sur le côté du visualiseur de documents.">
                                            While viewing a legal document, you can add notes by selecting text and clicking the annotation tool, or by using the notes panel on the side of the document viewer.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        <span data-en="Can I export my templates and notes?" data-fr="Puis-je exporter mes modèles et notes ?">Can I export my templates and notes?</span>
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p data-en="Yes, you can export your personal templates and notes from the respective management pages. Look for the export button in the template or notes list." data-fr="Oui, vous pouvez exporter vos modèles personnels et notes depuis les pages de gestion respectives. Recherchez le bouton d'exportation dans la liste des modèles ou des notes.">
                                            Yes, you can export your personal templates and notes from the respective management pages. Look for the export button in the template or notes list.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                        <span data-en="How do I search for specific legal documents?" data-fr="Comment rechercher des documents juridiques spécifiques ?">How do I search for specific legal documents?</span>
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p data-en="Use the search bar on the legal tables page to enter keywords, act names, or regulation numbers. You can also filter by jurisdiction, language, and document category for more precise results." data-fr="Utilisez la barre de recherche sur la page des tables juridiques pour saisir des mots-clés, des noms de lois ou des numéros de règlement. Vous pouvez également filtrer par juridiction, langue et catégorie de document pour des résultats plus précis.">
                                            Use the search bar on the legal tables page to enter keywords, act names, or regulation numbers. You can also filter by jurisdiction, language, and document category for more precise results.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div id="contact" class="help-section" style="display: none;">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0" data-en="Contact Support" data-fr="Contacter le support">Contact Support</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form id="supportForm">
                                    <div class="mb-3">
                                        <label for="supportSubject" class="form-label" data-en="Subject" data-fr="Sujet">Subject</label>
                                        <select class="form-select" id="supportSubject" required>
                                            <option value="" data-en="Select a subject" data-fr="Sélectionner un sujet">Select a subject</option>
                                            <option value="technical" data-en="Technical Issue" data-fr="Problème technique">Technical Issue</option>
                                            <option value="account" data-en="Account Question" data-fr="Question de compte">Account Question</option>
                                            <option value="feature" data-en="Feature Request" data-fr="Demande de fonctionnalité">Feature Request</option>
                                            <option value="billing" data-en="Billing Inquiry" data-fr="Demande de facturation">Billing Inquiry</option>
                                            <option value="other" data-en="Other" data-fr="Autre">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="supportMessage" class="form-label" data-en="Message" data-fr="Message">Message</label>
                                        <textarea class="form-control" id="supportMessage" rows="6" required placeholder="Please describe your issue or question in detail..." data-placeholder-en="Please describe your issue or question in detail..." data-placeholder-fr="Veuillez décrire votre problème ou question en détail..."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="supportAttachment" class="form-label" data-en="Attachment (optional)" data-fr="Pièce jointe (optionnel)">Attachment (optional)</label>
                                        <input type="file" class="form-control" id="supportAttachment" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                        <small class="text-muted" data-en="Supported formats: JPG, PNG, PDF, DOC, DOCX (max 10MB)" data-fr="Formats supportés : JPG, PNG, PDF, DOC, DOCX (max 10MB)">Supported formats: JPG, PNG, PDF, DOC, DOCX (max 10MB)</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        <span data-en="Send Message" data-fr="Envoyer le message">Send Message</span>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-info">
                                    <h6 data-en="Other Ways to Reach Us" data-fr="Autres moyens de nous contacter">Other Ways to Reach Us</h6>
                                    
                                    <div class="contact-method mb-3">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <strong data-en="Email:" data-fr="Email :">Email:</strong><br>
                                        <a href="mailto:support@jurislocator.com">support@jurislocator.com</a>
                                    </div>
                                    
                                    <div class="contact-method mb-3">
                                        <i class="fas fa-phone text-success me-2"></i>
                                        <strong data-en="Phone:" data-fr="Téléphone :">Phone:</strong><br>
                                        +1 (555) 123-4567<br>
                                        <small class="text-muted" data-en="Mon-Fri 9AM-6PM EST" data-fr="Lun-Ven 9h-18h EST">Mon-Fri 9AM-6PM EST</small>
                                    </div>
                                    
                                    <div class="contact-method mb-3">
                                        <i class="fas fa-clock text-info me-2"></i>
                                        <strong data-en="Response Time:" data-fr="Temps de réponse :">Response Time:</strong><br>
                                        <small class="text-muted" data-en="We typically respond within 24 hours" data-fr="Nous répondons généralement dans les 24 heures">We typically respond within 24 hours</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tutorials Section -->
            <div id="tutorials" class="help-section" style="display: none;">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0" data-en="Video Tutorials" data-fr="Tutoriels vidéo">Video Tutorials</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="tutorial-card">
                                    <div class="tutorial-thumbnail bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-play-circle text-primary" style="font-size: 3rem;"></i>
                                    </div>
                                    <div class="tutorial-content p-3">
                                        <h6 data-en="Getting Started with JurisLocator" data-fr="Commencer avec JurisLocator">Getting Started with JurisLocator</h6>
                                        <p class="text-muted small" data-en="Learn the basics of navigating and using JurisLocator" data-fr="Apprenez les bases de la navigation et de l'utilisation de JurisLocator">Learn the basics of navigating and using JurisLocator</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="playTutorial('intro')">
                                            <i class="fas fa-play me-1"></i>
                                            <span data-en="Watch (5:30)" data-fr="Regarder (5:30)">Watch (5:30)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="tutorial-card">
                                    <div class="tutorial-thumbnail bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-search text-info" style="font-size: 3rem;"></i>
                                    </div>
                                    <div class="tutorial-content p-3">
                                        <h6 data-en="Advanced Search Techniques" data-fr="Techniques de recherche avancées">Advanced Search Techniques</h6>
                                        <p class="text-muted small" data-en="Master the search and filtering features" data-fr="Maîtrisez les fonctionnalités de recherche et de filtrage">Master the search and filtering features</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="playTutorial('search')">
                                            <i class="fas fa-play me-1"></i>
                                            <span data-en="Watch (7:15)" data-fr="Regarder (7:15)">Watch (7:15)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="tutorial-card">
                                    <div class="tutorial-thumbnail bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-sticky-note text-success" style="font-size: 3rem;"></i>
                                    </div>
                                    <div class="tutorial-content p-3">
                                        <h6 data-en="Notes and Annotations" data-fr="Notes et annotations">Notes and Annotations</h6>
                                        <p class="text-muted small" data-en="How to create and manage your personal notes" data-fr="Comment créer et gérer vos notes personnelles">How to create and manage your personal notes</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="playTutorial('notes')">
                                            <i class="fas fa-play me-1"></i>
                                            <span data-en="Watch (4:45)" data-fr="Regarder (4:45)">Watch (4:45)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Default Welcome Section -->
            <div id="welcome" class="help-section">
                <div class="text-center py-5">
                    <div class="welcome-content">
                        <i class="fas fa-headset" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <h4 data-en="Welcome to JurisLocator Support" data-fr="Bienvenue au support JurisLocator">Welcome to JurisLocator Support</h4>
                        <p class="text-muted" data-en="Select a topic above to get started, or browse our helpful resources." data-fr="Sélectionnez un sujet ci-dessus pour commencer, ou parcourez nos ressources utiles.">
                            Select a topic above to get started, or browse our helpful resources.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.support-card {
    padding: 2rem 1rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    cursor: pointer;
    margin-bottom: 1rem;
}

.support-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: var(--bs-primary);
}

.support-icon {
    opacity: 0.8;
}

.help-section {
    min-height: 400px;
}

.tutorial-card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.tutorial-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.contact-method {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 6px;
}

.welcome-content {
    padding: 3rem 1rem;
}
</style>

<script>
function showHelpSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.help-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });
    
    // Show selected section
    document.getElementById(sectionId).style.display = 'block';
    
    // Update active state for support cards
    const cards = document.querySelectorAll('.support-card');
    cards.forEach(card => {
        card.style.backgroundColor = '';
        card.style.borderColor = '#e9ecef';
    });
    
    // Highlight selected card
    event.target.closest('.support-card').style.backgroundColor = '#f8f9fa';
    event.target.closest('.support-card').style.borderColor = 'var(--bs-primary)';
}

function playTutorial(tutorialType) {
    // In a real application, this would open a video player or redirect to tutorial
    alert(`Opening ${tutorialType} tutorial...`);
}

// Support form submission
document.getElementById('supportForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const subject = document.getElementById('supportSubject').value;
    const message = document.getElementById('supportMessage').value;
    
    if (!subject || !message) {
        alert('Please fill in all required fields.');
        return;
    }
    
    // In a real application, this would submit to the server
    alert('Your support request has been submitted. We will get back to you within 24 hours.');
    
    // Reset form
    this.reset();
});

// Set default view
document.addEventListener('DOMContentLoaded', function() {
    // Show welcome section by default
    document.getElementById('welcome').style.display = 'block';
});
</script>
@endsection
