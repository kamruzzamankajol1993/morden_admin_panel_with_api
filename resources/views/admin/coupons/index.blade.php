@extends('admin.master.master')

@section('title')

Coupon | {{ $ins_name }}

@endsection


@section('css')
 
@endsection


@section('body')

<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="{{route('home')}}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Coupon</span></li>
</ul>
</div>
<!-- Breadcrumb End -->



        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            {{-- <div class="position-relative text-gray-500 flex-align gap-4 text-13">
                <span class="text-inherit">Sort by: </span>
                <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-funnel-simple"></i></span>
                    <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">
                        <option value="1" selected>Popular</option>
                        <option value="1">Latest</option>
                        <option value="1">Trending</option>
                        <option value="1">Matches</option>
                    </select>
                </div>
            </div> --}}
            <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                {{-- <span class="text-lg"><i class="ph ph-layout"></i></span>
                <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center" id="invoiceFilter">
                    <option value="" selected disabled>Export</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">Pdf</option>
                </select> --}}
            </div>

            <div class="flex-align text-gray-500 text-13">

                @if (Auth::user()->can('couponAdd'))

                 <a href="{{ route('coupon.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>  Add New Coupon</a>

               
                @endif
         
            </div>
        </div>
        <!-- Breadcrumb Right End -->

    </div>
   

    <div class="card overflow-hidden">
        <div class="card-body">
            @include('flash_message')

            <div class="d-flex justify-content-between mb-3">
        <h4></h4>
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
    </div>


             <div class="table-responsive mt-5">
        <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Expires At</th>
                        <th>Total Usage</th>
                        <th>Usage Per User</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($coupons as $key=>$coupon)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ ucfirst($coupon->discount_type) }}</td>
                            <td>
                                @if($coupon->discount_type == 'percentage')
                                    {{ $coupon->discount_value }}%
                                @else
                                    ${{ number_format($coupon->discount_value, 2) }}
                                @endif
                            </td>
                            <td>{{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y') : 'N/A' }}</td>
                            <td> {{ $coupon->usage_limit ?? '∞' }}</td>
                            <td>{{ $coupon->usage_limit_per_user ?? '∞' }}</td>
                            <td>
                                <span class="badge {{ $coupon->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('coupon.edit', $coupon) }}" class="btn btn-sm btn-warning">Edit</a>
                                {{-- The onsubmit attribute is removed and a class is added to target with JS --}}
                                <form action="{{ route('coupon.destroy', $coupon) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No coupons found.</td>
                        </tr>
                    @endforelse
                </tbody>
        </table>
    </div>

   <nav>
       {{ $coupons->links() }}
    </nav>



          
        </div>
        
    </div>

    
</div>


@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Wait for the DOM to be fully loaded before running the script
    document.addEventListener('DOMContentLoaded', function () {
        
        // Find all forms with the 'delete-form' class
        const deleteForms = document.querySelectorAll('.delete-form');

        // Add a submit event listener to each delete form
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                // Prevent the form from submitting by default
                event.preventDefault();

                // Show the SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // If the user clicks "Yes, delete it!", submit the form
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    });
</script>
@endsection