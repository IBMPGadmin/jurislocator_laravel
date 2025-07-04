@extends('layouts.user-layout')

@section('content')
<div class="tool-container">
    <div class="tool-content">
        <!-- Header -->
        <div class="tool-header">
            <div class="tool-icon-large">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h1 class="tool-title" data-en="Date Duration Calculator" data-fr="Calculateur de durée de date">Date Duration Calculator</h1>
            <p class="tool-subtitle" data-en="How Many Days Are There Between Two Dates?" data-fr="Combien de jours y a-t-il entre deux dates?">How Many Days Are There Between Two Dates?</p>
        </div>

        <!-- Calculator Form -->
        <div class="calculator-card">
            <form id="dateCalculatorForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="start_date" data-en="Start Date" data-fr="Date de début">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date" data-en="End Date" data-fr="Date de fin">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="include_time" name="include_time">
                        <label for="include_time" data-en="Include time in calculation" data-fr="Inclure le temps dans le calcul">Include time in calculation</label>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="clearForm()" data-en="Clear" data-fr="Effacer">Clear</button>
                    <button type="submit" class="btn btn-primary" data-en="Calculate" data-fr="Calculer">Calculate</button>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div class="results-section" id="resultsSection" style="display: none;">
            <div class="results-card">
                <h3 data-en="Date Interval Between two Dates" data-fr="Intervalle de date entre deux dates">Date Interval Between two Dates</h3>
                
                <div class="result-display">
                    <div class="result-main" id="mainResult">
                        <span id="yearsResult">0</span> <span data-en="Years" data-fr="Années">Years</span>
                        <span id="monthsResult">0</span> <span data-en="Months" data-fr="Mois">Months</span>
                        <span id="daysResult">0</span> <span data-en="Days" data-fr="Jours">Days</span>
                    </div>
                    
                    <div class="result-or" data-en="OR" data-fr="OU">OR</div>
                    
                    <div class="result-alternative" id="alternativeResult">
                        <span id="totalMonthsResult">0</span> <span data-en="Months" data-fr="Mois">Months</span>
                        <span id="totalDaysAltResult">0</span> <span data-en="Days" data-fr="Jours">Days</span>
                        <span id="hoursResult" style="display: none;">0</span> <span id="hoursLabel" style="display: none;" data-en="Hours" data-fr="Heures">Hours</span>
                    </div>
                    
                    <div class="result-or" data-en="OR" data-fr="OU">OR</div>
                    
                    <div class="result-alternative" id="weeksResult">
                        <span id="totalWeeksResult">0</span> <span data-en="Weeks" data-fr="Semaines">Weeks</span>
                        <span id="weekDaysResult">0</span> <span data-en="Days" data-fr="Jours">Days</span>
                        <span id="weekHoursResult" style="display: none;">0</span> <span id="weekHoursLabel" style="display: none;" data-en="Hours" data-fr="Heures">Hours</span>
                        <span id="minutesResult" style="display: none;">0</span> <span id="minutesLabel" style="display: none;" data-en="Minutes" data-fr="Minutes">Minutes</span>
                    </div>
                </div>

                <!-- Date and Time units -->
                <div class="units-section">
                    <h4 data-en="Date and Time units" data-fr="Unités de date et d'heure">Date and Time units</h4>
                    <div class="units-grid">
                        <div class="unit-item">
                            <span data-en="Total Years" data-fr="Total des années">Total Years</span>
                            <span id="totalYearsUnit">0</span>
                        </div>
                        <div class="unit-item">
                            <span data-en="Total Months" data-fr="Total des mois">Total Months</span>
                            <span id="totalMonthsUnit">0</span>
                        </div>
                        <div class="unit-item">
                            <span data-en="Total Weeks" data-fr="Total des semaines">Total Weeks</span>
                            <span id="totalWeeksUnit">0</span>
                        </div>
                        <div class="unit-item">
                            <span data-en="Total Days" data-fr="Total des jours">Total Days</span>
                            <span id="totalDaysUnit">0</span>
                        </div>
                        <div class="unit-item" id="totalHoursUnit" style="display: none;">
                            <span data-en="Total Hours" data-fr="Total des heures">Total Hours</span>
                            <span id="totalHoursValue">0</span>
                        </div>
                        <div class="unit-item" id="totalMinutesUnit" style="display: none;">
                            <span data-en="Total Minutes" data-fr="Total des minutes">Total Minutes</span>
                            <span id="totalMinutesValue">0</span>
                        </div>
                    </div>
                </div>

                <div class="last-updated">
                    <i class="fas fa-clock"></i>
                    <span data-en="Last updated:" data-fr="Dernière mise à jour:">Last updated:</span>
                    <span id="lastUpdated"></span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="tool-navigation">
            <a href="{{ route('user.tools') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                <span data-en="Back to Tools" data-fr="Retour aux outils">Back to Tools</span>
            </a>
        </div>
    </div>
</div>

<style>
.tool-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    padding: 2rem 1rem;
}

