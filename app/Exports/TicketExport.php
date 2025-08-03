<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Ticket;
use Auth;
class TicketExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
       if(Auth::user()->id == 1){
      $tickets = Ticket::with([
            'customer',
            'helicopterModel',
            'flightType',
            'otherPassengers',
            'distanceSegments'
        ])->latest()->get();

      }else{
$tickets = Ticket::with([
            'customer',
            'helicopterModel',
            'flightType',
            'otherPassengers',
            'distanceSegments'
        ])->where('admin_id',Auth::user()->id)->latest()->get();

      }

     

    return view('admin.ticket._partial.custome.excelSheet', ['tickets' => $tickets ]);
    }
}