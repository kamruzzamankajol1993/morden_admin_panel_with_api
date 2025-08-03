@extends('admin.master.master')

@section('title')

Panel Management | {{ $ins_name }}

@endsection


@section('css')
<style>

    .table-bordered {
    border: 1px solid #ccc;
    border-collapse: collapse;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #ccc;
    padding: 8px 12px;
    text-align: left;
}
    </style>
 <style>
        th.sortable {
            cursor: pointer;
        }
        th.sortable{
            background-color: #f8f9fa;
        }
    </style>
@endsection


@section('body')

<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="{{route('home')}}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Panel Management</span></li>
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
           

            @if (Auth::user()->can('panelSettingAdd'))
            <a href="{{ route('systemInformation.create') }}" type="button"  class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i> Add Information
            </a>
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
        <table class="display responsive nowrap w-100 table-bordered "  style="width: 100% !important">
            <thead class="table-light">
                <tr>
                    <th class="sortable" style="width:5%">Sl</th>
                 
                   <th style="width:15%" class="sortable" data-column="branch_name">Branch Name</th>
            <th style="width:10%" class="sortable" data-column="icon">Icon</th>
            <th  style="width:10%"class="sortable" data-column="logo">Logo</th>
            <th style="width:15%" class="sortable" data-column="name">Name</th>
            <th style="width:10%" class="sortable" data-column="phone">Phone</th>
            <th style="width:10%" class="sortable" data-column="email">Email</th>
            <th style="width:15%" class="sortable" data-column="address">Address</th>
                    <th class="sortable" style="width:10%">Action</th>
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



@endsection


@section('script')
@include('admin.panelSettingInfo._partial.script')
@endsection
