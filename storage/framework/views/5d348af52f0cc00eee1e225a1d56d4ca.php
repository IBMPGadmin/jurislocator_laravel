

<?php $__env->startSection('content'); ?>
<div class="tool-container">
    <div class="tool-content">
        <!-- Header -->
        <div class="tool-header">
            <div class="tool-icon-large">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <h1 class="tool-title" data-en="Add or Subtract from a Date" data-fr="Ajouter ou soustraire d'une date">Add or Subtract from a Date</h1>
            <p class="tool-subtitle" data-en="Calculate future or past dates by adding or subtracting time periods" data-fr="Calculez les dates futures ou passées en ajoutant ou soustrayant des périodes">Calculate future or past dates by adding or subtracting time periods</p>
        </div>

        <!-- Calculator Form -->
        <div class="calculator-card">
            <form id="dateAddSubtractForm">
                <div class="form-group">
                    <label for="date" data-en="Date" data-fr="Date">Date</label>
                    <div class="date-time-row">
                        <input type="date" class="form-control" id="date" name="date" required>
                        <input type="time" class="form-control" id="time" name="time" value="13:00">
                        <span class="day-of-week" id="dayOfWeek">Friday</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="ignore_time" name="ignore_time">
                        <label for="ignore_time" data-en="Ignore time in calculation" data-fr="Ignorer le temps dans le calcul">Ignore time in calculation</label>
                    </div>
                </div>

                <div class="time-units">
                    <div class="unit-row">
                        <div class="operation-toggle">
                            <button type="button" class="toggle-btn add active" data-unit="years">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="toggle-btn subtract" data-unit="years">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control unit-input" id="years" name="years" min="0" value="0">
                        <label data-en="Years" data-fr="Années">Years</label>
                        <input type="hidden" id="years_operation" name="years_operation" value="add">
                    </div>

                    <div class="unit-row">
                        <div class="operation-toggle">
                            <button type="button" class="toggle-btn add active" data-unit="months">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="toggle-btn subtract" data-unit="months">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control unit-input" id="months" name="months" min="0" value="0">
                        <label data-en="Months" data-fr="Mois">Months</label>
                        <input type="hidden" id="months_operation" name="months_operation" value="add">
                    </div>

                    <div class="unit-row">
                        <div class="operation-toggle">
                            <button type="button" class="toggle-btn add active" data-unit="weeks">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="toggle-btn subtract" data-unit="weeks">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control unit-input" id="weeks" name="weeks" min="0" value="0">
                        <label data-en="Weeks" data-fr="Semaines">Weeks</label>
                        <input type="hidden" id="weeks_operation" name="weeks_operation" value="add">
                    </div>

                    <div class="unit-row">
                        <div class="operation-toggle">
                            <button type="button" class="toggle-btn add active" data-unit="days">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="toggle-btn subtract" data-unit="days">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control unit-input" id="days" name="days" min="0" value="0">
                        <label data-en="Days" data-fr="Jours">Days</label>
                        <input type="hidden" id="days_operation" name="days_operation" value="add">
                    </div>

                    <div class="unit-row">
                        <div class="operation-toggle">
                            <button type="button" class="toggle-btn add active" data-unit="hours">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="toggle-btn subtract" data-unit="hours">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control unit-input" id="hours" name="hours" min="0" value="0">
                        <label data-en="Hours" data-fr="Heures">Hours</label>
                        <input type="hidden" id="hours_operation" name="hours_operation" value="add">
                    </div>

                    <div class="unit-row">
                        <div class="operation-toggle">
                            <button type="button" class="toggle-btn add active" data-unit="minutes">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="toggle-btn subtract" data-unit="minutes">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control unit-input" id="minutes" name="minutes" min="0" value="0">
                        <label data-en="Minutes" data-fr="Minutes">Minutes</label>
                        <input type="hidden" id="minutes_operation" name="minutes_operation" value="add">
                    </div>

                    <div class="unit-row">
                        <div class="operation-toggle">
                            <button type="button" class="toggle-btn add active" data-unit="seconds">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="toggle-btn subtract" data-unit="seconds">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control unit-input" id="seconds" name="seconds" min="0" value="0">
                        <label data-en="Seconds" data-fr="Secondes">Seconds</label>
                        <input type="hidden" id="seconds_operation" name="seconds_operation" value="add">
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
                <h3 data-en="Result" data-fr="Résultat">Result</h3>
                
                <div class="result-display">
                    <div class="result-date" id="resultDate">
                        <!-- Result will be displayed here -->
                    </div>
                    <div class="result-formatted" id="resultFormatted">
                        <!-- Formatted result will be displayed here -->
                    </div>
                    <div class="result-day" id="resultDay">
                        <!-- Day of week will be displayed here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="tool-navigation">
            <a href="<?php echo e(route('user.tools')); ?>" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                <span data-en="Back to Tools" data-fr="Retour aux outils">Back to Tools</span>
            </a>
        </div>
    </div>
