

<?php $__env->startSection('admin-content'); ?>
<div class="card">
    <div class="card-header">
        <h5>Add Legal Documents (Alternative Process)</h5>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-container">
                    <form action="<?php echo e(route('admin.legal-documents.process-alternative')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="xmlfile" class="form-label">XML File:</label>
                            <div class="input-group">
                                <input type="file" class="form-control <?php $__errorArgs = ['xmlfile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="xmlfile" name="xmlfile" required>
                                <?php $__errorArgs = ['xmlfile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <small class="text-muted">Only XML files are accepted</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="law_id" class="form-label">Law ID:</label>
                            <input type="number" class="form-control <?php $__errorArgs = ['law_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="law_id" name="law_id" value="<?php echo e(old('law_id', 1)); ?>" required>
                            <?php $__errorArgs = ['law_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="act_id" class="form-label">Act ID:</label>
                            <input type="number" class="form-control <?php $__errorArgs = ['act_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="act_id" name="act_id" value="<?php echo e(old('act_id', 1)); ?>" required>
                            <?php $__errorArgs = ['act_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="act_name" class="form-label">Act Name:</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['act_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="act_name" name="act_name" value="<?php echo e(old('act_name')); ?>" required>
                            <?php $__errorArgs = ['act_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jurisdiction_id" class="form-label">Jurisdiction ID:</label>
                            <input type="number" class="form-control <?php $__errorArgs = ['jurisdiction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="jurisdiction_id" name="jurisdiction_id" value="<?php echo e(old('jurisdiction_id', 1)); ?>" required>
                            <?php $__errorArgs = ['jurisdiction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload XML</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Display existing tables -->
        <div class="table-container mt-4">
            <h5>Uploaded Documents</h5>
            
            <?php if(isset($tables) && count($tables) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Table Name</th>
                                <th>Original Filename</th>
                                <th>Act Name</th>
                                <th>Law ID</th>
                                <th>Act ID</th>
                                <th>Jurisdiction</th>
                                <th>Upload Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($table->id); ?></td>
                                    <td><?php echo e($table->table_name); ?></td>
                                    <td><?php echo e($table->original_filename); ?></td>
                                    <td><?php echo e($table->act_name); ?></td>
                                    <td><?php echo e($table->law_id); ?></td>
                                    <td><?php echo e($table->act_id); ?></td>
                                    <td><?php echo e($table->jurisdiction_id); ?></td>
                                    <td><?php echo e($table->created_at); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No documents have been uploaded yet.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ardent\Desktop\j.v1-main\j.v1-main\resources\views/admin/legal-documents/alternative-upload.blade.php ENDPATH**/ ?>