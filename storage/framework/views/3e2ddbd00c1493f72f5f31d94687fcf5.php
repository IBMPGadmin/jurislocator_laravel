

<?php $__env->startSection('content'); ?>
<div class="tool-container">
    <div class="tool-content">
        <!-- Header -->
        <div class="tool-header">
            <div class="tool-icon-large">
                <i class="fas fa-globe-americas"></i>
            </div>
            <h1 class="tool-title" data-en="World Clock" data-fr="Horloge mondiale">World Clock</h1>
            <p class="tool-subtitle" data-en="World Time And Date For Cities In All Time Zones" data-fr="Heure et date mondiales pour les villes de tous les fuseaux horaires">World Time And Date For Cities In All Time Zones</p>
        </div>

        <!-- Your Local Time -->
        <div class="local-time-card">
            <div class="time-display">
                <div class="clock-container">
                    <div class="analog-clock" id="analogClock">
                        <div class="clock-face">
                            <div class="hour-hand" id="hourHand"></div>
                            <div class="minute-hand" id="minuteHand"></div>
                            <div class="second-hand" id="secondHand"></div>
                            <div class="center-dot"></div>
                            <!-- Hour markers -->
                            <div class="hour-marker" style="transform: rotate(0deg)"><span>12</span></div>
                            <div class="hour-marker" style="transform: rotate(30deg)"><span>1</span></div>
                            <div class="hour-marker" style="transform: rotate(60deg)"><span>2</span></div>
                            <div class="hour-marker" style="transform: rotate(90deg)"><span>3</span></div>
                            <div class="hour-marker" style="transform: rotate(120deg)"><span>4</span></div>
                            <div class="hour-marker" style="transform: rotate(150deg)"><span>5</span></div>
                            <div class="hour-marker" style="transform: rotate(180deg)"><span>6</span></div>
                            <div class="hour-marker" style="transform: rotate(210deg)"><span>7</span></div>
                            <div class="hour-marker" style="transform: rotate(240deg)"><span>8</span></div>
                            <div class="hour-marker" style="transform: rotate(270deg)"><span>9</span></div>
                            <div class="hour-marker" style="transform: rotate(300deg)"><span>10</span></div>
                            <div class="hour-marker" style="transform: rotate(330deg)"><span>11</span></div>
                        </div>
                    </div>
                    <div class="digital-display">
                        <div class="local-time" id="localTime">12:29:12</div>
                        <div class="local-date" id="localDate">Friday, July 4, 2025</div>
                        <div class="timezone-info" id="timezoneInfo">(UTC-12:00) International Date Line West</div>
                    </div>
                </div>
                <div class="your-time-label" data-en="Your Time" data-fr="Votre heure">Your Time</div>
                <button class="update-btn" id="updateNow" data-en="Update now" data-fr="Mettre à jour maintenant">
                    <i class="fas fa-sync-alt"></i>
                    Update now
                </button>
            </div>
        </div>

        <!-- World Time Zones -->
        <div class="world-times-card">
            <h3 data-en="World Time Zones" data-fr="Fuseaux horaires mondiaux">World Time Zones</h3>
            
            <!-- Timezone Selection -->
            <div class="timezone-selector">
                <select class="form-control" id="timezoneSelect">
                    <option value="">(UTC-12:00) International Date Line West</option>
                    <option value="Pacific/Midway">(UTC-11:00) Midway Island, Samoa</option>
                    <option value="Pacific/Honolulu">(UTC-10:00) Hawaii</option>
                    <option value="America/Anchorage">(UTC-09:00) Alaska</option>
                    <option value="America/Los_Angeles">(UTC-08:00) Pacific Time (US & Canada)</option>
                    <option value="America/Denver">(UTC-07:00) Mountain Time (US & Canada)</option>
                    <option value="America/Chicago">(UTC-06:00) Central Time (US & Canada)</option>
                    <option value="America/New_York">(UTC-05:00) Eastern Time (US & Canada)</option>
                    <option value="America/Halifax">(UTC-04:00) Atlantic Time (Canada)</option>
                    <option value="America/St_Johns">(UTC-03:30) Newfoundland</option>
                    <option value="America/Sao_Paulo">(UTC-03:00) Brasilia</option>
                    <option value="Atlantic/South_Georgia">(UTC-02:00) Mid-Atlantic</option>
                    <option value="Atlantic/Azores">(UTC-01:00) Azores</option>
                    <option value="Europe/London">(UTC+00:00) Greenwich Mean Time</option>
                    <option value="Europe/Paris">(UTC+01:00) Central European Time</option>
                    <option value="Europe/Athens">(UTC+02:00) Eastern European Time</option>
                    <option value="Europe/Moscow">(UTC+03:00) Moscow, St. Petersburg</option>
                    <option value="Asia/Dubai">(UTC+04:00) Abu Dhabi, Muscat</option>
                    <option value="Asia/Karachi">(UTC+05:00) Islamabad, Karachi</option>
                    <option value="Asia/Kolkata">(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                    <option value="Asia/Dhaka">(UTC+06:00) Dhaka</option>
                    <option value="Asia/Bangkok">(UTC+07:00) Bangkok, Hanoi, Jakarta</option>
                    <option value="Asia/Shanghai">(UTC+08:00) Beijing, Chongqing, Hong Kong</option>
                    <option value="Asia/Tokyo">(UTC+09:00) Osaka, Sapporo, Tokyo</option>
                    <option value="Australia/Sydney">(UTC+10:00) Canberra, Melbourne, Sydney</option>
                    <option value="Pacific/Auckland">(UTC+12:00) Auckland, Wellington</option>
                </select>
                <button class="btn btn-primary" id="addTimezone" data-en="Add Timezone" data-fr="Ajouter un fuseau horaire">Add Timezone</button>
            </div>

            <!-- Selected Timezones Display -->
            <div class="timezones-grid" id="timezonesGrid">
                <!-- Pre-populate with popular timezones -->
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
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    padding: 2rem 1rem;
}

