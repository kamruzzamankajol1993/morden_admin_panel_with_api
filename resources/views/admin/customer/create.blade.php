@extends('admin.master.master')

@section('title')

Customer Management | {{ $ins_name }}

@endsection


@section('css')
{{-- No custom CSS needed as we are using Bootstrap 5 classes only --}}
@endsection


@section('body')

<div class="dashboard-body"> {{-- Retaining the dashboard-body class from your provided structure --}}

    <div class="breadcrumb-with-buttons mb-4 d-flex justify-content-between flex-wrap gap-2">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-0">
            <ul class="d-flex align-items-center gap-2 ps-0 mb-0 list-unstyled">
                <li><a href="{{route('home')}}" class="text-secondary fw-normal text-decoration-none">Home</a></li>
                <li> <span class="text-muted fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-primary fw-normal">Customer Management</span></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="card overflow-hidden shadow-lg rounded-3">
        <div class="card-header bg-primary text-white  rounded-top">
            <h4 class="mb-0 fs-5 fw-semibold">Add New Customer</h4>
        </div>
        <div class="card-body ">
            @include('flash_message')

            <!--add form here start--->
            <form id="customerForm" method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data" class="row g-4">
                @csrf

                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control rounded" id="name" name="name" value="{{ old('name') }}" placeholder="Enter customer name">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control rounded" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number">
                    @error('phone')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control rounded" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address"> {{-- Removed onblur --}}
                    <div id="email_uniqueness_feedback" class="mt-1">
                        {{-- Feedback message for email uniqueness will appear here --}}
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select rounded" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <!-- Add more status options as needed -->
                    </select>
                    @error('status')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control rounded" id="address" name="address" rows="3" placeholder="Enter customer address">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                    <label for="image" class="form-label">Customer Image</label>
                    <input class="form-control rounded" type="file" id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div class="mt-3 border p-1 rounded-3 d-flex align-items-center justify-content-center overflow-hidden bg-body-secondary" style="width: 144px; height: 144px;">
                        <img id="image_preview" src="https://placehold.co/144x144/E0E0E0/555555?text=No+Image" alt="Customer Image Preview" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                    <label for="nid_front_image" class="form-label">NID Front Image</label>
                    <input class="form-control rounded" type="file" id="nid_front_image" name="nid_front_image" accept="image/*">
                    @error('nid_front_image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div class="mt-3 border p-1 rounded-3 d-flex align-items-center justify-content-center overflow-hidden bg-body-secondary" style="width: 144px; height: 144px;">
                        <img id="nid_front_image_preview" src="https://placehold.co/144x144/E0E0E0/555555?text=NID+Front" alt="NID Front Image Preview" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                    <label for="nid_back_image" class="form-label">NID Back Image</label>
                    <input class="form-control rounded" type="file" id="nid_back_image" name="nid_back_image" accept="image/*">
                    @error('nid_back_image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div class="mt-3 border p-1 rounded-3 d-flex align-items-center justify-content-center overflow-hidden bg-body-secondary" style="width: 144px; height: 144px;">
                        <img id="nid_back_image_preview" src="https://placehold.co/144x144/E0E0E0/555555?text=NID+Back" alt="NID Back Image Preview" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end pt-3">
                    <button type="submit" id="submitBtn" class="btn btn-primary rounded-pill  shadow-sm" disabled>
                        <i class="ph ph-plus-circle me-2"></i>
                        Add Customer
                    </button>
                </div>
            </form>
            <!---addd form here end-->

        </div>
    </div>
</div>


@endsection


@section('script')
<script>
    // Global flag to track email uniqueness status
    let isEmailUnique = false;
    let emailCheckInProgress = false; // Flag to prevent multiple checks

    // Function to handle image preview (existing functionality)
    document.addEventListener('DOMContentLoaded', function() {
        const customerForm = document.getElementById('customerForm');
        const submitBtn = document.getElementById('submitBtn');
        const emailInput = document.getElementById('email');
        const feedbackDiv = document.getElementById('email_uniqueness_feedback');

        function setupImagePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            if (input && preview) {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If no file is selected, revert to placeholder
                        if (inputId === 'image') {
                            preview.src = 'https://placehold.co/144x144/E0E0E0/555555?text=No+Image';
                        } else if (inputId === 'nid_front_image') {
                            preview.src = 'https://placehold.co/144x144/E0E0E0/555555?text=NID+Front';
                        } else if (inputId === 'nid_back_image') {
                            preview.src = 'https://placehold.co/144x144/E0E0E0/555555?text=NID+Back';
                        }
                    }
                });
            }
        }

        // Setup preview for each image input
        setupImagePreview('image', 'image_preview');
        setupImagePreview('nid_front_image', 'nid_front_image_preview');
        setupImagePreview('nid_back_image', 'nid_back_image_preview');

        // Function to update submit button state
        function updateSubmitButtonState() {
            // Enable submit button only if email is unique and no check is in progress
            submitBtn.disabled = !isEmailUnique || emailCheckInProgress;
        }

        // New functionality for email uniqueness check via AJAX
        let emailCheckTimeout;

        window.checkEmailUniqueness = async function() {
            const email = emailInput.value.trim();

            // Clear previous timeout to debounce the request
            clearTimeout(emailCheckTimeout);
            emailCheckInProgress = true; // Set flag
            updateSubmitButtonState(); // Disable button

            // Only proceed if email is not empty and appears valid (basic check)
            if (email && email.includes('@') && email.includes('.')) {
                feedbackDiv.innerHTML = '<span class="text-info small">Checking availability...</span>'; // Loading indicator
                emailInput.classList.remove('is-invalid', 'is-valid'); // Clear previous validation states

                // Set a timeout to delay the AJAX call (debouncing)
                emailCheckTimeout = setTimeout(async () => {
                    try {
                        const baseUrl = @json(route('customers.checkEmail'));
                        const url = `${baseUrl}?email=${encodeURIComponent(email)}`; // Append email as query parameter

                        // Removed 'X-CSRF-TOKEN' header for GET requests as it's not standard practice
                        // and Laravel typically doesn't require it for GET routes unless specifically configured.
                        const response = await fetch(url, {
                            method: 'GET',
                            redirect: 'follow'
                        });

                        if (response.redirected) {
                            console.warn('Request was redirected! Original URL:', response.url);
                            feedbackDiv.innerHTML = '<span class="text-danger small">Network error: Unexpected redirect. Please contact support.</span>';
                            emailInput.classList.add('is-invalid');
                            isEmailUnique = false;
                        } else if (!response.ok) {
                            const errorText = await response.text();
                            console.error('HTTP Error:', response.status, errorText);
                            feedbackDiv.innerHTML = '<span class="text-danger small">Server error: Could not check email.</span>';
                            emailInput.classList.add('is-invalid');
                            isEmailUnique = false;
                        } else {
                            const data = await response.json();

                            if (data.unique) {
                                feedbackDiv.innerHTML = '<span class="text-success small">Email is available.</span>';
                                emailInput.classList.add('is-valid');
                                emailInput.classList.remove('is-invalid');
                                isEmailUnique = true;
                            } else {
                                feedbackDiv.innerHTML = '<span class="text-danger small">Email already exists.</span>';
                                emailInput.classList.add('is-invalid');
                                emailInput.classList.remove('is-valid');
                                isEmailUnique = false;
                            }
                        }
                    } catch (error) {
                        console.error('Error checking email uniqueness:', error);
                        feedbackDiv.innerHTML = '<span class="text-danger small">Error checking email. Please check console for details.</span>';
                        emailInput.classList.remove('is-valid');
                        isEmailUnique = false;
                    } finally {
                        emailCheckInProgress = false; // Reset flag
                        updateSubmitButtonState(); // Update button state
                    }
                }, 500); // Debounce: wait 500ms after user stops typing
            } else {
                feedbackDiv.innerHTML = ''; // Clear message if email is empty or invalid
                emailInput.classList.remove('is-invalid', 'is-valid');
                isEmailUnique = false; // Reset if email is empty or invalid
                emailCheckInProgress = false;
                updateSubmitButtonState(); // Update button state
            }
        };

        // Event listener for email input (replaces onblur and immediate input disable)
        emailInput.addEventListener('keyup', function() {
            // Trigger the debounced checkEmailUniqueness on every keyup
            window.checkEmailUniqueness();
        });


        // Form submission handler (remains the same to await final check)
        customerForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default submission initially

            // Ensure the latest email check is done before submitting
            await window.checkEmailUniqueness(); // Wait for uniqueness check to complete

            if (isEmailUnique) {
                // If email is confirmed unique, proceed with form submission
                this.submit(); // Programmatically submit the form
            } else {
                // If not unique, show final error message if not already visible
                if (!emailInput.classList.contains('is-invalid')) {
                    feedbackDiv.innerHTML = '<span class="text-danger small">Please correct the email address.</span>';
                    emailInput.classList.add('is-invalid');
                }
                submitBtn.disabled = true; // Ensure button stays disabled
            }
        });

        // Perform an initial check if the email field is pre-filled (e.g., old data)
        // This handles cases where the page loads with existing email data
        if (emailInput.value.trim() !== '') {
            window.checkEmailUniqueness();
        } else {
            // If email is empty initially, ensure button is disabled
            updateSubmitButtonState();
        }
    });
</script>
@endsection
