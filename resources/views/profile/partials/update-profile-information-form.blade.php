<section>
    <header class="mb-4">
        <p class="text-muted" data-en="Update your account's profile information and email address." data-fr="Mettre à jour les informations de profil et l'adresse e-mail de votre compte.">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-4 text-center">
                <div class="profile-image-container mb-3">
                    @if($user->profile_image)
                        <img src="{{ asset($user->profile_image) }}" alt="Profile Image" class="profile-image img-thumbnail" id="profile-image-preview">
                    @else
                        <div class="profile-image-placeholder" id="profile-image-placeholder">
                            <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                        </div>
                        <img src="" alt="Profile Image Preview" class="profile-image img-thumbnail d-none" id="profile-image-preview">
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="profile_image" class="form-label" data-en="Change Profile Image" data-fr="Changer l'image de profil">Change Profile Image</label>
                    <input id="profile_image" name="profile_image" type="file" class="form-control" accept="image/*" />
                    <div class="form-text" data-en="JPG, PNG, GIF up to 2MB" data-fr="JPG, PNG, GIF jusqu'à 2 Mo">JPG, PNG, GIF up to 2MB</div>
                    @error('profile_image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                @if($user->profile_image)
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                        <label class="form-check-label" for="remove_image" data-en="Remove current profile image" data-fr="Supprimer l'image de profil actuelle">
                            Remove current profile image
                        </label>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label for="name" class="form-label" data-en="Name" data-fr="Nom">Name</label>
                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label" data-en="Email" data-fr="E-mail">Email</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-muted">
                                <span data-en="Your email address is unverified." data-fr="Votre adresse e-mail n'est pas vérifiée.">Your email address is unverified.</span>

                                <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline" data-en="Click here to re-send the verification email." data-fr="Cliquez ici pour renvoyer l'e-mail de vérification.">
                                    Click here to re-send the verification email.
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="text-success mt-2" data-en="A new verification link has been sent to your email address." data-fr="Un nouveau lien de vérification a été envoyé à votre adresse e-mail.">
                                    A new verification link has been sent to your email address.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary" data-en="Save" data-fr="Enregistrer">Save</button>

                    @if (session('status') === 'profile-updated')
                        <div class="text-success ms-3" data-en="Saved." data-fr="Enregistré.">Saved.</div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>

<style>
.profile-image-container {
    margin-bottom: 15px;
}
.profile-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.profile-image-placeholder {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileImageInput = document.getElementById('profile_image');
    const profileImagePreview = document.getElementById('profile-image-preview');
    const profileImagePlaceholder = document.getElementById('profile-image-placeholder');
    const removeImageCheckbox = document.getElementById('remove_image');

    // Show preview of selected image
    profileImageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                profileImagePreview.src = e.target.result;
                profileImagePreview.classList.remove('d-none');
                
                if (profileImagePlaceholder) {
                    profileImagePlaceholder.classList.add('d-none');
                }
                
                // Uncheck remove image if it exists
                if (removeImageCheckbox) {
                    removeImageCheckbox.checked = false;
                }
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Handle remove image checkbox
    if (removeImageCheckbox) {
        removeImageCheckbox.addEventListener('change', function() {
            if (this.checked) {
                profileImageInput.value = ''; // Clear the file input
                
                if (profileImagePlaceholder) {
                    profileImagePreview.classList.add('d-none');
                    profileImagePlaceholder.classList.remove('d-none');
                } else {
                    // If there's no placeholder div, just show a blank image
                    profileImagePreview.src = '';
                }
            }
        });
    }
});
</script>
