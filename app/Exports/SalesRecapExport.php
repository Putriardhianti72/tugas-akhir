<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesRecapExport implements FromCollection, WithMapping, WithHeadings
{
    protected $data;

    protected $i = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }

    public function map($invoice): array
    {
        $this->i++;

        return [
            $this->i,
            $invoice->date,
            (string) ($invoice->total_order ?? '0'),
            (string) ($invoice->total_sales ?? '0'),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Date',
            'Total Order',
            'Total Sales',
        ];
    }
}
