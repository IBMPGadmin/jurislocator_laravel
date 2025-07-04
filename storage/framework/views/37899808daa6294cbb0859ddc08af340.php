

<?php $__env->startSection('content'); ?>
<div class="tool-container">
    <div class="tool-content">
        <!-- Header -->
        <div class="tool-header">
            <div class="tool-icon-large">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <h1 class="tool-title" data-en="Currency Converter" data-fr="Convertisseur de devises">Currency Converter</h1>
            <p class="tool-subtitle" data-en="Check Live Foreign Currency Exchange Rates" data-fr="Vérifiez les taux de change en direct">Check Live Foreign Currency Exchange Rates</p>
        </div>

        <!-- Calculator Form -->
        <div class="calculator-card">
            <form id="currencyConverterForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="from_currency" data-en="From" data-fr="De">From</label>
                        <select class="form-control" id="from_currency" name="from_currency" required>
                            <option value="CAD" selected>CAD - Canadian Dollar</option>
                            <option value="USD">USD - United States Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="GBP">GBP - British Pound Sterling</option>
                            <option value="JPY">JPY - Japanese Yen</option>
                            <option value="AUD">AUD - Australian Dollar</option>
                            <option value="CHF">CHF - Swiss Franc</option>
                            <option value="CNY">CNY - Chinese Yuan</option>
                            <option value="INR">INR - Indian Rupee</option>
                            <option value="KRW">KRW - South Korean Won</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount" data-en="Amount" data-fr="Montant">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" value="1" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="to_currency" data-en="To" data-fr="À">To</label>
                        <select class="form-control" id="to_currency" name="to_currency" required>
                            <option value="USD" selected>USD - United States Dollar</option>
                            <option value="CAD">CAD - Canadian Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="GBP">GBP - British Pound Sterling</option>
                            <option value="JPY">JPY - Japanese Yen</option>
                            <option value="AUD">AUD - Australian Dollar</option>
                            <option value="CHF">CHF - Swiss Franc</option>
                            <option value="CNY">CNY - Chinese Yuan</option>
                            <option value="INR">INR - Indian Rupee</option>
                            <option value="KRW">KRW - South Korean Won</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="converted_amount" data-en="Converted Amount" data-fr="Montant converti">Converted Amount</label>
                        <input type="text" class="form-control" id="converted_amount" readonly placeholder="0.00">
                    </div>
                </div>

                <div class="conversion-display">
                    <div class="conversion-rate" id="conversionRate">
                        1 CAD = 0.7366 USD
                    </div>
                    <button type="button" class="swap-btn" id="swapCurrencies" title="Swap currencies">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="clearForm()" data-en="Clear" data-fr="Effacer">Clear</button>
                    <button type="submit" class="btn btn-primary" data-en="Convert" data-fr="Convertir">Convert</button>
                </div>
            </form>
        </div>

        <!-- Exchange Rate Source -->
        <div class="rate-source">
            <div class="source-info">
                <i class="fas fa-info-circle"></i>
                <span data-en="Exchange rates source" data-fr="Source des taux de change">Exchange rates source</span>
                <a href="https://exchangerate-api.com" target="_blank">exchangerate-api.com</a>
            </div>
            <div class="last-updated" id="lastUpdated">
                <!-- Last updated time will be displayed here -->
            </div>
        </div>

        <!-- Popular Currency Pairs -->
        <div class="popular-pairs">
            <h3 data-en="Popular Currency Pairs" data-fr="Paires de devises populaires">Popular Currency Pairs</h3>
            <div class="pairs-grid" id="popularPairs">
                <!-- Popular pairs will be loaded here -->
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
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    padding: 2rem 1rem;
}

.tool-content {
    max-width: 800px;
    margin: 0 auto;
}

.tool-header {
    text-align: center;
    margin-bottom: 2rem;
    color: #333;
}

.tool-icon-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(255,255,255,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 3rem;
    color: #333;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.tool-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #333;
}

.tool-subtitle {
    font-size: 1.1rem;
    color: #666;
}

.calculator-card, .popular-pairs {
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
    border-color: #a8edea;
}

.form-control[readonly] {
    background-color: #f8f9fa;
    color: #28a745;
    font-weight: 600;
}

