@extends('layouts.user-layout')

@section('content')
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
                    <!-- Add New Timezone Section -->
                    <div class="timezone-selector sp-top">
                        <div class="form-group sp-top">
                            <label for="timezone-select">Select Timezone:</label>
                            <select id="timezone-select" class="form-control">
                                <option value="America/New_York" data-country="United States" data-flag="🇺🇸">New York (EST)</option>
                                <option value="America/Los_Angeles" data-country="United States" data-flag="🇺🇸">Los Angeles (PST)</option>
                                <option value="Europe/London" data-country="United Kingdom" data-flag="🇬🇧">London (GMT)</option>
                                <option value="Europe/Paris" data-country="France" data-flag="🇫🇷">Paris (CET)</option>
                                <option value="Asia/Tokyo" data-country="Japan" data-flag="🇯🇵">Tokyo (JST)</option>
                                <option value="Asia/Shanghai" data-country="China" data-flag="🇨🇳">Shanghai (CST)</option>
                                <option value="Australia/Sydney" data-country="Australia" data-flag="🇦🇺">Sydney (AEDT)</option>
                                <option value="Europe/Berlin" data-country="Germany" data-flag="🇩🇪">Berlin (CET)</option>
                                <option value="Asia/Dubai" data-country="UAE" data-flag="🇦🇪">Dubai (GST)</option>
                                <option value="America/Toronto" data-country="Canada" data-flag="🇨🇦">Toronto (EST)</option>
                                <option value="Asia/Singapore" data-country="Singapore" data-flag="🇸🇬">Singapore (SGT)</option>
                                <option value="Europe/Rome" data-country="Italy" data-flag="🇮🇹">Rome (CET)</option>
                                <option value="Asia/Kolkata" data-country="India" data-flag="🇮🇳">Mumbai (IST)</option>
                                <option value="America/Montreal" data-country="Canada" data-flag="🇨🇦">Montreal (EST)</option>
                                <option value="Asia/Colombo" data-country="Sri Lanka" data-flag="🇱🇰">Colombo (IST)</option>
                                <option value="Europe/Zurich" data-country="Switzerland" data-flag="🇨🇭">Zurich (CET)</option>
                                <option value="Asia/Hong_Kong" data-country="Hong Kong" data-flag="🇭🇰">Hong Kong (HKT)</option>
                                <option value="America/Chicago" data-country="United States" data-flag="🇺🇸">Chicago (CST)</option>
                                <option value="Australia/Melbourne" data-country="Australia" data-flag="🇦🇺">Melbourne (AEDT)</option>
                                <option value="Europe/Moscow" data-country="Russia" data-flag="🇷🇺">Moscow (MSK)</option>
                                <option value="Asia/Seoul" data-country="South Korea" data-flag="🇰🇷">Seoul (KST)</option>
                                <option value="America/Sao_Paulo" data-country="Brazil" data-flag="🇧🇷">São Paulo (BRT)</option>
                                <option value="Africa/Cairo" data-country="Egypt" data-flag="🇪🇬">Cairo (EET)</option>
                                <option value="Europe/Amsterdam" data-country="Netherlands" data-flag="🇳🇱">Amsterdam (CET)</option>
                                <option value="America/Mexico_City" data-country="Mexico" data-flag="🇲🇽">Mexico City (CST)</option>
                            </select>
                        </div>
                        <button id="add-timezone" class="btn btn-action sp-top">Add Timezone</button>
                    </div>

                    <!-- Current Time Display -->
                    <div id="world-clock-display" class="timezone-display sp-top"></div>
                </div>

                <div class="widget-footer" id="world-clock-footer">
                    <p><i class="fas fa-info-circle"></i> Pin your favorite timezones for easy access. Pinned timezones will also appear in the header bar.</p>
                </div>
            </div>
        </div>

        <!-- Back to Dashboard -->
        <div class="tools-navigation sp-top-dbl">
            <a href="{{ route('user.dashboard') }}" class="btn btn-custom2">
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
    margin-left: 8px;
}

.timezone-item .timezone-actions {
    display: flex;
    gap: 8px;
}

