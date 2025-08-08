@extends('admin.master.master')

@section('title')
Role Management | {{ $ins_name }}
@endsection

@section('css')
@endsection

@section('body')

<main class="main-content">
                <div class="container-fluid">
                    <h2 class="mb-4">Update Role</h2>

                    <div class="card">
                        <div class="card-body">
                     @include('flash_message')

            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br />

                            {{-- "Select All" Checkbox --}}
                            <label><input type="checkbox" id="checkAll" class="name"> All Permissions</label>
                            <br />
                            <hr>

                            @foreach($permission as $value)
                                {{-- Added a common class 'permission-checkbox' for easier selection --}}
                                <label><input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="name permission-checkbox" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                    {{ $value->name }}</label>
                                <br />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                    </div>
                </div>
            </form>
                        </div>
                    </div>
                </div>
               
            </main>

@endsection

@section('script')
{{-- It's recommended to include jQuery if it's not already globally available in your project --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}

<script type="text/javascript">
    $(document).ready(function() {
        // Function to check if all permission checkboxes are checked and update the "All" checkbox
        function checkAllState() {
            var allChecked = $('.permission-checkbox:checked').length === $('.permission-checkbox').length;
            $('#checkAll').prop('checked', allChecked);
        }

        // Initial check when the page loads
        checkAllState();

        // 1. "Select All" checkbox click event
        $("#checkAll").click(function() {
            $('.permission-checkbox').prop('checked', $(this).prop('checked'));
        });

        // 2. Individual permission checkbox click event
        $(".permission-checkbox").change(function() {
            checkAllState();
        });
    });
</script>
@endsection