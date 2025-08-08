<!-- new code strat -->

@extends('admin.master.master')

@section('title')

Role Management | {{ $ins_name }}

@endsection


@section('css')

@endsection


@section('body')

<main class="main-content">
                <div class="container-fluid">
                    <h2 class="mb-4">List Of Permissions</h2>

                    <div class="card">
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
               
            </main>


@endsection


@section('script')

@endsection
