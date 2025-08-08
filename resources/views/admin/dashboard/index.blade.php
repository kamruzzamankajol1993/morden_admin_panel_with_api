@extends('admin.master.master')

@section('title')
Dashboard
@endsection

@section('css')


@endsection

@section('body')
  <main class="main-content">
                <div class="container-fluid">
                    <h2 class="mb-4">Dashboard</h2>

                    <!-- Summary Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-icon bg-primary-soft me-3">
                                        <i data-feather="dollar-sign"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Total Sales</h6>
                                        <h4 class="mb-0">$24,598.50</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-icon bg-accent-soft me-3">
                                        <i data-feather="shopping-cart"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">New Orders</h6>
                                        <h4 class="mb-0">352</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-icon bg-primary-soft me-3">
                                        <i data-feather="package"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Total Products</h6>
                                        <h4 class="mb-0">1,280</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-icon bg-accent-soft me-3">
                                        <i data-feather="user-plus"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">New Customers</h6>
                                        <h4 class="mb-0">86</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="row g-4 mb-4">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-header" style="background-color: var(--primary-color); color: white;">
                                    Sales Overview
                                </div>
                                <div class="card-body">
                                    <img src="https://placehold.co/600x300/f8f9fa/6c757d?text=Sales+Chart+Placeholder" class="img-fluid" alt="Sales Chart">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header" style="background-color: var(--primary-color); color: white;">
                                    Sales by Category
                                </div>
                                <div class="card-body">
                                    <img src="https://placehold.co/400x300/f8f9fa/6c757d?text=Category+Chart+Placeholder" class="img-fluid" alt="Category Chart">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders Table -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Orders</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Order ID</th>
                                            <th>Product</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://placehold.co/40x40/2b7f75/ffffff?text=J" alt="User">
                                                    <div class="ms-3">John Doe</div>
                                                </div>
                                            </td>
                                            <td>#CL-1024</td>
                                            <td>Men's T-Shirt</td>
                                            <td>$25.00</td>
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://placehold.co/40x40/ffd66b/000000?text=S" alt="User">
                                                    <div class="ms-3">Sarah Smith</div>
                                                </div>
                                            </td>
                                            <td>#CL-1023</td>
                                            <td>Women's Dress</td>
                                            <td>$89.99</td>
                                            <td><span class="badge rounded-pill bg-warning text-dark">Shipped</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://placehold.co/40x40/2b7f75/ffffff?text=M" alt="User">
                                                    <div class="ms-3">Mike Johnson</div>
                                                </div>
                                            </td>
                                            <td>#CL-1022</td>
                                            <td>Kids Jeans</td>
                                            <td>$45.50</td>
                                            <td><span class="badge rounded-pill bg-danger">Cancelled</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://placehold.co/40x40/ffd66b/000000?text=E" alt="User">
                                                    <div class="ms-3">Emily Ross</div>
                                                </div>
                                            </td>
                                            <td>#CL-1021</td>
                                            <td>Summer Scarf</td>
                                            <td>$15.00</td>
                                            <td><span class="badge rounded-pill bg-info">Processing</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
@endsection

@section('script')

@endsection