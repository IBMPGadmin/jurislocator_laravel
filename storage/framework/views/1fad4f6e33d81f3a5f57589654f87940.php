

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
            <div class="widget sp-top widget-default widget-tool widget-vertical shadow-sm" data-tool="date-duration">
                <div class="widget-title">
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="title-content">
                        <h5 data-en="Date Duration Calculator" data-fr="Calculateur de durée de date">Date Duration Calculator</h5>
                        <p data-en="How Many Days Are There Between Two Dates?" data-fr="Combien de jours y a-t-il entre deux dates?">How Many Days Are There Between Two Dates?</p>
                    </div>
                </div>
                
                <div class="widget-content" id="date-duration-content">
                    <form id="date-duration-form">
                        <div class="form-group sp-top">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start-date" class="form-control" required>
                        </div>
                        <div class="form-group sp-top">
                            <label for="end-date">End Date:</label>
                            <input type="date" id="end-date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-action sp-top">Calculate</button>
                    </form>
                    <div id="date-duration-result" class="result-section sp-top"></div>
                </div>

                <div class="widget-footer" id="date-duration-footer">
                    <p>This is the widget footer</p>
                </div>
            </div>

            <!-- Age Calculator -->
            <div class="widget sp-top widget-default widget-tool widget-vertical shadow-sm" data-tool="age-calculator">
                <div class="widget-title">
                    <div class="icon">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div class="title-content">
                        <h5 data-en="Age Calculator" data-fr="Calculateur d'âge">Age Calculator</h5>
                        <p data-en="How Old A Person Is From The Birthday" data-fr="Quel âge a une personne depuis son anniversaire">How Old A Person Is From The Birthday</p>
                    </div>
                </div>
                
                <div class="widget-content" id="age-calculator-content">
                    <form id="age-calculator-form">
                        <div class="form-group sp-top">
                            <label for="birth-date">Birth Date:</label>
                            <input type="date" id="birth-date" class="form-control" required>
                        </div>
                        <div class="form-group sp-top">
                            <label for="current-date">Current Date:</label>
                            <input type="date" id="current-date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-action sp-top">Calculate Age</button>
                    </form>
                    <div id="age-calculator-result" class="result-section sp-top"></div>
                </div>

                <div class="widget-footer" id="age-calculator-footer">
                    <p>This is the widget footer</p>
                </div>
            </div>

            <!-- Currency Converter -->
            <div class="widget sp-top widget-default widget-tool widget-vertical shadow-sm" data-tool="currency-converter">
                <div class="widget-title">
                    <div class="icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="title-content">
                        <h5 data-en="Currency Converter" data-fr="Convertisseur de devises">Currency Converter</h5>
                        <p data-en="Check Live Foreign Currency Exchange Rates" data-fr="Vérifiez les taux de change en direct">Check Live Foreign Currency Exchange Rates</p>
                    </div>
                </div>
                
                <div class="widget-content" id="currency-converter-content">
                    <form id="currency-converter-form">
                        <div class="form-group sp-top">
                            <label for="amount">Amount:</label>
                            <input type="number" id="amount" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group sp-top">
                            <label for="from-currency">From Currency:</label>
                            <select id="from-currency" class="form-control" required>
                                <option value="USD">USD - US Dollar</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">GBP - British Pound</option>
                                <option value="CAD">CAD - Canadian Dollar</option>
                                <option value="AUD">AUD - Australian Dollar</option>
                            </select>
                        </div>
                        <div class="form-group sp-top">
                            <label for="to-currency">To Currency:</label>
                            <select id="to-currency" class="form-control" required>
                                <option value="EUR">EUR - Euro</option>
                                <option value="USD">USD - US Dollar</option>
                                <option value="GBP">GBP - British Pound</option>
                                <option value="CAD">CAD - Canadian Dollar</option>
                                <option value="AUD">AUD - Australian Dollar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-action sp-top">Convert</button>
                    </form>
                    <div id="currency-converter-result" class="result-section sp-top"></div>
                </div>

                <div class="widget-footer" id="currency-converter-footer">
                    <p>This is the widget footer</p>
                </div>
            </div>

            <!-- Add/Subtract Date Calculator -->
            <div class="widget sp-top widget-default widget-tool widget-vertical shadow-sm" data-tool="add-subtract-date">
                <div class="widget-title">
                    <div class="icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="title-content">
                        <h5 data-en="Add or Subtract from a Date" data-fr="Ajouter ou soustraire d'une date">Add or Subtract from a Date</h5>
                        <p data-en="Calculate future or past dates by adding or subtracting time periods" data-fr="Calculez les dates futures ou passées en ajoutant ou soustrayant des périodes">Calculate future or past dates by adding or subtracting time periods</p>
                    </div>
                </div>
                
                <div class="widget-content" id="add-subtract-date-content">
                    <form id="add-subtract-date-form">
                        <div class="form-group sp-top">
                            <label for="base-date">Base Date:</label>
                            <input type="date" id="base-date" class="form-control" required>
                        </div>
                        <div class="form-group sp-top">
                            <label for="operation">Operation:</label>
                            <select id="operation" class="form-control" required>
                                <option value="add">Add</option>
                                <option value="subtract">Subtract</option>
                            </select>
                        </div>
                        <div class="form-group sp-top">
                            <label for="time-value">Time Value:</label>
                            <input type="number" id="time-value" class="form-control" required>
                        </div>
                        <div class="form-group sp-top">
                            <label for="time-unit">Time Unit:</label>
                            <select id="time-unit" class="form-control" required>
                                <option value="days">Days</option>
                                <option value="weeks">Weeks</option>
                                <option value="months">Months</option>
                                <option value="years">Years</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-action sp-top">Calculate</button>
                    </form>
                    <div id="add-subtract-date-result" class="result-section sp-top"></div>
                </div>

                <div class="widget-footer" id="add-subtract-date-footer">
                    <p>This is the widget footer</p>
                </div>
            </div>

            <!-- World Clock -->
            <div class="widget sp-top widget-default widget-tool widget-vertical shadow-sm" data-tool="world-clock">
                <div class="widget-title">
                    <div class="icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <div class="title-content">
                        <h5 data-en="World Clock" data-fr="Horloge mondiale">World Clock</h5>
                        <p data-en="World Time And Date For Cities In All Time Zones" data-fr="Heure et date mondiales pour les villes de tous les fuseaux horaires">World Time And Date For Cities In All Time Zones</p>
                    </div>
                </div>
                
                <div class="widget-content" id="world-clock-content">
                    <div class="timezone-selector sp-top">
                        <div class="form-group sp-top">
                            <label for="timezone-select">Select Timezone:</label>
                            <select id="timezone-select" class="form-control">
                                <option value="America/New_York">New York (EST)</option>
                                <option value="America/Los_Angeles">Los Angeles (PST)</option>
                                <option value="Europe/London">London (GMT)</option>
                                <option value="Europe/Paris">Paris (CET)</option>
                                <option value="Asia/Tokyo">Tokyo (JST)</option>
                                <option value="Asia/Shanghai">Shanghai (CST)</option>
                                <option value="Australia/Sydney">Sydney (AEDT)</option>
                            </select>
                        </div>
                        <button id="add-timezone" class="btn btn-action sp-top">Add Timezone</button>
                    </div>
                    <div id="world-clock-display" class="timezone-display sp-top"></div>
                </div>

                <div class="widget-footer" id="world-clock-footer">
                    <p>This is the widget footer</p>
                </div>
            </div>
        </div>

        <!-- Back to Dashboard -->
        <div class="tools-navigation sp-top-dbl">
            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-custom2">
                <i class="fas fa-arrow-left"></i>
                <span data-en="Back to Dashboard" data-fr="Retour au tableau de bord">Back to Dashboard</span>
            </a>
        </div>
    </div>
