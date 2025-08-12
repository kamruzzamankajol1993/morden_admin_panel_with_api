@extends('admin.master.master')
@section('title', 'Edit Offer Name')
@section('css')
    
@endsection
@section('body')
<main class="main-content">
    <div class="container-fluid">
        <h2 class="mb-4">Edit Offer Name</h2>
        <form action="{{ route('bundle-offer.update', $bundleOffer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Offer Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Offer Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $bundleOffer->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Offer Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $bundleOffer->title }}" required>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1" id="status" @if($bundleOffer->status) checked @endif>
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>
                    </div>
                   
                </div>
                
            </div>
            <button type="submit" class="btn btn-primary mt-4">Update Offer</button>
        </form>
    </div>
</main>
@endsection
@section('script')

@endsection
