<?php

namespace App\Exports;

use App\Register;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegisterExport implements FromQuery, WithHeadings
{

    use Exportable;

    public $startDate;
    public $endDate;


    public function query()
    {
        // TODO: Implement query() method.
        return \App\Models\Register::query()->whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.

        return
            [
                'Id',
                'Student Name',
                'Registration Number',
                'Card Number',
                'Status',
                'Collection Date',
                'Expire Date',
                'Created At',
                'Updated At',

            ];
    }
}
