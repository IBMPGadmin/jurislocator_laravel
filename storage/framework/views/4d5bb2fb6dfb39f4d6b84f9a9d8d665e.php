

<?php $__env->startSection('admin-content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Add New User</h4>
                </div>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?php echo e($errors->first()); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo e(route('admin.users.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required value="<?php echo e(old('first_name')); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required value="<?php echo e(old('last_name')); ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?php echo e(old('email')); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="user_type" class="form-label">User Type</label>
                            <select class="form-control" id="user_type" name="user_type" required onchange="toggleConditionalFields()">
                                <option value="">Select User Type</option>
                                <option value="licensed_practitioner" <?php echo e(old('user_type') == 'licensed_practitioner' ? 'selected' : ''); ?>>Licensed Canadian Immigration Practitioner</option>
                                <option value="immigration_lawyer" <?php echo e(old('user_type') == 'immigration_lawyer' ? 'selected' : ''); ?>>Canadian Immigration Lawyer</option>
                                <option value="notaire_quebec" <?php echo e(old('user_type') == 'notaire_quebec' ? 'selected' : ''); ?>>Member of Chambre des notaires du Québec</option>
                                <option value="student_queens" <?php echo e(old('user_type') == 'student_queens' ? 'selected' : ''); ?>>Immigration Law student - Queens University</option>
                                <option value="student_montreal" <?php echo e(old('user_type') == 'student_montreal' ? 'selected' : ''); ?>>Immigration Law student - Université de Montréal</option>
                            </select>
                        </div>
                        
                        <!-- License Number Field -->
                        <div class="mb-3" id="license_field" style="display: none;">
                            <label for="license_number" class="form-label">License Number</label>
                            <input type="text" class="form-control" id="license_number" name="license_number" placeholder="License Number" value="<?php echo e(old('license_number')); ?>">
                        </div>

                        <!-- Student ID Number Field -->
                        <div class="mb-3" id="student_id_number_field" style="display: none;">
                            <label for="student_id_number" class="form-label">Student ID Number</label>
                            <input type="text" class="form-control" id="student_id_number" name="student_id_number" placeholder="Student ID Number" value="<?php echo e(old('student_id_number')); ?>">
                        </div>

                        <!-- Student ID Upload Field -->
                        <div class="mb-3" id="student_id_file_field" style="display: none;">
                            <label for="student_id_file" class="form-label">Student ID Photo</label>
                            <input type="file" class="form-control" id="student_id_file" name="student_id_file" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="form-text">Choose Student ID photo (PDF, JPG, PNG)</div>
                        </div>
                        
                        <!-- Hidden fields with fixed values -->
                        <input type="hidden" name="approval_status" value="approved">
                        <input type="hidden" name="role" value="user">
                        <input type="hidden" id="name" name="name" value="">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="form-text">Minimum 8 characters required</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Create User Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Users List -->
            <div class="card shadow mt-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>All Users</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($user->first_name ?? $user->name); ?> <?php echo e($user->last_name ?? ''); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td>
                                            <?php if($user->user_type): ?>
                                                <span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $user->user_type))); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Not Set</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($user->role == 'admin'): ?>
                                                <span class="badge bg-danger">Admin</span>
                                            <?php else: ?>
                                                <span class="badge bg-primary">User</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($user->approval_status == 'approved'): ?>
                                                <span class="badge bg-success">Approved</span>
                                            <?php elseif($user->approval_status == 'pending'): ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Rejected</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->created_at->format('M d, Y')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="7" class="text-center">No users found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleConditionalFields() {
        const userType = document.getElementById('user_type').value;
        const licenseField = document.getElementById('license_field');
        const studentIdNumberField = document.getElementById('student_id_number_field');
        const studentIdFileField = document.getElementById('student_id_file_field');
        const licenseInput = document.getElementById('license_number');
        const studentIdNumberInput = document.getElementById('student_id_number');
        const studentIdFileInput = document.getElementById('student_id_file');
        
        // Hide all conditional fields
        licenseField.style.display = 'none';
        studentIdNumberField.style.display = 'none';
        studentIdFileField.style.display = 'none';
        
        // Remove required attributes
        licenseInput.removeAttribute('required');
        studentIdNumberInput.removeAttribute('required');
        studentIdFileInput.removeAttribute('required');
        
        // Clear values
        licenseInput.value = '';
        studentIdNumberInput.value = '';
        studentIdFileInput.value = '';
        
        // Show relevant fields based on user type
        if (userType === 'licensed_practitioner') {
            licenseField.style.display = 'block';
            licenseInput.setAttribute('placeholder', 'License Number R400000 / 13456');
        } else if (userType === 'immigration_lawyer') {
            licenseField.style.display = 'block';
            licenseInput.setAttribute('placeholder', 'License Number 703492 / S700000 / B-1000 / 1999123 / 00001-F / 1234567 / 1999-0005 / 92-04-14 / 1999001');
        } else if (userType === 'notaire_quebec') {
            licenseField.style.display = 'block';
            licenseInput.setAttribute('placeholder', 'License Number A0000');
        } else if (userType === 'student_queens' || userType === 'student_montreal') {
            studentIdNumberField.style.display = 'block';
            studentIdFileField.style.display = 'block';
            studentIdNumberInput.setAttribute('placeholder', 'Student ID Number');
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleConditionalFields();
        updateNameField(); // Initialize name field
    });
    
    // Function to combine first and last name
    function updateNameField() {
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;
        const nameField = document.getElementById('name');
        nameField.value = (firstName + ' ' + lastName).trim();
    }
    
    // Add event listeners to update name field when first or last name changes
    document.getElementById('first_name').addEventListener('input', updateNameField);
    document.getElementById('last_name').addEventListener('input', updateNameField);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel_new\resources\views/admin/users/add.blade.php ENDPATH**/ ?>