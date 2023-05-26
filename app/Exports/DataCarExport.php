<?php

namespace App\Exports;

use App\data_car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataCarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return data_car::all();
        return view('homecar.viewreport', compact('data','title','type','fdate','tdate','originType'));
    }
}
