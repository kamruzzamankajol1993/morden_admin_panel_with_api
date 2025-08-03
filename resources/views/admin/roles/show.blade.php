<!-- new code strat -->

@extends('admin.master.master')

@section('title')

Role Management | {{ $ins_name }}

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
<li><span class="text-main-600 fw-normal text-15">Role Management</span></li>
</ul>
</div>
</div>
<!-- Breadcrumb End -->
<div class="card overflow-hidden">
    <div class="card-header">
        Role Information
    </div>
    <div class="card-body">
        @include('flash_message')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <label class="badge bg-success mb-2">{{ $v->name }},</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    </div>



@endsection


@section('script')

@endsection
