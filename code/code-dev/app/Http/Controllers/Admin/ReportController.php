<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use  App\Http\Models\Service, App\Http\Models\ServiceSiigss, App\Http\Models\Bitacora, App\Http\Models\Diet, App\Http\Models\Journey,  App\Http\Models\DietRequest, App\Http\Models\DietRequestDetail, App\Exports\HeadquartersDietsExport, App\Exports\HeadquartersDietsExportMonth;
use Carbon\Carbon, Auth, Validator, Str, Config, Session, DB, Response, File, Image, PDF, Arr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;


class ReportController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getReport(){
        return view('admin.reports.home');
    }

    public function postReportBatchPrinting(Request $request){
        $rules = [
    		'date' => 'required',
            'type' => 'required'
    	];
    	$messagess = [
    		'date.required' => 'Se requiere la fecha para generar las solicitudes.',
            'type.required' => 'Se requiere el tipo de jornada de las dietas a generar.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else:
            $date = $request->input('date');
            $type = $request->input('type');

            $diet_request = DietRequest::whereDate('created_at', $date)->where('idjourney', $type)->get();
            $details = DietRequestDetail::all();           
            

            $subtotales = DB::table('diet_request_details')
                    ->select('iddiet', 'iddiet_request', DB::raw('count(iddiet) as subtotal'))
                    ->groupBy('iddiet')
                    ->groupBy('iddiet_request')
                    ->get();    
                    
            

            $data = [
                'diet_request' => $diet_request,
                'details' => $details,
                'subtotales' => $subtotales
            ];

            $pdf = PDF::loadView('admin.reports.branch_printing',$data)->setPaper('a4', 'portrait');
            return $pdf->stream('ING-7.pdf');
    	endif;
    }

    public function postReportHeadquartersDiets(Request $request){
        $date_in = $request->get('date_in');

        $fecha = Carbon::createFromFormat('Y-m-d', $date_in)->format('Y-m-d');

        /*$conteo_desayunos = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_desayunos'))
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

        return  $conteo_desayunos;*/

        
        

        



        $data = [
            'date_in' => $date_in
        ];

        return Excel::download(new HeadquartersDietsExport($data), 'SPS-98 Dietas del '.Carbon::createFromFormat('Y-m-d', $date_in)->format('d-m-Y').'.xlsx');
    }

    public function postReportHeadquartersDietsMonth(Request $request){
        $month_in = $request->get('month_in');
        $mes = getMonths(null, $month_in);

        /*$conteo_desayunos = DB::table('diet_request_details')
                    ->select(
                        DB::raw('services.name AS nombre'), 
                        DB::raw('services.reporte_siigss AS servicio'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_desayunos'))
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

        return  $conteo_desayunos;*/      

        $data = [
            'month_in' => $month_in
        ];

        return Excel::download(new HeadquartersDietsExportMonth($data), 'SPS-98 Dietas del mes de '.$mes.' - '.Carbon::now()->year.'.xlsx');
    }
}