</div>

<style>
.tools-container {
    min-height: 100vh;
    background: var(--main-bg);
    padding: 32px 16px;
}

.tools-content {
    max-width: 1200px;
    margin: 0 auto;
}

.tools-header {
    text-align: center;
    margin-bottom: 48px;
    color: var(--color-01);
}

.tools-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 16px;
    color: var(--color-01);
}

.tools-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 0;
    color: var(--color-06);
}

.tools-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    grid-auto-rows: min-content;
    gap: 24px;
    margin-bottom: 48px;
}

.widget {
    break-inside: avoid;
    align-self: start;
}

.widget .widget-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 24px;
}

.widget .widget-title .icon {
    flex-shrink: 0;
    margin-right: 16px;
}

.widget .widget-title .icon i {
    font-size: 2.5rem;
}

.widget .widget-title .title-content {
    flex-grow: 1;
    text-align: right;
}

.widget .widget-title .title-content h5 {
    margin: 0 0 8px 0;
    font-size: 1.25rem;
    font-weight: 600;
}

.widget .widget-title .title-content p {
    margin: 0;
    font-size: 0.875rem;
    opacity: 0.9;
}

.widget .widget-content {
    padding: 24px;
}

.widget .widget-content .form-group {
    margin-bottom: 32px;
}

