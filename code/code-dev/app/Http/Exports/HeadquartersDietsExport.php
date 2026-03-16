<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Http\Models\DietRequest;
use App\Http\Models\DietRequestDetail;
use App\Http\Models\Service;
use App\Http\Models\ServiceSiigss;
use Illuminate\Support\Facades\Http;
use DB, Carbon\Carbon,  Auth;

class HeadquartersDietsExport implements FromView, WithEvents, WithDrawings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $date_in;
    public $services_siigss;
    public $datos;
    public $servicios;

    function __construct($data){
        
        $this->date_in = $data['date_in'];
        $this->services_siigss = ServiceSiigss::select('name')->get();
        $this->datos = DietRequestDetail::whereDate('created_at', $this->date_in)
                ->get();
        $this->servicios = Service::all();
    }



    public function view(): View{
        

        $data = [
            
        ];

        return view('admin.diet_request.reports.matriz', $data);
    }

    public function title(): string
    {   
        //return 'Día '.Carbon::now()->format('d');
        return 'Día '.Carbon::createFromFormat('Y-m-d', $this->date_in)->format('d');
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event){
                

                $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);
                $event->sheet->getPageSetup()->setFitToPage(true);
                $event->sheet->setShowGridlines(False);

                $event->sheet->freezePane('C12');

                $event->sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        
                // lock all cells then unlock the cell
                $event->sheet->getParent()->getActiveSheet()
                    ->getStyle('BB40:BJ43')
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_UNPROTECTED);

                $event->sheet->getParent()->getActiveSheet()
                    ->getStyle('BB46:BJ49')
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_UNPROTECTED);

                // styling first row
                $event->sheet->getStyle(1)->getFont()->setBold(true);

                $columnas = [
                    'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
                    'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
                    'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO'
                ];

                foreach($columnas as $columna){
                    $event->sheet->getDelegate()->getColumnDimension($columna)->setWidth(30, 'px');
                }

                for($i = 1; $i <= 66; $i++){
                    $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(23, 'px');
                }

                $event->sheet->getDelegate()->mergeCells('C1:BO1');
                $event->sheet->getDelegate()->mergeCells('C2:BL2');
                $event->sheet->getDelegate()->mergeCells('BM2:BO2');
                $event->sheet->getDelegate()->mergeCells('C3:BL3');
                $event->sheet->getDelegate()->mergeCells('C4:BL4');
                $event->sheet->getDelegate()->mergeCells('C5:BL5');
                $event->sheet->getDelegate()->mergeCells('C6:BL6');
                $event->sheet->getDelegate()->mergeCells('BM3:BO6');
                $event->sheet->getDelegate()->mergeCells('A1:B6');
                

                $event->sheet->getDelegate()->getStyle('C2:BO6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                                
                
                $event->sheet->setCellValue('C2', 'INSTITUTO GUATEMALTECO DE SEGURIDAD SOCIAL');              
                $event->sheet->getDelegate()->getStyle('C2:BL2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('C2:BL2')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('C2:BL2')->getFont()->setSize(12);
                $event->sheet->setCellValue('BM2', 'SPS-98');
                $event->sheet->getDelegate()->getStyle('BM2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('BM2')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('BM2')->getFont()->setSize(12);
                $event->sheet->setCellValue('C3', 'SECCIÓN DE NUTRICIÓN');
                $event->sheet->getDelegate()->getStyle('C3:BL3')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('C3:BL3')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('C3:BL3')->getFont()->setSize(12);
                $event->sheet->setCellValue('C4', 'HOSPITAL GENERAL DE QUETZALTENANGO');
                $event->sheet->getDelegate()->getStyle('C4:BL4')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('C4:BL4')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('C4:BL4')->getFont()->setSize(12);
                $event->sheet->setCellValue('C5', 'ESTANCIA DIARIA DE PACIENTES Y PERSONAL');
                $event->sheet->getDelegate()->getStyle('C5:BL5')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('C5:BL5')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('C5:BL5')->getFont()->setSize(12);
                
                /* ----------------------------------------------------------------------------------------------------------- */
                $event->getSheet()->getDelegate()->getStyle('A7:BO52')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );

                $event->sheet->getDelegate()->mergeCells('A7:A10');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30, 'px');
                $event->sheet->setCellValue('A7', 'FECHA');              
                $event->sheet->getDelegate()->getStyle('A7')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A7')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('A7')->getFont()->setSize(8);
                $event->sheet->getDelegate()->getStyle("A7")->getAlignment()->setTextRotation(90);
                $event->sheet->getDelegate()->getStyle('A7:A10')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A7:A10')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->getDelegate()->mergeCells('B7:B10');
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(200, 'px');
                $event->sheet->setCellValue('B7', 'SERVICIO/UNIDAD');              
                $event->sheet->getDelegate()->getStyle('B7')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B7')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('B7')->getFont()->setSize(10);
                $event->sheet->getStyle('B7:B10')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('B7:B10')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B7:B10')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->getDelegate()->getStyle('C7:BO11')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->mergeCells('C7:BL7');
                $event->sheet->setCellValue('C7', 'TIPO DE DIETAS');              
                $event->sheet->getDelegate()->getStyle('C7')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('C7')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('C7')->getFont()->setSize(12);

                $event->sheet->getDelegate()->mergeCells('BM7:BO9');
                $event->sheet->setCellValue('BM7', 'DIETISTA RESPONSABLE');              
                $event->sheet->getDelegate()->getStyle('BM7')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('BM7')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('BM7')->getFont()->setSize(8);
                $event->sheet->getStyle('BM7:BO9')->getAlignment()->setWrapText(true);

                $event->sheet->getDelegate()->mergeCells('C11:BJ11');
                $event->sheet->getDelegate()->mergeCells('BK11:BL11');

                $event->sheet->getDelegate()->mergeCells('C8:H8');
                $event->sheet->setCellValue('C8', 'LIQUIDOS');
                $event->sheet->getDelegate()->mergeCells('C9:E9');
                $event->sheet->setCellValue('C9', 'CLAROS');
                $event->sheet->getStyle("C10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('C10', 'D'); 
                $event->sheet->getStyle("D10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('D10', 'A');
                $event->sheet->getStyle("E10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('E10', 'C'); 
                $event->sheet->getDelegate()->mergeCells('F9:H9');
                $event->sheet->setCellValue('F9', 'COMPLETOS');
                $event->sheet->getStyle("F10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('F10', 'D'); 
                $event->sheet->getStyle("G10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('G10', 'A');
                $event->sheet->getStyle("H10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('H10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('I8:K9');
                $event->sheet->setCellValue('I8', 'BLANDAS');
                $event->sheet->getStyle("I10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('I10', 'D'); 
                $event->sheet->getStyle("J10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('J10', 'A');
                $event->sheet->getStyle("K10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('K10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('L8:N9');
                $event->sheet->setCellValue('L8', 'PAPILLAS (LICUADAS/PURE)');
                $event->sheet->getDelegate()->getStyle('L8')->getFont()->setSize(8);
                $event->sheet->getStyle('L8')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle("L10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('L10', 'D'); 
                $event->sheet->getStyle("M10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('M10', 'A');
                $event->sheet->getStyle("N10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('N10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('O8:Q9');
                $event->sheet->setCellValue('O8', 'PICADA');
                $event->sheet->getStyle("O10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('O10', 'D'); 
                $event->sheet->getStyle("P10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('P10', 'A');
                $event->sheet->getStyle("Q10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('Q10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('R8:T9');
                $event->sheet->setCellValue('R8', 'HIPOGRASA');
                $event->sheet->getStyle("R10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('R10', 'D'); 
                $event->sheet->getStyle("S10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('S10', 'A');
                $event->sheet->getStyle("T10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('T10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('U8:W9');
                $event->sheet->setCellValue('U8', 'HIPOSODICA');
                $event->sheet->getStyle("U10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('U10', 'D'); 
                $event->sheet->getStyle("V10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('V10', 'A');
                $event->sheet->getStyle("W10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('W10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('X8:AI8');
                $event->sheet->setCellValue('X8', 'DIABETICO');
                $event->sheet->getDelegate()->mergeCells('X9:Z9');
                $event->sheet->setCellValue('X9', '1500 Kcal');
                $event->sheet->getStyle("X10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('X10', 'D'); 
                $event->sheet->getStyle("Y10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('Y10', 'A');
                $event->sheet->getStyle("Z10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('Z10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AA9:AC9');
                $event->sheet->setCellValue('AA9', '1800 Kcal');
                $event->sheet->getStyle("AA10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AA10', 'D'); 
                $event->sheet->getStyle("AB10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AB10', 'A');
                $event->sheet->getStyle("AC10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AC10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AD9:AF9');
                $event->sheet->setCellValue('AD9', '2000 Kcal');
                $event->sheet->getStyle("AD10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AD10', 'D'); 
                $event->sheet->getStyle("AE10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AE10', 'A');
                $event->sheet->getStyle("AF10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AF10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AG9:AI9');
                $event->sheet->setCellValue('AG9', '2200 Kcal');
                $event->sheet->getStyle("AG10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AG10', 'D'); 
                $event->sheet->getStyle("AH10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AH10', 'A');
                $event->sheet->getStyle("AI10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AI10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AJ8:AR8');
                $event->sheet->setCellValue('AJ8', 'PEDIATRICAS');
                $event->sheet->getDelegate()->mergeCells('AJ9:AL9');
                $event->sheet->getStyle("AJ10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AJ10', 'D'); 
                $event->sheet->getStyle("AK10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AK10', 'A');
                $event->sheet->getStyle("AL10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AL10', 'C'); 

                $event->sheet->setCellValue('AJ9', '6 a 9 meses');
                $event->sheet->getDelegate()->mergeCells('AM9:AO9');
                $event->sheet->setCellValue('AM9', '9 a 12 meses');
                $event->sheet->getStyle("AM10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AM10', 'D'); 
                $event->sheet->getStyle("AN10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AN10', 'A');
                $event->sheet->getStyle("AO10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AO10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AP9:AR9');
                $event->sheet->setCellValue('AP9', '1 a 7 años');
                $event->sheet->getStyle("AP10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AP10', 'D'); 
                $event->sheet->getStyle("AQ10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AQ10', 'A');
                $event->sheet->getStyle("AR10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AR10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AS8:AU9');
                $event->sheet->setCellValue('AS8', 'CALCULADAS POR NUTRICION'); 
                $event->sheet->getDelegate()->getStyle('AS8')->getFont()->setSize(8);
                $event->sheet->getStyle('AS8')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle("AS10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AS10', 'D'); 
                $event->sheet->getStyle("AT10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AT10', 'A');
                $event->sheet->getStyle("AU10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AU10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AV8:AX9');
                $event->sheet->setCellValue('AV8', 'OTROS'); 
                $event->sheet->getStyle("AV10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AV10', 'D'); 
                $event->sheet->getStyle("AW10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AW10', 'A');
                $event->sheet->getStyle("AX10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('AX10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('AY8:BA9');
                $event->sheet->getStyle('AY8:BA9')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'FFFF00'],]);
                $event->sheet->setCellValue('AY8', 'TOTAL DE DIETAS MODIFICADAS'); 
                $event->sheet->getDelegate()->getStyle('AY8')->getFont()->setSize(8);
                $event->sheet->getStyle('AY8')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle("AY10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('AY10', 'D'); 
                $event->sheet->getStyle("AZ10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('AZ10', 'A');
                $event->sheet->getStyle("BA10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('BA10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('BB8:BD9');
                $event->sheet->getStyle('BB8:BD9')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'C4D79B'],]);
                $event->sheet->setCellValue('BB8', 'LIBRES'); 
                $event->sheet->getStyle('BB8')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle("BB10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('BB10', 'D'); 
                $event->sheet->getStyle("BC10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('BC10', 'A');
                $event->sheet->getStyle("BD10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('BD10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('BE8:BG9');
                $event->sheet->getStyle('BE8:BG8')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'CCC0DA'],]);
                $event->sheet->setCellValue('BE8', 'TOTAL DE DIETAS'); 
                $event->sheet->getStyle('BE8')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle("BE10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('BE10', 'D'); 
                $event->sheet->getStyle("BF10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('BF10', 'A');
                $event->sheet->getStyle("BG10")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('BG10', 'C'); 

                $event->sheet->getDelegate()->mergeCells('BH8:BK8');
                $event->sheet->getStyle('BH8:BK8')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'FABF8F'],]);
                $event->sheet->setCellValue('BH8', 'REFACCIONES'); 

                $event->sheet->getDelegate()->mergeCells('BH9:BH10');
                $event->sheet->getStyle("BH9:BH10")->getFont()->getColor()->setRGB('60497A');
                $event->sheet->setCellValue('BH9', 'RM');

                $event->sheet->getDelegate()->mergeCells('BI9:BI10');
                $event->sheet->getStyle("BI9:BI10")->getFont()->getColor()->setRGB('E26B0A');
                $event->sheet->setCellValue('BI9', 'RV');

                $event->sheet->getDelegate()->mergeCells('BJ9:BJ10');
                $event->sheet->getStyle("BJ9:BJ10")->getFont()->getColor()->setRGB('963634');
                $event->sheet->setCellValue('BJ9', 'RN');

                $event->sheet->getDelegate()->mergeCells('BK9:BK10');
                $event->sheet->getStyle("BK9:BK10")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('BK9', 'BANCO DE SANGRE'); 
                $event->sheet->getDelegate()->getStyle('BK9')->getFont()->setSize(8);
                $event->sheet->getStyle('BK9')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('BK')->setWidth(80, 'px');

                $event->sheet->getDelegate()->mergeCells('BL8:BL10');
                $event->sheet->getStyle("BL8:BL10")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('BL8', 'DIETAS DE VIAJE'); 
                $event->sheet->getDelegate()->getColumnDimension('BL')->setWidth(80, 'px');
                $event->sheet->getStyle('BL8')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('BL8')->getFont()->setSize(10);
                $event->sheet->getDelegate()->getStyle('BL8:BL10')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BL8:BL10')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->getDelegate()->mergeCells('BM10:BM11');
                $event->sheet->getStyle("BM10:BM11")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('BM10', 'D'); 

                $event->sheet->getDelegate()->mergeCells('BN10:BN11');
                $event->sheet->getStyle("BN10:BN11")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('BN10', 'A'); 

                $event->sheet->getDelegate()->mergeCells('BO10:BO11');
                $event->sheet->getStyle("BO10:BO11")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('BO10', 'C');
                
                /*--------------------------------------------------------------------------------------------------------------*/
                $event->sheet->setCellValue('B11', 'PACIENTES');              
                $event->sheet->getDelegate()->getStyle('B11')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B11')->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle('B11')->getFont()->setSize(8);
                $event->sheet->getDelegate()->getStyle('B11')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $servicios_siigss_total = ServiceSiigss::count();
                $services_siigss = ServiceSiigss::all();
                $row_count1 = 12;

                

                for($i=0; $i < $servicios_siigss_total; $i++) {
                    $event->sheet->setCellValue('B'.$row_count1, $services_siigss[$i]->name);                                  
                    $row_count1++;
                }

                $row_count2 = $row_count1;

                $event->getSheet()->getDelegate()->getStyle('A12'.':BO'.$row_count2)->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );

                $event->sheet->getDelegate()->mergeCells('A12:A52');
                $event->sheet->setCellValue('A12', Carbon::createFromFormat('Y-m-d', $this->date_in)->format('d-m-Y'));
                $event->sheet->getDelegate()->getStyle("A12")->getAlignment()->setTextRotation(90);
                $event->sheet->getDelegate()->getStyle('A12'.':A'.$row_count2)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A12'.':A'.$row_count2)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->getDelegate()->mergeCells('BK12'.':BK'.$row_count2-1);  
                $event->sheet->getDelegate()->getStyle('BK12'.':BK'.$row_count2-1)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BK12'.':BK'.$row_count2-1)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


                $fecha = Carbon::createFromFormat('Y-m-d', $this->date_in)->format('Y-m-d');

                
                
                
                
                

                

                /*Columnas Desayunos */
                $columnas1 = [
                    'C', 'F', 'I', 'L', 'O', 'R', 'U', 'X', 'AA', 'AD', 'AG', 'AJ', 'AM', 'AP', 'AS', 'AV',
                    'AY', 'BB', 'BE', 'BH', 'BK'
                ];
                $refacciones = DB::table('diet_requests')
                    ->select(DB::raw("SUM(diet_requests.total_diets) as suma"))
                    ->where('diet_requests.idjourney', 4)
                    ->whereDate('created_at', $this->date_in)
                    ->get();
                $row_count3 = 12;
                $fila_in = 11;
                $fila_out = $fila_in + $servicios_siigss_total;
                /*$event->sheet->setCellValue('BP12', $fila_in);
                $event->sheet->setCellValue('BP13', $fila_out);
                $event->sheet->setCellValue('BP14', $fila_out+1);*/

                

                $conteo_desayunos = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 12)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_request_details.iddiet','<>', 19)
                    ->where('diet_request_details.iddiet','<>', 20)
                    ->where('diet_request_details.iddiet','<>', 21)
                    ->where('diet_request_details.iddiet','<>', 22)
                    ->where('diet_request_details.iddiet','<>', 23)
                    ->where('diet_request_details.iddiet','<>', 24)
                    ->where('diet_request_details.iddiet','<>', 25)
                    ->where('diet_request_details.iddiet','<>', 26)
                    ->where('diet_request_details.iddiet','<>', 27)
                    ->where('diet_request_details.iddiet','<>', 28)
                    ->where('diet_request_details.iddiet','<>', 29)
                    ->where('diet_requests.idjourney', 1)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'diet_request_details.iddiet',
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_desayunos_libres = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet', 12)
                    ->where('diet_requests.idjourney', 1)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'diet_request_details.iddiet',
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_desayunos_otros = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->whereIn('diet_request_details.iddiet', ['19','20','21','22','23','24','25','26','27','29'])
                    ->where('diet_requests.idjourney', 1)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                



                
                for($i = 0; $i < count($columnas1); $i++){
                    for($j=0; $j < $servicios_siigss_total ; $j++) {
                        if($i == 20){
                            $event->sheet->getStyle('BK12')->getFont()->getColor()->setRGB('0000FF');
                            foreach($refacciones as $ref){
                                $ref->suma != null ? $event->sheet->setCellValue('BK12', $ref->suma) : $event->sheet->setCellValue('BK12', 0);
                            }
                            $event->sheet->getDelegate()->getStyle('BK12')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                            $event->sheet->getDelegate()->getStyle('BK12')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        }

                        $sumrange = 'BK12:BK'.$fila_out;
                        $event->sheet->setCellValue('BK'.$fila_out+1, '=SUM(' . $sumrange . ')');
                        $event->sheet->getStyle('BK'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                        $event->sheet->getDelegate()->getStyle('BK'.$fila_out+1)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle('BK'.$fila_out+1)
                            ->getAlignment()
                            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                       

                        $event->sheet->setCellValue($columnas1[$i].$row_count3, 0); 
                        $event->sheet->getStyle($columnas1[$i].$row_count3)->getFont()->getColor()->setRGB('0000FF');
                        $event->sheet->getDelegate()->getStyle($columnas1[$i].$row_count3)
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas1[$i].$row_count3)
                            ->getAlignment()
                            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                        
                        $contador = 0;
                        $contador1 = 0;
                        $contador2 = 0;
                        $columnas = $i+1;
                        //$columnas = $columnas1[$i]+1;
        
                        
                
                        for($d = 0; $d < count($conteo_desayunos); $d++){
                            if($conteo_desayunos[$contador]->dieta == 1){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('C'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 2){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('F'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 3){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('I'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 4){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('L'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 5){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('O'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 6){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('R'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 7){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('U'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 8){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('X'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 9){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AA'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 10){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AD'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 11){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AG'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 13){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AJ'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 14){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AM'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 15){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AP'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            if($conteo_desayunos[$contador]->dieta == 16){                               
                                if($conteo_desayunos[$contador]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AS'.$row_count3, $conteo_desayunos[$contador]->total_dietas);
                                }                                
                            }
                            
                            $contador++;
                        }

                        for($d = 0; $d < count($conteo_desayunos_libres); $d++){
                            if($conteo_desayunos_libres[$contador1]->dieta == 12){                               
                                if($conteo_desayunos_libres[$contador1]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('BB'.$row_count3, $conteo_desayunos_libres[$contador1]->total_dietas);
                                }                                
                            }
                            
                            $contador1++;
                        }

                        for($d = 0; $d < count($conteo_desayunos_otros); $d++){                             
                                if($conteo_desayunos_otros[$contador2]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AV'.$row_count3, $conteo_desayunos_otros[$contador2]->total_dietas);
                                } 
                            
                            $contador2++;
                        }
                            
                                                     
                        $row_count3++; 
                        if($j == 24){
                            $row_count3 = 12;             
                        }                       
                    }
                }                
                
                $sumrange_C = 'C12:C'.$fila_out;
                $event->sheet->setCellValue('C'.$fila_out+1, '=SUM(' . $sumrange_C . ')');
                $event->sheet->getStyle('C'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('C'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                
                $sumrange_F = 'F12:F'.$fila_out;
                $event->sheet->setCellValue('F'.$fila_out+1, '=SUM(' . $sumrange_F . ')');
                $event->sheet->getStyle('F'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('F'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('F'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_I = 'I12:I'.$fila_out;
                $event->sheet->setCellValue('I'.$fila_out+1, '=SUM(' . $sumrange_I . ')');
                $event->sheet->getStyle('I'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('I'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('I'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_L = 'L12:L'.$fila_out;
                $event->sheet->setCellValue('L'.$fila_out+1, '=SUM(' . $sumrange_L . ')');
                $event->sheet->getStyle('L'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('L'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('L'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_O = 'O12:O'.$fila_out;
                $event->sheet->setCellValue('O'.$fila_out+1, '=SUM(' . $sumrange_O . ')');
                $event->sheet->getStyle('O'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('O'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('O'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_R = 'R12:R'.$fila_out;
                $event->sheet->setCellValue('R'.$fila_out+1, '=SUM(' . $sumrange_R . ')');
                $event->sheet->getStyle('R'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('R'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('R'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_U = 'U12:U'.$fila_out;
                $event->sheet->setCellValue('U'.$fila_out+1, '=SUM(' . $sumrange_U . ')');
                $event->sheet->getStyle('U'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('U'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('U'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_X = 'X12:X'.$fila_out;
                $event->sheet->setCellValue('X'.$fila_out+1, '=SUM(' . $sumrange_X . ')');
                $event->sheet->getStyle('X'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('X'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('X'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AA = 'AA12:AA'.$fila_out;
                $event->sheet->setCellValue('AA'.$fila_out+1, '=SUM(' . $sumrange_AA . ')');
                $event->sheet->getStyle('AA'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AA'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AA'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AD = 'AD12:AD'.$fila_out;
                $event->sheet->setCellValue('AD'.$fila_out+1, '=SUM(' . $sumrange_AD . ')');
                $event->sheet->getStyle('AD'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AD'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AD'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
                $sumrange_AG = 'AG12:AG'.$fila_out;
                $event->sheet->setCellValue('AG'.$fila_out+1, '=SUM(' . $sumrange_AG . ')');
                $event->sheet->getStyle('AG'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AG'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AG'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                    
                
                $sumrange_AJ = 'AJ12:AJ'.$fila_out;
                $event->sheet->setCellValue('AJ'.$fila_out+1, '=SUM(' . $sumrange_AJ . ')');
                $event->sheet->getStyle('AJ'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AJ'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AJ'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AM = 'AM12:AM'.$fila_out;
                $event->sheet->setCellValue('AM'.$fila_out+1, '=SUM(' . $sumrange_AM . ')');
                $event->sheet->getStyle('AM'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AM'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AM'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AP = 'AP12:AP'.$fila_out;
                $event->sheet->setCellValue('AP'.$fila_out+1, '=SUM(' . $sumrange_AP . ')');
                $event->sheet->getStyle('AP'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AP'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AP'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AS = 'AS12:AS'.$fila_out;
                $event->sheet->setCellValue('AS'.$fila_out+1, '=SUM(' . $sumrange_AS . ')');
                $event->sheet->getStyle('AS'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AS'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AS'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AV = 'AV12:AV'.$fila_out;
                $event->sheet->setCellValue('AV'.$fila_out+1, '=SUM(' . $sumrange_AV . ')');
                $event->sheet->getStyle('AV'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AV'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AV'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AY = 'AY12:AY'.$fila_out;
                $event->sheet->setCellValue('AY'.$fila_out+1, '=SUM(' . $sumrange_AY . ')');
                $event->sheet->getStyle('AY'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('AY'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AY'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BB = 'BB12:BB'.$fila_out;
                $event->sheet->setCellValue('BB'.$fila_out+1, '=SUM(' . $sumrange_BB . ')');
                $event->sheet->getStyle('BB'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BB'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BB'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BE = 'BE12:BE'.$fila_out;
                $event->sheet->setCellValue('BE'.$fila_out+1, '=SUM(' . $sumrange_BE . ')');
                $event->sheet->getStyle('BE'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BE'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BE'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BH = 'BH12:BH'.$fila_out;
                $event->sheet->setCellValue('BH'.$fila_out+1, '=SUM(' . $sumrange_BH . ')');
                $event->sheet->getStyle('BH'.$fila_out+1)->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BH'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BH'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                /*Fin Columnas Desayunos */

                

                

                
                /*Columnas Almuerzos */
                $conteo_almuerzos = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 12)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_request_details.iddiet','<>', 19)
                    ->where('diet_request_details.iddiet','<>', 20)
                    ->where('diet_request_details.iddiet','<>', 21)
                    ->where('diet_request_details.iddiet','<>', 22)
                    ->where('diet_request_details.iddiet','<>', 23)
                    ->where('diet_request_details.iddiet','<>', 24)
                    ->where('diet_request_details.iddiet','<>', 25)
                    ->where('diet_request_details.iddiet','<>', 26)
                    ->where('diet_request_details.iddiet','<>', 27)
                    ->where('diet_request_details.iddiet','<>', 28)
                    ->where('diet_request_details.iddiet','<>', 29)
                    ->where('diet_requests.idjourney', 2)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'diet_request_details.iddiet',
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_almuerzos_libres = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet', 12)
                    ->where('diet_requests.idjourney',2)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'diet_request_details.iddiet',
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_almuerzos_otros = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->whereIn('diet_request_details.iddiet', ['19','20','21','22','23','24','25','26','27','29'])
                    ->where('diet_requests.idjourney', 2)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();

                $conteo_de_viaje = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet', 28)
                    ->whereIn('diet_requests.idjourney',['1','2','3'])
                    ->where('diet_requests.status', 2)
                    ->groupBy('diet_requests.idjourney')
                    ->orderBy('services.reporte_siigss')
                    ->get();

                $columnas2 = [
                    'D', 'G', 'J', 'M', 'P','S','V','Y','AB','AE','AH','AK','AN','AQ','AT','AW','AZ',
                    'BC','BF', 'BI', 'BL'
                ];
                $row_count4 = 12;
                for($i = 0; $i < count($columnas2); $i++){
                    for($j=0; $j < $servicios_siigss_total; $j++) {
                        $event->sheet->getStyle($columnas2[$i].$row_count4)->getFont()->getColor()->setRGB('FF0000');
                        $event->sheet->setCellValue($columnas2[$i].$row_count4, 0);          
                        $event->sheet->getDelegate()->getStyle($columnas2[$i].$row_count4)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas2[$i].$row_count4)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                    
                        

                        $contador3 = 0;
                        $contador4 = 0;
                        $contador5 = 0;
                        $contador6 = 0;
                        $columnas = $i+1;
                        //$columnas = $columnas1[$i]+1;       
                        
                
                        for($d = 0; $d < count($conteo_almuerzos); $d++){
                            if($conteo_almuerzos[$contador3]->dieta == 1){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('D'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 2){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('G'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 3){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('J'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 4){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('M'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 5){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('P'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 6){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('S'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 7){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('V'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 8){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('Y'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 9){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AB'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 10){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AE'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 11){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AH'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 13){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AK'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 14){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AN'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 15){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AQ'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            if($conteo_almuerzos[$contador3]->dieta == 16){                               
                                if($conteo_almuerzos[$contador3]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AT'.$row_count4, $conteo_almuerzos[$contador3]->total_dietas);
                                }                                
                            }
                            
                            $contador3++;
                        }

                        for($d = 0; $d < count($conteo_almuerzos_libres); $d++){
                            if($conteo_almuerzos_libres[$contador4]->dieta == 12){                               
                                if($conteo_almuerzos_libres[$contador4]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('BC'.$row_count4, $conteo_almuerzos_libres[$contador4]->total_dietas);
                                }                                
                            }
                            
                            $contador4++;
                        }

                        for($d = 0; $d < count($conteo_almuerzos_otros); $d++){                             
                                if($conteo_almuerzos_otros[$contador5]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AW'.$row_count4, $conteo_almuerzos_otros[$contador5]->total_dietas);
                                } 
                            
                            $contador5++;
                        }

                        for($d = 0; $d < count($conteo_de_viaje); $d++){                             
                            if($conteo_de_viaje[$contador6]->servicio == $services_siigss[$j]->id){
                                $event->sheet->setCellValue('BL'.$row_count4, $conteo_de_viaje[$contador6]->total_dietas);
                            } 
                        
                            $contador6++;
                        }

                        $row_count4++; 
                        if($j == 24){
                            $row_count4 = 12;             
                        }                       
                    }
                }

                $sumrange_D = 'D12:D'.$fila_out;
                $event->sheet->setCellValue('D'.$fila_out+1, '=SUM(' . $sumrange_D . ')');
                $event->sheet->getStyle('D'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('D'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('D'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_G = 'G12:G'.$fila_out;
                $event->sheet->setCellValue('G'.$fila_out+1, '=SUM(' . $sumrange_G . ')');
                $event->sheet->getStyle('G'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('G'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('G'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_J = 'J12:J'.$fila_out;
                $event->sheet->setCellValue('J'.$fila_out+1, '=SUM(' . $sumrange_J . ')');
                $event->sheet->getStyle('J'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('J'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('J'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_M = 'M12:M'.$fila_out;
                $event->sheet->setCellValue('M'.$fila_out+1, '=SUM(' . $sumrange_M . ')');
                $event->sheet->getStyle('M'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('M'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('M'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_P = 'P12:P'.$fila_out;
                $event->sheet->setCellValue('P'.$fila_out+1, '=SUM(' . $sumrange_P . ')');
                $event->sheet->getStyle('P'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('P'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('P'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_S = 'S12:S'.$fila_out;
                $event->sheet->setCellValue('S'.$fila_out+1, '=SUM(' . $sumrange_S . ')');
                $event->sheet->getStyle('S'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('S'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('S'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_V = 'V12:V'.$fila_out;
                $event->sheet->setCellValue('V'.$fila_out+1, '=SUM(' . $sumrange_V . ')');
                $event->sheet->getStyle('V'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('V'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('V'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_Y = 'Y12:Y'.$fila_out;
                $event->sheet->setCellValue('Y'.$fila_out+1, '=SUM(' . $sumrange_Y . ')');
                $event->sheet->getStyle('Y'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('Y'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('Y'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AB = 'AB12:AB'.$fila_out;
                $event->sheet->setCellValue('AB'.$fila_out+1, '=SUM(' . $sumrange_AB . ')');
                $event->sheet->getStyle('AB'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AB'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AB'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AE = 'AE12:AE'.$fila_out;
                $event->sheet->setCellValue('AE'.$fila_out+1, '=SUM(' . $sumrange_AE . ')');
                $event->sheet->getStyle('AE'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AE'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AE'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AH = 'AH12:AH'.$fila_out;
                $event->sheet->setCellValue('AH'.$fila_out+1, '=SUM(' . $sumrange_AH . ')');
                $event->sheet->getStyle('AH'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AH'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AH'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AK = 'AK12:AK'.$fila_out;
                $event->sheet->setCellValue('AK'.$fila_out+1, '=SUM(' . $sumrange_AK . ')');
                $event->sheet->getStyle('AK'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AK'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AK'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AN = 'AN12:AN'.$fila_out;
                $event->sheet->setCellValue('AN'.$fila_out+1, '=SUM(' . $sumrange_AN . ')');
                $event->sheet->getStyle('AN'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AN'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AN'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AQ = 'AQ12:AQ'.$fila_out;
                $event->sheet->setCellValue('AQ'.$fila_out+1, '=SUM(' . $sumrange_AQ . ')');
                $event->sheet->getStyle('AQ'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AQ'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AQ'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AT = 'AT12:AT'.$fila_out;
                $event->sheet->setCellValue('AT'.$fila_out+1, '=SUM(' . $sumrange_AT . ')');
                $event->sheet->getStyle('AT'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AT'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AT'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AW = 'AW12:AW'.$fila_out;
                $event->sheet->setCellValue('AW'.$fila_out+1, '=SUM(' . $sumrange_AW . ')');
                $event->sheet->getStyle('AW'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AW'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AW'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AZ = 'AZ12:AZ'.$fila_out;
                $event->sheet->setCellValue('AZ'.$fila_out+1, '=SUM(' . $sumrange_AZ . ')');
                $event->sheet->getStyle('AZ'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('AZ'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AZ'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BC = 'BC12:BC'.$fila_out;
                $event->sheet->setCellValue('BC'.$fila_out+1, '=SUM(' . $sumrange_BC . ')');
                $event->sheet->getStyle('BC'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BC'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BC'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BF = 'BF12:BF'.$fila_out;
                $event->sheet->setCellValue('BF'.$fila_out+1, '=SUM(' . $sumrange_BF . ')');
                $event->sheet->getStyle('BF'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BF'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BF'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BI = 'BI12:BI'.$fila_out;
                $event->sheet->setCellValue('BI'.$fila_out+1, '=SUM(' . $sumrange_BI . ')');
                $event->sheet->getStyle('BI'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BI'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BI'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BL = 'BL12:BL'.$fila_out;
                $event->sheet->setCellValue('BL'.$fila_out+1, '=SUM(' . $sumrange_BL . ')');
                $event->sheet->getStyle('BL'.$fila_out+1)->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BL'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BL'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                /*Fin Columnas Almuerzos */

                /*Columnas Cenas */
                $conteo_cenas = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 12)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_request_details.iddiet','<>', 19)
                    ->where('diet_request_details.iddiet','<>', 20)
                    ->where('diet_request_details.iddiet','<>', 21)
                    ->where('diet_request_details.iddiet','<>', 22)
                    ->where('diet_request_details.iddiet','<>', 23)
                    ->where('diet_request_details.iddiet','<>', 24)
                    ->where('diet_request_details.iddiet','<>', 25)
                    ->where('diet_request_details.iddiet','<>', 26)
                    ->where('diet_request_details.iddiet','<>', 27)
                    ->where('diet_request_details.iddiet','<>', 28)
                    ->where('diet_request_details.iddiet','<>', 29)
                    ->where('diet_requests.idjourney', 3)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'diet_request_details.iddiet',
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_cenas_libres = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet', 12)
                    ->where('diet_requests.idjourney', 3)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'diet_request_details.iddiet',
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_cenas_otros = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->whereIn('diet_request_details.iddiet', ['19','20','21','22','23','24','25','26','27'])
                    ->where('diet_requests.idjourney', 3)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();

                $conteo_de_rn = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet', 29)
                    ->where('diet_requests.idjourney',3)
                    ->where('diet_requests.status', 2)
                    ->groupBy('services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();

                $columnas3 = [
                    'E', 'H', 'K','N','Q','T','W','Z','AC','AF','AI','AL','AO','AR','AU','AX','BA',
                    'BD','BG','BJ'
                ];
                $row_count5 = 12;
                for($i = 0; $i < count($columnas3); $i++){
                    for($j=0; $j < $servicios_siigss_total; $j++) {
                        $event->sheet->getStyle($columnas3[$i].$row_count5)->getFont()->getColor()->setRGB('32CD32');
                        $event->sheet->setCellValue($columnas3[$i].$row_count5, 0); 
                        $event->sheet->getDelegate()->getStyle($columnas3[$i].$row_count5)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas3[$i].$row_count5)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                               
                        

                        $contador7 = 0;
                        $contador8 = 0;
                        $contador9 = 0;
                        $contador10 = 0;
                        $columnas = $i+1;
                        //$columnas = $columnas1[$i]+1;       
                        
                
                        for($d = 0; $d < count($conteo_cenas); $d++){
                            if($conteo_cenas[$contador7]->dieta == 1){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('E'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 2){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('H'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 3){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('K'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 4){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('N'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 5){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('Q'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 6){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('T'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 7){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('W'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 8){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('Z'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 9){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AC'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 10){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AF'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 11){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AI'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 13){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AL'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 14){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AO'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 15){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AR'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            if($conteo_cenas[$contador7]->dieta == 16){                               
                                if($conteo_cenas[$contador7]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AU'.$row_count5, $conteo_cenas[$contador7]->total_dietas);
                                }                                
                            }
                            
                            $contador7++;
                        }

                        for($d = 0; $d < count($conteo_cenas_libres); $d++){
                            if($conteo_cenas_libres[$contador8]->dieta == 12){                               
                                if($conteo_cenas_libres[$contador8]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('BD'.$row_count5, $conteo_cenas_libres[$contador8]->total_dietas);
                                }                                
                            }
                            
                            $contador8++;
                        }

                        for($d = 0; $d < count($conteo_cenas_otros); $d++){                             
                                if($conteo_cenas_otros[$contador9]->servicio == $services_siigss[$j]->id){
                                    $event->sheet->setCellValue('AX'.$row_count5, $conteo_cenas_otros[$contador9]->total_dietas);
                                } 
                            
                            $contador9++;
                        }

                        for($d = 0; $d < count($conteo_de_rn); $d++){                             
                            if($conteo_de_rn[$contador10]->servicio == $services_siigss[$j]->id){
                                $event->sheet->setCellValue('BJ'.$row_count5, $conteo_de_rn[$contador10]->total_dietas);
                            } 
                        
                            $contador10++;
                        }

                        $row_count5++; 
                        if($j == 24){
                            $row_count5 = 12;             
                        }                       
                    }
                }

                $sumrange_E = 'E12:E'.$fila_out;
                $event->sheet->setCellValue('E'.$fila_out+1, '=SUM(' . $sumrange_E . ')');
                $event->sheet->getStyle('E'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('E'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('E'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_H = 'H12:H'.$fila_out;
                $event->sheet->setCellValue('H'.$fila_out+1, '=SUM(' . $sumrange_H . ')');
                $event->sheet->getStyle('H'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('H'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('H'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_K = 'K12:K'.$fila_out;
                $event->sheet->setCellValue('K'.$fila_out+1, '=SUM(' . $sumrange_K . ')');
                $event->sheet->getStyle('K'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('K'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('K'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_N = 'N12:N'.$fila_out;
                $event->sheet->setCellValue('N'.$fila_out+1, '=SUM(' . $sumrange_N . ')');
                $event->sheet->getStyle('N'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('N'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('N'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_Q = 'Q12:Q'.$fila_out;
                $event->sheet->setCellValue('Q'.$fila_out+1, '=SUM(' . $sumrange_Q . ')');
                $event->sheet->getStyle('Q'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('Q'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('Q'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_T = 'T12:T'.$fila_out;
                $event->sheet->setCellValue('T'.$fila_out+1, '=SUM(' . $sumrange_T . ')');
                $event->sheet->getStyle('T'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('T'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('T'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_W = 'W12:W'.$fila_out;
                $event->sheet->setCellValue('W'.$fila_out+1, '=SUM(' . $sumrange_W . ')');
                $event->sheet->getStyle('W'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('W'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('W'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_Z = 'Z12:Z'.$fila_out;
                $event->sheet->setCellValue('Z'.$fila_out+1, '=SUM(' . $sumrange_Z . ')');
                $event->sheet->getStyle('Z'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('Z'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('Z'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AC = 'AC12:AC'.$fila_out;
                $event->sheet->setCellValue('AC'.$fila_out+1, '=SUM(' . $sumrange_AC . ')');
                $event->sheet->getStyle('AC'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AC'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AC'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AF = 'AF12:AF'.$fila_out;
                $event->sheet->setCellValue('AF'.$fila_out+1, '=SUM(' . $sumrange_AF . ')');
                $event->sheet->getStyle('AF'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AF'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AF'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AI = 'AI12:AI'.$fila_out;
                $event->sheet->setCellValue('AI'.$fila_out+1, '=SUM(' . $sumrange_AI . ')');
                $event->sheet->getStyle('AI'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AI'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AI'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AL = 'AL12:AL'.$fila_out;
                $event->sheet->setCellValue('AL'.$fila_out+1, '=SUM(' . $sumrange_AL . ')');
                $event->sheet->getStyle('AL'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AL'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AL'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AO = 'AO12:AO'.$fila_out;
                $event->sheet->setCellValue('AO'.$fila_out+1, '=SUM(' . $sumrange_AO . ')');
                $event->sheet->getStyle('AO'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AO'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AO'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AR = 'AR12:AR'.$fila_out;
                $event->sheet->setCellValue('AR'.$fila_out+1, '=SUM(' . $sumrange_AR . ')');
                $event->sheet->getStyle('AR'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AR'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AR'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AU = 'AU12:AU'.$fila_out;
                $event->sheet->setCellValue('AU'.$fila_out+1, '=SUM(' . $sumrange_AU . ')');
                $event->sheet->getStyle('AU'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AU'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AU'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_AX = 'AX12:AX'.$fila_out;
                $event->sheet->setCellValue('AX'.$fila_out+1, '=SUM(' . $sumrange_AX . ')');
                $event->sheet->getStyle('AX'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('AX'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AX'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BA = 'BA12:BA'.$fila_out;
                $event->sheet->setCellValue('BA'.$fila_out+1, '=SUM(' . $sumrange_BA . ')');
                $event->sheet->getStyle('BA'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BA'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BA'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BD = 'BD12:BD'.$fila_out;
                $event->sheet->setCellValue('BD'.$fila_out+1, '=SUM(' . $sumrange_BD . ')');
                $event->sheet->getStyle('BD'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BD'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BD'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BG = 'BG12:BG'.$fila_out;
                $event->sheet->setCellValue('BG'.$fila_out+1, '=SUM(' . $sumrange_BG . ')');
                $event->sheet->getStyle('BG'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BG'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BG'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BJ = 'BJ12:BJ'.$fila_out;
                $event->sheet->setCellValue('BJ'.$fila_out+1, '=SUM(' . $sumrange_BJ . ')');
                $event->sheet->getStyle('BJ'.$fila_out+1)->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BJ'.$fila_out+1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BJ'.$fila_out+1)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                /*Fin Columnas Cenas */

                /* Suma total de dietas modificadas */
                $conteo_desayunos_modificados = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 12)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_requests.idjourney', 1)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_almuerzos_modificados = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 12)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_requests.idjourney', 2)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_cenas_modificados = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 12)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_requests.idjourney', 3)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $row_count6 = 12;
                for($j=0; $j < $servicios_siigss_total ; $j++) {
                    $contador11=0;
                    $contador12=0;
                    $contador13=0;

                    for($d = 0; $d < count($conteo_desayunos_modificados); $d++){                             
                        if($conteo_desayunos_modificados[$contador11]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('AY'.$row_count6, $conteo_desayunos_modificados[$contador11]->total_dietas);
                        } 
                    
                        $contador11++;
                    }

                    for($d = 0; $d < count($conteo_almuerzos_modificados); $d++){                             
                        if($conteo_almuerzos_modificados[$contador12]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('AZ'.$row_count6, $conteo_almuerzos_modificados[$contador12]->total_dietas);
                        } 
                    
                        $contador12++;
                    }

                    for($d = 0; $d < count($conteo_cenas_modificados); $d++){                             
                        if($conteo_cenas_modificados[$contador13]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('BA'.$row_count6, $conteo_cenas_modificados[$contador13]->total_dietas);
                        } 
                    
                        $contador13++;
                    }

                    $row_count6++;
                }

                /* Suma total de dietas (modificadas + libres) */
                $conteo_desayunos_total = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_requests.idjourney', 1)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_almuerzos_total = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_requests.idjourney', 2)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_cenas_total = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('diet_requests.idjourney', 3)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $row_count7 = 12;
                for($j=0; $j < $servicios_siigss_total ; $j++) {
                    $contador14=0;
                    $contador15=0;
                    $contador16=0;

                    for($d = 0; $d < count($conteo_desayunos_total); $d++){                             
                        if($conteo_desayunos_total[$contador14]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('BE'.$row_count7, $conteo_desayunos_total[$contador14]->total_dietas);
                        } 
                    
                        $contador14++;
                    }

                    for($d = 0; $d < count($conteo_almuerzos_total); $d++){                             
                        if($conteo_almuerzos_total[$contador15]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('BF'.$row_count7, $conteo_almuerzos_total[$contador15]->total_dietas);
                        } 
                    
                        $contador15++;
                    }

                    for($d = 0; $d < count($conteo_cenas_total); $d++){                             
                        if($conteo_cenas_total[$contador16]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('BG'.$row_count7, $conteo_cenas_total[$contador16]->total_dietas);
                        } 
                    
                        $contador16++;
                    }

                    $row_count7++;
                }

                /* Suma total de refacciones rm y rv */
                $conteo_desayunos_refacciones_total = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('services.reporte_siigss','<>', 15)
                    ->where('services.reporte_siigss','<>', 16)
                    ->where('services.reporte_siigss','<>', 18)
                    ->where('services.reporte_siigss','<>', 19)
                    ->where('services.reporte_siigss','<>', 20)
                    ->where('services.reporte_siigss','<>', 21)
                    ->where('services.reporte_siigss','<>', 22)
                    ->where('services.reporte_siigss','<>', 23)
                    ->where('services.reporte_siigss','<>', 24)
                    ->where('services.reporte_siigss','<>', 25)
                    ->where('diet_requests.idjourney', 1)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $conteo_almuerzos_refacciones_total = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                    ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                    ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                    ->whereDate('diet_requests.created_at', $fecha)
                    ->where('diet_request_details.iddiet','<>', 18)
                    ->where('services.reporte_siigss','<>', 15)
                    ->where('services.reporte_siigss','<>', 16)
                    ->where('services.reporte_siigss','<>', 18)
                    ->where('services.reporte_siigss','<>', 19)
                    ->where('services.reporte_siigss','<>', 20)
                    ->where('services.reporte_siigss','<>', 21)
                    ->where('services.reporte_siigss','<>', 22)
                    ->where('services.reporte_siigss','<>', 23)
                    ->where('services.reporte_siigss','<>', 24)
                    ->where('services.reporte_siigss','<>', 25)
                    ->where('diet_requests.idjourney', 2)
                    ->where('diet_requests.status', 2)
                    ->groupBy(
                        'services.reporte_siigss')
                    ->orderBy('services.reporte_siigss')
                    ->get();
                
                $row_count8 = 12;
                for($j=0; $j < $servicios_siigss_total ; $j++) {
                    $contador17=0;
                    $contador18=0;

                    for($d = 0; $d < count($conteo_desayunos_refacciones_total); $d++){                             
                        if($conteo_desayunos_refacciones_total[$contador17]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('BH'.$row_count8, $conteo_desayunos_refacciones_total[$contador17]->total_dietas);
                        } 
                    
                        $contador17++;
                    }

                    for($d = 0; $d < count($conteo_almuerzos_refacciones_total); $d++){                             
                        if($conteo_almuerzos_refacciones_total[$contador18]->servicio == $services_siigss[$j]->id){
                            $event->sheet->setCellValue('BI'.$row_count8, $conteo_almuerzos_refacciones_total[$contador18]->total_dietas);
                        } 
                    
                        $contador18++;
                    }

                    $row_count8++;
                }


                
                
                /*Fila subtotales pacientes */
                $event->sheet->setCellValue('B'.$row_count2, 'Subtotal Pacientes');
                $event->sheet->getDelegate()->getStyle('B'.$row_count2)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B'.$row_count2)->getFont()->setSize(8);
                $columnas4 = [
                    'B', 'C', 'F', 'I', 'L', 'O', 'R', 'U', 'X', 'AA', 'AD', 'AG', 'AJ', 'AM', 'AP', 'AS', 'AV',
                    'AY', 'BB', 'BE', 'BH', 'BK', 'D', 'G', 'J', 'M', 'P','S','V','Y','AB','AE','AH','AK',
                    'AN','AQ','AT','AW','AZ', 'BC','BF', 'BI', 'BL', 'E', 'H', 'K','N','Q','T','W','Z','AC',
                    'AF','AI','AL','AO','AR','AU','AX','BA','BD','BG','BJ'
                ];
                for($i = 0; $i < count($columnas4); $i++){
                    $event->sheet->getStyle($columnas4[$i].$row_count2)->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'A6A6A6'],]);
                }

                /*Filas responsables tiempos de dietas */

                $realizado =  Auth::user()->name.' '.Auth::user()->lastname;

                $event->sheet->getDelegate()->mergeCells('BM12:BM52');
                $event->sheet->setCellValue('BM12', $realizado);
                $event->sheet->getStyle("BM12")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle("BM12")->getAlignment()->setTextRotation(90);
                $event->sheet->getDelegate()->getStyle('BM12:BM52')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BM12:BM52')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('BN12:BN52');
                $event->sheet->setCellValue('BN12', $realizado);
                $event->sheet->getStyle("BN12")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle("BN12")->getAlignment()->setTextRotation(90);
                $event->sheet->getDelegate()->getStyle('BN12:BN52')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BN12:BN52')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->mergeCells('BO12:BO52');
                $event->sheet->setCellValue('BO12', $realizado);
                $event->sheet->getStyle("BO12")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle("BO12")->getAlignment()->setTextRotation(90);
                $event->sheet->getDelegate()->getStyle('BO12:BO52')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BO12:BO52')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                

                /* Dietas de Personal */
                $event->sheet->setCellValue('B38', 'PERSONAL');
                $event->sheet->getDelegate()->getStyle('B38')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B38')->getFont()->setSize(8);
                $event->sheet->getDelegate()->mergeCells('C38:BL38');
                /* Dietas de Personal con tarjeta */
                $event->sheet->setCellValue('B39', 'PERSONAL TARJETA');
                $event->sheet->getDelegate()->getStyle('B39')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B39')->getFont()->setSize(8);
                $event->sheet->getDelegate()->mergeCells('C39:BL39');

                $event->sheet->setCellValue('B40', 'Médicos');
                $event->sheet->setCellValue('B41', 'Enfermería');
                $event->sheet->setCellValue('B42', 'Servicios Varios');
                $event->sheet->setCellValue('B43', 'Otros');

                $columnasp1 = [
                    'C', 'D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V',
                    'W','X','Y','Z','AA','AB','AC', 'AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
                    'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC', 
                    'BD','BE','BF','BG','BH','BI','BJ','BK','BL'
                ];
                $row_countp = 40;
                for($i = 0; $i < count($columnas1); $i++){
                    for($j=0; $j < 5; $j++) {
                        $event->sheet->getStyle($columnas1[$i].$row_countp)->getFont()->getColor()->setRGB('0000FF');
                        $event->sheet->setCellValue($columnas1[$i].$row_countp, 0);   
                        $event->sheet->getDelegate()->getStyle($columnas1[$i].$row_countp)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas1[$i].$row_countp)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                             
                        $row_countp++; 
                        if($j == 4){
                            $row_countp = 40;             
                        }                       
                    }
                }
                for($i = 0; $i < count($columnas2); $i++){
                    for($j=0; $j < 5; $j++) {
                        $event->sheet->getStyle($columnas2[$i].$row_countp)->getFont()->getColor()->setRGB('FF0000');
                        $event->sheet->setCellValue($columnas2[$i].$row_countp, 0);          
                        $event->sheet->getDelegate()->getStyle($columnas2[$i].$row_countp)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas2[$i].$row_countp)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                    
                        $row_countp++; 
                        if($j == 4){
                            $row_countp = 40;             
                        }                       
                    }
                }
                for($i = 0; $i < count($columnas3); $i++){
                    for($j=0; $j < 5; $j++) {
                        $event->sheet->getStyle($columnas3[$i].$row_countp)->getFont()->getColor()->setRGB('32CD32');
                        $event->sheet->setCellValue($columnas3[$i].$row_countp, 0); 
                        $event->sheet->getDelegate()->getStyle($columnas3[$i].$row_countp)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas3[$i].$row_countp)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                               
                        $row_countp++; 
                        if($j == 4){
                            $row_countp = 40;             
                        }                       
                    }
                }
                /* Subtotal personal tarjeta */
                $event->sheet->setCellValue('B44', 'Subtotal');
                $event->sheet->getDelegate()->getStyle('B44')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B44')->getFont()->setSize(8);
                for($i = 0; $i < count($columnas4); $i++){
                    $event->sheet->getStyle($columnas4[$i].'44')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'EBF496'],]);
                }

                $response = Http::get('http://10.11.0.45/api/beneficiosAlimentacion.php', [
                    'fecha' => $fecha
                ]);
        
                $dietasPersonal = (array)json_decode($response);
                
                $event->sheet->setCellValue('BB40', $dietasPersonal['990A']->desayuno->medicos);
                $event->sheet->setCellValue('BB41', $dietasPersonal['990A']->desayuno->enfermeria);
                $event->sheet->setCellValue('BB42', $dietasPersonal['990A']->desayuno->serviciosVarios);
                $event->sheet->setCellValue('BB43', $dietasPersonal['990A']->desayuno->otros);
                

                $sumrange_BB = 'BB40:BB43';
                $event->sheet->setCellValue('BB44', '=SUM(' . $sumrange_BB . ')');
                $event->sheet->getStyle('BB44')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BB44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BB44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BC40', $dietasPersonal['990A']->almuerzo->medicos);
                $event->sheet->setCellValue('BC41', $dietasPersonal['990A']->almuerzo->enfermeria);
                $event->sheet->setCellValue('BC42', $dietasPersonal['990A']->almuerzo->serviciosVarios);
                $event->sheet->setCellValue('BC43', $dietasPersonal['990A']->almuerzo->otros);

                $sumrange_BC = 'BC40:BC43';
                $event->sheet->setCellValue('BC44', '=SUM(' . $sumrange_BC . ')');
                $event->sheet->getStyle('BC44')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BC44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BC44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BD40', $dietasPersonal['990A']->cena->medicos);
                $event->sheet->setCellValue('BD41', $dietasPersonal['990A']->cena->enfermeria);
                $event->sheet->setCellValue('BD42', $dietasPersonal['990A']->cena->serviciosVarios);
                $event->sheet->setCellValue('BD43', $dietasPersonal['990A']->cena->otros);

                $sumrange_BD = 'BD40:BD43';
                $event->sheet->setCellValue('BD44', '=SUM(' . $sumrange_BD . ')');
                $event->sheet->getStyle('BD44')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BD44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BD44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                
                $event->sheet->setCellValue('BE40', $dietasPersonal['990A']->desayuno->medicos);
                $event->sheet->setCellValue('BE41', $dietasPersonal['990A']->desayuno->enfermeria);
                $event->sheet->setCellValue('BE42', $dietasPersonal['990A']->desayuno->serviciosVarios);
                $event->sheet->setCellValue('BE43', $dietasPersonal['990A']->desayuno->otros);

                $sumrange_BE = 'BE40:BE43';
                $event->sheet->setCellValue('BE44', '=SUM(' . $sumrange_BE . ')');
                $event->sheet->getStyle('BE44')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BE44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BE44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BF40', $dietasPersonal['990A']->almuerzo->medicos);
                $event->sheet->setCellValue('BF41', $dietasPersonal['990A']->almuerzo->enfermeria);
                $event->sheet->setCellValue('BF42', $dietasPersonal['990A']->almuerzo->serviciosVarios);
                $event->sheet->setCellValue('BF43', $dietasPersonal['990A']->almuerzo->otros);

                $sumrange_BF = 'BF40:BF43';
                $event->sheet->setCellValue('BF44', '=SUM(' . $sumrange_BF . ')');
                $event->sheet->getStyle('BF44')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BF44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BF44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BG40', $dietasPersonal['990A']->cena->medicos);
                $event->sheet->setCellValue('BG41', $dietasPersonal['990A']->cena->enfermeria);
                $event->sheet->setCellValue('BG42', $dietasPersonal['990A']->cena->serviciosVarios);
                $event->sheet->setCellValue('BG43', $dietasPersonal['990A']->cena->otros);

                $sumrange_BG = 'BG40:BG43';
                $event->sheet->setCellValue('BG44', '=SUM(' . $sumrange_BG . ')');
                $event->sheet->getStyle('BG44')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BG44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BG44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BH = 'BH40:BH43';
                $event->sheet->setCellValue('BH44', '=SUM(' . $sumrange_BH . ')');
                $event->sheet->getStyle('BH44')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BH44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BH44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BI = 'BI40:BI43';
                $event->sheet->setCellValue('BI44', '=SUM(' . $sumrange_BI . ')');
                $event->sheet->getStyle('BI44')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BI44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BI44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BJ40', $dietasPersonal['990A']->refaccionNocturna->medicos);
                $event->sheet->setCellValue('BJ41', $dietasPersonal['990A']->refaccionNocturna->enfermeria);
                $event->sheet->setCellValue('BJ42', $dietasPersonal['990A']->refaccionNocturna->serviciosVarios);
                $event->sheet->setCellValue('BJ43', $dietasPersonal['990A']->refaccionNocturna->otros);

                $sumrange_BJ = 'BJ40:BJ43';
                $event->sheet->setCellValue('BJ44', '=SUM(' . $sumrange_BJ . ')');
                $event->sheet->getStyle('BJ44')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BJ44')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BJ44')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                /* Dietas de Personal con cambios de turno */

                $event->sheet->setCellValue('B45', 'PERSONAL/CAMBIO DE TURNO/TIEMPOS SUELTOS');
                $event->sheet->getDelegate()->getStyle('B45')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B45')->getFont()->setSize(8);
                $event->sheet->getDelegate()->getRowDimension(45)->setRowHeight(40, 'px');
                $event->sheet->getStyle('B45')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->mergeCells('C45:BL45');

                $event->sheet->setCellValue('B46', 'Médicos');
                $event->sheet->setCellValue('B47', 'Enfermería');
                $event->sheet->setCellValue('B48', 'Servicios Varios');
                $event->sheet->setCellValue('B49', 'Otros');

                $row_countp1 = 46;
                for($i = 0; $i < count($columnas1); $i++){
                    for($j=0; $j < 7; $j++) {
                        $event->sheet->getStyle($columnas1[$i].$row_countp1)->getFont()->getColor()->setRGB('0000FF');
                        $event->sheet->setCellValue($columnas1[$i].$row_countp1, 0);   
                        $event->sheet->getDelegate()->getStyle($columnas1[$i].$row_countp1)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas1[$i].$row_countp1)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                             
                        $row_countp1++; 
                        if($j == 6){
                            $row_countp1 = 46;             
                        }                       
                    }
                }
                for($i = 0; $i < count($columnas2); $i++){
                    for($j=0; $j < 7; $j++) {
                        $event->sheet->getStyle($columnas2[$i].$row_countp1)->getFont()->getColor()->setRGB('FF0000');
                        $event->sheet->setCellValue($columnas2[$i].$row_countp1, 0);          
                        $event->sheet->getDelegate()->getStyle($columnas2[$i].$row_countp1)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas2[$i].$row_countp1)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                    
                        $row_countp1++; 
                        if($j == 6){
                            $row_countp1 = 46;             
                        }                       
                    }
                }
                for($i = 0; $i < count($columnas3); $i++){
                    for($j=0; $j < 7; $j++) {
                        $event->sheet->getStyle($columnas3[$i].$row_countp1)->getFont()->getColor()->setRGB('32CD32');
                        $event->sheet->setCellValue($columnas3[$i].$row_countp1, 0); 
                        $event->sheet->getDelegate()->getStyle($columnas3[$i].$row_countp1)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        $event->sheet->getDelegate()->getStyle($columnas3[$i].$row_countp1)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                               
                        $row_countp1++; 
                        if($j == 6){
                            $row_countp1 = 46;             
                        }                       
                    }
                }
                
                /* Subtotal personal con cambios */

                $event->sheet->setCellValue('B50', 'Subtotal');
                $event->sheet->getDelegate()->getStyle('B50')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B50')->getFont()->setSize(8);
                for($i = 0; $i < count($columnas4); $i++){
                    $event->sheet->getStyle($columnas4[$i].'50')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'EBF496'],]);
                }   

                $event->sheet->setCellValue('BB46', $dietasPersonal['990B']->desayuno->medicos);
                $event->sheet->setCellValue('BB47', $dietasPersonal['990B']->desayuno->enfermeria);
                $event->sheet->setCellValue('BB48', $dietasPersonal['990B']->desayuno->serviciosVarios);
                $event->sheet->setCellValue('BB49', $dietasPersonal['990B']->desayuno->otros);
                
                $sumrange_BB = 'BB46:BB49';
                $event->sheet->setCellValue('BB50', '=SUM(' . $sumrange_BB . ')');
                $event->sheet->getStyle('BB50')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BB50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BB50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BC46', $dietasPersonal['990B']->almuerzo->medicos);
                $event->sheet->setCellValue('BC47', $dietasPersonal['990B']->almuerzo->enfermeria);
                $event->sheet->setCellValue('BC48', $dietasPersonal['990B']->almuerzo->serviciosVarios);
                $event->sheet->setCellValue('BC49', $dietasPersonal['990B']->almuerzo->otros);

                $sumrange_BC = 'BC46:BC49';
                $event->sheet->setCellValue('BC50', '=SUM(' . $sumrange_BC . ')');
                $event->sheet->getStyle('BC50')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BC50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BC50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BD46', $dietasPersonal['990B']->cena->medicos);
                $event->sheet->setCellValue('BD47', $dietasPersonal['990B']->cena->enfermeria);
                $event->sheet->setCellValue('BD48', $dietasPersonal['990B']->cena->serviciosVarios);
                $event->sheet->setCellValue('BD49', $dietasPersonal['990B']->cena->otros);

                $sumrange_BD = 'BD46:BD49';
                $event->sheet->setCellValue('BD50', '=SUM(' . $sumrange_BD . ')');
                $event->sheet->getStyle('BD50')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BD50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BD50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BE46', $dietasPersonal['990B']->desayuno->medicos);
                $event->sheet->setCellValue('BE47', $dietasPersonal['990B']->desayuno->enfermeria);
                $event->sheet->setCellValue('BE48', $dietasPersonal['990B']->desayuno->serviciosVarios);
                $event->sheet->setCellValue('BE49', $dietasPersonal['990B']->desayuno->otros);

                $sumrange_BE = 'BE46:BE49';
                $event->sheet->setCellValue('BE50', '=SUM(' . $sumrange_BE . ')');
                $event->sheet->getStyle('BE50')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BE50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BE50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BF46', $dietasPersonal['990B']->almuerzo->medicos);
                $event->sheet->setCellValue('BF47', $dietasPersonal['990B']->almuerzo->enfermeria);
                $event->sheet->setCellValue('BF48', $dietasPersonal['990B']->almuerzo->serviciosVarios);
                $event->sheet->setCellValue('BF49', $dietasPersonal['990B']->almuerzo->otros);

                $sumrange_BF = 'BF46:BF49';
                $event->sheet->setCellValue('BF50', '=SUM(' . $sumrange_BF . ')');
                $event->sheet->getStyle('BF50')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BF50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BF50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BG46', $dietasPersonal['990B']->cena->medicos);
                $event->sheet->setCellValue('BG47', $dietasPersonal['990B']->cena->enfermeria);
                $event->sheet->setCellValue('BG48', $dietasPersonal['990B']->cena->serviciosVarios);
                $event->sheet->setCellValue('BG49', $dietasPersonal['990B']->cena->otros);

                $sumrange_BG = 'BG46:BG49';
                $event->sheet->setCellValue('BG50', '=SUM(' . $sumrange_BG . ')');
                $event->sheet->getStyle('BG50')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BG50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BG50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BH = 'BH46:BH49';
                $event->sheet->setCellValue('BH50', '=SUM(' . $sumrange_BH . ')');
                $event->sheet->getStyle('BH50')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BH50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BH50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $sumrange_BI = 'BI46:BI49';
                $event->sheet->setCellValue('BI50', '=SUM(' . $sumrange_BI . ')');
                $event->sheet->getStyle('BI50')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BI50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BI50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BJ46', $dietasPersonal['990B']->refaccionNocturna->medicos);
                $event->sheet->setCellValue('BJ47', $dietasPersonal['990B']->refaccionNocturna->enfermeria);
                $event->sheet->setCellValue('BJ48', $dietasPersonal['990B']->refaccionNocturna->serviciosVarios);
                $event->sheet->setCellValue('BJ49', $dietasPersonal['990B']->refaccionNocturna->otros);

                $sumrange_BJ = 'BJ46:BJ49';
                $event->sheet->setCellValue('BJ50', '=SUM(' . $sumrange_BJ . ')');
                $event->sheet->getStyle('BJ50')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BJ50')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BJ50')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                /*Subtotal de persona (tarjeta + cambios) */
                $event->sheet->setCellValue('B51', 'Subtotal Personal');
                $event->sheet->getDelegate()->getStyle('B51')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B51')->getFont()->setSize(8);
                for($i = 0; $i < count($columnas4); $i++){
                    $event->sheet->getStyle($columnas4[$i].'51')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'A6A6A6'],]);
                }                

                $event->sheet->setCellValue('BB51', '=BB44+BB50');
                $event->sheet->getStyle('BB51')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BB51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BB51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BC51', '=BC44+BC50');
                $event->sheet->getStyle('BC51')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BC51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BC51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BD51', '=BD44+BD50');
                $event->sheet->getStyle('BD51')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BD51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BD51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BE51', '=BE44+BE50');
                $event->sheet->getStyle('BE51')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BE51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BE51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BF51', '=BF44+BF50');
                $event->sheet->getStyle('BF51')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BF51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BF51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BG51', '=BG44+BG50');
                $event->sheet->getStyle('BG51')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BG51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BG51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BH51', '=BH44+BH50');
                $event->sheet->getStyle('BH51')->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->getDelegate()->getStyle('BH51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BH51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BI51', '=BI44+BI50');
                $event->sheet->getStyle('BI51')->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->getDelegate()->getStyle('BI51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BI51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->setCellValue('BJ51', '=BJ44+BJ50');
                $event->sheet->getStyle('BJ51')->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->getDelegate()->getStyle('BJ51')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BJ51')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                /* Total diario */
                $event->sheet->setCellValue('B52', 'TOTAL DIARIO');
                $event->sheet->getDelegate()->getStyle('B52')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('B52')->getFont()->setSize(8);
                for($i = 0; $i < count($columnas4); $i++){
                    $event->sheet->getStyle($columnas4[$i].'52')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '95B3D7'],]);
                }

                $columnas5 = [
                    'C', 'D', 'E', 'F', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 
                    'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK',
                    'AL', 'AM', 'AN', 'AO', 'AP', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AY', 'AZ',
                    'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL'
                ];

                for($i = 0; $i < count($columnas5); $i++){
                    $event->sheet->setCellValue($columnas5[$i].'52', '='.$columnas5[$i].'37+'.$columnas5[$i].'51');
                }

                

                /* */

                $event->sheet->setCellValue('C53', 'Nomenclatura:');
                $event->sheet->getDelegate()->getStyle('C53')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('C53')->getFont()->setSize(8);

                $event->sheet->setCellValue('C55', 'D');
                $event->sheet->getDelegate()->getStyle('C55')->getFont()->setBold(true);
                $event->getSheet()->getDelegate()->getStyle('C55')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                $event->sheet->getStyle("C55")->getFont()->getColor()->setRGB('0000FF');
                $event->sheet->setCellValue('D55', 'Desayuno');

                $event->sheet->setCellValue('F55', 'A');
                $event->sheet->getDelegate()->getStyle('F55')->getFont()->setBold(true);
                $event->getSheet()->getDelegate()->getStyle('F55')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                $event->sheet->getStyle("F55")->getFont()->getColor()->setRGB('FF0000');
                $event->sheet->setCellValue('G55', 'Almuerzo');

                $event->sheet->setCellValue('I55', 'C');
                $event->sheet->getDelegate()->getStyle('I55')->getFont()->setBold(true);
                $event->getSheet()->getDelegate()->getStyle('I55')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                $event->sheet->getStyle("I55")->getFont()->getColor()->setRGB('32CD32');
                $event->sheet->setCellValue('J55', 'Cena');

                $event->sheet->setCellValue('L55', 'RM');
                $event->sheet->getDelegate()->getStyle('L55')->getFont()->setBold(true);
                $event->getSheet()->getDelegate()->getStyle('L55')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                $event->sheet->getStyle("L55")->getFont()->getColor()->setRGB('60497A');
                $event->sheet->setCellValue('M55', 'Refacción Matutina');

                $event->sheet->setCellValue('Q55', 'RV');
                $event->sheet->getDelegate()->getStyle('Q55')->getFont()->setBold(true);
                $event->getSheet()->getDelegate()->getStyle('Q55')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                $event->sheet->getStyle("Q55")->getFont()->getColor()->setRGB('E26B0A');
                $event->sheet->setCellValue('R55', 'Refacción Vespertina');

                $event->sheet->setCellValue('V55', 'RN');
                $event->sheet->getDelegate()->getStyle('V55')->getFont()->setBold(true);
                $event->getSheet()->getDelegate()->getStyle('V55')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                $event->sheet->getStyle("V55")->getFont()->getColor()->setRGB('963634');
                $event->sheet->setCellValue('W55', 'Refacción Nocturna');


                $event->getSheet()->getDelegate()->getStyle('AV53:BA56')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );

                $event->sheet->getDelegate()->mergeCells('AV53:AX54');
                $event->sheet->setCellValue('AV53', 'TOTAL DE DIETAS MODIFICADAS'); 
                $event->sheet->getDelegate()->getStyle('AV53')->getFont()->setSize(6);
                $event->sheet->getDelegate()->getStyle('AV53')->getFont()->setBold(true);
                $event->sheet->getStyle('AV53')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('AV53:AX54')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'FFFF00'],]);
                $event->sheet->getDelegate()->mergeCells('AY53:BA54');
                $event->sheet->setCellValue('AY53', '=AY52+AZ52+BA52');
                $event->sheet->getDelegate()->getStyle('AY53:BA54')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AY53:BA54')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->getDelegate()->mergeCells('AV55:AX56');
                $event->sheet->setCellValue('AV55', 'TOTAL DE DIETAS LIBRES'); 
                $event->sheet->getDelegate()->getStyle('AV55')->getFont()->setSize(8);
                $event->sheet->getDelegate()->getStyle('AV55')->getFont()->setBold(true);
                $event->sheet->getStyle('AV55')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('AV55:AX56')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'C4D79B'],]);
                $event->sheet->getDelegate()->mergeCells('AY55:BA56');
                $event->sheet->setCellValue('AY55', '=BB52+BC52+BD52');
                $event->sheet->getDelegate()->getStyle('AY55:BA56')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('AY55:BA56')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->getDelegate()->mergeCells('BH53:BJ54');
                $event->sheet->setCellValue('BH53', 'TOTAL DE REFACCIONES'); 
                $event->sheet->getDelegate()->getStyle('BH53')->getFont()->setSize(6);
                $event->sheet->getDelegate()->getStyle('BH53')->getFont()->setBold(true);
                $event->sheet->getStyle('BH53')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('BH53:BJ54')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'FABF8F'],]);
                $event->sheet->getDelegate()->mergeCells('BK53:BK54');
                $event->sheet->setCellValue('BK53', '=BH52+BI52+BJ52+BK52');
                $event->sheet->getDelegate()->getStyle('BK53:BK54')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('BK53:BK54')
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->getSheet()->getDelegate()->getStyle('BH53:BK54')->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ]
                    )
                );
                

                

                
                
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
