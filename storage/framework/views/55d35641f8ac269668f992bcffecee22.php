<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">JurisLocator Pricing</h1>
            <p class="lead mt-3">
                Choose the plan that fits your legal research needs. Whether you're a solo practitioner or a large legal firm, 
                JurisLocator offers flexible packages with optional services to suit your workflow.
            </p>
            <p class="mt-2">
                All plans include access to Canadian immigration acts and regulations, advanced search tools, 
                legal cross-referencing, and dynamic content popups.
            </p>
        </div>        <?php if(session('warning')): ?>
            <div class="col-12 mb-4">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>
                        <strong>Attention:</strong> <?php echo e(session('warning')); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="col-12 mb-4">
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>
                        <strong>Error:</strong> <?php echo e(session('error')); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(session('success')): ?>
            <div class="col-12 mb-4">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>
                        <strong>Success:</strong> <?php echo e(session('success')); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($currentSubscription): ?>
            <div class="col-12 mb-5">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Your Current Subscription</h5>
                        <?php if($currentSubscription->status === 'trial'): ?>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-pill bg-info me-2"><i class="bi bi-clock"></i></span>
                                <div>
                                    <p class="mb-0">Your trial subscription will expire on <strong><?php echo e($currentSubscription->trial_ends_at->format('F j, Y')); ?></strong>.</p>
                                    <small class="text-muted"><?php echo e($currentSubscription->trial_ends_at->diffForHumans()); ?> - Choose a plan below to continue accessing JurisLocator.</small>
                                </div>
                            </div>
                        <?php elseif($currentSubscription->status === 'active'): ?>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-pill bg-success me-2"><i class="bi bi-check-circle"></i></span>
                                <div>
                                    <p class="mb-0">You have an active <strong><?php echo e($currentSubscription->package->name); ?></strong> subscription.</p>
                                    <?php if($currentSubscription->subscription_ends_at): ?>
                                        <small class="text-muted">Valid until <?php echo e($currentSubscription->subscription_ends_at->format('F j, Y')); ?></small>
                                    <?php else: ?>
                                        <small class="text-muted">Lifetime access - Thank you for your subscription!</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-pill bg-danger me-2"><i class="bi bi-exclamation-circle"></i></span>
                                <p class="mb-0">Your subscription has expired. Please select a plan below to regain access.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold text-primary">Lifetime Plans</h2>
            <p class="text-muted mb-4">One-time payment, unlimited access — ideal for long-term users and organizations.</p>
        </div>

        <div class="row justify-content-center">
            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-white bg-primary text-center py-3">
                            <h3 class="mb-0 fw-bold"><?php echo e($package->name); ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h4 class="display-5 fw-bold text-primary">$<?php echo e(number_format($package->price, 0)); ?></h4>
                                <p class="text-muted">CAD / lifetime</p>
                            </div>
                            
                            <ul class="list-group list-group-flush mb-4">
                                <?php $__currentLoopData = $package->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item border-0 d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <?php echo e($feature); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            
                            <form action="<?php echo e(route('subscription.purchase', $package)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-primary btn-lg w-100">Choose Plan</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div class="col-12 mt-5 mb-5">
            <h2 class="fw-bold text-primary text-center mb-4">Features Explained</h2>
            
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="bi bi-shield-check text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title text-center">Built-In Issue Reporting System</h5>
                            <p class="card-text">Identify and report content issues within legal references and documents. Help maintain the reliability of the platform.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="bi bi-headset text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title text-center">Premium Support</h5>
                            <p class="card-text">Access dedicated assistance for faster resolutions and personalized help. Enterprise users receive fast-tracked support with minimal wait times.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="bi bi-mortarboard text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title text-center">Onboarding & Training</h5>
                            <p class="card-text">Comprehensive training to get your team up to speed quickly. Personalized onboarding sessions to ensure you get the most out of JurisLocator.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="mb-0 fw-bold">Frequently Asked Questions</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is included in the subscription?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    All plans include access to Canadian immigration acts and regulations, advanced search tools, legal cross-referencing, and dynamic content popups.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How does the lifetime license work?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Lifetime licenses provide permanent access to JurisLocator with all current features. You'll also receive updates and improvements to the platform.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Can I upgrade my plan later?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, you can upgrade from a Single User license to an Enterprise license at any time by paying the difference in price.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        <div class="col-12 mt-5 text-center">
            <p>Need more information? Contact us at <a href="mailto:sales@jurislocator.ca" class="text-primary">sales@jurislocator.ca</a></p>
            <p class="mt-2">WhatsApp: +1 (514) 299-5150</p>
              <div class="alert alert-info mt-4 mx-auto" style="max-width: 600px;">                <p class="mb-0">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Development Mode:</strong> This site is currently using Stripe's test payment system.
                    <a href="<?php echo e(route('subscription.test-cards')); ?>" class="alert-link">View test card information</a> for testing payments.
                </p>
                <hr>
                <p class="mb-0">
                    <i class="bi bi-bug-fill me-2"></i>
                    <strong>Having issues?</strong> 
                    <a href="<?php echo e(route('subscription.test-checkout')); ?>" class="alert-link">Try our direct test checkout</a> or 
                    <a href="<?php echo e(route('subscription.debug-stripe')); ?>" class="alert-link">check Stripe configuration</a>.
                </p>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize any JavaScript components that might be needed
    document.addEventListener('DOMContentLoaded', function() {
        // Any initialization code can go here
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ardent\Desktop\j.v1-main\j.v1-main\resources\views/subscription/pricing.blade.php ENDPATH**/ ?>