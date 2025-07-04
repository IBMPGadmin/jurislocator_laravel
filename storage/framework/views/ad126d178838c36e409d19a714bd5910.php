

<?php $__env->startSection('content'); ?>
<div class="pending-approval-container">
    <div class="pending-approval-card">
        <div class="text-center">
            <div class="approval-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h1 class="approval-title">Account Pending Approval</h1>
            <p class="approval-subtitle">Your registration has been submitted successfully!</p>
            
            <div class="approval-content">
                <div class="approval-message">
                    <i class="fas fa-info-circle me-2"></i>
                    <p>Thank you for registering with JurisLocator. Your account is currently under review by our administrators.</p>
                </div>
                
                <div class="approval-timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Registration Submitted</h4>
                            <p>Your information has been received</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item pending">
                        <div class="timeline-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Under Review</h4>
                            <p>Admin is reviewing your application</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Account Activation</h4>
                            <p>You'll receive an email once approved</p>
                        </div>
                    </div>
                </div>
                
                <div class="approval-info">
                    <div class="info-box">
                        <h5><i class="fas fa-envelope me-2"></i>Email Notification</h5>
                        <p>You will receive an email notification once your account has been reviewed. Please check your inbox and spam folder.</p>
                    </div>
                    
                    <div class="info-box">
                        <h5><i class="fas fa-stopwatch me-2"></i>Review Time</h5>
                        <p>Account reviews are typically completed within 24 hours during business days.</p>
                    </div>
                </div>
                
                <div class="approval-actions">
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary me-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Back to Login
                    </a>
                    <a href="mailto:support@jurislocator.com" class="btn btn-secondary">
                        <i class="fas fa-headset me-2"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #002B5B;
    --secondary-color: #C19A6B;
    --success-color: #28a745;
    --info-color: #17a2b8;
    --warning-color: #ffc107;
    --light-color: #ffffff;
    --bg-color: #f8f5f1;
}

.pending-approval-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: linear-gradient(135deg, rgba(0,43,91,0.03) 0%, rgba(193,154,107,0.07) 100%);
}

.pending-approval-card {
    background: var(--light-color);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 3rem;
    max-width: 800px;
    width: 100%;
}

.approval-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--warning-color), #ff9800);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    font-size: 3rem;
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.approval-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.approval-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 2rem;
}

.approval-message {
    background: rgba(23, 162, 184, 0.1);
    border: 1px solid var(--info-color);
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: flex-start;
}

.approval-message i {
    color: var(--info-color);
    margin-top: 2px;
    font-size: 1.2rem;
}

.approval-message p {
    margin: 0;
    color: #333;
    line-height: 1.6;
}

.approval-timeline {
    margin: 2rem 0;
}

.timeline-item {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    position: relative;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 22px;
    top: 45px;
    width: 2px;
    height: 30px;
    background: #ddd;
}

.timeline-item.completed::after {
    background: var(--success-color);
}

.timeline-item.pending::after {
    background: var(--warning-color);
}

.timeline-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.2rem;
    color: white;
}

.timeline-item.completed .timeline-icon {
    background: var(--success-color);
}

.timeline-item.pending .timeline-icon {
    background: var(--warning-color);
}

.timeline-item:not(.completed):not(.pending) .timeline-icon {
    background: #ddd;
    color: #999;
}

.timeline-content h4 {
    margin: 0 0 0.25rem 0;
    font-size: 1.1rem;
    color: var(--primary-color);
}

.timeline-content p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.approval-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin: 2rem 0;
}

.info-box {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
    border-left: 4px solid var(--secondary-color);
}

.info-box h5 {
    color: var(--primary-color);
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.info-box h5 i {
    color: var(--secondary-color);
}

.info-box p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
}

.approval-actions {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
}

.btn-outline-primary {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    background: transparent;
}

.btn-outline-primary:hover {
    background: var(--primary-color);
    color: white;
    text-decoration: none;
}

.btn-secondary {
    background: var(--secondary-color);
    color: white;
    border: 2px solid var(--secondary-color);
}

.btn-secondary:hover {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    text-decoration: none;
}

@media (max-width: 768px) {
    .pending-approval-card {
        padding: 2rem 1.5rem;
    }
    
    .approval-title {
        font-size: 2rem;
    }
    
    .approval-info {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .approval-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\14\jurislocator_laravel\resources\views/auth/pending-approval.blade.php ENDPATH**/ ?>