.tool-content {
    max-width: 800px;
    margin: 0 auto;
}

.tool-header {
    text-align: center;
    margin-bottom: 2rem;
    color: white;
}

.tool-icon-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 3rem;
    backdrop-filter: blur(10px);
}

.tool-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.tool-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.calculator-card, .results-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #4facfe;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.checkbox-wrapper input[type="checkbox"] {
    width: 20px;
    height: 20px;
}

.button-group {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn {
    padding: 12px 30px;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}

.btn-secondary {
    background: #f8f9fa;
    color: #333;
    border: 2px solid #e0e0e0;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.results-section {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.result-display {
    text-align: center;
    margin: 2rem 0;
}

.result-main, .result-alternative {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 1rem 0;
}

.result-or {
    color: #4facfe;
    font-weight: 600;
    margin: 1rem 0;
}

.units-section {
    margin-top: 2rem;
}

.units-section h4 {
    color: #4facfe;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.units-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.unit-item {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.last-updated {
    text-align: center;
    color: #666;
    font-size: 0.9rem;
    margin-top: 1rem;
}

.tool-navigation {
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
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .button-group {
        flex-direction: column;
    }
    
    .tool-title {
        font-size: 2rem;
    }
}
</style>

<script>
document.getElementById('dateCalculatorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;
    const includeTime = document.getElementById('include_time').checked;
    
    if (!startDate || !endDate) {
        alert('Please select both start and end dates.');
        return;
    }
    
    if (new Date(endDate) < new Date(startDate)) {
        alert('End date must be after or equal to start date.');
        return;
    }
    
    const formData = new FormData();
    formData.append('start_date', startDate);
    formData.append('end_date', endDate);
    formData.append('include_time', includeTime ? '1' : '0');
    
    fetch('{{ route("tools.calculate-date-difference") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 422) {
                // Validation error
                return response.json().then(errorData => {
                    throw new Error('Validation error: ' + JSON.stringify(errorData.errors || errorData.message));
                });
            }
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            alert('Error: ' + data.message);
        } else {
            displayResults(data, includeTime);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message);
    });
});

function displayResults(data, includeTime) {
    document.getElementById('resultsSection').style.display = 'block';
    
    // Main result
    document.getElementById('yearsResult').textContent = data.years;
    document.getElementById('monthsResult').textContent = data.months;
    document.getElementById('daysResult').textContent = data.days;
    
    // Alternative results
    document.getElementById('totalMonthsResult').textContent = data.total_months;
    document.getElementById('totalDaysAltResult').textContent = data.days;
    document.getElementById('totalWeeksResult').textContent = data.total_weeks;
    document.getElementById('weekDaysResult').textContent = data.days;
    
    // Units
    document.getElementById('totalYearsUnit').textContent = data.total_years;
    document.getElementById('totalMonthsUnit').textContent = data.total_months;
    document.getElementById('totalWeeksUnit').textContent = data.total_weeks;
    document.getElementById('totalDaysUnit').textContent = data.total_days;
    
    // Show/hide time-related fields
    if (includeTime && data.hours !== undefined) {
        document.getElementById('hoursResult').textContent = data.hours;
        document.getElementById('hoursResult').style.display = 'inline';
        document.getElementById('hoursLabel').style.display = 'inline';
        
        document.getElementById('weekHoursResult').textContent = data.hours;
        document.getElementById('weekHoursResult').style.display = 'inline';
        document.getElementById('weekHoursLabel').style.display = 'inline';
        
        document.getElementById('minutesResult').textContent = data.minutes;
        document.getElementById('minutesResult').style.display = 'inline';
        document.getElementById('minutesLabel').style.display = 'inline';
        
        document.getElementById('totalHoursUnit').style.display = 'block';
        document.getElementById('totalHoursValue').textContent = data.total_hours;
        
        document.getElementById('totalMinutesUnit').style.display = 'block';
        document.getElementById('totalMinutesValue').textContent = data.total_minutes;
    } else {
        // Hide time fields
        document.getElementById('hoursResult').style.display = 'none';
        document.getElementById('hoursLabel').style.display = 'none';
        document.getElementById('weekHoursResult').style.display = 'none';
        document.getElementById('weekHoursLabel').style.display = 'none';
        document.getElementById('minutesResult').style.display = 'none';
        document.getElementById('minutesLabel').style.display = 'none';
        document.getElementById('totalHoursUnit').style.display = 'none';
        document.getElementById('totalMinutesUnit').style.display = 'none';
    }
    
    // Update timestamp
    document.getElementById('lastUpdated').textContent = new Date().toLocaleString();
    
    // Scroll to results
    document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth' });
}

function clearForm() {
    document.getElementById('dateCalculatorForm').reset();
    document.getElementById('resultsSection').style.display = 'none';
}

// Set default dates (today and tomorrow)
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowStr = tomorrow.toISOString().split('T')[0];
    
    document.getElementById('start_date').value = today;
    document.getElementById('end_date').value = tomorrowStr;
});
</script>
@endsection