.widget .widget-content .form-group:last-of-type {
    margin-bottom: 40px;
}

.widget .widget-content .btn {
    margin-top: 24px;
    margin-bottom: 16px;
}

.widget .widget-content .result-section {
    margin-top: 24px;
}

.widget .widget-content .timezone-selector {
    margin-bottom: 32px;
}

.widget .widget-content .timezone-display {
    margin-top: 40px;
}

.result-section {
    background-color: var(--widget-bg);
    border: 1px solid var(--color-05);
    border-radius: var(--border-radious);
    padding: 16px;
    border-left: 4px solid var(--color-03);
}

.result-section h6 {
    color: var(--color-01);
    margin-bottom: 8px;
    font-weight: 600;
}

.result-section p {
    margin-bottom: 4px;
    color: var(--color-06);
}

.result-section strong {
    color: var(--color-01);
}

.timezone-display {
    margin-top: 16px;
}

.timezone-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    margin-bottom: 8px;
    background-color: var(--widget-bg);
    border: 1px solid var(--color-05);
    border-radius: var(--border-radious);
}

.timezone-item span:first-child {
    font-weight: 600;
    color: var(--color-01);
}

.timezone-item span:nth-child(2) {
    color: var(--color-06);
}

.timezone-item button {
    padding: 4px 8px;
    font-size: 0.875rem;
}

.tools-navigation {
    text-align: center;
}

@media (max-width: 768px) {
    .tools-title {
        font-size: 2.5rem;
    }
    
    .tools-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .widget {
        margin: 0;
    }
}

