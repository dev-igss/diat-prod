<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use App\Http\Models\DietRequest;

class DietRequestReportExport implements FromView, ShouldAutoSize, WithEvents, WithDrawings
{
    
    public function view(): View{
        //$diet_requests = DietRequest::withTrashed()->get();
        $diet_requests = DietRequest::all();

        $data = [
            'diet_requests' => $diet_requests
        ];

        return view('admin.diet_request.export', $data);
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event){

                $event->sheet->getDelegate()->mergeCells('B1:F1');
                $event->sheet->getDelegate()->mergeCells('B2:F2');
                $event->sheet->getDelegate()->mergeCells('B3:F3');
                $event->sheet->getDelegate()->mergeCells('B4:F4');
                $event->sheet->getDelegate()->mergeCells('B5:F5');
                $event->sheet->getDelegate()->mergeCells('A1:A5');

                

                $event->sheet->setCellValue('B2', 'Listado de Solicitudes de Dietas');
                $event->sheet->getDelegate()->getStyle('B2:F2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B2:F2')->getFont()->setName('Calibri');
                $event->sheet->getDelegate()->getStyle('B2:F2')->getFont()->setSize(14);
                $event->sheet->setCellValue('B3', 'Sistema de Dietas');
                $event->sheet->getDelegate()->getStyle('B3:F3')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B3:F3')->getFont()->setName('Calibri');
                $event->sheet->getDelegate()->getStyle('B3:F3')->getFont()->setSize(12);


                $event->sheet->getDelegate()->getStyle('A6:F6')->getFont()->setName('Calibri');
                $event->sheet->getDelegate()->getStyle('A6:F6')->getFont()->setSize(12);

                //$diets_total = DietRequest::withTrashed()->count();
                $diets_total = DietRequest::count();
                $row_count = 6;
                for($i=0; $i < $diets_total; $i++) {
                    $row_count++;
                  }

                $event->getSheet()->getDelegate()->getStyle('A6:F'.$row_count)->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                
                $event->sheet->getStyle('A6:F6')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'],]);
                
                $event->sheet->getDelegate()->getStyle('A1:F'.$row_count)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        
            },
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/Isotipo.png'));
        $drawing->setHeight(100);
        $drawing->setOffsetX(30);
        $drawing->setOffsetY(2);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
