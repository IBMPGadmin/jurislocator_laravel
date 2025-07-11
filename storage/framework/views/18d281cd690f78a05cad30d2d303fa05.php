<section>
    <header class="mb-4">
        <p class="text-muted" data-en="Ensure your account is using a long, random password to stay secure." data-fr="Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="<?php echo e(route('password.update')); ?>" class="mt-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label" data-en="Current Password" data-fr="Mot de passe actuel">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="form-control <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   autocomplete="current-password" />
            <?php $__errorArgs = ['current_password', 'updatePassword'];
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
            <label for="update_password_password" class="form-label" data-en="New Password" data-fr="Nouveau mot de passe">New Password</label>
            <input id="update_password_password" name="password" type="password" 
                   class="form-control <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   autocomplete="new-password" />
            <?php $__errorArgs = ['password', 'updatePassword'];
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
            <label for="update_password_password_confirmation" class="form-label" data-en="Confirm Password" data-fr="Confirmer le mot de passe">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="form-control <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   autocomplete="new-password" />
            <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
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

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary" data-en="Save" data-fr="Enregistrer">Save</button>

            <?php if(session('status') === 'password-updated'): ?>
                <div class="text-success ms-3" data-en="Saved." data-fr="Enregistré.">Saved.</div>
            <?php endif; ?>
        </div>
    </form>
</section>
<?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>