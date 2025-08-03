<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\AircraftModeltype;
class AircraftModeltypeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
       $aircraftModeltype = AircraftModeltype::latest()->get();

    return view('admin.aircraftModeltype._partial.excelSheet', ['aircraftModeltype' => $aircraftModeltype ]);
    }
}
