<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="{{ $ins_name }}">
	<meta name="robots" content="">
    <meta name="keywords" content="{{ $keyword }}">
	<meta name="description" content="{{ $description }}">
	<meta property="og:title" content="{{ $ins_name }}">
	<meta property="og:description" content="{{ $description }}">
	<meta property="og:image" content="{{ asset('/') }}{{ $logo }}">
    <!-- Title -->
    <title>Change Password</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}{{ $icon }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}public/admin/assets/css/auth-style.css">
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-container">
             <div class="auth-branding-column">
                <h1 class="branding-title">{{ $ins_name }}</h1>
                <p class="branding-subtitle">The future of fashion retail management is here. Streamlined, simple, and powerful.</p>
            </div>

            <div class="auth-form-column">
                <div class="auth-form-header">
                    <img src="{{ asset('/') }}{{ $logo }}" alt="Logo" class="auth-logo">
                    <h3 class="auth-title">Create New Password</h3>
                    <p class="text-muted">Your new password must be secure and different from previous ones.</p>
                </div>

                <form class="theme-form login-form" action="{{route('postPasswordChange')}}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                  @csrf
                  <input type="hidden" value="{{ $email }}" name="mainEmail" />
                  @include('flash_message') 
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="newPassword" placeholder="••••••••" required>
                            <span class="input-group-text toggle-password-span" data-target="newPassword"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="••••••••" required>
                            <span class="input-group-text toggle-password-span" data-target="confirmPassword"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary auth-btn">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password-span').forEach(item => {
            item.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>