.pin-btn {
    background-color: var(--color-03);
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.875rem;
}

.pin-btn:hover {
    background-color: var(--color-02);
}

.pin-btn.pinned {
    background-color: var(--color-01);
    color: var(--color-03);
    border: 1px solid var(--color-01);
}

.pin-btn.pinned:hover {
    background-color: var(--color-03);
    border: 1px solid var(--color-01);
    color: var(--color-01);
}

.empty-pinned-message {
    text-align: center;
    color: var(--color-06);
    padding: 24px;
    font-style: italic;
}

/* Adjust main content when pinned bar is visible */
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
    let pinnedTimezones = [];
    
    // Load user's pinned timezones from server
    async function loadUserPinnedTimezones() {
        try {
            console.log('Loading pinned timezones from server...');
            
            const response = await fetch('/user/timezones/pinned', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            console.log('Server response status:', response.status);
            
            if (response.ok) {
                const data = await response.json();
                console.log('Server response data:', data);
                
                if (data.success && data.data) {
                    pinnedTimezones = data.data;
                    console.log('Loaded pinned timezones from server:', pinnedTimezones);
                    
                    // Sync with localStorage for header compatibility
                    localStorage.setItem('pinnedTimezones', JSON.stringify(pinnedTimezones));
                } else {
                    console.log('No pinned timezones found on server, using localStorage');
                    // Fallback to localStorage
                    pinnedTimezones = JSON.parse(localStorage.getItem('pinnedTimezones') || '[]');
                }
            } else {
                console.log('Failed to load from server (HTTP ' + response.status + '), using localStorage');
                // Check if it's an authentication error
                if (response.status === 401 || response.status === 302) {
                    console.log('Authentication required - user may need to log in');
                }
                // Fallback to localStorage
                pinnedTimezones = JSON.parse(localStorage.getItem('pinnedTimezones') || '[]');
            }
        } catch (error) {
            console.log('Error loading from server, using localStorage:', error);
            pinnedTimezones = JSON.parse(localStorage.getItem('pinnedTimezones') || '[]');
        }
        
        updateWorldClock();
    }
    
    // Add timezone to display (and optionally pin)
    document.getElementById('add-timezone').addEventListener('click', function() {
        const timezone = document.getElementById('timezone-select').value;
        const selectedOption = document.getElementById('timezone-select').options[document.getElementById('timezone-select').selectedIndex];
        const timezoneName = selectedOption.text;
        const country = selectedOption.getAttribute('data-country');
        const flag = selectedOption.getAttribute('data-flag');
        
        const newTimezone = {
            timezone: timezone,
            name: timezoneName,
            country: country,
            flag: flag
        };
        
        // Add to display if not already there
        if (!timezonesDisplay.find(tz => tz.timezone === timezone)) {
            timezonesDisplay.push(newTimezone);
            updateWorldClock();
        }
    });
    
    // Pin/Unpin timezone function
    async function togglePin(timezone) {
        const timezoneData = timezonesDisplay.find(tz => tz.timezone === timezone) || 
                           pinnedTimezones.find(tz => tz.timezone === timezone);
        
        if (!timezoneData) return;
        
        const isPinned = pinnedTimezones.find(pt => pt.timezone === timezone);
        
        try {
            if (isPinned) {
                // Unpin timezone
                const response = await fetch('/user/timezones/unpin', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ timezone: timezone })
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    // Remove from pinned array
                    pinnedTimezones = pinnedTimezones.filter(tz => tz.timezone !== timezone);
                    updatePinnedTimezones();
                    updateWorldClock();
                    console.log('Timezone unpinned successfully');
                } else {
                    console.error('Failed to unpin timezone:', data.message);
                    // Check if it's an authentication error
                    if (response.status === 401 || response.status === 302) {
                        alert('Authentication required. Please refresh the page and log in again.');
                    } else {
                        alert(data.message || 'Failed to unpin timezone');
                    }
                }
            } else {
                // Pin timezone
                const response = await fetch('/user/timezones/pin', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(timezoneData)
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    // Add to pinned array
                    pinnedTimezones.push(timezoneData);
                    updatePinnedTimezones();
                    updateWorldClock();
                    console.log('Timezone pinned successfully');
                } else {
                    console.error('Failed to pin timezone:', data.message);
                    // Check if it's an authentication error
                    if (response.status === 401 || response.status === 302) {
                        alert('Authentication required. Please refresh the page and log in again.');
                    } else {
                        alert(data.message || 'Failed to pin timezone');
                    }
                }
            }
        } catch (error) {
            console.error('Error toggling pin:', error);
            // Check if it's a network error that might indicate authentication issues
            if (error.name === 'TypeError' || error.message.includes('Failed to fetch')) {
                alert('Network error. Please check your connection and ensure you are logged in.');
            } else {
                alert('Error updating timezone. Please try again.');
            }
        }
    }
    
    function updateWorldClock() {
        const display = document.getElementById('world-clock-display');
        display.innerHTML = '';
        
        // Combine pinned and display timezones, avoiding duplicates
        const allTimezones = [...pinnedTimezones];
        timezonesDisplay.forEach(tz => {
            if (!pinnedTimezones.find(ptz => ptz.timezone === tz.timezone)) {
                allTimezones.push(tz);
            }
        });
        
        if (allTimezones.length === 0) {
            display.innerHTML = `
                <div class="empty-pinned-message">
                    <p>No timezones to display. Select a timezone above and click "Add Timezone" to get started.</p>
                </div>
            `;
            return;
        }
        
        allTimezones.forEach((timezoneData, index) => {
            const now = new Date();
            
            // Get time in timezone
            const timeString = now.toLocaleString('en-US', { 
                timeZone: timezoneData.timezone,
                hour12: true,
                hour: '2-digit',
                minute: '2-digit'
            });
            
            // Get day and date in timezone
            const dayString = now.toLocaleDateString('en-US', { 
                timeZone: timezoneData.timezone,
                weekday: 'short'
            }).toUpperCase();
            
            const dateString = now.toLocaleDateString('en-US', { 
                timeZone: timezoneData.timezone,
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }).replace(/,/g, '');
            
            // Get timezone abbreviation
            const timezoneName = timezoneData.name.match(/\(([^)]+)\)/);
            const timezoneAbbr = timezoneName ? timezoneName[1] : '';
            
            const isPinned = pinnedTimezones.find(pt => pt.timezone === timezoneData.timezone);
           
            const timezoneItem = document.createElement('div');
            timezoneItem.className = 'timezone-item';
            timezoneItem.innerHTML = `
                <div>
                    <span><strong>${timezoneData.flag} ${timezoneData.name}</strong></span>
                    <br>
                    <span style="font-size: 1.1em; font-weight: 500;">${timeString} ${timezoneAbbr}</span>
                    <br>
                    <span style="font-size: 0.9em; color: #666;">${dayString} ${dateString}</span>
                </div>
                <div class="timezone-actions">
                    <button onclick="togglePin('${timezoneData.timezone}')" class="btn pin-btn ${isPinned ? 'pinned' : ''}">
                        <i class="fas fa-thumbtack"></i> ${isPinned ? 'Unpin' : 'Pin'}
                    </button>
                    <button onclick="removeTimezone('${timezoneData.timezone}')" class="btn btn-danger">Remove</button>
                </div>
            `;
            display.appendChild(timezoneItem);
        });
    }

    function updatePinnedTimezones() {
        // Save to localStorage for header compatibility
        localStorage.setItem('pinnedTimezones', JSON.stringify(pinnedTimezones));
        
        // Trigger header update
        window.dispatchEvent(new CustomEvent('pinnedTimezonesUpdated'));
    }
    
    function removeTimezone(timezone) {
        timezonesDisplay = timezonesDisplay.filter(tz => tz.timezone !== timezone);
        updateWorldClock();
    }

    // Make functions globally available
    window.togglePin = togglePin;
    window.removeTimezone = removeTimezone;

    // Update world clock every minute
    setInterval(function() {
        updateWorldClock();
    }, 60000);    
    
    // Load existing pinned timezones from server on page load
    loadUserPinnedTimezones();

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
@endsection