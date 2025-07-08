<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 10px;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin: 0;
        }
        .report-meta {
            margin: 20px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .stat-box {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            width: 22%;
            text-align: center;
        }
        .stat-title {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }
        td {
            padding: 10px;
            font-size: 13px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .filters {
            margin-bottom: 20px;
            font-size: 13px;
        }
        .filter-item {
            display: inline-block;
            margin-right: 15px;
            padding: 5px 10px;
            background-color: #e9ecef;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>JurisLocator Payment Report</h1>
        <p>Generated on <?php echo e(now()->format('F d, Y H:i:s')); ?></p>
    </div>
    
    <div class="report-meta">
        <p><strong>Report Period:</strong> <?php echo e($startDate ?? 'All time'); ?> to <?php echo e($endDate ?? 'Present'); ?></p>
        <?php if($search): ?>
        <p><strong>Search Query:</strong> <?php echo e($search); ?></p>
        <?php endif; ?>
        <?php if($status): ?>
        <p><strong>Status Filter:</strong> <?php echo e(ucfirst($status)); ?></p>
        <?php endif; ?>
        <?php if($packageName): ?>
        <p><strong>Package Filter:</strong> <?php echo e($packageName); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="stats-container">
        <div class="stat-box">
            <div class="stat-title">Total Revenue</div>
            <div class="stat-value">$<?php echo e(number_format($stats['total_revenue'], 2)); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-title">Total Payments</div>
            <div class="stat-value"><?php echo e($stats['total_payments']); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-title">Active Subscriptions</div>
            <div class="stat-value"><?php echo e($stats['active_subscriptions']); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-title">Payments This Month</div>
            <div class="stat-value"><?php echo e($stats['payments_this_month']); ?></div>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>                <th>User</th>
                <th>Package</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($subscription->id); ?></td>
                <td>
                    <?php echo e($subscription->user->name ?? 'Unknown'); ?><br>
                    <small><?php echo e($subscription->user->email ?? 'N/A'); ?></small>
                </td>
                <td><?php echo e($subscription->package->name ?? 'N/A'); ?></td>                <td><?php echo e($subscription->amount ? '$'.number_format($subscription->amount, 2) : ($subscription->package ? '$'.number_format($subscription->package->price, 2) : 'N/A')); ?></td>
                <td><?php echo e($subscription->created_at ? $subscription->created_at->format('M d, Y') : 'N/A'); ?></td>
                <td><?php echo e($subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A'); ?></td>
                <td>
                    <?php if($subscription->is_trial): ?>
                    Trial
                    <?php elseif($subscription->isCanceled()): ?>
                    Canceled
                    <?php elseif($subscription->isExpired()): ?>
                    Expired
                    <?php else: ?>
                    Active
                    <?php endif; ?>
                </td>
                <td><?php echo e($subscription->payment_method ?? 'N/A'); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" style="text-align: center;">No payment records found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="footer">
        <p>&copy; <?php echo e(date('Y')); ?> JurisLocator. All rights reserved.</p>
        <p>This is an auto-generated report. Please do not reply.</p>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\admin\payments\pdf_report.blade.php ENDPATH**/ ?>