<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\FlightType;
class FlightTypeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
            $flightType = FlightType::latest()->get();

    return view('admin.flightType._partial.excelSheet', ['flightType' => $flightType ]);
    }
}
