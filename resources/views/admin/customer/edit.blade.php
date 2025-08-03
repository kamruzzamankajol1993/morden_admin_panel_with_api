@extends('admin.master.master')

@section('title')

Edit Customer | {{ $ins_name }}

@endsection


@section('css')
{{-- No custom CSS needed as we are using Bootstrap 5 classes only --}}
@endsection


@section('body')

<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-4 d-flex justify-content-between flex-wrap gap-2">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-0">
            <ul class="d-flex align-items-center gap-2 ps-0 mb-0 list-unstyled">
                <li><a href="{{route('home')}}" class="text-secondary fw-normal text-decoration-none">Home</a></li>
                <li> <span class="text-muted fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><a href="{{ route('customer.index') }}" class="text-secondary fw-normal text-decoration-none">Customer Management</a></li>
                <li> <span class="text-muted fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-primary fw-normal">Edit Customer</span></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="card overflow-hidden shadow-lg rounded-3">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0 fs-5 fw-semibold">Edit Customer: {{ $customer->name }}</h4>
        </div>
        <div class="card-body">
            @include('flash_message')

            <form id="customerForm" method="POST" action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data" class="row g-4">
                @csrf
                @method('PUT') {{-- Or @method('PATCH') --}}

                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control rounded" id="name" name="name" value="{{ old('name', $customer->name) }}" placeholder="Enter customer name">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control rounded" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" placeholder="Enter phone number">
                    @error('phone')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control rounded" id="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="Enter email address" onblur="checkEmailUniqueness()">
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
                        <option value="active" {{ old('status', $customer->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $customer->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <!-- Add more status options as needed -->
                    </select>
                    @error('status')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control rounded" id="address" name="address" rows="3" placeholder="Enter customer address">{{ old('address', $customer->address) }}</textarea>
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
                        <img id="image_preview" src="{{ $customer->image ? asset('public/'.$customer->image) : 'https://placehold.co/144x144/E0E0E0/555555?text=No+Image' }}" alt="Customer Image Preview" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                    <label for="nid_front_image" class="form-label">NID Front Image</label>
                    <input class="form-control rounded" type="file" id="nid_front_image" name="nid_front_image" accept="image/*">
                    @error('nid_front_image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div class="mt-3 border p-1 rounded-3 d-flex align-items-center justify-content-center overflow-hidden bg-body-secondary" style="width: 144px; height: 144px;">
                        <img id="nid_front_image_preview" src="{{ $customer->nid_front_image ? asset('public/'.$customer->nid_front_image) : 'https://placehold.co/144x144/E0E0E0/555555?text=NID+Front' }}" alt="NID Front Image Preview" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                    <label for="nid_back_image" class="form-label">NID Back Image</label>
                    <input class="form-control rounded" type="file" id="nid_back_image" name="nid_back_image" accept="image/*">
                    @error('nid_back_image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div class="mt-3 border p-1 rounded-3 d-flex align-items-center justify-content-center overflow-hidden bg-body-secondary" style="width: 144px; height: 144px;">
                        <img id="nid_back_image_preview" src="{{ $customer->nid_back_image ? asset('public/'.$customer->nid_back_image) : 'https://placehold.co/144x144/E0E0E0/555555?text=NID+Back' }}" alt="NID Back Image Preview" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end pt-3">
                    <button type="submit" id="submitBtn" class="btn btn-primary rounded-pill shadow-sm">
                        <i class="ph ph-pencil-simple me-2"></i>
                        Update Customer
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection


@section('script')
<script>
    // Global flag to track email uniqueness status
    let isEmailUnique = true; // Set to true by default for edit as current email is unique
    let emailCheckInProgress = false;

    document.addEventListener('DOMContentLoaded', function() {
        const customerForm = document.getElementById('customerForm');
        const submitBtn = document.getElementById('submitBtn');
        const emailInput = document.getElementById('email');
        const feedbackDiv = document.getElementById('email_uniqueness_feedback');
        const initialEmail = emailInput.value; // Store initial email value

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
                        // Revert to original image if file is cleared, or placeholder
                        const originalSrc = preview.getAttribute('data-original-src');
                        if (originalSrc) {
                            preview.src = originalSrc;
                        } else {
                             if (inputId === 'image') {
                                preview.src = 'https://placehold.co/144x144/E0E0E0/555555?text=No+Image';
                            } else if (inputId === 'nid_front_image') {
                                preview.src = 'https://placehold.co/144x144/E0E0E0/555555?text=NID+Front';
                            } else if (inputId === 'nid_back_image') {
                                preview.src = 'https://placehold.co/144x144/E0E0E0/555555?text=NID+Back';
                            }
                        }
                    }
                });
                 // Store original src for reverting
                preview.setAttribute('data-original-src', preview.src);
            }
        }

        setupImagePreview('image', 'image_preview');
        setupImagePreview('nid_front_image', 'nid_front_image_preview');
        setupImagePreview('nid_back_image', 'nid_back_image_preview');

        function updateSubmitButtonState() {
            submitBtn.disabled = !isEmailUnique || emailCheckInProgress;
        }

        let emailCheckTimeout;

        window.checkEmailUniqueness = async function() {
            const email = emailInput.value.trim();

            // If email is the same as the initial email, it's considered unique
            if (email === initialEmail) {
                isEmailUnique = true;
                emailCheckInProgress = false;
                feedbackDiv.innerHTML = '';
                emailInput.classList.remove('is-invalid', 'is-valid');
                updateSubmitButtonState();
                return;
            }

            clearTimeout(emailCheckTimeout);
            emailCheckInProgress = true;
            updateSubmitButtonState();

            if (email && email.includes('@') && email.includes('.')) {
                feedbackDiv.innerHTML = '<span class="text-info small">Checking availability...</span>';
                emailInput.classList.remove('is-invalid', 'is-valid');

                emailCheckTimeout = setTimeout(async () => {
                    try {
                        const baseUrl = @json(route('customers.checkEmail'));
                        const url = `${baseUrl}?email=${encodeURIComponent(email)}&ignore_id={{ $customer->id }}`; // Pass customer ID to ignore
                        const response = await fetch(url, { method: 'GET', redirect: 'follow' });

                        if (response.redirected) {
                            feedbackDiv.innerHTML = '<span class="text-danger small">Network error: Unexpected redirect.</span>';
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
                        feedbackDiv.innerHTML = '<span class="text-danger small">Error checking email.</span>';
                        emailInput.classList.remove('is-valid');
                        isEmailUnique = false;
                    } finally {
                        emailCheckInProgress = false;
                        updateSubmitButtonState();
                    }
                }, 500);
            } else {
                feedbackDiv.innerHTML = '';
                emailInput.classList.remove('is-invalid', 'is-valid');
                isEmailUnique = false; // Invalid or empty email is not unique
                emailCheckInProgress = false;
                updateSubmitButtonState();
            }
        };

        emailInput.addEventListener('keyup', window.checkEmailUniqueness);
        emailInput.addEventListener('change', window.checkEmailUniqueness); // Also check on change for robustness


        customerForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            // Perform a final check before submission
            await window.checkEmailUniqueness();

            if (isEmailUnique) {
                this.submit();
            } else {
                if (!emailInput.classList.contains('is-invalid')) {
                    feedbackDiv.innerHTML = '<span class="text-danger small">Please correct the email address.</span>';
                    emailInput.classList.add('is-invalid');
                }
                submitBtn.disabled = true;
            }
        });

        // Initial check if page loads with pre-filled email
        if (initialEmail !== '') {
            // For edit page, if email hasn't changed, it's considered unique by default.
            // If it has changed, the keyup/change listener will trigger the check.
            updateSubmitButtonState(); // Ensure button is correctly enabled/disabled
        } else {
            updateSubmitButtonState();
        }
    });
</script>
@endsection