.conversion-display {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin: 2rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.conversion-rate {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
}

.swap-btn {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #333;
    font-size: 1.2rem;
}

.swap-btn:hover {
    transform: rotate(180deg) scale(1.1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    color: #333;
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

.rate-source {
    background: white;
    border-radius: 15px;
    padding: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.source-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #666;
    font-size: 0.9rem;
}

.source-info a {
    color: #a8edea;
    text-decoration: none;
}

.source-info a:hover {
    text-decoration: underline;
}

.last-updated {
    color: #999;
    font-size: 0.9rem;
}

.popular-pairs h3 {
    color: #333;
    margin-bottom: 1.5rem;
    text-align: center;
}

.pairs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.pair-card {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.pair-card:hover {
    background: #e9ecef;
    border-color: #a8edea;
    transform: translateY(-2px);
}

.pair-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.pair-rate {
    color: #28a745;
    font-weight: 600;
}

.tool-navigation {
    text-align: center;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #333;
    text-decoration: none;
    font-size: 1.1rem;
    padding: 12px 24px;
    border-radius: 25px;
    background: rgba(255,255,255,0.8);
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.back-btn:hover {
    background: rgba(255,255,255,1);
    color: #333;
    text-decoration: none;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .conversion-display {
        flex-direction: column;
        text-align: center;
    }
    
    .button-group {
        flex-direction: column;
    }
    
    .rate-source {
        flex-direction: column;
        text-align: center;
    }
    
    .tool-title {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load popular currency pairs
    loadPopularPairs();
    
    // Auto-convert when amount or currencies change
    document.getElementById('amount').addEventListener('input', convertCurrency);
    document.getElementById('from_currency').addEventListener('change', convertCurrency);
    document.getElementById('to_currency').addEventListener('change', convertCurrency);
    
    // Swap currencies functionality
    document.getElementById('swapCurrencies').addEventListener('click', function() {
        const fromCurrency = document.getElementById('from_currency');
        const toCurrency = document.getElementById('to_currency');
        
        const temp = fromCurrency.value;
        fromCurrency.value = toCurrency.value;
        toCurrency.value = temp;
        
        convertCurrency();
    });
    
    // Initial conversion
    convertCurrency();
});

document.getElementById('currencyConverterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    convertCurrency();
});

function convertCurrency() {
    const fromCurrency = document.getElementById('from_currency').value;
    const toCurrency = document.getElementById('to_currency').value;
    const amount = parseFloat(document.getElementById('amount').value) || 0;
    
    if (amount <= 0) return;
    
    const formData = new FormData();
    formData.append('from', fromCurrency);
    formData.append('to', toCurrency);
    formData.append('amount', amount);
    
    fetch('<?php echo e(route("tools.exchange-rates")); ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('converted_amount').value = data.converted_amount.toFixed(2);
            document.getElementById('conversionRate').textContent = 
                `1 ${data.from} = ${data.rate.toFixed(4)} ${data.to}`;
            
            if (data.last_updated) {
                document.getElementById('lastUpdated').textContent = 
                    `Last updated: ${new Date(data.last_updated).toLocaleString()}`;
            }
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while converting currency.');
    });
}

function loadPopularPairs() {
    const popularPairsContainer = document.getElementById('popularPairs');
    const pairs = [
        { from: 'USD', to: 'EUR' },
        { from: 'USD', to: 'GBP' },
        { from: 'USD', to: 'JPY' },
        { from: 'EUR', to: 'GBP' },
        { from: 'CAD', to: 'USD' },
        { from: 'AUD', to: 'USD' }
    ];
    
    pairs.forEach(pair => {
        const formData = new FormData();
        formData.append('from', pair.from);
        formData.append('to', pair.to);
        formData.append('amount', 1);
        
        fetch('<?php echo e(route("tools.exchange-rates")); ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const pairCard = document.createElement('div');
                pairCard.className = 'pair-card';
                pairCard.innerHTML = `
                    <div class="pair-title">${pair.from} to ${pair.to}</div>
                    <div class="pair-rate">1 ${pair.from} = ${data.rate.toFixed(4)} ${pair.to}</div>
                `;
                pairCard.addEventListener('click', function() {
                    document.getElementById('from_currency').value = pair.from;
                    document.getElementById('to_currency').value = pair.to;
                    convertCurrency();
                });
                popularPairsContainer.appendChild(pairCard);
            }
        })
        .catch(error => {
            console.error('Error loading pair:', pair, error);
        });
    });
}

function clearForm() {
    document.getElementById('amount').value = '1';
    document.getElementById('converted_amount').value = '';
    document.getElementById('from_currency').value = 'CAD';
    document.getElementById('to_currency').value = 'USD';
    document.getElementById('conversionRate').textContent = '1 CAD = 0.7366 USD';
    document.getElementById('lastUpdated').textContent = '';
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/user/tools/currency-converter.blade.php ENDPATH**/ ?>