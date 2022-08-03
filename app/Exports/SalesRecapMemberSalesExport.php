<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SalesRecapMemberSalesExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
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
            $invoice->nama,
            $invoice->email,
            $invoice->hp . ' ',
            (string) ($invoice->orderData->total_order ?? '0'),
            (string ($invoice->orderData->total_sales ?? '0'),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'Email',
            'HP',
            'Total Order',
            'Total Penjualan',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
