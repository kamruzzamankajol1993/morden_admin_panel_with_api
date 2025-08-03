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
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}{{ $icon }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/plyr.css">
 
    <!-- full calendar -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/css/main.css">
</head> 
<body>
    
<!--==================== Preloader Start ====================-->
  <div class="preloader">
    <div class="loader"></div>
  </div>
<!--==================== Preloader End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24" style="background-color: #B2E6FF !important;">
            <img src="{{asset('/')}}public/helicop.png" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="#" class="auth-right__logo">
                    <img src="{{ asset('/') }}{{ $logo }}" alt="">
                </a>
                <h2 class="mb-8">Welcome to Back! &#128075;</h2>
                <p class="text-gray-600 text-15 mb-32">Please sign in to your account and start the adventure</p>

                <form method="POST" action="{{ route('login') }}" >

                    @csrf   
                    <div class="mb-24">
                        <label for="fname" class="form-label mb-8 h6">Email</label>
                        <div class="position-relative">
                            <input type="email" name="email" class="form-control py-11 ps-40 @error('email') is-invalid @enderror" id="fname" placeholder="Type your email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-envelope"></i></span>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-24">
                        <label for="current-password" class="form-label mb-8 h6">Current Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control py-11 ps-40 @error('password') is-invalid @enderror" id="current-password" placeholder="Enter Current Password" value="" required autocomplete="current-password">
                            <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#current-password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-32 flex-between flex-wrap gap-8">
                        <div class="form-check mb-0 flex-shrink-0">
                            <input class="form-check-input flex-shrink-0 rounded-4" type="checkbox" value="" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-15 flex-grow-1" for="remember">Remember Me </label>
                        </div>
                        <a href="{{ route('showLinkRequestForm') }}" class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-main rounded-pill w-100">Sign In</button>
                   

                   

                    
                    
                </form>
            </div>
        </div>
    </section>

        <!-- Jquery js -->
    <script src="{{asset('/')}}public/admin/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{asset('/')}}public/admin/assets/js/boostrap.bundle.min.js"></script>
    <!-- Phosphor Js -->
    <script src="{{asset('/')}}public/admin/assets/js/phosphor-icon.js"></script>
    <!-- file upload -->
    <script src="{{asset('/')}}public/admin/assets/js/file-upload.js"></script>
    <!-- file upload -->
    <script src="{{asset('/')}}public/admin/assets/js/plyr.js"></script>
   
    <!-- full calendar -->
    <script src="{{asset('/')}}public/admin/assets/js/full-calendar.js"></script>
    <!-- jQuery UI -->
    <script src="{{asset('/')}}public/admin/assets/js/jquery-ui.js"></script>
    <!-- jQuery UI -->
    <script src="{{asset('/')}}public/admin/assets/js/editor-quill.js"></script>
    <!-- apex charts -->
    <script src="{{asset('/')}}public/admin/assets/js/apexcharts.min.js"></script>
    <!-- jvectormap Js -->
    <script src="{{asset('/')}}public/admin/assets/js/jquery-jvectormap-2.0.5.min.js"></script>
    <!-- jvectormap world Js -->
    <script src="{{asset('/')}}public/admin/assets/js/jquery-jvectormap-world-mill-en.js"></script>
    
    <!-- main js -->
    <script src="{{asset('/')}}public/admin/assets/js/main.js"></script>



    </body>


</html>

