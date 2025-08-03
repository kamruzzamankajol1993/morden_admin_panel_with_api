<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\AircraftModeltype;
use App\Models\Offer;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\GeneralTicket;
use DB;
use Auth;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $latestOfferList = Offer::where("fly_date",">",date('Y-m-d'))
        ->latest()->limit(3)->where('status','Active')->get();


        if(Auth::user()->id == 1){
        // Get the sum of 'total_seat' for each month over the last 12 months.
        $sales = GeneralTicket::select(
            DB::raw('count(id) as seats_sold'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as sale_month")
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
        ->groupBy('sale_month')
        ->orderBy('sale_month', 'ASC')
        ->get();
        }else{

            $sales = GeneralTicket::select(
            DB::raw('count(id) as seats_sold'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as sale_month")
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
        ->where('admin_id',Auth::user()->id)
        ->groupBy('sale_month')
        ->orderBy('sale_month', 'ASC')
        ->get();


        }

        // Create a lookup array for quick access to sales data
        $salesLookup = [];
        foreach ($sales as $sale) {
            $salesLookup[$sale->sale_month] = (int)$sale->seats_sold;
        }

        // Prepare the data array for Google Charts, ensuring all 12 months are present
        $ticketSalesData = [['Month', 'Seats Sold']];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');      // Format: "2024-06"
            $monthName = $date->format('M Y');      // Format: "Jun 2024"

            // Use the sales data from the lookup, or 0 if no sales for that month
            $seatsSold = $salesLookup[$monthKey] ?? 0;

            $ticketSalesData[] = [$monthName, $seatsSold];
        }
        // --- END: Logic for Google Bar Chart ---

        //dd($ticketSalesData);

        // --- START: Logic for Helicopter Distribution Pie Chart ---

$helicopterUsage = Ticket::join('aircraft_modeltypes', 'tickets.helicopter_model_id', '=', 'aircraft_modeltypes.id')
    ->select('aircraft_modeltypes.name as model_name', DB::raw('count(tickets.id) as ticket_count'))
    ->groupBy('aircraft_modeltypes.name')
    ->orderBy('ticket_count', 'desc')
    ->get();

$helicopterUsageData = [['Helicopter Model', 'Number of Tickets']];
foreach ($helicopterUsage as $usage) {
    $helicopterUsageData[] = [$usage->model_name, (int)$usage->ticket_count];
}

// If no tickets are found, add a placeholder to avoid chart errors
if (count($helicopterUsageData) === 1) {
    $helicopterUsageData[] = ['No Tickets Found', 0];
}

// --- END: Logic for Pie Chart ---

$latestCustomeTicket = Ticket::latest()->limit(5)->get();
if(Auth::user()->id == 1){
  $latestGeneralTicket = GeneralTicket::latest()->limit(5)->get(); 
}else{

    $latestGeneralTicket = GeneralTicket::latest()
    ->where('admin_id',Auth::user()->id)
    ->limit(5)->get(); 

}     
        return view('admin.dashboard.index',compact('latestGeneralTicket','latestCustomeTicket','latestOfferList','ticketSalesData','helicopterUsageData'));
    }
}
