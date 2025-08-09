@extends('admin.master.master')
@section('title', 'Edit Product')
@section('body')
<main class="main-content">
    <div class="container-fluid">
        <div class="mb-4">
            <h2>Edit Product: {{ $product->name }}</h2>
        </div>
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    {{-- Main Product Fields --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Main Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Code</label>
                                <input type="text" name="product_code" class="form-control" value="{{ old('product_code', $product->product_code) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Size Chart Section --}}
                    <div class="card mb-4">
                        <div class="card-header"><h5 class="mb-0">Size Chart</h5></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Select Default Size Chart</label>
                                <select name="size_chart_id" id="sizeChartSelect" class="form-select">
                                    <option value="">None</option>
                                    @foreach($size_charts as $chart)
                                    <option value="{{ $chart->id }}" @selected($product->assignChart && $product->assignChart->size_chart_id == $chart->id)>
                                        {{ $chart->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="size-chart-entries-container">
                                @if($product->assignChart)
                                <h6 class="mt-3">Edit Entries for this product:</h6>
                                <table class="table table-bordered table-sm">
                                    <thead><tr><th>Size</th><th>Length</th><th>Width</th><th>Shoulder</th><th>Sleeve</th></tr></thead>
                                    <tbody>
                                        @foreach($product->assignChart->entries as $index => $entry)
                                        <tr>
                                            <td><input type="text" name="chart_entries[{{$index}}][size]" class="form-control form-control-sm" value="{{$entry->size}}"></td>
                                            <td><input type="text" name="chart_entries[{{$index}}][length]" class="form-control form-control-sm" value="{{$entry->length}}"></td>
                                            <td><input type="text" name="chart_entries[{{$index}}][width]" class="form-control form-control-sm" value="{{$entry->width}}"></td>
                                            <td><input type="text" name="chart_entries[{{$index}}][shoulder]" class="form-control form-control-sm" value="{{$entry->shoulder}}"></td>
                                            <td><input type="text" name="chart_entries[{{$index}}][sleeve]" class="form-control form-control-sm" value="{{$entry->sleeve}}"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Product Variations --}}
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Product Variations (Color & Size)</h5>
                            <button type="button" id="add-variant-btn" class="btn btn-sm btn-success">Add Color Variation</button>
                        </div>
                        <div class="card-body">
                            <div id="variant-container">
                                @foreach($product->variants as $variantIndex => $variant)
                                <div class="variant-section border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Color Variation</h6>
                                        <button type="button" class="btn-close remove-variant-btn"></button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Color</label>
                                            <select name="variants[{{ $variantIndex }}][color_id]" class="form-select">
                                                @foreach($colors as $color)
                                                <option value="{{ $color->id }}" @selected($variant->color_id == $color->id)>{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Variant Image</label>
                                            <input type="file" name="variants[{{ $variantIndex }}][image]" class="form-control">
                                            @if($variant->variant_image)
                                            <img src="{{ asset('storage/'.$variant->variant_image) }}" height="50" class="mt-2 rounded">
                                            <input type="hidden" name="variants[{{$variantIndex}}][existing_image]" value="{{$variant->variant_image}}">
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Additional Price (Optional)</label>
                                            <input type="number" name="variants[{{ $variantIndex }}][additional_price]" class="form-control" step="0.01" value="{{ $variant->additional_price }}">
                                        </div>
                                    </div>
                                    <h6>Sizes & Quantity</h6>
                                    <div class="p-2 border rounded bg-light">
                                        @php
                                            $variantSizes = collect($variant->sizes)->keyBy('size_id');
                                        @endphp
                                        @foreach($sizes as $sizeIndex => $size)
                                        <div class="row align-items-center mb-2">
                                            <div class="col-5"><label class="form-label-sm">{{ $size->name }} ({{ $size->code }})</label></div>
                                            <div class="col-7">
                                                <input type="hidden" name="variants[{{ $variantIndex }}][sizes][{{ $sizeIndex }}][size_id]" value="{{ $size->id }}">
                                                <input type="number" name="variants[{{ $variantIndex }}][sizes][{{ $sizeIndex }}][quantity]" class="form-control form-control-sm" placeholder="Quantity" value="{{ $variantSizes[$size->id]['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {{-- Pricing & Organization --}}
                    <div class="card mb-4">
                        <div class="card-body">
                             <h5 class="card-title mb-4">Pricing & Organization</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Purchase Price</label>
                                    <input type="number" name="purchase_price" class="form-control" value="{{ old('purchase_price', $product->purchase_price) }}" required step="0.01">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Base Price</label>
                                    <input type="number" name="base_price" class="form-control" value="{{ old('base_price', $product->base_price) }}" required step="0.01">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Discount Price</label>
                                <input type="number" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}" step="0.01">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" id="categoryId" class="form-select" required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <select name="brand_id" class="form-select">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Material</label>
                                <select name="fabric_id" class="form-select">
                                     <option value="">Select Fabric</option>
                                    @foreach($fabrics as $fabric)
                                    <option value="{{ $fabric->id }}" @selected($product->fabric_id == $fabric->id)>{{ $fabric->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Unit</label>
                                <select name="unit_id" class="form-select" required>
                                     @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" @selected($product->unit_id == $unit->id)>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="card">
                        <div class="card-body">
                             <h5 class="card-title mb-4">Media</h5>
                             <div class="mb-3">
                                <label class="form-label">Thumbnail Images</label>
                                <input type="file" name="thumbnail_image[]" class="form-control" id="thumbnailInput" multiple>
                                <div id="thumbnail-preview-container" class="mt-2 d-flex flex-wrap gap-2">
                                    @if(is_array($product->thumbnail_image))
                                        @foreach($product->thumbnail_image as $image)
                                        <div class="existing-image-wrapper" style="position: relative;">
                                            <img src="{{ asset('storage/'.$image) }}" class="img-thumbnail" style="height: 80px; width: 80px; object-fit: cover;">
                                            <button type="button" class="btn btn-danger btn-sm delete-image-btn" style="position: absolute; top: 0; right: 0; padding: 2px 5px;">&times;</button>
                                            <input type="hidden" name="delete_images[]" value="{{ $image }}" disabled>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
        </form>
    </div>
</main>
@endsection
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Dependent Category & Size Chart Logic ---
    var routes = {
        getSubcategories: id => `{{ route('get_subcategories', ':id') }}`.replace(':id', id),
        getSubSubcategories: id => `{{ url('get-sub-subcategories') }}/${id}`,
        getSizeChartEntries: id => `{{ route('get.size-chart.entries', ':id') }}`.replace(':id', id)
    };

    $('#categoryId').on('change', function() {
        let categoryId = $(this).val();
        $('#subcategoryId, #subSubcategoryId').empty().append('<option value="">Select</option>');
        if (categoryId) {
            $.get(routes.getSubcategories(categoryId), function(data) {
                data.forEach(sub => $('#subcategoryId').append(`<option value="${sub.id}">${sub.name}</option>`));
            });
        }
    });

    $('#subcategoryId').on('change', function() {
        let subcategoryId = $(this).val();
        $('#subSubcategoryId').empty().append('<option value="">Select</option>');
        if (subcategoryId) {
            $.get(routes.getSubSubcategories(subcategoryId), function(data) {
                data.forEach(sub => $('#subSubcategoryId').append(`<option value="${sub.id}">${sub.name}</option>`));
            });
        }
    });

    $('#sizeChartSelect').on('change', function() {
        let chartId = $(this).val();
        const container = $('#size-chart-entries-container');
        container.empty();
        if (chartId) {
            $.get(routes.getSizeChartEntries(chartId), function(data) {
                if(data.entries) {
                    let table = `<h6 class="mt-3">Edit Entries for this product:</h6><table class="table table-bordered table-sm"><thead><tr><th>Size</th><th>Length</th><th>Width</th><th>Shoulder</th><th>Sleeve</th></tr></thead><tbody>`;
                    data.entries.forEach((entry, index) => {
                        table += `<tr>
                            <td><input type="text" name="chart_entries[${index}][size]" class="form-control form-control-sm" value="${entry.size}"></td>
                            <td><input type="text" name="chart_entries[${index}][length]" class="form-control form-control-sm" value="${entry.length || ''}"></td>
                            <td><input type="text" name="chart_entries[${index}][width]" class="form-control form-control-sm" value="${entry.width || ''}"></td>
                            <td><input type="text" name="chart_entries[${index}][shoulder]" class="form-control form-control-sm" value="${entry.shoulder || ''}"></td>
                            <td><input type="text" name="chart_entries[${index}][sleeve]" class="form-control form-control-sm" value="${entry.sleeve || ''}"></td>
                        </tr>`;
                    });
                    table += `</tbody></table>`;
                    container.html(table);
                }
            });
        }
    });


    // --- Variation Logic ---
    let variantIndex = {{ $product->variants->count() }}; // Start index from existing variants
    const colors = @json($colors);
    const sizes = @json($sizes);
    $('#add-variant-btn').on('click', function() {
        const container = $('#variant-container');
        let colorOptions = colors.map(color => `<option value="${color.id}">${color.name}</option>`).join('');
        let sizeFields = sizes.map((size, sizeIndex) => `
            <div class="row align-items-center mb-2">
                <div class="col-5"><label class="form-label-sm">${size.name} (${size.code})</label></div>
                <div class="col-7">
                    <input type="hidden" name="variants[${variantIndex}][sizes][${sizeIndex}][size_id]" value="${size.id}">
                    <input type="number" name="variants[${variantIndex}][sizes][${sizeIndex}][quantity]" class="form-control form-control-sm" placeholder="Quantity">
                </div>
            </div>
        `).join('');
        const variantHtml = `
            <div class="variant-section border rounded p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">New Color Variation</h6>
                    <button type="button" class="btn-close remove-variant-btn"></button>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Color</label>
                        <select name="variants[${variantIndex}][color_id]" class="form-select">${colorOptions}</select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Variant Image</label>
                        <input type="file" name="variants[${variantIndex}][image]" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Additional Price (Optional)</label>
                        <input type="number" name="variants[${variantIndex}][additional_price]" class="form-control" step="0.01" placeholder="e.g., 5.00">
                    </div>
                </div>
                <h6>Sizes & Quantity</h6>
                <div class="p-2 border rounded bg-light">${sizeFields}</div>
            </div>
        `;
        container.append(variantHtml);
        variantIndex++;
    });
    $('#variant-container').on('click', '.remove-variant-btn', function() {
        $(this).closest('.variant-section').remove();
    });

    // --- Image Preview & Delete Logic ---
    const previewContainer = document.getElementById('thumbnail-preview-container');
    $('#thumbnailInput').on('change', function(event) {
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => $(previewContainer).append(`<img src="${e.target.result}" class="img-thumbnail" style="height: 80px; width: 80px; object-fit: cover;">`);
            reader.readAsDataURL(file);
        });
    });
    $(previewContainer).on('click', '.delete-image-btn', function() {
        const wrapper = $(this).closest('.existing-image-wrapper');
        const hiddenInput = wrapper.find('input[type="hidden"]');
        if (hiddenInput.prop('disabled')) {
            hiddenInput.prop('disabled', false);
            wrapper.css('opacity', '0.5');
            $(this).html('+').removeClass('btn-danger').addClass('btn-success');
        } else {
            hiddenInput.prop('disabled', true);
            wrapper.css('opacity', '1');
            $(this).html('&times;').removeClass('btn-success').addClass('btn-danger');
        }
    });
});
</script>
@endsection
