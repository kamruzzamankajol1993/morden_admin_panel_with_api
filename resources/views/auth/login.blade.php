@extends('front.master.master')
@section('title')
Login/Register
@endsection

@section('css')
<style>
    /* Style for invalid feedback to ensure it's visible */
    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: .875em;
        color: #dc3545;
    }
    /* Adds a bit of margin to the image previews */
    .image-preview-container {
        margin-top: 10px;
    }
</style>
@endsection

@section('body')
<div class="container py-5">
    <h2 class="auth-section-title">Login or Register</h2>
    <div class="auth-card-container">
        @include('flash_message')
        <div class="row g-4">
            <div class="col-lg-6 col-md-12 auth-card-divider pe-lg-4">
                <div class="auth-card">
                    <h4>Register Now</h4>
                    {{-- Added id="registerForm" and novalidate attribute --}}
                    <form id="registerForm" action="{{ route('front.registerUserPost') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="regFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" id="regFullName" placeholder="Enter your full name" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="regPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" id="regPhone" placeholder="Enter your phone number" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="regEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="regEmail" placeholder="Enter your email" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="regProfileImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" name="image" id="regProfileImage" accept="image/*">
                            <div class="image-preview-container" id="previewProfileImage"></div>
                        </div>
                        <div class="mb-3">
                            <label for="regNIDFront" class="form-label">NID/Passport Front</label>
                            <input type="file" class="form-control" name="nid_front_image" id="regNIDFront" accept="image/*">
                            <div class="image-preview-container" id="previewNIDFront"></div>
                        </div>
                        <div class="mb-3">
                            <label for="regNIDBack" class="form-label">NID/Passport Back</label>
                            <input type="file" class="form-control" name="nid_back_image" id="regNIDBack" accept="image/*">
                            <div class="image-preview-container" id="previewNIDBack"></div>
                        </div>
                        <div class="mb-3">
                            <label for="regPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="regPassword" placeholder="Enter password (min. 8 characters)" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-4">
                            <label for="regConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="regConfirmPassword" placeholder="Confirm password" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Register Account</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 auth-card-right-padding ps-lg-4">
                <div class="auth-card">
                    <h4>Login to Your Account</h4>
                     {{-- Added id="loginForm" and novalidate attribute --}}
                    <form id="loginForm" action="{{ route('front.loginUserPost') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Enter your email" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                             <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-4 text-end">
                            <a href="{{ route('front.password.request') }}" class="text-link">Forgot Password?</a>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // --- 1. IMAGE PREVIEW SCRIPT (No Changes) ---
        function setupImagePreview(inputFileId, previewContainerId) {
            const inputFile = document.getElementById(inputFileId);
            const previewContainer = document.getElementById(previewContainerId);

            inputFile.addEventListener('change', function() {
                previewContainer.innerHTML = '';
                previewContainer.classList.remove('empty');
                const file = this.files[0];
                if (file) {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '150px';
                            img.style.maxHeight = '150px';
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.classList.add('empty');
                        previewContainer.innerHTML = '<span class="text-danger">Not an image file.</span>';
                    }
                } else {
                    previewContainer.classList.add('empty');
                    previewContainer.innerHTML = '';
                }
            });

            if (!inputFile.value) {
                previewContainer.classList.add('empty');
            }
        }

        setupImagePreview('regProfileImage', 'previewProfileImage');
        setupImagePreview('regNIDFront', 'previewNIDFront');
        setupImagePreview('regNIDBack', 'previewNIDBack');


        // --- 2. VALIDATION SCRIPT (Updated Logic) ---
        
        // Helper functions (no changes)
        const showError = (input, message) => {
            const formField = input.parentElement;
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            const error = formField.querySelector('.invalid-feedback');
            error.textContent = message;
        };
        const showSuccess = (input) => {
            const formField = input.parentElement;
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            const error = formField.querySelector('.invalid-feedback');
            error.textContent = '';
        };
        const isRequired = value => value.trim() !== '';
        const isEmail = (email) => {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        };
        const isLength = (password, min) => password.length >= min;

        // --- Registration Form Logic ---
        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            const nameInput = document.getElementById('regFullName');
            const phoneInput = document.getElementById('regPhone');
            const emailInput = document.getElementById('regEmail');
            const passwordInput = document.getElementById('regPassword');
            const confirmPasswordInput = document.getElementById('regConfirmPassword');

            // Specific validation functions for each field
            const validateName = () => {
                let valid = false;
                if (!isRequired(nameInput.value)) { showError(nameInput, 'Full Name is required.'); } 
                else { showSuccess(nameInput); valid = true; }
                return valid;
            };

            const validatePhone = () => {
                let valid = false;
                if (!isRequired(phoneInput.value)) { showError(phoneInput, 'Phone Number is required.'); } 
                else { showSuccess(phoneInput); valid = true; }
                return valid;
            };

            const validateEmail = () => {
                let valid = false;
                if (!isRequired(emailInput.value)) { showError(emailInput, 'Email is required.'); } 
                else if (!isEmail(emailInput.value)) { showError(emailInput, 'Email is not valid.'); } 
                else { showSuccess(emailInput); valid = true; }
                return valid;
            };

            const validatePassword = () => {
                let valid = false;
                if (!isRequired(passwordInput.value)) { showError(passwordInput, 'Password is required.'); } 
                else if (!isLength(passwordInput.value, 8)) { showError(passwordInput, 'Password must be at least 8 characters.'); } 
                else { showSuccess(passwordInput); valid = true; }
                return valid;
            };

            const validateConfirmPassword = () => {
                let valid = false;
                if (!isRequired(confirmPasswordInput.value)) { showError(confirmPasswordInput, 'Please confirm your password.'); } 
                else if (passwordInput.value !== confirmPasswordInput.value) { showError(confirmPasswordInput, 'Passwords do not match.'); } 
                else { showSuccess(confirmPasswordInput); valid = true; }
                return valid;
            };
            
            // Add real-time validation to each field individually
            nameInput.addEventListener('input', validateName);
            phoneInput.addEventListener('input', validatePhone);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validateConfirmPassword);
            // Also re-validate confirm password when the main password changes
            passwordInput.addEventListener('input', validateConfirmPassword);

            // Validate full form on submit
            registerForm.addEventListener('submit', (e) => {
                let isNameValid = validateName(),
                    isPhoneValid = validatePhone(),
                    isEmailValid = validateEmail(),
                    isPasswordValid = validatePassword(),
                    isConfirmPasswordValid = validateConfirmPassword();

                if (!isNameValid || !isPhoneValid || !isEmailValid || !isPasswordValid || !isConfirmPasswordValid) {
                    e.preventDefault(); // Prevent form submission
                }
            });
        }

        // --- Login Form Logic ---
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            const emailInput = document.getElementById('loginEmail');
            const passwordInput = document.getElementById('loginPassword');

            const validateLoginEmail = () => {
                let valid = false;
                if (!isRequired(emailInput.value)) { showError(emailInput, 'Email is required.'); } 
                else if (!isEmail(emailInput.value)) { showError(emailInput, 'Email is not valid.'); } 
                else { showSuccess(emailInput); valid = true; }
                return valid;
            };

            const validateLoginPassword = () => {
                let valid = false;
                if (!isRequired(passwordInput.value)) { showError(passwordInput, 'Password is required.'); } 
                else { showSuccess(passwordInput); valid = true; }
                return valid;
            };

            // Add real-time validation to each field individually
            emailInput.addEventListener('input', validateLoginEmail);
            passwordInput.addEventListener('input', validateLoginPassword);

            // Validate full form on submit
            loginForm.addEventListener('submit', (e) => {
                let isEmailValid = validateLoginEmail(),
                    isPasswordValid = validateLoginPassword();
                
                if (!isEmailValid || !isPasswordValid) {
                    e.preventDefault(); // Prevent form submission
                }
            });
        }
    });
</script>
@endsection