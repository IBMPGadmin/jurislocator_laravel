@extends('layouts.user-layout')

@section('content')
<div class="tool-container">
    <div class="tool-content">
        <!-- Header -->
        <div class="tool-header">
            <div class="tool-icon-large">
                <i class="fas fa-birthday-cake"></i>
            </div>
            <h1 class="tool-title" data-en="Age Calculator" data-fr="Calculateur d'âge">Age Calculator</h1>
            <p class="tool-subtitle" data-en="How Old A Person Is From The Birthday" data-fr="Quel âge a une personne depuis son anniversaire">How Old A Person Is From The Birthday</p>
        </div>

        <!-- Calculator Form -->
        <div class="calculator-card">
            <form id="ageCalculatorForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="birth_date" data-en="Date of Birth" data-fr="Date de naissance">Date of Birth</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                    <div class="form-group">
                        <label for="calculation_date" data-en="Today's Date" data-fr="Date d'aujourd'hui">Today's Date</label>
                        <div class="today-date-wrapper">
                            <input type="date" class="form-control" id="calculation_date" name="calculation_date" required>
                            <span class="day-of-week" id="todayDayOfWeek">Friday</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="ignore_time" name="ignore_time" checked>
                        <label for="ignore_time" data-en="Ignore time in calculation" data-fr="Ignorer le temps dans le calcul">Ignore time in calculation</label>
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
                <h3 data-en="Your Age" data-fr="Votre âge">Your Age</h3>
                
                <div class="result-display">
                    <div class="result-main" id="mainAgeResult">
                        <span id="ageYears">0</span> <span data-en="Years" data-fr="Années">Years</span>
                        <span id="ageMonths">0</span> <span data-en="Months" data-fr="Mois">Months</span>
                        <span id="ageDays">0</span> <span data-en="Days" data-fr="Jours">Days</span>
                    </div>
                    
                    <div class="result-or" data-en="OR" data-fr="OU">OR</div>
                    
                    <div class="result-alternative">
                        <span id="totalMonthsAge">0</span> <span data-en="Months" data-fr="Mois">Months</span>
                        <span id="totalDaysAge">0</span> <span data-en="Days" data-fr="Jours">Days</span>
                        <span id="totalHoursAge" style="display: none;">0</span> <span id="hoursLabelAge" style="display: none;" data-en="Hours" data-fr="Heures">Hours</span>
                    </div>
                    
                    <div class="result-or" data-en="OR" data-fr="OU">OR</div>
                    
                    <div class="result-alternative">
                        <span id="totalWeeksAge">0</span> <span data-en="Weeks" data-fr="Semaines">Weeks</span>
                        <span id="weekDaysAge">0</span> <span data-en="Days" data-fr="Jours">Days</span>
                        <span id="weekHoursAge" style="display: none;">0</span> <span id="weekHoursLabelAge" style="display: none;" data-en="Hours" data-fr="Heures">Hours</span>
                        <span id="weekMinutesAge" style="display: none;">0</span> <span id="weekMinutesLabelAge" style="display: none;" data-en="Minutes" data-fr="Minutes">Minutes</span>
                    </div>
                </div>

                <!-- Next Birthday Section -->
                <div class="next-birthday-section">
                    <h4 data-en="Next Birthday" data-fr="Prochain anniversaire">Next Birthday</h4>
                    <div class="next-birthday-display">
                        <div class="birthday-info">
                            <span id="nextBirthdayDate">--</span>
                        </div>
                        <div class="birthday-countdown">
                            <span id="daysUntilBirthday">0</span> <span data-en="Months" data-fr="Mois">Months</span>
                            <span id="monthsUntilBirthday">0</span> <span data-en="Days" data-fr="Jours">Days</span>
                        </div>
                    </div>
                </div>

                <!-- Age Totals -->
                <div class="units-section">
                    <h4 data-en="Age Totals" data-fr="Totaux d'âge">Age Totals</h4>
                    <div class="units-grid">
                        <div class="unit-item">
                            <span data-en="Years" data-fr="Années">Years</span>
                            <span id="totalYearsAge">0</span>
                        </div>
                        <div class="unit-item">
                            <span data-en="Months" data-fr="Mois">Months</span>
                            <span id="totalMonthsAgeUnit">0</span>
                        </div>
                        <div class="unit-item">
                            <span data-en="Weeks" data-fr="Semaines">Weeks</span>
                            <span id="totalWeeksAgeUnit">0</span>
                        </div>
                        <div class="unit-item">
                            <span data-en="Days" data-fr="Jours">Days</span>
                            <span id="totalDaysAgeUnit">0</span>
                        </div>
                        <div class="unit-item" id="totalHoursAgeUnit" style="display: none;">
                            <span data-en="Hours" data-fr="Heures">Hours</span>
                            <span id="totalHoursAgeValue">0</span>
                        </div>
                        <div class="unit-item" id="totalMinutesAgeUnit" style="display: none;">
                            <span data-en="Minutes" data-fr="Minutes">Minutes</span>
                            <span id="totalMinutesAgeValue">0</span>
                        </div>
                    </div>
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
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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

