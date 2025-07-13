<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class FullReportExport implements FromCollection
{
    public function collection()
    {
        return Employee::select('id', 'name', 'position', 'email')->get();
    }
}
