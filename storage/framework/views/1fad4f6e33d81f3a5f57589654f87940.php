

<?php $__env->startSection('content'); ?>
<div class="tools-container">
    <div class="tools-content">
        <!-- Header Section -->
        <div class="tools-header">
            <h1 class="tools-title" data-en="Tools" data-fr="Outils">Tools</h1>
            <p class="tools-subtitle" data-en="Useful calculators and utilities to help with your daily tasks" data-fr="Calculatrices et utilitaires utiles pour vous aider dans vos tâches quotidiennes">Useful calculators and utilities to help with your daily tasks</p>
        </div>

        <!-- Tools Grid -->
        <div class="tools-grid">
            <!-- Date Duration Calculator -->
            <div class="tool-card" onclick="window.location.href='<?php echo e(route('user.tools.date-to-date')); ?>'">
                <div class="tool-icon date-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="tool-content">
                    <h3 data-en="Date Duration Calculator" data-fr="Calculateur de durée de date">Date Duration Calculator</h3>
                    <p data-en="How Many Days Are There Between Two Dates?" data-fr="Combien de jours y a-t-il entre deux dates?">How Many Days Are There Between Two Dates?</p>
                    <button class="tool-button" data-en="Calculate" data-fr="Calculer">Calculate</button>
                </div>
            </div>

            <!-- Age Calculator -->
            <div class="tool-card" onclick="window.location.href='<?php echo e(route('user.tools.age-calculator')); ?>'">
                <div class="tool-icon age-icon">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <div class="tool-content">
                    <h3 data-en="Age Calculator" data-fr="Calculateur d'âge">Age Calculator</h3>
                    <p data-en="How Old A Person Is From The Birthday" data-fr="Quel âge a une personne depuis son anniversaire">How Old A Person Is From The Birthday</p>
                    <button class="tool-button" data-en="Calculate" data-fr="Calculer">Calculate</button>
                </div>
            </div>

            <!-- Currency Converter -->
            <div class="tool-card" onclick="window.location.href='<?php echo e(route('user.tools.currency-converter')); ?>'">
                <div class="tool-icon currency-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="tool-content">
                    <h3 data-en="Currency Converter" data-fr="Convertisseur de devises">Currency Converter</h3>
                    <p data-en="Check Live Foreign Currency Exchange Rates" data-fr="Vérifiez les taux de change en direct">Check Live Foreign Currency Exchange Rates</p>
                    <button class="tool-button" data-en="Convert" data-fr="Convertir">Convert</button>
                </div>
            </div>

            <!-- Add/Subtract Date Calculator -->
            <div class="tool-card" onclick="window.location.href='<?php echo e(route('user.tools.add-subtract-date')); ?>'">
                <div class="tool-icon date-math-icon">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="tool-content">
                    <h3 data-en="Add or Subtract from a Date" data-fr="Ajouter ou soustraire d'une date">Add or Subtract from a Date</h3>
                    <p data-en="Calculate future or past dates by adding or subtracting time periods" data-fr="Calculez les dates futures ou passées en ajoutant ou soustrayant des périodes">Calculate future or past dates by adding or subtracting time periods</p>
                    <button class="tool-button" data-en="Calculate" data-fr="Calculer">Calculate</button>
                </div>
            </div>

            <!-- World Clock -->
            <div class="tool-card" onclick="window.location.href='<?php echo e(route('user.tools.time-zones')); ?>'">
                <div class="tool-icon world-clock-icon">
                    <i class="fas fa-globe-americas"></i>
                </div>
                <div class="tool-content">
                    <h3 data-en="World Clock" data-fr="Horloge mondiale">World Clock</h3>
                    <p data-en="World Time And Date For Cities In All Time Zones" data-fr="Heure et date mondiales pour les villes de tous les fuseaux horaires">World Time And Date For Cities In All Time Zones</p>
                    <button class="tool-button" data-en="View Times" data-fr="Voir les heures">View Times</button>
                </div>
            </div>
        </div>

        <!-- Back to Dashboard -->
        <div class="tools-navigation">
            <a href="<?php echo e(route('user.dashboard')); ?>" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                <span data-en="Back to Dashboard" data-fr="Retour au tableau de bord">Back to Dashboard</span>
            </a>
        </div>
    </div>
</div>

<style>
.tools-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 1rem;
}

.tools-content {
    max-width: 1200px;
    margin: 0 auto;
}

.tools-header {
    text-align: center;
    margin-bottom: 3rem;
    color: white;
}

.tools-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.tools-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 0;
}

.tools-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.tool-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.tool-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: #667eea;
}

.tool-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
}

.date-icon {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}

.age-icon {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    color: white;
}

.currency-icon {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    color: #333;
}

.date-math-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.world-clock-icon {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.tool-content {
    text-align: center;
}

.tool-content h3 {
    color: #333;
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.tool-content p {
    color: #666;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.tool-button {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.tool-button:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.tools-navigation {
    text-align: center;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    text-decoration: none;
    font-size: 1.1rem;
    padding: 12px 24px;
    border-radius: 25px;
    background: rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.back-btn:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .tools-title {
        font-size: 2.5rem;
    }
    
    .tools-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .tool-card {
        padding: 1.5rem;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/user/tools/index.blade.php ENDPATH**/ ?>