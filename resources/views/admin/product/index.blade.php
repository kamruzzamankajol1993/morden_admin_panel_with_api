@extends('admin.master.master')
@section('title', 'Product List')
@section('body')
<main class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <h2 class="mb-0">Product List</h2>
            <div class="d-flex align-items-center">
                <form class="d-flex me-2" role="search">
                    <input class="form-control" id="searchInput" type="search" placeholder="Search products..." aria-label="Search">
                </form>
                <a href="{{ route('product.create') }}" class="btn text-white" style="background-color: var(--primary-color); white-space: nowrap;">
                    <i data-feather="plus" class="me-1" style="width:18px; height:18px;"></i> Add New Product
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @include('flash_message')
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th class="sortable" data-column="name">Name</th>
                                <th>Price</th>
                               
                                <th>Total Stock</th>
                                <th class="sortable" data-column="created_at">Created At</th>
                                <th class="sortable" data-column="status">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            {{-- Data will be loaded via AJAX --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <div class="text-muted"></div>
                <nav>
                    <ul class="pagination justify-content-center" id="pagination"></ul>
                </nav>
            </div>
        </div>
    </div>
</main>
<!-- Stock Details Modal -->
<div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stockModalLabel">Stock Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="stockModalBodyContent">
          <!-- Stock details will be loaded here -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    // Store all sizes passed from the controller for easy lookup
    const allSizes = @json($sizes);

    var currentPage = 1, searchTerm = '', sortColumn = 'id', sortDirection = 'desc';

    var routes = {
        fetch: "{{ route('ajax.product.data') }}",
        destroy: id => `{{ route('product.destroy', ':id') }}`.replace(':id', id),
        csrf: "{{ csrf_token() }}"
    };

    function fetchData() {
        $.get(routes.fetch, {
            page: currentPage, search: searchTerm, sort: sortColumn, direction: sortDirection
        }, function (res) {
            let rows = '';
            if (res.data.length === 0) {
                rows = '<tr><td colspan="8" class="text-center">No products found.</td></tr>';
            } else {
                res.data.forEach((product, i) => {
                    const statusBadge = product.status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                    const firstImage = Array.isArray(product.thumbnail_image) && product.thumbnail_image.length > 0 ? product.thumbnail_image[0] : null;
                    const imageUrl = firstImage ? `{{ asset('public/uploads') }}/${firstImage}` : 'https://placehold.co/50x50';
                    const editUrl = `{{ url('product') }}/${product.id}/edit`;
                    const showUrl = `{{ url('product') }}/${product.id}`;

                    // --- PRICE LOGIC ---
                    let priceHtml = `<b>${product.base_price}</b>`;
                    if (product.discount_price) {
                        priceHtml = `<del>${product.base_price}</del><br><b>${product.discount_price}</b>`;
                    }

                    // --- STOCK LOGIC ---
                    let totalStock = 0;
                    if (product.variants && product.variants.length > 0) {
                        product.variants.forEach(variant => {
                            if (variant.sizes && Array.isArray(variant.sizes)) {
                                variant.sizes.forEach(sizeInfo => {
                                    totalStock +=  Number(sizeInfo.quantity);
                                });
                            }
                        });
                    }
                    
                    // Escape single quotes in product name for the data attribute
                    const safeProductName = product.name.replace(/'/g, "&apos;");
                    const variantsJson = JSON.stringify(product.variants);
                    const stockButton = `<button type="button" class="btn btn-sm btn-outline-secondary btn-stock-modal"
                                            data-bs-toggle="modal"
                                            data-bs-target="#stockModal"
                                            data-product-name='${safeProductName}'
                                            data-variants='${variantsJson}'>
                                            <b>${totalStock}</b>
                                         </button>`;

                    // --- DATE FORMATTING ---
                    const createdAt = new Date(product.created_at).toLocaleDateString('en-US', {
                        day: '2-digit', month: 'short', year: 'numeric'
                    });

                    rows += `<tr>
                        <td>${(res.current_page - 1) * 10 + i + 1}</td>
                        <td><img src="${imageUrl}" alt="${product.name}" width="50" class="img-thumbnail"></td>
                        <td>${product.name}</td>
                        <td>${priceHtml}</td>
                        <td>${stockButton}</td>
                        <td>${createdAt}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <a href="${showUrl}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="${editUrl}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="${product.id}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
                });
            }
            $('#tableBody').html(rows);

            // Pagination logic
            let paginationHtml = '';
            if (res.last_page > 1) {
                 paginationHtml += `<li class="page-item ${res.current_page === 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="1">First</a></li>`;
                paginationHtml += `<li class="page-item ${res.current_page === 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${res.current_page - 1}">Prev</a></li>`;
                const startPage = Math.max(1, res.current_page - 2);
                const endPage = Math.min(res.last_page, res.current_page + 2);
                for (let i = startPage; i <= endPage; i++) {
                    paginationHtml += `<li class="page-item ${i === res.current_page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                }
                paginationHtml += `<li class="page-item ${res.current_page === res.last_page ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${res.current_page + 1}">Next</a></li>`;
                paginationHtml += `<li class="page-item ${res.current_page === res.last_page ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${res.last_page}">Last</a></li>`;
            }
            $('#pagination').html(paginationHtml);
        });
    }

    // --- Modal Population Logic ---
    $(document).on('click', '.btn-stock-modal', function() {
        const productName = $(this).data('product-name');
        const variants = $(this).data('variants');
        const modalTitle = $('#stockModalLabel');
        const modalBody = $('#stockModalBodyContent');

        modalTitle.text(`Stock Details for: ${productName}`);
        modalBody.empty();

        if (variants && variants.length > 0) {
            let contentHtml = '<table class="table table-sm table-bordered"><thead><tr><th>Color</th><th>Size</th><th>Quantity</th></tr></thead><tbody>';
            let hasStock = false;
            variants.forEach(variant => {
                if (variant.sizes && Array.isArray(variant.sizes)) {
                    const availableSizes = variant.sizes.filter(s => s.quantity > 0);
                    if (availableSizes.length > 0) {
                        hasStock = true;
                        availableSizes.forEach(sizeInfo => {
                            const sizeName = allSizes[sizeInfo.size_id] ? allSizes[sizeInfo.size_id].name : 'Unknown';
                            contentHtml += `<tr>
                                <td>${variant.color ? variant.color.name : 'N/A'}</td>
                                <td>${sizeName}</td>
                                <td><b>${sizeInfo.quantity}</b></td>
                            </tr>`;
                        });
                    }
                }
            });
            contentHtml += '</tbody></table>';

            if (!hasStock) {
                modalBody.html('<p class="text-muted">No stock variations available for this product.</p>');
            } else {
                modalBody.html(contentHtml);
            }
        } else {
            modalBody.html('<p class="text-muted">No stock variations available for this product.</p>');
        }
    });

    $('#searchInput').on('keyup', function () { searchTerm = $(this).val(); currentPage = 1; fetchData(); });
    $(document).on('click', '.sortable', function () {
        let col = $(this).data('column');
        sortDirection = sortColumn === col ? (sortDirection === 'asc' ? 'desc' : 'asc') : 'asc';
        sortColumn = col; fetchData();
    });
    $(document).on('click', '.page-link', function (e) { e.preventDefault(); currentPage = $(this).data('page'); fetchData(); });

    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: routes.destroy(id),
                    method: 'DELETE',
                    data: { _token: routes.csrf },
                    success: function() {
                        Swal.fire('Deleted!', 'The product has been deleted.', 'success');
                        fetchData(); // Refresh the table
                    }
                });
            }
        });
    });

    fetchData(); // Initial data load
});
</script>
@endsection
