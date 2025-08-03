@extends('admin.master.master')

@section('title')
Dashboard
@endsection

@section('css')

<style>
     /* --- Button Sizing --- */
    .card-design .btn-sm {
        padding: 0.35rem 0.8rem;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    /* --- CORRECTED: Styles for the "Details" Button --- */
    .card-design .btn-outline-primary {
        color: #652E89 !important; /* Use !important to force override other styles */
        background-color: transparent; /* Ensure background is not white */
        border-color: #652E89;
    }
    .card-design .btn-outline-primary:hover {
        color: #fff !important; /* Also add !important here for consistency */
        background-color: #652E89;
        border-color: #652E89;
    }
</style>

@endsection

@section('body')
<div class="dashboard-body">
           
    <div class="row gy-4">
        <div class="col-lg-9">
            <!-- Widgets Start -->
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{\App\Models\AircraftModeltype::count()}}</h4>
                            <span class="text-gray-600">Total Helicopter</span>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl"><i class="ph ph-airplane-taxiing"></i></span>
                                <div id="complete-course" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{\App\Models\Offer::where('status','Active')->count()}}</h4>
                            <span class="text-gray-600">Total Offer</span>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-two-600 text-white text-2xl"><i class="ph-fill ph-file"></i></span>
                                <div id="earned-certificate" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{\App\Models\Service::where('status','Active')->count()}}</h4>
                            <span class="text-gray-600">Total Service</span>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-purple-600 text-white text-2xl"> <i class="ph-fill ph-file"></i></span>
                                <div id="course-progress" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">

                                @if(Auth::user()->id == 1)
                                
                                {{\App\Models\Customer::where('status','Active')->count()}}

                                @else
 {{\App\Models\Customer::where('status','Active')->where('admin_id',Auth::user()->id)->count()}}
                                @endif
                            
                            
                            </h4>
                            <span class="text-gray-600">Total Customer</span>
                            <div class="flex-between gap-8 mt-16">
                                <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl"><i class="ph-fill ph-users-three"></i></span>
                                <div id="community-support" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->

            <!-- Top Course Start -->
            <div class="card mt-24">
    <div class="card-body">
        <div class="mb-20 flex-between flex-wrap gap-8">
            <h4 class="mb-0">Monthly General Ticket Sales (Last 12 Months)</h4>
        </div>

        {{-- Google Chart will be rendered here --}}
        <div id="monthly_ticket_sales_chart" style="width: 100%; height: 350px;"></div>

    </div>
</div>'

<div class="card mt-24">
    <div class="card-body">
        <div class="mb-20">
            <h4 class="mb-0">Ticket Distribution by Helicopter Model</h4>
        </div>

        {{-- Google Pie Chart will be rendered here --}}
        <div id="helicopter_distribution_chart" style="width: 100%; height: 400px;"></div>

    </div>
