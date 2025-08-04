@extends('admin.master.master')

@section('title')
Dashboard
@endsection

@section('css')


@endsection

@section('body')
 <main class="container-fluid px-4">
                <div class="row g-3 my-4">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div><h3 class="fs-2">720</h3><p class="fs-5 mb-0 text-muted">Total Products</p></div>
                            <i class="fas fa-box-open fs-1 primary-text border rounded-full p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div><h3 class="fs-2">4,920</h3><p class="fs-5 mb-0 text-muted">Total Sales</p></div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div><h3 class="fs-2">385</h3><p class="fs-5 mb-0 text-muted">Pending Orders</p></div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div><h3 class="fs-2">25%</h3><p class="fs-5 mb-0 text-muted">Increase</p></div>
                            <i class="fas fa-chart-line fs-1 primary-text border rounded-full p-3"></i>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Orders</h3>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table bg-white rounded shadow-sm table-hover align-middle">
                                <thead class="table-custom-header">
                                    <tr>
                                        <th scope="col" width="50">#</th><th scope="col">Product</th><th scope="col">Customer</th><th scope="col">Price</th><th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><th scope="row">1</th><td>T-Shirt</td><td>John Doe</td><td>$15.00</td><td><span class="badge bg-success">Shipped</span></td></tr>
                                    <tr><th scope="row">2</th><td>Jeans</td><td>Jane Smith</td><td>$45.50</td><td><span class="badge bg-warning text-dark">Processing</span></td></tr>
                                    <tr><th scope="row">3</th><td>Hoodie</td><td>Mike Johnson</td><td>$29.99</td><td><span class="badge bg-success">Shipped</span></td></tr>
                                    <tr><th scope="row">4</th><td>Formal Shirt</td><td>Emily Brown</td><td>$32.00</td><td><span class="badge bg-danger">Cancelled</span></td></tr>
                                    <tr><th scope="row">5</th><td>Kurta</td><td>Ahmed Khan</td><td>$22.75</td><td><span class="badge bg-warning text-dark">Processing</span></td></tr>
                                    <tr><th scope="row">6</th><td>Saree</td><td>Priya Patel</td><td>$75.00</td><td><span class="badge bg-info">Delivered</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Orders</h3>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table bg-white rounded shadow-sm table-hover align-middle">
                                <thead class="table-custom-header">
                                    <tr>
                                        <th scope="col" width="50">#</th><th scope="col">Product</th><th scope="col">Customer</th><th scope="col">Price</th><th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><th scope="row">1</th><td>T-Shirt</td><td>John Doe</td><td>$15.00</td><td><span class="badge bg-success">Shipped</span></td></tr>
                                    <tr><th scope="row">2</th><td>Jeans</td><td>Jane Smith</td><td>$45.50</td><td><span class="badge bg-warning text-dark">Processing</span></td></tr>
                                    <tr><th scope="row">3</th><td>Hoodie</td><td>Mike Johnson</td><td>$29.99</td><td><span class="badge bg-success">Shipped</span></td></tr>
                                    <tr><th scope="row">4</th><td>Formal Shirt</td><td>Emily Brown</td><td>$32.00</td><td><span class="badge bg-danger">Cancelled</span></td></tr>
                                    <tr><th scope="row">5</th><td>Kurta</td><td>Ahmed Khan</td><td>$22.75</td><td><span class="badge bg-warning text-dark">Processing</span></td></tr>
                                    <tr><th scope="row">6</th><td>Saree</td><td>Priya Patel</td><td>$75.00</td><td><span class="badge bg-info">Delivered</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Orders</h3>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table bg-white rounded shadow-sm table-hover align-middle">
                                <thead class="table-custom-header">
                                    <tr>
                                        <th scope="col" width="50">#</th><th scope="col">Product</th><th scope="col">Customer</th><th scope="col">Price</th><th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><th scope="row">1</th><td>T-Shirt</td><td>John Doe</td><td>$15.00</td><td><span class="badge bg-success">Shipped</span></td></tr>
                                    <tr><th scope="row">2</th><td>Jeans</td><td>Jane Smith</td><td>$45.50</td><td><span class="badge bg-warning text-dark">Processing</span></td></tr>
                                    <tr><th scope="row">3</th><td>Hoodie</td><td>Mike Johnson</td><td>$29.99</td><td><span class="badge bg-success">Shipped</span></td></tr>
                                    <tr><th scope="row">4</th><td>Formal Shirt</td><td>Emily Brown</td><td>$32.00</td><td><span class="badge bg-danger">Cancelled</span></td></tr>
                                    <tr><th scope="row">5</th><td>Kurta</td><td>Ahmed Khan</td><td>$22.75</td><td><span class="badge bg-warning text-dark">Processing</span></td></tr>
                                    <tr><th scope="row">6</th><td>Saree</td><td>Priya Patel</td><td>$75.00</td><td><span class="badge bg-info">Delivered</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </main>
@endsection

@section('script')

@endsection