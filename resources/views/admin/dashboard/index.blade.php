@extends('admin.master.master')

@section('title')
Dashboard
@endsection

@section('css')
<style>
    .card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        color: white;
    }
    .card-header-custom {
        background-color: var(--primary-color);
        color: white;
        border-bottom: none;
    }
</style>
@endsection

@section('body')
 <main class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <h2 class="mb-0">Dashboard</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary">Today</button>
                    <button class="btn btn-sm btn-outline-secondary">This Month</button>
                    <button class="btn btn-sm btn-outline-secondary">This Year</button>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-xl-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-primary me-3">
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
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-success me-3">
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
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-info me-3">
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
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-warning me-3">
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
                    <div class="card h-100">
                        <div class="card-header card-header-custom">
                            Sales Overview
                        </div>
                        <div class="card-body">
                            {{-- Google Chart will be rendered here --}}
                            <div id="sales_chart" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card h-100">
                        <div class="card-header card-header-custom">
                            Sales by Category
                        </div>
                        <div class="card-body">
                             {{-- Google Chart will be rendered here --}}
                            <div id="category_chart" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
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
                                            <img src="https://placehold.co/40x40/2b7f75/ffffff?text=J" alt="User" class="rounded-circle">
                                            <div class="ms-3">John Doe</div>
                                        </div>
                                    </td>
                                    <td>#CL-1024</td>
                                    <td>Men's T-Shirt</td>
                                    <td>$25.00</td>
                                    <td><span class="badge rounded-pill bg-success-soft text-success">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/40x40/ffd66b/000000?text=S" alt="User" class="rounded-circle">
                                            <div class="ms-3">Sarah Smith</div>
                                        </div>
                                    </td>
                                    <td>#CL-1023</td>
                                    <td>Women's Dress</td>
                                    <td>$89.99</td>
                                    <td><span class="badge rounded-pill bg-warning-soft text-warning">Shipped</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/40x40/2b7f75/ffffff?text=M" alt="User" class="rounded-circle">
                                            <div class="ms-3">Mike Johnson</div>
                                        </div>
                                    </td>
                                    <td>#CL-1022</td>
                                    <td>Kids Jeans</td>
                                    <td>$45.50</td>
                                    <td><span class="badge rounded-pill bg-danger-soft text-danger">Cancelled</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/40x40/ffd66b/000000?text=E" alt="User" class="rounded-circle">
                                            <div class="ms-3">Emily Ross</div>
                                        </div>
                                    </td>
                                    <td>#CL-1021</td>
                                    <td>Summer Scarf</td>
                                    <td>$15.00</td>
                                    <td><span class="badge rounded-pill bg-info-soft text-info">Processing</span></td>
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
<!-- Google Charts Loader -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        drawSalesChart();
        drawCategoryChart();
    }

    function drawSalesChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Sales');
        data.addRows([
            ['Jan', 18000], ['Feb', 22000], ['Mar', 25000],
            ['Apr', 23000], ['May', 28000], ['Jun', 31000],
            ['Jul', 29000]
        ]);

        // Set chart options
        var options = {
            'title':'Sales Overview',
            'hAxis': {title: 'Month'},
            'vAxis': {title: 'Sales ($)'},
            'legend': { position: 'none' },
            'colors': ['#2b7f75'] // Corresponds to your --primary-color
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('sales_chart'));
        chart.draw(data, options);
    }

    function drawCategoryChart() {
        var data = google.visualization.arrayToDataTable([
            ['Category', 'Sales'],
            ['Men',     11000],
            ['Women',      8000],
            ['Kids',  5000],
            ['Accessories', 2500]
        ]);

        var options = {
            title: 'Sales by Category',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('category_chart'));
        chart.draw(data, options);
    }

    // Redraw charts on window resize
    $(window).resize(function(){
        drawCharts();
    });
</script>
@endsection
