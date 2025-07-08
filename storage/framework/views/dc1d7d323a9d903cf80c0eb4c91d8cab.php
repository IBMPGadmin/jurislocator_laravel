
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jurislocator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #002B5B;
            --secondary-color: #C19A6B;
            --accent-color: #0056b3;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --dark-color: #001B3B;
            --light-color: #ffffff;
            --bg-color: #f8f5f1;
        }
        body {
            background: var(--bg-color);
            min-height: 100vh;
            font-family: 'Roboto-Regular', Tahoma, Geneva, Verdana, sans-serif;
        }
        .signup-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, rgba(0,43,91,0.03) 0%, rgba(193,154,107,0.07) 100%);
        }
        .signup-card {
            background: var(--light-color);
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }
        .signup-left {
            background: var(--primary-color);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .signup-left::after {
            content: '';
            position: absolute;
            bottom: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: var(--secondary-color);
            opacity: 0.1;
            border-radius: 50%;
        }
        .logo-section {
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }
        .logo-section img {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
            object-fit: contain;
        }
        .signup-right {
            padding: 60px 40px;
        }
        .form-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 2.5rem;
        }
        .form-subtitle {
            color: #666;
            margin-bottom: 40px;
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .form-control {
            border: 1px solid #e1e8ed;
            border-radius: 4px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: var(--bg-color);
        }
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(193, 154, 107, 0.15);
            background-color: var(--light-color);
        }
        .btn-signup {
            background: var(--secondary-color);
            border: none;
            border-radius: 4px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
            color: white;
        }
        .btn-signup:hover {
            background: var(--primary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(193, 154, 107, 0.3);
        }
        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }
        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            color: var(--accent-color);
            border-left: 4px solid var(--accent-color);
        }
        .alert-success {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }
        .login-link {
            text-align: center;
            margin-top: 30px;
        }
        .login-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            color: var(--primary-color);
        }
        .password-requirements {
            font-size: 0.875rem;
            color: #666;
            margin-top: 5px;
        }
        .conditional-field {
            display: none;
            animation: slideDown 0.3s ease;
        }
        .conditional-field.show {
            display: block;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .file-upload-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .file-upload-wrapper input[type=file] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        .file-upload-display {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border: 1px solid #e1e8ed;
            border-radius: 4px;
            background-color: var(--bg-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .file-upload-display:hover {
            border-color: var(--secondary-color);
            background-color: var(--light-color);
        }
        .file-upload-display i {
            margin-right: 8px;
            color: #666;
        }
        .file-upload-text {
            color: #666;
            flex: 1;
        }
        @media (max-width: 768px) {
            .signup-left {
                padding: 40px 20px;
            }
            .signup-right {
                padding: 40px 20px;
            }
            .form-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-card">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="signup-left h-100">
                        <div class="logo-section">
                            <img src="<?php echo e(asset('user_assets/img/logo-01.png')); ?>" alt="Jurislocator Logo">
                            <h3 class="mb-0">Jurislocator</h3>
                        </div>
                        <div>
                            <h4 class="mb-3">Join Our Community!</h4>
                            <p class="mb-0">Create your account to access legal services and connect with professionals in the legal field.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="signup-right">
                        <h2 class="form-title">Create Account</h2>
                        <p class="form-subtitle">Fill in your details to get started</p>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?php echo e($errors->first()); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required value="<?php echo e(old('first_name')); ?>">
                                        <label for="first_name"><i class="fas fa-user me-2"></i>First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required value="<?php echo e(old('last_name')); ?>">
                                        <label for="last_name"><i class="fas fa-user me-2"></i>Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo e(old('email')); ?>">
                                <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                            </div>
                            <div class="form-floating">
                                <select class="form-control" id="user_type" name="user_type" required onchange="toggleConditionalFields()">
                                    <option value="">Select User Type</option>
                                    <option value="licensed_practitioner" <?php echo e(old('user_type') == 'licensed_practitioner' ? 'selected' : ''); ?>>Licensed Canadian Immigration Practitioner</option>
                                    <option value="immigration_lawyer" <?php echo e(old('user_type') == 'immigration_lawyer' ? 'selected' : ''); ?>>Canadian Immigration Lawyer</option>
                                    <option value="notaire_quebec" <?php echo e(old('user_type') == 'notaire_quebec' ? 'selected' : ''); ?>>Member of Chambre des notaires du Québec</option>
                                    <option value="student_queens" <?php echo e(old('user_type') == 'student_queens' ? 'selected' : ''); ?>>Immigration Law student - Queens University</option>
                                    <option value="student_montreal" <?php echo e(old('user_type') == 'student_montreal' ? 'selected' : ''); ?>>Immigration Law student - Université de Montréal</option>
                                </select>
                                <label for="user_type"><i class="fas fa-briefcase me-2"></i>User Type</label>
                            </div>
                            
                            <!-- License Number Field (for licensed practitioners, lawyers, and notaires) -->
                            <div class="conditional-field" id="license_field" style="margin-bottom: 20px;">
                                <label class="form-label"><i class="fas fa-certificate me-2"></i>License Number</label>
                                <input type="text" class="form-control" id="license_number" name="license_number" placeholder="License Number" value="<?php echo e(old('license_number')); ?>">
                            </div>

                            <!-- Student ID Number Field (for students) -->
                            <div class="conditional-field" id="student_id_number_field" style="margin-bottom: 20px;">
                                <label class="form-label"><i class="fas fa-id-badge me-2"></i>Student ID Number</label>
                                <input type="text" class="form-control" id="student_id_number" name="student_id_number" placeholder="Student ID Number" value="<?php echo e(old('student_id_number')); ?>">
                            </div>

                            <!-- Student ID Upload Field (for students) -->
                            <div class="conditional-field" id="student_id_file_field" style="margin-bottom: 20px;">
                                <label class="form-label"><i class="fas fa-id-card me-2"></i>Student ID Photo</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="student_id_file" name="student_id_file" accept=".pdf,.jpg,.jpeg,.png">
                                    <div class="file-upload-display">
                                        <i class="fas fa-upload"></i>
                                        <span class="file-upload-text">Choose Student ID photo (PDF, JPG, PNG)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                    </div>
                                    <div class="password-requirements">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Minimum 8 characters required
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-signup">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </form>
                        <div class="login-link">
                            <p>Already have an account? <a href="<?php echo e(route('login')); ?>">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleConditionalFields() {
            const userType = document.getElementById('user_type').value;
            const licenseField = document.getElementById('license_field');
            const studentIdNumberField = document.getElementById('student_id_number_field');
            const studentIdFileField = document.getElementById('student_id_file_field');
            const licenseInput = document.getElementById('license_number');
            const studentIdNumberInput = document.getElementById('student_id_number');
            const studentIdFileInput = document.getElementById('student_id_file');
            
            // Hide all conditional fields and remove required attributes
            licenseField.classList.remove('show');
            studentIdNumberField.classList.remove('show');
            studentIdFileField.classList.remove('show');
            
            // Remove required attributes from all conditional fields
            licenseInput.removeAttribute('required');
            studentIdNumberInput.removeAttribute('required');
            studentIdFileInput.removeAttribute('required');
            
            // Clear all conditional field values
            licenseInput.value = '';
            studentIdNumberInput.value = '';
            studentIdFileInput.value = '';
            document.querySelector('.file-upload-text').textContent = 'Choose Student ID photo (PDF, JPG, PNG)';
            
            // Set placeholders and show relevant fields based on user type
            if (userType === 'licensed_practitioner') {
                licenseField.classList.add('show');
                licenseInput.setAttribute('required', 'required');
                licenseInput.setAttribute('placeholder', 'License Number R400000 / 13456');
            } else if (userType === 'immigration_lawyer') {
                licenseField.classList.add('show');
                licenseInput.setAttribute('required', 'required');
                licenseInput.setAttribute('placeholder', 'License Number 703492 / S700000 / B-1000 / 1999123 / 00001-F / 1234567 / 1999-0005 / 92-04-14 / 1999001');
            } else if (userType === 'notaire_quebec') {
                licenseField.classList.add('show');
                licenseInput.setAttribute('required', 'required');
                licenseInput.setAttribute('placeholder', 'License Number A0000');
            } else if (userType === 'student_queens' || userType === 'student_montreal') {
                studentIdNumberField.classList.add('show');
                studentIdFileField.classList.add('show');
                studentIdNumberInput.setAttribute('required', 'required');
                studentIdFileInput.setAttribute('required', 'required');
                studentIdNumberInput.setAttribute('placeholder', 'Student ID Number');
            }
        }

        // Handle file upload display
        document.getElementById('student_id_file').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Choose Student ID photo (PDF, JPG, PNG)';
            document.querySelector('.file-upload-text').textContent = fileName;
        });

        // Initialize on page load if there's an old value
        document.addEventListener('DOMContentLoaded', function() {
            toggleConditionalFields();
        });

        // Add form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            console.log('Form submitted');
            const userType = document.getElementById('user_type').value;
            
            if (!userType) {
                alert('Please select a user type');
                e.preventDefault();
                return false;
            }
            
            // Check if required conditional fields are filled
            if ((userType === 'licensed_practitioner' || userType === 'immigration_lawyer' || userType === 'notaire_quebec') && !document.getElementById('license_number').value) {
                alert('Please enter your license number');
                e.preventDefault();
                return false;
            }
            
            if ((userType === 'student_queens' || userType === 'student_montreal')) {
                if (!document.getElementById('student_id_number').value) {
                    alert('Please enter your student ID number');
                    e.preventDefault();
                    return false;
                }
                if (!document.getElementById('student_id_file').files[0]) {
                    alert('Please upload your student ID photo');
                    e.preventDefault();
                    return false;
                }
            }
            
            return true;
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\13\jurislocator_laravel\resources\views/auth/register.blade.php ENDPATH**/ ?>