.today-date-wrapper {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.day-of-week {
    font-weight: 600;
    color: #fa709a;
    padding: 0.5rem;
    white-space: nowrap;
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
    border-color: #fa709a;
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
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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
    color: #fa709a;
    font-weight: 600;
    margin: 1rem 0;
}

.next-birthday-section {
    margin: 2rem 0;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.next-birthday-section h4 {
    color: #fa709a;
    margin-bottom: 1rem;
    text-align: center;
}

.next-birthday-display {
    text-align: center;
}

.birthday-info {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.birthday-countdown {
    font-size: 1rem;
    color: #666;
}

.units-section {
    margin-top: 2rem;
}

.units-section h4 {
    color: #fa709a;
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
    
    .today-date-wrapper {
        flex-direction: column;
        align-items: stretch;
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
document.addEventListener('DOMContentLoaded', function() {
    // Set default calculation date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('calculation_date').value = today;
    updateTodayDayOfWeek();
    
    // Add event listeners for date changes
    document.getElementById('calculation_date').addEventListener('change', updateTodayDayOfWeek);
});

function updateTodayDayOfWeek() {
    const dateInput = document.getElementById('calculation_date');
    const daySpan = document.getElementById('todayDayOfWeek');
    
    if (dateInput.value) {
        const date = new Date(dateInput.value);
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        daySpan.textContent = days[date.getDay()];
    }
}

document.getElementById('ageCalculatorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("tools.calculate-age") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            alert('Error: ' + data.message);
        } else {
            displayAgeResults(data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while calculating the age. Please check your input and try again.');
    });
});

function displayAgeResults(data) {
    document.getElementById('resultsSection').style.display = 'block';
    
    // Main age result
    document.getElementById('ageYears').textContent = data.age.years;
    document.getElementById('ageMonths').textContent = data.age.months;
    document.getElementById('ageDays').textContent = data.age.days;
    
    // Alternative results
    document.getElementById('totalMonthsAge').textContent = data.total_months;
    document.getElementById('totalDaysAge').textContent = data.age.days;
    document.getElementById('totalWeeksAge').textContent = data.total_weeks;
    document.getElementById('weekDaysAge').textContent = data.age.days;
    
    // Next birthday
    const nextBirthdayDate = new Date(data.next_birthday.date);
    document.getElementById('nextBirthdayDate').textContent = nextBirthdayDate.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    document.getElementById('daysUntilBirthday').textContent = data.next_birthday.days_remaining;
    document.getElementById('monthsUntilBirthday').textContent = data.next_birthday.months_remaining;
    
    // Age totals
    document.getElementById('totalYearsAge').textContent = data.total_years;
    document.getElementById('totalMonthsAgeUnit').textContent = data.total_months;
    document.getElementById('totalWeeksAgeUnit').textContent = data.total_weeks;
    document.getElementById('totalDaysAgeUnit').textContent = data.total_days;
    
    // Scroll to results
    document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth' });
}

function clearForm() {
    document.getElementById('ageCalculatorForm').reset();
    document.getElementById('resultsSection').style.display = 'none';
    
    // Set default calculation date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('calculation_date').value = today;
    updateTodayDayOfWeek();
}
</script>
@endsection
