<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesRecapMostSalesExport implements FromCollection, WithMapping, WithHeadings
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
            $invoice['product_name'],
            $invoice['code'],
            $invoice['total_qty'] ?? '0',
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Produk',
            'Kode Produk',
            'Jumlah Terjual',
        ];
    }
}
