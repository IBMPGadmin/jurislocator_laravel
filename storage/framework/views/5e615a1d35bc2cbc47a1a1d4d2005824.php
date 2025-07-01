<section>
    <header class="mb-4">
        <p class="text-muted" data-en="Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain." data-fr="Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion" data-en="Delete Account" data-fr="Supprimer le compte">
        Delete Account
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel" data-en="Are you sure you want to delete your account?" data-fr="Êtes-vous sûr de vouloir supprimer votre compte ?">Are you sure you want to delete your account?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo e(route('profile.destroy')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    
                    <div class="modal-body">
                        <p data-en="Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account." data-fr="Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <div class="mb-3 mt-3">
                            <label for="password" class="form-label" data-en="Password" data-fr="Mot de passe">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Password"
                                data-placeholder-en="Password"
                                data-placeholder-fr="Mot de passe"
                            />
                            <?php $__errorArgs = ['password', 'userDeletion'];
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
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Cancel" data-fr="Annuler">Cancel</button>
                        <button type="submit" class="btn btn-danger" data-en="Delete Account" data-fr="Supprimer le compte">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\Dileesha\Desktop\j.v1-main\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>