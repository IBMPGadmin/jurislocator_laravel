

<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">Stripe Configuration Debug</h1>
            <p class="lead mt-3">
                This page helps verify your Stripe configuration.
            </p>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Development Only:</strong> This page should only be accessible in development mode.
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Stripe Configuration</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Public Key</th>
                                <td>
                                    <?php if($publicKey): ?>
                                        <span class="text-success"><i class="bi bi-check-circle-fill me-2"></i>Set</span>
                                        <small class="text-muted d-block"><?php echo e($publicKey); ?></small>
                                    <?php else: ?>
                                        <span class="text-danger"><i class="bi bi-x-circle-fill me-2"></i>Not Set</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Secret Key</th>
                                <td>
                                    <?php if($secretKeySet): ?>
                                        <span class="text-success"><i class="bi bi-check-circle-fill me-2"></i>Set</span>
                                        <small class="text-muted d-block"><?php echo e($secretKeyPrefix); ?> (<?php echo e($secretKeyLength); ?> characters)</small>
                                    <?php else: ?>
                                        <span class="text-danger"><i class="bi bi-x-circle-fill me-2"></i>Not Set</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Currency</th>
                                <td><?php echo e(strtoupper($currency)); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Environment Information</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">PHP Version</th>
                                <td><?php echo e($phpVersion); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">cURL Extension</th>
                                <td>
                                    <?php if($stripeExtensionLoaded): ?>
                                        <span class="text-success"><i class="bi bi-check-circle-fill me-2"></i>Loaded</span>
                                    <?php else: ?>
                                        <span class="text-danger"><i class="bi bi-x-circle-fill me-2"></i>Not Loaded</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Environment</th>
                                <td><?php echo e(app()->environment()); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Test Payments</h3>
                </div>
                <div class="card-body">
                    <p>Use the links below to test your Stripe integration:</p>
                    
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('subscription.test-checkout')); ?>" class="btn btn-primary">
                            <i class="bi bi-credit-card me-2"></i> Test Checkout
                        </a>
                        <a href="<?php echo e(route('subscription.test-cards')); ?>" class="btn btn-outline-primary">
                            <i class="bi bi-info-circle me-2"></i> View Test Cards
                        </a>
                        <a href="<?php echo e(route('subscription.pricing')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Return to Pricing
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\subscription\stripe-debug.blade.php ENDPATH**/ ?>