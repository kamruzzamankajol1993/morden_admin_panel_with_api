<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Aircraft;
class AircraftExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        $aircraft = Aircraft::latest()->get();

    return view('admin.aircraft._partial.excelSheet', ['aircraft' => $aircraft ]);
    }
}
