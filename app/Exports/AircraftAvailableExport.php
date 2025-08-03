<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\AircraftAvailabiity;
class AircraftAvailableExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $aircraftAvailabiity = AircraftAvailabiity::latest()->get();

    return view('admin.aircraftAvailabiity._partial.excelSheet', ['aircraftAvailabiity' => $aircraftAvailabiity ]);
    }
}
