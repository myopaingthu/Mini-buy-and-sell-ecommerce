<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Description',
            'Price',
            'Phone',
            'Address',
            'Category id',
            'User id',
            'Created at',
            'Updated at',
            'Available',
            'Deleted at',
        ];
    }

      /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:L1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $worksheet = $event->sheet->getDelegate();
             
                $colorArray =  [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FF13A7E6']
                    ]
                    ];
                
                $worksheet->getStyle('A1:L1')->applyFromArray($colorArray);
                
            },
        ];
    }
}