</div>

<style>
.tool-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 1rem;
}

.tool-content {
    max-width: 600px;
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

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #333;
}

.date-time-row {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 1rem;
    align-items: center;
}

.day-of-week {
    font-weight: 600;
    color: #667eea;
    padding: 0.5rem;
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
    border-color: #667eea;
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

.time-units {
    border: 2px solid #f0f0f0;
    border-radius: 15px;
    padding: 1.5rem;
    margin: 1.5rem 0;
}

.unit-row {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1rem;
    align-items: center;
    margin-bottom: 1rem;
}

.unit-row:last-child {
    margin-bottom: 0;
}

.operation-toggle {
    display: flex;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid #e0e0e0;
}

.toggle-btn {
    background: #f8f9fa;
    border: none;
    padding: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.toggle-btn.add.active {
    background: #28a745;
    color: white;
}

.toggle-btn.subtract.active {
    background: #dc3545;
    color: white;
}

.toggle-btn:hover {
    opacity: 0.8;
}

.unit-input {
    max-width: 100px;
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

.result-date {
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 1rem;
}

.result-formatted {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.result-day {
    font-size: 1.1rem;
    color: #666;
    font-style: italic;
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
    .date-time-row {
        grid-template-columns: 1fr;
    }
    
    .unit-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .operation-toggle {
        width: fit-content;
        margin: 0 auto;
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
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = today;
    updateDayOfWeek();
    
    // Add event listeners for date changes
    document.getElementById('date').addEventListener('change', updateDayOfWeek);
    
    // Add toggle button functionality
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const unit = this.dataset.unit;
            const parent = this.parentElement;
            const siblings = parent.querySelectorAll('.toggle-btn');
            
            // Remove active class from siblings
            siblings.forEach(sibling => sibling.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Update hidden input value
            const operation = this.classList.contains('add') ? 'add' : 'subtract';
            document.getElementById(unit + '_operation').value = operation;
        });
    });
});

function updateDayOfWeek() {
    const dateInput = document.getElementById('date');
    const daySpan = document.getElementById('dayOfWeek');
    
    if (dateInput.value) {
        const date = new Date(dateInput.value);
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        daySpan.textContent = days[date.getDay()];
    }
}

document.getElementById('dateAddSubtractForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const ignoreTime = document.getElementById('ignore_time').checked;
    
    if (!date) {
        alert('Please select a date.');
        return;
    }
    
    const formData = new FormData();
    
    // Combine date and time
    const dateTime = ignoreTime ? date : `${date} ${time}`;
    formData.append('date', dateTime);
    
    // Get all operations and values
    const units = ['years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'];
    let hasValues = false;
    
    units.forEach(unit => {
        const value = parseInt(document.getElementById(unit).value) || 0;
        const operation = document.getElementById(unit + '_operation').value;
        
        formData.append(unit, value.toString()); // Ensure it's a string representation of integer
        formData.append(unit + '_operation', operation);
        
        if (value > 0) {
            hasValues = true;
        }
    });
    
    if (!hasValues) {
        alert('Please enter at least one time unit value greater than 0.');
        return;
    }
    
    fetch('<?php echo e(route("tools.add-subtract-from-date")); ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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
            displayResults(data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message);
    });
});

function displayResults(data) {
    document.getElementById('resultsSection').style.display = 'block';
    
    document.getElementById('resultDate').textContent = data.result_date;
    document.getElementById('resultFormatted').textContent = data.formatted_date;
    document.getElementById('resultDay').textContent = data.day_of_week;
    
    // Scroll to results
    document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth' });
}

function clearForm() {
    document.getElementById('dateAddSubtractForm').reset();
    document.getElementById('resultsSection').style.display = 'none';
    
    // Reset all toggle buttons to add
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.classList.contains('add')) {
            btn.classList.add('active');
        }
    });
    
    // Reset all operation hidden inputs
    document.querySelectorAll('input[name$="_operation"]').forEach(input => {
        input.value = 'add';
    });
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = today;
    updateDayOfWeek();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\user\tools\add-subtract-date.blade.php ENDPATH**/ ?>