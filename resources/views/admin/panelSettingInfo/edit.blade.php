@extends('admin.master.master')

@section('title')

Panel Setting | {{ $ins_name }}

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
<li><span class="text-main-600 fw-normal text-15">Panel Setting</span></li>
</ul>
</div>
</div>
<!-- Breadcrumb End -->
<div class="card overflow-hidden">
    <div class="card-header">
        Update Panel Information
    </div>
    <div class="card-body">
        @include('flash_message')

                        <form method="post" action="{{ route('systemInformation.update',$panelSettingInfo->id)}}" enctype="multipart/form-data" id="form" data-parsley-validate="">
                            @csrf
                            @method('PUT')


                            <div class="row">
                               @if(Auth::user()->id == 1)

                                <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                    <label class="form-label">Branch Name<span class="text-red font-w900">*</span>  </label>
                                    <select name="branch_id" style="width: 100%" class="form-control" required>
                                            <option value="">--select brnach--</option>
                                            @foreach($branchInfo as $branchInfos)
                                            <option value="{{ $branchInfos->id }}" {{ $panelSettingInfo->branch_id == $branchInfos->id ? 'selected':'' }}>{{ $branchInfos->name }}</option>
                                            @endforeach
                                    </select>
                                </div>

                                @else
                                <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}" class="form-control" id="" placeholder="System Name" required>
                                @endif

                                <div class="col-xl-4 col-xxl-4 col-sm-4 mb-3 mt-3">
                                    <label class="form-label">System Name<span class="text-red font-w900">*</span>  </label>
                                    <input type="text" name="ins_name" value="{{ $panelSettingInfo->ins_name }}" class="form-control" id="" placeholder="System Name" required>
                                </div>
                                <div class="col-xl-4 col-xxl-4 col-sm-4 mb-3 mt-3">
                                    <label class="form-label">System Phone Number<span class="text-red font-w900">*</span>  </label>
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    type = "number" maxlength = "11" class="form-control col-xl-3" id="text" data-parsley-length="[11, 11]" value="{{ $panelSettingInfo->phone }}"  id="" name="phone" placeholder="System Phone Number" required>
                                </div>
                                <div class="col-xl-4 col-xxl-4 col-sm-4 mb-3 mt-3">
                                    <label class="form-label">System Email<span class="text-red font-w900">*</span>  </label>
                                    <input type="email" class="form-control" value="{{ $panelSettingInfo->email }}"  name="email" id="" placeholder="System Email" required>
                                </div>
                                <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                    <label class="form-label">System Icon<span class="text-red font-w900">*</span>  </label>
                                    <input type="file" class="form-control" name="icon" id="" placeholder="System Icon" >
                                    <img src="{{ asset('/') }}{{ $panelSettingInfo->icon }}" style="height:20px;"/>
                                </div>
                                <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                    <label class="form-label">System Logo<span class="text-red font-w900">*</span>  </label>
                                    <input type="file" class="form-control" name="logo" id="" placeholder="System Logo" >
                                    <img src="{{ asset('/') }}{{ $panelSettingInfo->logo }}" style="height:20px;"/>
                                </div>

                                <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                    <label class="form-label">Tax(%)<span class="text-red font-w900">*</span>  </label>
                                    <input type="number" class="form-control" value="{{ $panelSettingInfo->tax }}" name="tax" id="" placeholder="Tax" required>
                                </div>

                                <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                                    <label class="form-label">Service Charge(%)<span class="text-red font-w900">*</span>  </label>
                                    <input type="number" class="form-control" value="{{ $panelSettingInfo->charge }}" name="charge" id="" placeholder="Service Charge" required>
                                </div>

                                          <div class="col-xl-6 col-xxl-6 col-sm-6 mb-3">
                <label class="form-label">BD To USD Conversation<span class="text-red font-w900">*</span>  </label>
                <small class="text-danger">please type here the exchange rate</small>
                <input type="text" class="form-control" name="usdollar" value="{{ $panelSettingInfo->usdollar }}" id="" placeholder="D To USD Conversation" required>
            </div>


                                <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                    <label class="form-label">System Address<span class="text-red font-w900">*</span>  </label>
                                    <textarea class="form-control" name="address" id="" placeholder="System Address" required>{{ $panelSettingInfo->address }}</textarea>
                                </div>

                                <h4>Seo Information</h4>
                                <hr>
                                <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                    <label class="form-label">Keyword</label>
                                    <input type="text" class="form-control" value="{{ $panelSettingInfo->keyword }}"  name="keyword" id="" placeholder="Keyword">
                                </div>
                                <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="" placeholder="Description">{{ $panelSettingInfo->description }}</textarea>
                                </div>
                                <h4>Other</h4>
                               <hr>
                              
                                <div class="col-xl-12 col-xxl-12 col-sm-12 mb-3">
                                    <label class="form-label">Developed By</label>
                                    <input type="text" class="form-control" value="{{ $panelSettingInfo->develop_by }}"  name="develop_by" id="" placeholder="Developed By">
                                </div>
                                <div class="col-xl-4 col-xxl-6 col-sm-6 mb-3 mt-3">
                                    <button class="btn btn-primary" title="Update Panel Info" type="submit"><i
                                            class="fa-sharp fa-solid fa-add me-1"></i>Update Panel Info
                                    </button>

                                </div>


                            </div>


                        </form>
    </div>
</div>
    </div>





@endsection


@section('script')

@endsection