</div>'
            <!-- Top Course End -->

            <!-- Top Course Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Latest Offer</h4>
                        <a href="{{route('offer.index')}}" class="text-13 fw-medium text-main-600 hover-text-decoration-underline">See All</a>
                    </div>
                    
                    <div class="row g-20">

                        @foreach($latestOfferList as $offer)

                        <?php 

                        

                        $bookedSeats = \App\Models\GeneralTicket::where('offer_or_service_id', $offer->id)
                                        ->where('ticket_type', 'offer')
                                        ->sum('total_seat');
                    
                        
                        $finalSeat = (int)$offer->total_seat - (int)$bookedSeats;

                        
                        ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card border border-gray-100">
                                <div class="card-body p-8">
                                   <div class="col">
            <div class="card h-100 card-design">
                <img src="{{ asset($offer->image) }}" class="card-img-top" alt="{{ $offer->mainTitle }}">
                <div class="card-body">
                    <h5 class="card-title">{{ Str::limit($offer->mainTitle,15) }}</h5>
                    <p class="card-text mb-1">

                        <?php  

                        if(Auth::user()->id == 1){
$increaseAmount =0;
                        }else{
                        $perType = Auth::user()->markamounttype;
                        $perAmount = Auth::user()->markupamount; 
                        
                        if($perType == 'percentage'){

                            $increaseAmount = ceil(($offer->price*$perAmount)/100);


                        }else{

                            $increaseAmount = ceil($offer->price - $perAmount);


                        }
                    }  
                        ?>
                        
                        <strong>Price:</strong> ৳{{ number_format($offer->price + $increaseAmount, 2) }}</p>
                    <p class="card-text mb-1"><strong>Flight:</strong> {{ \Carbon\Carbon::parse($offer->fly_date)->format('d M, Y') }} to {{ \Carbon\Carbon::parse($offer->end_date)->format('d M, Y') }}</p>
                  
                    <div class="seat-info bg-light p-2 rounded mb-3">
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-couch"></i> Total: <strong>{{ $offer->total_seat }}</strong></span>
                            <span class="text-success"><i class="fas fa-check-circle"></i> Available: <strong>{{ $finalSeat }}</strong></span>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" data-description="{!! e($offer->des) !!}" data-title="{{ e($offer->mainTitle) }}">
                                <i class="fas fa-info-circle"></i> Details
                            </button>
                            <a href="{{ url('/create-ticket/offer/' . $offer->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-ticket-alt"></i> Create Ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <!-- Top Course End -->
        </div>

        <div class="col-lg-3">
            <!-- Calendar Start -->
            <div class="card">
                <div class="card-body">
                    <div class="calendar">
                        <div class="calendar__header">
                            <button type="button" class="calendar__arrow left"><i class="ph ph-caret-left"></i></button>
                            <p class="display h6 mb-0">""</p>
                            <button type="button" class="calendar__arrow right"><i class="ph ph-caret-right"></i></button>
                        </div>
                    
                        <div class="calendar__week week">
                            <div class="calendar__week-text">Su</div>
                            <div class="calendar__week-text">Mo</div>
                            <div class="calendar__week-text">Tu</div>
                            <div class="calendar__week-text">We</div>
                            <div class="calendar__week-text">Th</div>
                            <div class="calendar__week-text">Fr</div>
                            <div class="calendar__week-text">Sa</div>
                        </div>
                        <div class="days"></div>
                    </div>
                </div>
            </div>
            <!-- Calendar End -->
            @if(Auth::user()->id == 1)
            <!-- Assignment Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Custome Ticket</h4>
                        <a href="{{route('ticket.index')}}" class="text-13 fw-medium text-main-600 hover-text-decoration-underline">See All</a>
                    </div>
                    @foreach($latestCustomeTicket as $latestCustomeTickets)
                    <div class="p-xl-4 py-16 px-12 flex-between gap-8 rounded-8 border border-gray-100 hover-border-gray-200 transition-1 mb-16">
                        <div class="flex-align flex-wrap gap-8">
                            <span class="text-main-600 bg-main-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0"><i class="ph-fill ph-graduation-cap"></i></span>
                            <div>
                                <h6 class="mb-0">{{$latestCustomeTickets->ticket_number}}</h6>
                                <span class="text-13 text-gray-400">{{\Carbon\Carbon::parse($latestCustomeTickets->fly_date)->format('d/m/Y')}}</span>
                            </div>
                        </div>
                        <a href="{{route('ticket.show',$latestCustomeTickets->id)}}" class="text-gray-900 hover-text-main-600"><i class="ph ph-caret-right"></i></a>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            <!-- Assignment End -->
            @endif
            
              <!-- Assignment Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">General Ticket</h4>
                        <a href="{{route('generalTicket.index')}}" class="text-13 fw-medium text-main-600 hover-text-decoration-underline">See All</a>
                    </div>
                    @foreach($latestGeneralTicket as $latestGeneralTickets)
                    <div class="p-xl-4 py-16 px-12 flex-between gap-8 rounded-8 border border-gray-100 hover-border-gray-200 transition-1 mb-16">
                        <div class="flex-align flex-wrap gap-8">
                            <span class="text-main-600 bg-main-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0"><i class="ph-fill ph-graduation-cap"></i></span>
                            <div>
                                <h6 class="mb-0">{{$latestGeneralTickets->ticket_number}}</h6>
                                <span class="text-13 text-gray-400">{{\Carbon\Carbon::parse($latestGeneralTickets->created_at)->format('d/m/Y')}}</span>
                            </div>
                        </div>
                        <a href="{{route('generalTicket.show',$latestGeneralTickets->id)}}" class="text-gray-900 hover-text-main-600"><i class="ph ph-caret-right"></i></a>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            <!-- Assignment End -->
        </div>

    </div>
</div>
{{-- Detail Modal remains the same --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
     // Modal Logic
    $(document).on('click', '[data-bs-toggle="modal"]', function(){
        const button = $(this);
        $('#detailModal .modal-title').text(button.data('title'));
        $('#detailModal .modal-body').html(button.data('description'));
    });
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load the Visualization API and required packages.
    google.charts.load('current', {'packages':['corechart', 'bar']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawAllCharts);

    // Function to draw all charts on the page
    function drawAllCharts() {
        drawSalesBarChart();
        drawHelicopterPieChart();
    }

    // 1. Draw the Monthly Sales Bar Chart
    function drawSalesBarChart() {
        const data = google.visualization.arrayToDataTable({!! json_encode($ticketSalesData) !!});

        const options = {
            chart: {
                title: 'Total Seats Sold Per Month',
                subtitle: 'Based on ticket creation dates for the last 12 months',
            },
            bars: 'vertical',
            vAxis: { format: 'decimal', title: 'Number of Seats Sold', minValue: 0 },
            hAxis: { title: 'Month' },
            colors: ['#652E89'],
            legend: { position: "none" }
        };

        const chart = new google.charts.Bar(document.getElementById('monthly_ticket_sales_chart'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    // 2. Draw the Helicopter Distribution Pie Chart
    function drawHelicopterPieChart() {
        const data = google.visualization.arrayToDataTable({!! json_encode($helicopterUsageData) !!});

        const options = {
            title: 'Ticket Distribution by Helicopter Model',
            is3D: true,
            pieSliceText: 'percentage',
            pieSliceTextStyle: {
                color: 'white',
                fontSize: 14,
            },
            legend: {
                position: 'bottom',
                alignment: 'center'
            },
            // You can define custom colors for each slice
             colors: ['#652E89', '#8a4fb2', '#a86ec8', '#c790de', '#e5b3f4']
        };

        const chart = new google.visualization.PieChart(document.getElementById('helicopter_distribution_chart'));
        chart.draw(data, options);
    }

    // Redraw all charts on window resize for responsiveness
    $(window).resize(function(){
        drawAllCharts();
    });
</script>
@endsection