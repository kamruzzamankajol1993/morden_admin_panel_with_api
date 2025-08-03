@extends('admin.master.master')

@section('title')

Profile | {{ $ins_name }}

@endsection


@section('css')

@endsection


@section('body')
<div class="dashboard-body">
  <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="{{route('home')}}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Profile Information</span></li>
</ul>
</div>
<!-- Breadcrumb End -->
<?php
$designationName = DB::table('designations')
->where('id',Auth::user()->designation_id)
->value('name');

$branchName = DB::table('branches')
->where('id',Auth::user()->branch_id)
->value('name');

?>
  <div class="card overflow-hidden">
      <div class="card-body p-0">
         

          <div class="setting-profile px-24">
              <div class="flex-between">
                  <div class="d-flex align-items-end flex-wrap mb-32 gap-24">
                    @if(empty(Auth::user()->image))
                      <img src="{{asset('/')}}public/No_Image_Available.jpg" alt="" class="w-120 h-120 rounded-circle border border-white">
                      @else
                      <img src="{{asset('/')}}{{Auth::user()->image}}" alt="" class="w-120 h-120 rounded-circle border border-white">
                      @endif
                      <div>
                          <h4 class="mb-8">{{ Auth::user()->name }}</h4>
                          <div class="setting-profile__infos flex-align flex-wrap gap-16">
                              <div class="flex-align gap-6">
                                  <span class="text-gray-600 d-flex text-lg"><i class="ph ph-swatches"></i></span>
                                  <span class="text-gray-600 d-flex text-15">{{ $designationName}}</span>
                              </div>
                              @if(!empty(Auth::user()->address))
                              <div class="flex-align gap-6">
                                  <span class="text-gray-600 d-flex text-lg"><i class="ph ph-map-pin"></i></span>
                                  <span class="text-gray-600 d-flex text-15">{{Auth::user()->address}}</span>
                              </div>
                              @endif
                              <div class="flex-align gap-6">
                                  <span class="text-gray-600 d-flex text-lg"><i class="ph ph-calendar-dots"></i></span>
                                  <span class="text-gray-600 d-flex text-15">Join {{ date("F Y", strtotime(Auth::user()->created_at)) }}</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <ul class="nav common-tab style-two nav-pills mb-0" id="pills-tab" role="tablist">
                 
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                  </li>
                 
              </ul>
          </div>

      </div>
  </div>

  <div class="tab-content" id="pills-tabContent">
     
      
      <!-- Profile Tab Start -->
      <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <div class="row gy-4">
              <div class="col-lg-6">
                  <div class="card mt-24">
                      <div class="card-body">
                          <h6 class="mb-12">Address</h6>
                          <p class="text-gray-600 text-15 rounded-8 border border-gray-100 p-16">{{Auth::user()->address}}</p>
                      </div>
                  </div>
                 
                  
              </div>
              <div class="col-lg-6">
                  <div class="card mt-24">
                      <div class="card-body">
                         
                          <div class="mt-24">
                              <div class="flex-align gap-8 flex-wrap mb-16">
                                  <span class="flex-center w-36 h-36 text-main-600 bg-main-100 rounded-circle text-xl"> 
                                      <i class="ph ph-phone"></i>
                                  </span>
                                  <div class="flex-align gap-8 flex-wrap text-gray-600">
                                      <span>{{Auth::user()->phone}}</span>
                                  </div>
                              </div>
                              <div class="flex-align gap-8 flex-wrap mb-16">
                                  <span class="flex-center w-36 h-36 text-main-600 bg-main-100 rounded-circle text-xl"> 
                                      <i class="ph ph-envelope-simple"></i>
                                  </span>
                                  <div class="flex-align gap-8 flex-wrap text-gray-600">
                                      <span>{{Auth::user()->email}}</span>
                                  </div>
                              </div>
                              <div class="flex-align gap-8 flex-wrap mb-16">
                                  <span class="flex-center w-36 h-36 text-main-600 bg-main-100 rounded-circle text-xl"> 
                                      <i class="ph ph-map-pin"></i>
                                  </span>
                                  <div class="flex-align gap-8 flex-wrap text-gray-600">
                                      <span>{{ $branchName}}</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
      <!-- Profile Tab End -->

    

  </div>
</div>




@endsection


@section('script')

@endsection