/* Masonry layout styles */
@media (min-width: 769px) {
    .tools-grid.masonry {
        display: block;
        column-count: auto;
        column-width: 360px;
        column-gap: 24px;
        column-fill: balance;
    }
    
    .tools-grid.masonry .widget {
        display: inline-block;
        width: 100%;
        margin-bottom: 24px;
        break-inside: avoid;
        page-break-inside: avoid;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize masonry layout
    initMasonryLayout();
    
    // Set current date as default for relevant forms
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('current-date').value = today;
    document.getElementById('base-date').value = today;

    // Toggle tool content
    document.querySelectorAll('.tool-toggle-btn').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const content = document.getElementById(targetId);
            const expandText = this.querySelector('.expand-text');
            const collapseText = this.querySelector('.collapse-text');
            
            if (content.style.display === 'none') {
                content.style.display = 'block';
                expandText.style.display = 'none';
                collapseText.style.display = 'inline';
            } else {
                content.style.display = 'none';
                expandText.style.display = 'inline';
                collapseText.style.display = 'none';
            }
        });
    });

    // Date Duration Calculator
    document.getElementById('date-duration-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const startDate = new Date(document.getElementById('start-date').value);
        const endDate = new Date(document.getElementById('end-date').value);
        const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
        const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
        
        document.getElementById('date-duration-result').innerHTML = `
            <h6>Result:</h6>
            <p><strong>${daysDiff}</strong> days between the selected dates</p>
            <p>Start Date: ${startDate.toDateString()}</p>
            <p>End Date: ${endDate.toDateString()}</p>
        `;
    });

    // Age Calculator
    document.getElementById('age-calculator-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const birthDate = new Date(document.getElementById('birth-date').value);
        const currentDate = new Date(document.getElementById('current-date').value);
        const age = Math.floor((currentDate - birthDate) / (365.25 * 24 * 60 * 60 * 1000));
        
        document.getElementById('age-calculator-result').innerHTML = `
            <h6>Result:</h6>
            <p><strong>${age}</strong> years old</p>
            <p>Birth Date: ${birthDate.toDateString()}</p>
            <p>Current Date: ${currentDate.toDateString()}</p>
        `;
    });

    // Currency Converter (Mock data - replace with real API)
    document.getElementById('currency-converter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const amount = parseFloat(document.getElementById('amount').value);
        const fromCurrency = document.getElementById('from-currency').value;
        const toCurrency = document.getElementById('to-currency').value;
        
        // Mock exchange rate (replace with real API call)
        const exchangeRate = 0.85; // Example rate
        const convertedAmount = (amount * exchangeRate).toFixed(2);
        
        document.getElementById('currency-converter-result').innerHTML = `
            <h6>Result:</h6>
            <p><strong>${amount} ${fromCurrency}</strong> = <strong>${convertedAmount} ${toCurrency}</strong></p>
            <p><small>Exchange rate: 1 ${fromCurrency} = ${exchangeRate} ${toCurrency}</small></p>
        `;
    });

    // Add/Subtract Date Calculator
    document.getElementById('add-subtract-date-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const baseDate = new Date(document.getElementById('base-date').value);
        const operation = document.getElementById('operation').value;
        const timeValue = parseInt(document.getElementById('time-value').value);
        const timeUnit = document.getElementById('time-unit').value;
        
        let resultDate = new Date(baseDate);
        let multiplier = operation === 'add' ? 1 : -1;
        
        switch(timeUnit) {
            case 'days':
                resultDate.setDate(resultDate.getDate() + (timeValue * multiplier));
                break;
            case 'weeks':
                resultDate.setDate(resultDate.getDate() + (timeValue * 7 * multiplier));
                break;
            case 'months':
                resultDate.setMonth(resultDate.getMonth() + (timeValue * multiplier));
                break;
            case 'years':
                resultDate.setFullYear(resultDate.getFullYear() + (timeValue * multiplier));
                break;
        }
        
        document.getElementById('add-subtract-date-result').innerHTML = `
            <h6>Result:</h6>
            <p><strong>${resultDate.toDateString()}</strong></p>
            <p>Operation: ${operation} ${timeValue} ${timeUnit}</p>
            <p>Base Date: ${baseDate.toDateString()}</p>
        `;
    });

    // World Clock
    let timezonesDisplay = [];
    
    document.getElementById('add-timezone').addEventListener('click', function() {
        const timezone = document.getElementById('timezone-select').value;
        const timezoneName = document.getElementById('timezone-select').options[document.getElementById('timezone-select').selectedIndex].text;
        
        if (!timezonesDisplay.includes(timezone)) {
            timezonesDisplay.push(timezone);
            updateWorldClock();
        }
    });
    
    function updateWorldClock() {
        const display = document.getElementById('world-clock-display');
        display.innerHTML = '';
        
        timezonesDisplay.forEach(timezone => {
            const now = new Date();
            const timeString = now.toLocaleString('en-US', { timeZone: timezone });
            const timezoneName = document.getElementById('timezone-select').querySelector(`option[value="${timezone}"]`).text;
            
            const timezoneItem = document.createElement('div');
            timezoneItem.className = 'timezone-item';
            timezoneItem.innerHTML = `
                <span><strong>${timezoneName}</strong></span>
                <span>${timeString}</span>
                <button onclick="removeTimezone('${timezone}')" class="btn btn-danger">Remove</button>
            `;
            display.appendChild(timezoneItem);
        });
    }
    
    window.removeTimezone = function(timezone) {
        timezonesDisplay = timezonesDisplay.filter(tz => tz !== timezone);
        updateWorldClock();
    };
    
    // Update world clock every second
    setInterval(updateWorldClock, 1000);
});

// Initialize masonry layout
function initMasonryLayout() {
    const grid = document.querySelector('.tools-grid');
    
    // Check if screen is wide enough for masonry
    if (window.innerWidth > 768) {
        grid.classList.add('masonry');
    } else {
        grid.classList.remove('masonry');
    }
}

// Reinitialize masonry on window resize
window.addEventListener('resize', function() {
    initMasonryLayout();
});

// Toggle tool function
function toggleTool(toolName) {
    const content = document.getElementById(toolName + '-content');
    const footer = document.getElementById(toolName + '-footer');
    
    if (content.style.display === 'none') {
        content.style.display = 'block';
        footer.style.display = 'block';
    } else {
        content.style.display = 'none';
        footer.style.display = 'none';
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/user/tools/index.blade.php ENDPATH**/ ?>