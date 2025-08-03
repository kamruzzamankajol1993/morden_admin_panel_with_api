@extends('admin.master.master')

@section('title')

Profile Setting | {{ $ins_name }}

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
<li><span class="text-main-600 fw-normal text-15">Profile Setting</span></li>
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
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile Update</button>
                  </li>
                 
              </ul>
          </div>

      </div>
  </div>

  <div class="tab-content" id="pills-tabContent">
     
      
      <!-- Profile Tab Start -->
      <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <div class="row gy-4">
              <div class="col-lg-12">
                  <div class="card mt-24">
                      <div class="card-body">
                        @include('flash_message')

                         
                        <form method="post" action="{{ route('profileSettingUpdate') }}" enctype="multipart/form-data" id="form" data-parsley-validate="">

                            @csrf
                        <div class="row">

                           
                            <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                <label class="form-label">Name<span class="text-red font-w900">*</span>  </label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="" placeholder="Name" required>
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}" class="form-control" id="" placeholder="Name" required>
                            </div>

                            <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                <label class="form-label">Phone Number<span class="text-red font-w900">*</span>  </label>
                                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                type = "number" value="{{ Auth::user()->phone }}" maxlength = "11" class="form-control roles" id="text" data-parsley-length="[11, 11]" id="" name="phone" placeholder="Phone Number" required>
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                <label class="form-label">Email<span class="text-red font-w900">*</span>  </label>
                                <input type="email" value="{{ Auth::user()->email }}" class="form-control" name="email" id="" placeholder="Email" required>
                            </div>
                           
                            <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                <label class="form-label">Profile Image</label>
                                <input type="file" class="form-control" name="image" id="" placeholder="Profile Image" />


                                @if(empty(Auth::user()->image))

                                

                                @else
                                
                                <img src="{{ asset('/') }}{{ Auth::user()->image }}" style="height:20px;"/>

                                @endif

                            </div>
                            <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                <label class="form-label">Address<span class="text-red font-w900">*</span>  </label>
                                <textarea class="form-control" name="address" id="" placeholder="Address" required>{{ Auth::user()->address }}</textarea>
                            </div>
                            
                            <h4>Password</h4>
                            <hr>
                            <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control" >
                            </div>
                            <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control" >
                            </div>
                            
                            
                            <div class="col-xl-4 col-xxl-6 col-sm-6 mb-3 mt-2">
                                <button class="btn btn-primary" title="Update Profile" type="submit"><i
                                        class="fa-sharp fa-solid fa-add me-1"></i>Update Profile
                                </button>
                              
                            </div>
                        </div>
                    </form>
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






