<section>
    <header class="mb-4">
        <p class="text-muted" data-en="Ensure your account is using a long, random password to stay secure." data-fr="Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label" data-en="Current Password" data-fr="Mot de passe actuel">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                   autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label" data-en="New Password" data-fr="Nouveau mot de passe">New Password</label>
            <input id="update_password_password" name="password" type="password" 
                   class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                   autocomplete="new-password" />
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label" data-en="Confirm Password" data-fr="Confirmer le mot de passe">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                   autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary" data-en="Save" data-fr="Enregistrer">Save</button>

            @if (session('status') === 'password-updated')
                <div class="text-success ms-3" data-en="Saved." data-fr="Enregistré.">Saved.</div>
            @endif
        </div>
    </form>
</section>
