@extends('admin.master.master')

@section('title')

Customer Details | {{ $ins_name }}

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
                <li><span class="text-primary fw-normal">Customer Details</span></li>
            </ul>
        </div>
        <!-- Back Button -->
        <a href="{{ route('customer.index') }}" class="btn btn-secondary rounded-pill shadow-sm">
            <i class="ph ph-arrow-left me-2"></i> Back to List
        </a>
    </div>
    <!-- Breadcrumb End -->
    <div class="card overflow-hidden shadow-lg rounded-3">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0 fs-5 fw-semibold">Customer Details: {{ $customer->name }}</h4>
        </div>
        <div class="card-body">

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <h6 class="fw-semibold text-muted mb-1">Name:</h6>
                    <p class="mb-0 fs-5 text-dark">{{ $customer->name }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <h6 class="fw-semibold text-muted mb-1">Email:</h6>
                    <p class="mb-0 fs-5 text-dark">{{ $customer->email }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <h6 class="fw-semibold text-muted mb-1">Phone:</h6>
                    <p class="mb-0 fs-5 text-dark">{{ $customer->phone ?? 'N/A' }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <h6 class="fw-semibold text-muted mb-1">Status:</h6>
                    <p class="mb-0 fs-5 text-dark">{{ ucfirst($customer->status ?? 'N/A') }}</p>
                </div>
                <div class="col-12">
                    <h6 class="fw-semibold text-muted mb-1">Address:</h6>
                    <p class="mb-0 fs-5 text-dark">{{ $customer->address ?? 'N/A' }}</p>
                </div>

                <div class="col-12 mt-5">
                    <h5 class="fw-bold text-primary mb-3">Images</h5>
                    <div class="row g-3">
                        <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                            <h6 class="fw-semibold text-muted mb-2">Customer Image:</h6>
                            <div class="border p-1 rounded-3 bg-body-secondary" style="width: 180px; height: 180px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if($customer->image)
                                    <img src="{{ asset('public/'.$customer->image) }}" alt="Customer Image" class="img-fluid rounded">
                                @else
                                    <img src="https://placehold.co/180x180/E0E0E0/555555?text=No+Image" alt="No Customer Image" class="img-fluid rounded">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                            <h6 class="fw-semibold text-muted mb-2">NID Front Image:</h6>
                            <div class="border p-1 rounded-3 bg-body-secondary" style="width: 180px; height: 180px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if($customer->nid_front_image)
                                    <img src="{{ asset('public/'.$customer->nid_front_image) }}" alt="NID Front Image" class="img-fluid rounded">
                                @else
                                    <img src="https://placehold.co/180x180/E0E0E0/555555?text=NID+Front" alt="No NID Front Image" class="img-fluid rounded">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center">
                            <h6 class="fw-semibold text-muted mb-2">NID Back Image:</h6>
                            <div class="border p-1 rounded-3 bg-body-secondary" style="width: 180px; height: 180px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if($customer->nid_back_image)
                                    <img src="{{ asset('public/'.$customer->nid_back_image) }}" alt="NID Back Image" class="img-fluid rounded">
                                @else
                                    <img src="https://placehold.co/180x180/E0E0E0/555555?text=NID+Back" alt="No NID Back Image" class="img-fluid rounded">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- New Ticket List Section --}}
                <div class="col-12 mt-5">
                    <h5 class="fw-bold text-primary mb-3">Ticket List</h5>
                    <div class="table-responsive">
                        <table class="table  table-hover table-bordered align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Ticket ID</th>
                                    <th scope="col">Destination From</th>
                                    <th scope="col">Destination To</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Dummy Data for Table Design --}}
                                <tr>
                                    <td>1</td>
                                    <td>TKT-1001</td>
                                    <td>Dhaka</td>
                                    <td>Chittagong</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>TKT-1002</td>
                                    <td>Cox's Bazar</td>
                                    <td>Sylhet</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>TKT-1003</td>
                                    <td>Rajshahi</td>
                                    <td>Khulna</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>
                                {{-- End Dummy Data --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end pt-3">
                    <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning rounded-pill shadow-sm me-2">
                        <i class="ph ph-pencil-simple me-2"></i> Edit Customer
                    </a>
                   
                </div>
            </div>

        </div>
    </div>
</div>

@endsection


@section('script')
{{-- No specific script needed for the show page besides master script --}}
@endsection
