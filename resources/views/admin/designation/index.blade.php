@extends('admin.master.master')

@section('title')

Designation Management | {{ $ins_name }}

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
<li><span class="text-main-600 fw-normal text-15">Designation Management</span></li>
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
                <span class="text-lg"><i class="ph ph-layout"></i></span>
               <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center" id="invoiceFilter">
                    <option value="" selected disabled>Export</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">Pdf</option>
                </select>
            </div>

            <div class="flex-align text-gray-500 text-13">
          

            @if (Auth::user()->can('designationAdd'))

            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i> Add Name
            </button>

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
            <thead class="table-light">
                <tr>
                    <th>Sl</th>
                    <th class="sortable" data-column="name">Designation Name</th>
                    <th >Action</th>
                </tr>
            </thead>
           <tbody id="tableBody"></tbody>
        </table>
    </div>

   <nav>
       <ul class="pagination justify-content-center" id="pagination"></ul>
    </nav>
        </div>
        
    </div>

    
</div>


@include('admin.designation._partial.addModal')
@include('admin.designation._partial.editModal')
@endsection


@section('script')
@include('admin.designation._partial.script')
@endsection