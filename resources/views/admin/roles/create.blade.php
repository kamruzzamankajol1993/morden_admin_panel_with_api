@extends('admin.master.master')

@section('title')
Role Management | {{ $ins_name }}
@endsection

@section('css')
@endsection

@section('body')

<main class="main-content">
                <div class="container-fluid">
                    <h2 class="mb-4">Create Role</h2>

                    <div class="card">
                        <div class="card-body">
                        @include('flash_message')

            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>

                            {{-- "Select All" Checkbox --}}
                            <label><input type="checkbox" id="checkAll"> All Permissions</label>
                            <br/>
                            <hr>

                            @foreach($permission as $value)
                                {{-- Added 'permission-checkbox' class for easier JS targeting --}}
                                <label><input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="name permission-checkbox">
                                {{ $value->name }}</label>
                                <br/>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>
                </div>
            </form>
                        </div>
                    </div>
                </div>
               
            </main>

@endsection

@section('script')
{{-- Make sure jQuery is available in your project --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}

<script type="text/javascript">
    $(document).ready(function() {
        // 1. "Select All" checkbox click event
        $("#checkAll").click(function() {
            // Check or uncheck all checkboxes with the 'permission-checkbox' class
            $('.permission-checkbox').prop('checked', $(this).prop('checked'));
        });

        // 2. Individual permission checkbox click event
        $(".permission-checkbox").change(function() {
            // If any individual box is unchecked, uncheck the "All" box
            if (!$(this).prop("checked")) {
                $("#checkAll").prop("checked", false);
            }
            // Optional: Check the "All" box if all other boxes are checked
            else {
                var allChecked = $('.permission-checkbox:checked').length === $('.permission-checkbox').length;
                $('#checkAll').prop('checked', allChecked);
            }
        });
    });
</script>
@endsection