.tool-content {
    max-width: 1000px;
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

.local-time-card, .world-times-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.time-display {
    text-align: center;
    position: relative;
}

.clock-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 3rem;
    margin-bottom: 2rem;
}

.analog-clock {
    width: 200px;
    height: 200px;
    position: relative;
}

.clock-face {
    width: 100%;
    height: 100%;
    border: 4px solid #f093fb;
    border-radius: 50%;
    position: relative;
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.hour-marker {
    position: absolute;
    top: 10px;
    left: 50%;
    transform-origin: 50% 90px;
    width: 2px;
    height: 20px;
    background: #333;
}

.hour-marker span {
    position: absolute;
    top: -5px;
    left: -8px;
    font-size: 14px;
    font-weight: 600;
}

.hour-hand, .minute-hand, .second-hand {
    position: absolute;
    background: #333;
    transform-origin: bottom center;
    left: 50%;
    bottom: 50%;
}

.hour-hand {
    width: 4px;
    height: 50px;
    margin-left: -2px;
    background: #333;
}

.minute-hand {
    width: 2px;
    height: 70px;
    margin-left: -1px;
    background: #333;
}

.second-hand {
    width: 1px;
    height: 80px;
    margin-left: -0.5px;
    background: #f093fb;
}

.center-dot {
    position: absolute;
    width: 12px;
    height: 12px;
    background: #f093fb;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
}

.digital-display {
    text-align: left;
}

.local-time {
    font-size: 3rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
    font-family: 'Courier New', monospace;
}

.local-date {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.timezone-info {
    font-size: 1rem;
    color: #999;
}

.your-time-label {
    font-size: 1.5rem;
    font-weight: 600;
    color: #f093fb;
    margin-bottom: 1rem;
}

.update-btn {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0 auto;
}

.update-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(240, 147, 251, 0.4);
}

.world-times-card h3 {
    color: #333;
    margin-bottom: 2rem;
    text-align: center;
    font-size: 1.5rem;
}

.timezone-selector {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    align-items: center;
}

.form-control {
    flex: 1;
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #f093fb;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.btn-primary {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.timezones-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.timezone-card {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    position: relative;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.timezone-card:hover {
    border-color: #f093fb;
    transform: translateY(-2px);
}

.timezone-city {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.timezone-time {
    font-size: 2rem;
    font-weight: 700;
    color: #f093fb;
    margin-bottom: 0.5rem;
    font-family: 'Courier New', monospace;
}

.timezone-date {
    font-size: 1rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.timezone-offset {
    font-size: 0.9rem;
    color: #999;
}

.remove-timezone {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
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
    .clock-container {
        flex-direction: column;
        gap: 1rem;
    }
    
    .analog-clock {
        width: 150px;
        height: 150px;
    }
    
    .local-time {
        font-size: 2rem;
    }
    
    .timezone-selector {
        flex-direction: column;
    }
    
    .timezones-grid {
        grid-template-columns: 1fr;
    }
    
    .tool-title {
        font-size: 2rem;
    }
}
</style>

<script>
let selectedTimezones = [
    { timezone: 'America/New_York', city: 'New York' },
    { timezone: 'Europe/London', city: 'London' },
    { timezone: 'Asia/Tokyo', city: 'Tokyo' },
    { timezone: 'Australia/Sydney', city: 'Sydney' }
];

document.addEventListener('DOMContentLoaded', function() {
    updateLocalTime();
    updateWorldTimes();
    
    // Update times every second
    setInterval(() => {
        updateLocalTime();
        updateWorldTimes();
    }, 1000);
    
    // Add timezone functionality
    document.getElementById('addTimezone').addEventListener('click', addTimezone);
    document.getElementById('updateNow').addEventListener('click', function() {
        updateLocalTime();
        updateWorldTimes();
        
        // Add animation to update button
        this.style.transform = 'rotate(360deg)';
        setTimeout(() => {
            this.style.transform = 'rotate(0deg)';
        }, 500);
    });
    
    // Initial render
    renderWorldTimes();
});

function updateLocalTime() {
    const now = new Date();
    
    // Update digital display
    const timeString = now.toLocaleTimeString('en-US', { 
        hour12: false, 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
    });
    const dateString = now.toLocaleDateString('en-US', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
    
    document.getElementById('localTime').textContent = timeString;
    document.getElementById('localDate').textContent = dateString;
    
    // Update timezone info
    const timezoneOffset = -now.getTimezoneOffset() / 60;
    const timezoneString = `(UTC${timezoneOffset >= 0 ? '+' : ''}${timezoneOffset}:00) ${Intl.DateTimeFormat().resolvedOptions().timeZone}`;
    document.getElementById('timezoneInfo').textContent = timezoneString;
    
    // Update analog clock
    updateAnalogClock(now);
}

function updateAnalogClock(time) {
    const hours = time.getHours() % 12;
    const minutes = time.getMinutes();
    const seconds = time.getSeconds();
    
    const hourAngle = (hours * 30) + (minutes * 0.5); // 30 degrees per hour + minute adjustment
    const minuteAngle = minutes * 6; // 6 degrees per minute
    const secondAngle = seconds * 6; // 6 degrees per second
    
    document.getElementById('hourHand').style.transform = `rotate(${hourAngle}deg)`;
    document.getElementById('minuteHand').style.transform = `rotate(${minuteAngle}deg)`;
    document.getElementById('secondHand').style.transform = `rotate(${secondAngle}deg)`;
}

function addTimezone() {
    const select = document.getElementById('timezoneSelect');
    const selectedOption = select.options[select.selectedIndex];
    
    if (!selectedOption.value) {
        alert('Please select a timezone');
        return;
    }
    
    const timezone = selectedOption.value;
    const city = selectedOption.text.split(') ')[1] || timezone.split('/')[1].replace('_', ' ');
    
    // Check if timezone already exists
    if (selectedTimezones.find(tz => tz.timezone === timezone)) {
        alert('This timezone is already added');
        return;
    }
    
    selectedTimezones.push({ timezone, city });
    renderWorldTimes();
    
    // Reset select
    select.selectedIndex = 0;
}

function removeTimezone(index) {
    selectedTimezones.splice(index, 1);
    renderWorldTimes();
}

function renderWorldTimes() {
    const container = document.getElementById('timezonesGrid');
    container.innerHTML = '';
    
    selectedTimezones.forEach((tz, index) => {
        const card = document.createElement('div');
        card.className = 'timezone-card';
        card.innerHTML = `
            <button class="remove-timezone" onclick="removeTimezone(${index})">×</button>
            <div class="timezone-city">${tz.city}</div>
            <div class="timezone-time" id="time-${index}">--:--:--</div>
            <div class="timezone-date" id="date-${index}">-</div>
            <div class="timezone-offset" id="offset-${index}">-</div>
        `;
        container.appendChild(card);
    });
    
    updateWorldTimes();
}

function updateWorldTimes() {
    selectedTimezones.forEach((tz, index) => {
        try {
            const now = new Date();
            const timeInTimezone = new Date(now.toLocaleString("en-US", {timeZone: tz.timezone}));
            
            const timeString = timeInTimezone.toLocaleTimeString('en-US', { 
                hour12: false, 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            });
            const dateString = timeInTimezone.toLocaleDateString('en-US', { 
                weekday: 'long', 
                month: 'long', 
                day: 'numeric' 
            });
            
            // Calculate UTC offset for this timezone
            const utcTime = new Date(now.getTime() + (now.getTimezoneOffset() * 60000));
            const timezoneTime = new Date(utcTime.toLocaleString("en-US", {timeZone: tz.timezone}));
            const offset = (timezoneTime.getTime() - utcTime.getTime()) / (1000 * 60 * 60);
            const offsetString = `UTC${offset >= 0 ? '+' : ''}${offset}:00`;
            
            document.getElementById(`time-${index}`).textContent = timeString;
            document.getElementById(`date-${index}`).textContent = dateString;
            document.getElementById(`offset-${index}`).textContent = offsetString;
        } catch (error) {
            console.error('Error updating timezone:', tz.timezone, error);
        }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/user/tools/time-zones.blade.php ENDPATH**/ ?>