<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Diet, App\Http\Models\Bitacora, App\Http\Models\Journey, App\Http\Models\Service,  App\Http\Models\DietRequest, App\Http\Models\DietRequestDetail, App\Http\Models\DietRequestOut;
use Carbon\Carbon, Auth, Validator, Str, Config, Session, DB, Response, File, Image, PDF;

use App\Exports\DietRequestReportExport;
use Maatwebsite\Excel\Facades\Excel;
//use Elibyy\TCPDF\Facades\TCPDF;


class DietRequestsController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions'); 
    }

    public function getHome($status){

        $year = Carbon::now()->format('Y');
        //return $year;

        switch ($status) {
            case '1':
                if(Auth::user()->role == 5){
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->where('status', '1')->where('idapplicant', Auth::user()->id)->orderBy('id', 'Desc')->get();
                }else{
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->where('status', '1')->orderBy('id', 'Desc')->get();
                }

            break;

            case '2':
                if(Auth::user()->role == 5){
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->whereYear('created_at', $year)->where('status', '2')->where('idapplicant', Auth::user()->id)->orderBy('created_at', 'Desc')->get();
                }else{
                    //$hoy = Carbon::now()->format('Y-m-d');
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->whereYear('created_at', $year)->where('status', '2')->orderBy('created_at', 'Desc')->get();
                }
            break;

            case 'todas':
                if(Auth::user()->role == 5){
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->where('idapplicant', Auth::user()->id)->orderBy('id', 'Desc')->get();
                }else{
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->orderBy('id', 'Desc')->get();
                }
            break;

            case 'anuladas':
                if(Auth::user()->role == 5){
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->onlyTrashed()->where('idapplicant', Auth::user()->id)->orderBy('id', 'Desc')->get();
                }else{
                    $diet_requests = DietRequest::with(['journey', 'service', 'user'])->onlyTrashed()->orderBy('id', 'Desc')->get();
                }

            break;
        }

        $data = [
            'diet_requests' => $diet_requests
        ];

    	return view('admin.diet_request.home', $data);
    }

    public function getDietRequestAdd(){

        $hora = Carbon::now()->format('H:i');
        $fecha = Carbon::now()->format('Y-m-d');

        if(Auth::user()->role == 5):
            $solicitud_fuera = DietRequestOut::whereIn('idjourney', ['1','2','3'])->whereDate('created_at',$fecha)->where('idapplicant', Auth::user()->id)->where('status',1)->first();
        endif;

        if($solicitud_fuera):
            $servicios_restringidos = ['5','63','68','105','106','107','108'];
            $journeys = Journey::where('id', $solicitud_fuera->idjourney)->get();
            $diets = Diet::where('id','<>',17)->get();
            $services = Service::where('type','1')
                ->where('parent_id', '<>', '2')
                ->whereNotIn('id', $servicios_restringidos)
                ->where('unit_id', '1')
                ->get();
            $user = Auth::user()->name.' '.Auth::user()->lastname;
            $solicitud_fuera_tiempo = 1;
            $solicitud_fuera_id = $solicitud_fuera->id;
            $cantidad_dietas = $solicitud_fuera->amount_diets;

            $data = [
                'journeys' => $journeys,
                'diets' => $diets,
                'services' => $services,
                'user' => $user,
                'cantidad_dietas' => $cantidad_dietas,
                'solicitud_fuera_tiempo' => $solicitud_fuera_tiempo,
                'solicitud_fuera_id' => $solicitud_fuera_id

            ];

            return view('admin.diet_request.add_out_time', $data);
        else:
            $servicios_restringidos = ['5','63','68','105','106','107','108'];
            $journeys = Journey::where('id', '<>', 4)->get();
            $diets = Diet::where('id','<>',17)->get();
            $services = Service::where('type','1')
                ->where('parent_id', '<>', '2')
                ->whereNotIn('id', $servicios_restringidos)
                ->where('unit_id', '1')
                ->get();
            $user = Auth::user()->name.' '.Auth::user()->lastname;

            $data = [
                'journeys' => $journeys,
                'diets' => $diets,
                'services' => $services,
                'user' => $user
            ];

            return view('admin.diet_request.add', $data);
        endif;

        


    }

    public function postDietRequestAdd(Request $request){
        if($request->get('route') == 'diet_request_add'):
            if($request->input('solicitud_fuera_tiempo') != NULL && $request->input('solicitud_fuera_tiempo') == 1):

                $rules = [

                    'idjourney' => 'required'
                ];

                $messages = [

                    'idjourney.required' => 'Se requiere que seleccione la jornada de la solicitud a realizar.'
                ];

                $validator = Validator::make($request->all(),$rules,$messages);

                if($validator->fails()):
                    return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                    ->with('typealert', 'danger')->withInput();
                else:
                    $solicitud_fuera = DietRequestOut::findOrFail($request->input('solicitud_fuera_id'));

                    $jornada = Journey::findOrFail($request->get('idjourney'));

                    switch($solicitud_fuera->time_available):
                        case 1:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(5)->format('H:i');
                        break;

                        case 2:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(10)->format('H:i');
                        break;

                        case 3:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(15)->format('H:i');
                        break;

                        case 4:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(20)->format('H:i');
                        break;

                        case 5:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(25)->format('H:i');
                        break;

                        case 6:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(30)->format('H:i');
                        break;

                    endswitch;

                    //return $hora_disponible;

                    $hora_actual = Carbon::now()->format('H:i');

                    if( $hora_actual > $hora_disponible ):
                        $solicitud_fuera->status = 2;
                        $solicitud_fuera->save();
                        return redirect('/admin/solicitud_dietas/1')->with('messages', '¡Excedio el tiempo habilitado para realizar la solicitud!.')
                                ->with('typealert', 'warning');

                    else:
                        DB::beginTransaction();

                        $ingreso = new DietRequest;
                        $ingreso->id=$request->get('id');
                        $ingreso->idjourney =$request->get('idjourney');
                        $ingreso->idapplicant = Auth::user()->id;
                        $ingreso->idapplicant_service=$request->get('idservice');
                        $ingreso->status = 1;
                        $ingreso->save();

                        $idarticulo=$request->get('idarticulo');
                        $cantidad=$request->get('cantidad');
                        //$especificar=$request->get('especificar');
                        $idcaracteristica1=$request->get('idcaracteristica1');
                        $idcaracteristica2=$request->get('idcaracteristica2');
                        $idcaracteristica3=$request->get('idcaracteristica3');
                        $idcaracteristica4=$request->get('idcaracteristica4');
                        $idcaracteristica5=$request->get('idcaracteristica5');
                        $idcaracteristica6=$request->get('idcaracteristica6');

                        $cont=0;
                        $cont_npo=0;
                        $cont_refa=0;

                        //return $idcaracteristica1;

                        while ($cont<count($idarticulo)) {

                            if($request->get('idservice') == 66 || $request->get('idservice') == 65 || $request->get('idservice') == 67 || $request->get('idservice') == 5 || $request->get('idservice') == 68 || $request->get('idservice') == 105 || $request->get('idservice') == 106 || $request->get('idservice') == 107 || $request->get('idservice') == 108 || $request->get('idservice') == 56 || $request->get('idservice') == 61 || $request->get('idservice') == 60 || $request->get('idservice') == 58 || $request->get('idservice') == 70 || $request->get('idservice') == 81 || $request->get('idservice') == 57 || $request->get('idservice') == 59 || $request->get('idservice') == 62 || $request->get('idservice') == 8 || $request->get('idservice') == 69 || $request->get('idservice') == 109 || $request->get('idservice') == 110 || $request->get('idservice') == 111 || $request->get('idservice') == 112 || $request->get('idservice') == 113 || $request->get('idservice') == 114 || $request->get('idservice') == 115):
                                $detalle=new DietRequestDetail();
                                $detalle->iddiet_request=$ingreso->id;
                                $detalle->iddiet=$idarticulo[$cont];
                                if($idarticulo[$cont] == 18):
                                    $cont_npo=$cont_npo+1;
                                endif;
                                $detalle->bed_number=$cantidad[$cont];
                                if($ingreso->idapplicant_service == 66 || $ingreso->idapplicant_service == 109 || $ingreso->idapplicant_service == 110 || $ingreso->idapplicant_service == 111 || $ingreso->idapplicant_service == 112 || $ingreso->idapplicant_service == 113 || $ingreso->idapplicant_service == 114 || $ingreso->idapplicant_service == 115):
                                    
                                    if($idcaracteristica1[$cont] == "0"):
                                        $detalle->type_pack="3";
                                        //return $detalle->type_pack;
                                    elseif($idcaracteristica1[$cont] == "1"):
                                        $detalle->type_pack= "4";
                                    elseif($idcaracteristica1[$cont] == "2"):
                                        $detalle->type_pack="5";
                                    else:
                                        $detalle->type_pack=$idcaracteristica1[$cont];
                                    endif;
                                else:
                                    $detalle->type_pack=$idcaracteristica1[$cont];
                                endif;
                                
                                $detalle->type_diet_1=$idcaracteristica2[$cont];
                                $detalle->type_diet_hiposodicas=$idcaracteristica3[$cont];
                                $detalle->type_diet_renal=$idcaracteristica4[$cont];
                                $detalle->type_diet_de_viaje=$idcaracteristica5[$cont];
                                $detalle->type_diet_pediatricas=$idcaracteristica6[$cont];
                                $detalle->save();
                                $cont=$cont+1;
                            else:
                                if($request->get('idjourney') == 1 || $request->get('idjourney') == 2):
                                    if($idarticulo[$cont] != 29):
                                        $detalle=new DietRequestDetail();
                                        $detalle->iddiet_request=$ingreso->id;
                                        $detalle->iddiet=$idarticulo[$cont];
                                        if($idarticulo[$cont] == 18):
                                            $cont_npo=$cont_npo+1;
                                        endif;
                                        $detalle->bed_number=$cantidad[$cont];
                                        if($ingreso->idapplicant_service == 66 || $ingreso->idapplicant_service == 109 || $ingreso->idapplicant_service == 110 || $ingreso->idapplicant_service == 111 || $ingreso->idapplicant_service == 112 || $ingreso->idapplicant_service == 113 || $ingreso->idapplicant_service == 114 || $ingreso->idapplicant_service == 115):
                                            
                                            if($idcaracteristica1[$cont] == "0"):
                                                $detalle->type_pack="3";
                                                //return $detalle->type_pack;
                                            elseif($idcaracteristica1[$cont] == "1"):
                                                $detalle->type_pack= "4";
                                            elseif($idcaracteristica1[$cont] == "2"):
                                                $detalle->type_pack="5";
                                            else:
                                                $detalle->type_pack=$idcaracteristica1[$cont];
                                            endif;
                                        else:
                                            $detalle->type_pack=$idcaracteristica1[$cont];
                                        endif;
                                        
                                        $detalle->type_diet_1=$idcaracteristica2[$cont];
                                        $detalle->type_diet_hiposodicas=$idcaracteristica3[$cont];
                                        $detalle->type_diet_renal=$idcaracteristica4[$cont];
                                        $detalle->type_diet_de_viaje=$idcaracteristica5[$cont];
                                        $detalle->type_diet_pediatricas=$idcaracteristica6[$cont];
                                        $detalle->save();
                                        $cont=$cont+1;
                                    else:
                                        $cont_refa=$cont_refa+1;
                                        $cont=$cont+1;
                                    endif;
                                else:
                                    $detalle=new DietRequestDetail();
                                        $detalle->iddiet_request=$ingreso->id;
                                        $detalle->iddiet=$idarticulo[$cont];
                                        if($idarticulo[$cont] == 18):
                                            $cont_npo=$cont_npo+1;
                                        endif;
                                        $detalle->bed_number=$cantidad[$cont];
                                        if($ingreso->idapplicant_service == 66 || $ingreso->idapplicant_service == 109 || $ingreso->idapplicant_service == 110 || $ingreso->idapplicant_service == 111 || $ingreso->idapplicant_service == 112 || $ingreso->idapplicant_service == 113 || $ingreso->idapplicant_service == 114 || $ingreso->idapplicant_service == 115):
                                            
                                            if($idcaracteristica1[$cont] == "0"):
                                                $detalle->type_pack="3";
                                                //return $detalle->type_pack;
                                            elseif($idcaracteristica1[$cont] == "1"):
                                                $detalle->type_pack= "4";
                                            elseif($idcaracteristica1[$cont] == "2"):
                                                $detalle->type_pack="5";
                                            else:
                                                $detalle->type_pack=$idcaracteristica1[$cont];
                                            endif;
                                        else:
                                            $detalle->type_pack=$idcaracteristica1[$cont];
                                        endif;
                                        
                                        $detalle->type_diet_1=$idcaracteristica2[$cont];
                                        $detalle->type_diet_hiposodicas=$idcaracteristica3[$cont];
                                        $detalle->type_diet_renal=$idcaracteristica4[$cont];
                                        $detalle->type_diet_de_viaje=$idcaracteristica5[$cont];
                                        $detalle->type_diet_pediatricas=$idcaracteristica6[$cont];
                                        $detalle->save();
                                        $cont=$cont+1;
                                endif;
                            endif;
                            
                        } 

                        $ingreso->total_diets = $cont-$cont_npo-$cont_refa;

                        DB::commit();


                        if($ingreso->save()):
                            $b = new Bitacora;
                            $b->action = "Registro de solucitud de dietas. ";
                            $b->user_id = Auth::id();
                            $b->save();

                            $solicitud_fuera->status = 3;
                            $solicitud_fuera->save();

                            return redirect('/admin/solicitud_dietas/1')->with('messages', '¡Solicitud registrada y guardada con exito!.')
                                ->with('typealert', 'success');
                        endif;

                    endif;




                endif;

            else:
                $rules = [

                    'idjourney' => 'required'
                ];

                $messages = [

                    'idjourney.required' => 'Se requiere que seleccione la jornada de la solicitud a realizar.'
                ];

                $validator = Validator::make($request->all(),$rules,$messages);

                if($validator->fails()):
                    return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                    ->with('typealert', 'danger')->withInput();
                else:

                    $jornada = Journey::findOrFail($request->get('idjourney'));
                    $hora_actual = Carbon::now()->format('H:i');
                    //return $hora_actual;

                    if($hora_actual >= $jornada->start_time && $hora_actual <= $jornada->end_time):
                        DB::beginTransaction();

                        $ingreso = new DietRequest;
                        $ingreso->id=$request->get('id');
                        $ingreso->idjourney =$request->get('idjourney');
                        $ingreso->idapplicant = Auth::user()->id;
                        $ingreso->idapplicant_service=$request->get('idservice');
                        $ingreso->status = 1;
                        $ingreso->save();

                        $idarticulo=$request->get('idarticulo');
                        $cantidad=$request->get('cantidad');
                        //$especificar=$request->get('especificar');
                        $idcaracteristica1=$request->get('idcaracteristica1');
                        $idcaracteristica2=$request->get('idcaracteristica2');
                        $idcaracteristica3=$request->get('idcaracteristica3');
                        $idcaracteristica4=$request->get('idcaracteristica4');
                        $idcaracteristica5=$request->get('idcaracteristica5');
                        $idcaracteristica6=$request->get('idcaracteristica6');

                        $cont=0;
                        $cont_npo=0;
                        $cont_refa=0;

                        //return $idcaracteristica1;

                        while ($cont<count($idarticulo)) {

                            if($request->get('idservice') == 66 || $request->get('idservice') == 65 || $request->get('idservice') == 67 || $request->get('idservice') == 5 || $request->get('idservice') == 68 || $request->get('idservice') == 105 || $request->get('idservice') == 106 || $request->get('idservice') == 107 || $request->get('idservice') == 108 || $request->get('idservice') == 56 || $request->get('idservice') == 61 || $request->get('idservice') == 60 || $request->get('idservice') == 58 || $request->get('idservice') == 70 || $request->get('idservice') == 81 || $request->get('idservice') == 57 || $request->get('idservice') == 59 || $request->get('idservice') == 62 || $request->get('idservice') == 8 || $request->get('idservice') == 69 || $request->get('idservice') == 109 || $request->get('idservice') == 110 || $request->get('idservice') == 111 || $request->get('idservice') == 112 || $request->get('idservice') == 113 || $request->get('idservice') == 114 || $request->get('idservice') == 115):
                                $detalle=new DietRequestDetail();
                                $detalle->iddiet_request=$ingreso->id;
                                $detalle->iddiet=$idarticulo[$cont];
                                if($idarticulo[$cont] == 18):
                                    $cont_npo=$cont_npo+1;
                                endif;
                                $detalle->bed_number=$cantidad[$cont];
                                if($ingreso->idapplicant_service == 66 || $ingreso->idapplicant_service == 109 || $ingreso->idapplicant_service == 110 || $ingreso->idapplicant_service == 111 || $ingreso->idapplicant_service == 112 || $ingreso->idapplicant_service == 113 || $ingreso->idapplicant_service == 114 || $ingreso->idapplicant_service == 115):
                                    
                                    if($idcaracteristica1[$cont] == "0"):
                                        $detalle->type_pack="3";
                                        //return $detalle->type_pack;
                                    elseif($idcaracteristica1[$cont] == "1"):
                                        $detalle->type_pack= "4";
                                    elseif($idcaracteristica1[$cont] == "2"):
                                        $detalle->type_pack="5";
                                    else:
                                        $detalle->type_pack=$idcaracteristica1[$cont];
                                    endif;
                                else:
                                    $detalle->type_pack=$idcaracteristica1[$cont];
                                endif;
                                
                                $detalle->type_diet_1=$idcaracteristica2[$cont];
                                $detalle->type_diet_hiposodicas=$idcaracteristica3[$cont];
                                $detalle->type_diet_renal=$idcaracteristica4[$cont];
                                $detalle->type_diet_de_viaje=$idcaracteristica5[$cont];
                                $detalle->type_diet_pediatricas=$idcaracteristica6[$cont];
                                $detalle->save();
                                $cont=$cont+1;
                            else:
                                if($request->get('idjourney') == 1 || $request->get('idjourney') == 2):
                                    if($idarticulo[$cont] != 29):
                                        $detalle=new DietRequestDetail();
                                        $detalle->iddiet_request=$ingreso->id;
                                        $detalle->iddiet=$idarticulo[$cont];
                                        if($idarticulo[$cont] == 18):
                                            $cont_npo=$cont_npo+1;
                                        endif;
                                        $detalle->bed_number=$cantidad[$cont];
                                        if($ingreso->idapplicant_service == 66 || $ingreso->idapplicant_service == 109 || $ingreso->idapplicant_service == 110 || $ingreso->idapplicant_service == 111 || $ingreso->idapplicant_service == 112 || $ingreso->idapplicant_service == 113 || $ingreso->idapplicant_service == 114 || $ingreso->idapplicant_service == 115):
                                            
                                            if($idcaracteristica1[$cont] == "0"):
                                                $detalle->type_pack="3";
                                                //return $detalle->type_pack;
                                            elseif($idcaracteristica1[$cont] == "1"):
                                                $detalle->type_pack= "4";
                                            elseif($idcaracteristica1[$cont] == "2"):
                                                $detalle->type_pack="5";
                                            else:
                                                $detalle->type_pack=$idcaracteristica1[$cont];
                                            endif;
                                        else:
                                            $detalle->type_pack=$idcaracteristica1[$cont];
                                        endif;
                                        
                                        $detalle->type_diet_1=$idcaracteristica2[$cont];
                                        $detalle->type_diet_hiposodicas=$idcaracteristica3[$cont];
                                        $detalle->type_diet_renal=$idcaracteristica4[$cont];
                                        $detalle->type_diet_de_viaje=$idcaracteristica5[$cont];
                                        $detalle->type_diet_pediatricas=$idcaracteristica6[$cont];
                                        $detalle->save();
                                        $cont=$cont+1;
                                    else:
                                        $cont_refa=$cont_refa+1;
                                        $cont=$cont+1;
                                    endif;
                                else:
                                    $detalle=new DietRequestDetail();
                                        $detalle->iddiet_request=$ingreso->id;
                                        $detalle->iddiet=$idarticulo[$cont];
                                        if($idarticulo[$cont] == 18):
                                            $cont_npo=$cont_npo+1;
                                        endif;
                                        $detalle->bed_number=$cantidad[$cont];
                                        if($ingreso->idapplicant_service == 66 || $ingreso->idapplicant_service == 109 || $ingreso->idapplicant_service == 110 || $ingreso->idapplicant_service == 111 || $ingreso->idapplicant_service == 112 || $ingreso->idapplicant_service == 113 || $ingreso->idapplicant_service == 114 || $ingreso->idapplicant_service == 115):
                                            
                                            if($idcaracteristica1[$cont] == "0"):
                                                $detalle->type_pack="3";
                                                //return $detalle->type_pack;
                                            elseif($idcaracteristica1[$cont] == "1"):
                                                $detalle->type_pack= "4";
                                            elseif($idcaracteristica1[$cont] == "2"):
                                                $detalle->type_pack="5";
                                            else:
                                                $detalle->type_pack=$idcaracteristica1[$cont];
                                            endif;
                                        else:
                                            $detalle->type_pack=$idcaracteristica1[$cont];
                                        endif;
                                        
                                        $detalle->type_diet_1=$idcaracteristica2[$cont];
                                        $detalle->type_diet_hiposodicas=$idcaracteristica3[$cont];
                                        $detalle->type_diet_renal=$idcaracteristica4[$cont];
                                        $detalle->type_diet_de_viaje=$idcaracteristica5[$cont];
                                        $detalle->type_diet_pediatricas=$idcaracteristica6[$cont];
                                        $detalle->save();
                                        $cont=$cont+1;
                                endif;
                            endif;
                            
                        } 

                        $ingreso->total_diets = $cont-$cont_npo-$cont_refa;

                        DB::commit();


                        if($ingreso->save()):
                            $b = new Bitacora;
                            $b->action = "Registro de solucitud de dietas. ";
                            $b->user_id = Auth::id();
                            $b->save();

                            return redirect('/admin/solicitud_dietas/1')->with('messages', '¡Solicitud registrada y guardada con exito!.')
                                ->with('typealert', 'success');
                        endif;
                    else:
                        return back()->with('messages', '¡El tiempo de alimentación seleccionado está fuera del horario de solicitud establecido!.')
                                ->with('typealert', 'warning');

                    endif;




                endif;
            endif;
        else:
            if($request->input('solicitud_fuera_tiempo') != NULL && $request->input('solicitud_fuera_tiempo') == 1):

                $rules = [

                    'amount' => 'required'
                ];

                $messages = [

                    'amount.required' => 'Se requiere que ingrese la cantidad de refacciones a solicitar.'
                ];

                $validator = Validator::make($request->all(),$rules,$messages);

                if($validator->fails()):
                    return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                    ->with('typealert', 'danger')->withInput();
                else:
                    $solicitud_fuera = DietRequestOut::findOrFail($request->input('solicitud_fuera_id'));

                    switch($solicitud_fuera->time_available):
                        case 1:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(5)->format('H:i');
                        break;

                        case 2:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(10)->format('H:i');
                        break;

                        case 3:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(15)->format('H:i');
                        break;

                        case 4:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(20)->format('H:i');
                        break;

                        case 5:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(25)->format('H:i');
                        break;

                        case 6:
                            $hora_disponible = $solicitud_fuera->created_at->addMinutes(30)->format('H:i');
                        break;

                    endswitch;

                    //return $hora_disponible;

                    $hora_actual = Carbon::now()->format('H:i');

                    if( $hora_actual > $hora_disponible ):
                        $solicitud_fuera->status = 2;
                        $solicitud_fuera->save();
                        return redirect('/admin/solicitud_refacciones')->with('messages', '¡Excedio el tiempo habilitado para realizar la solicitud!.')
                                ->with('typealert', 'warning');
                    else:
                        if($request->get('amount') > $request->get('cantidad_dietas') ):
                            return back()->with('messages', '¡No puede ingresar más refacciones de las autorizadas por alimentación!.')
                                ->with('typealert', 'warning');
                        else:
                            $ingreso = new DietRequest;
                            $ingreso->id=$request->get('id');
                            $ingreso->idjourney = 4;
                            $ingreso->idapplicant = Auth::user()->id;
                            $ingreso->idapplicant_service=$request->get('idservice');
                            $ingreso->total_diets = $request->get('amount');
                            $ingreso->status = 1;
                            $ingreso->save();

                            if($ingreso->save()):
                                $b = new Bitacora;
                                $b->action = "Registro de solucitud de refacciones. ";
                                $b->user_id = Auth::id();
                                $b->save();

                                $solicitud_fuera->status = 3;
                                $solicitud_fuera->save();

                                return redirect('/admin/solicitud_refacciones')->with('messages', '¡Solicitud registrada y guardada con exito!.')
                                    ->with('typealert', 'success');
                            endif;
                        endif;

                    endif;




                endif;

            else:
                $rules = [

                    'amount' => 'required'
                ];

                $messages = [

                    'amount.required' => 'Se requiere que ingrese la cantidad de refacciones a solicitar.'
                ];

                $validator = Validator::make($request->all(),$rules,$messages);

                if($validator->fails()):
                    return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                    ->with('typealert', 'danger')->withInput();
                else:
                    $fecha = Carbon::now()->format('Y-m-d');
                    $solicitudes = DietRequest::whereDate('created_at',$fecha)->where('idjourney', 4)->where('idapplicant', Auth::user()->id)->where('idapplicant_service', $request->get('idservice'))->get();
                    
                    if(count($solicitudes) > 0):
                        return back()->with('messages', '¡Solo puede realizar 1 solicitud por día!.')
                                ->with('typealert', 'warning');
                    else:                    
                        $ingreso = new DietRequest;
                        $ingreso->id=$request->get('id');
                        $ingreso->idjourney = 4;
                        $ingreso->idapplicant = Auth::user()->id;
                        $ingreso->idapplicant_service=$request->get('idservice');
                        $ingreso->total_diets = $request->get('amount');
                        $ingreso->status = 1;
                        $ingreso->save();

                        if($ingreso->save()):
                            $b = new Bitacora;
                            $b->action = "Registro de solucitud de refacciones. ";
                            $b->user_id = Auth::id();
                            $b->save();

                            return redirect('/admin/solicitud_refacciones')->with('messages', '¡Solicitud registrada y guardada con exito!.')
                                ->with('typealert', 'success');
                        endif;

                    endif;
                    




                endif;
            endif;
        endif;



    }

    public function getDietRequestServida($id, $cantidad){

        $dr = DietRequest::findOrFail($id);

        if($cantidad > $dr->total_diets){
            return back()->with('messages', '¡Esta sirviendo más dietas de las solicitadas, verifique sus datos!.')
                        ->with('typealert', 'warning');
        }else{
            $dr->diets_served = $cantidad;
            $dr->iduser_served = Auth::id();
            $dr->status = 2;

            if($dr->save()):
                $b = new Bitacora;
                $b->action = "Dieta con id: ".$dr->id." fue servida, con: ".$cantidad." dietas";
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Solicitud de dieta servida y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        }



    }

    public function getDietRequestChangeDietsServida($id, $cantidad){

        $dr = DietRequest::findOrFail($id);
        $dietas_servidas_ant = $dr->diets_served;

        if($cantidad > $dr->total_diets){
            return back()->with('messages', '¡Esta sirviendo más dietas de las solicitadas, verifique sus datos!.')
                        ->with('typealert', 'warning');
        }else{
            $dr->diets_served = $cantidad;
            $dr->iduser_served = Auth::id();
            $dr->status = 2;

            if($dr->save()):
                $b = new Bitacora;
                $b->action = "Dieta con id: ".$dr->id." fue modificada la cantidad de dietas servidas, de: ".$dietas_servidas_ant." dietas a: " .$cantidad." dietas";
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Solicitud de dieta servida y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        }



    }

    public function getDietRequestView($id){
        $diet_request = DietRequest::findOrFail($id);
        $iddiet_request = $diet_request->id;
        $details = DietRequestDetail::where('iddiet_request', $iddiet_request)->get();


        $data = [
            'diet_request' => $diet_request,
            'details' => $details
        ];

        return view('admin.diet_request.view', $data);
    }

    public function getDietRequestDelete($id){
        $dr = DietRequest::findOrFail($id);
        $dr1 = DietRequest::findOrFail($id);
        $dr1->status = 3;
        $dr1->update();

        if($dr->delete()):
            $b = new Bitacora;
            $b->action = "Se anulo la solicitud de dietas con id: ".$dr->id;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Solicitud enviada a la papelera de reciclaje!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getDietRequestPdf($id) {
    // Usamos with() para cargar relaciones si las tienes (ej: service, user, journey)
    $diet_request = DietRequest::with(['service', 'user', 'journey'])->findOrFail($id);
    
    // Obtenemos los detalles y los agrupamos por ID de dieta inmediatamente
    $details = DietRequestDetail::where('iddiet_request', $id)->get()->groupBy('iddiet');

    // Optimizamos subtotales: convertimos a un Key-Value pair para acceso rápido
    $subtotales = DB::table('diet_request_details')
                 ->select('iddiet', DB::raw('count(iddiet) as subtotal'))
                 ->where('iddiet_request', $id)
                 ->groupBy('iddiet')
                 ->get()
                 ->pluck('subtotal', 'iddiet'); // Resultado: [1 => 5, 2 => 3...]

    $data = [
        'dr' => $diet_request, // Lo llamo $dr para simplificar en la vista
        'details' => $details,
        'subtotales' => $subtotales
    ];

    $pdf = PDF::loadView('admin.diet_request.print', $data)->setPaper('a4', 'portrait');
    return $pdf->stream('Solicitud_Dietas_'.$id.'.pdf');
}

    /*public function getDietRequestPdf($id){
        $diet_request = DietRequest::findOrFail($id);
        $iddiet_request = $diet_request->id;
        $details = DietRequestDetail::where('iddiet_request', $iddiet_request)->get();

        //return $details;


        $subtotales = DB::table('diet_request_details')
                 ->select('iddiet', DB::raw('count(iddiet) as subtotal'))
                 ->where('iddiet_request', $iddiet_request)
                 ->groupBy('iddiet')
                 ->get();

        $subtotales_otras = DB::table('diet_request_details')
                 ->select( DB::raw('count(iddiet) as subtotal'))
                 ->where('iddiet_request', $iddiet_request)
                 ->whereIn('iddiet', ['19','20','21','22','23','24','25','26','27','28','29'])
                 ->get();

        //return $subtotales_otras;

        $data = [
            'diet_request' => $diet_request,
            'details' => $details,
            'subtotales' => $subtotales,
            'subtotales_otras' => $subtotales_otras
        ];

        $pdf = PDF::loadView('admin.diet_request.print',$data)->setPaper('a4', 'portrait');
        return $pdf->stream('ING-7.pdf');
    }*/

    public function getDietRequestPdfLote($jornada){
        $hoy = Carbon::now()->format('Y-m-d');
        $diet_request = DietRequest::with('details')->whereDate('created_at', $hoy)->where('idjourney', $jornada)->where('status',1)->get();
        //$details = DietRequestDetail::whereDate('created_at', $hoy)->get();



        $subtotales = DB::table('diet_request_details')
                ->select(DB::raw('diet_request_details.iddiet_request as iddiet_request'), DB::raw('diet_request_details.iddiet as iddiet'), DB::raw('count(diet_request_details.iddiet) as subtotal'))
                ->join('diet_requests', 'diet_requests.id', 'diet_request_details.iddiet_request')
                ->whereDate('diet_requests.created_at', $hoy)
                ->groupBy('diet_request_details.iddiet_request','diet_request_details.iddiet')
                ->get();

        //return $subtotales;

        $subtotales_otras = DB::table('diet_request_details')
                    ->select(DB::raw('diet_request_details.iddiet_request as iddiet_request'),DB::raw('count(diet_request_details.iddiet) as subtotal'))
                    ->join('diet_requests', 'diet_requests.id', 'diet_request_details.iddiet_request')
                    ->whereIn('diet_request_details.iddiet', ['19','20','21','22','23','24','25','26','27','28','29'])
                    ->whereDate('diet_requests.created_at', $hoy)
                    ->groupBy('diet_request_details.iddiet_request')
                    ->get();

        //return $subtotales_otras;

        $subtotales_diabeticas = DB::table('diet_request_details')
                    ->select(DB::raw('diet_request_details.iddiet_request as iddiet_request'),DB::raw('count(diet_request_details.iddiet) as subtotal'))
                    ->join('diet_requests', 'diet_requests.id', 'diet_request_details.iddiet_request')
                    ->whereIn('diet_request_details.iddiet', ['8','9','10','11'])
                    ->whereDate('diet_requests.created_at', $hoy)
                    ->groupBy('diet_request_details.iddiet_request')
                    ->get();

        $data = [
            'diet_request' => $diet_request,
            'subtotales' => $subtotales,
            'subtotales_otras' => $subtotales_otras,
            'subtotales_diabeticas' => $subtotales_diabeticas
        ];

       

        $pdf = PDF::loadView('admin.diet_request.print_lote',$data)->setPaper('a4', 'portrait');
        return $pdf->stream('ING-7.pdf');
    }

    public function getDietRequestPdfCocineta($jornada){
        $hoy = Carbon::now()->format('Y-m-d');
        $hora_actual = Carbon::now()->format('H:i');
        //$hoy = '2022-08-11';
        $dietas = Diet::where('id','<>',17)->where('id','<>',18)->get();     
        $estado_solicitud = 1;       
       
        $cocineta1 = [ $this->calcularCocineta1($hoy,$jornada,$estado_solicitud) ];
        $cocineta2 = [ $this->calcularCocineta2($hoy,$jornada,$estado_solicitud) ];
        $cocinetaED = [ $this->calcularCocinetaEdificioD($hoy,$jornada,$estado_solicitud) ];
        $cocinetaEM = [ $this->calcularCocinetaEmergencia($hoy,$jornada,$estado_solicitud) ]; 


        //return $cocineta1;
        $data = [
            'hoy' => $hoy,
            'hora_actual' => $hora_actual,
            'jornada' => $jornada,
            'dietas' => $dietas,
            'cocineta1' => $cocineta1,
            'cocineta2' => $cocineta2,
            'cocinetaED'=> $cocinetaED,
            'cocinetaEM' => $cocinetaEM
        ];

        //return $data;

        $pdf = PDF::loadView('admin.diet_request.print_cocineta',$data)->setPaper('a4', 'portrait');
        return $pdf->stream('ING-7.pdf');
    }

    public function calcularCocineta1($hoy,$jornada, $estado_solicitud){
        $conteo_c1_ped_totales = DB::table('diet_request_details')
                ->select(
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',0)
                ->groupBy('diet_request_details.iddiet')
                ->get();
        $conteo_c1_ped_semp = DB::table('diet_request_details')
                ->select(
                        DB::raw('services.name AS servicio'), 
                        DB::raw('diet_request_details.type_pack AS carac1'), 
                        DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                        DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                        DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                        DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',0)
                ->whereIn('diet_request_details.type_pack', ['0','1','2'])
                ->groupBy(
                        'diet_request_details.iddiet',
                        'diet_request_details.type_diet_1',
                        'diet_request_details.type_diet_hiposodicas',
                        'diet_request_details.type_diet_renal',
                        'diet_request_details.type_diet_de_viaje')
                ->get();
        $conteo_c1_ped_emp = DB::table('diet_request_details')
                ->select(
                        DB::raw('services.name AS servicio'), 
                        DB::raw('diet_request_details.type_pack AS carac1'), 
                        DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                        DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                        DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                        DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',0)
                ->whereIn('diet_request_details.type_pack', ['3','4','5'])
                ->groupBy(
                        'diet_request_details.iddiet',
                        'diet_request_details.type_diet_1',
                        'diet_request_details.type_diet_hiposodicas',
                        'diet_request_details.type_diet_renal',
                        'diet_request_details.type_diet_de_viaje')
                ->get();

        $total_c1_ped = DB::table('diet_request_details')
                ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',0)
                ->get();

        $conteo_c1_ala1_totales = DB::table('diet_request_details')
                ->select(
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',1)
                ->groupBy('diet_request_details.iddiet')
                ->get();

        $conteo_c1_ala1_semp = DB::table('diet_request_details')
                ->select(
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',1)
                ->whereIn('diet_request_details.type_pack', ['0','1','2'])
                ->groupBy(
                    'diet_request_details.iddiet',
                    'diet_request_details.type_diet_1',
                    'diet_request_details.type_diet_hiposodicas',
                    'diet_request_details.type_diet_renal',
                    'diet_request_details.type_diet_de_viaje'
                )
                ->get();
        $conteo_c1_ala1_emp = DB::table('diet_request_details')
                ->select(
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',1)
                ->whereIn('diet_request_details.type_pack', ['3','4','5'])
                ->groupBy(
                    'diet_request_details.iddiet',
                    'diet_request_details.type_diet_1',
                    'diet_request_details.type_diet_hiposodicas',
                    'diet_request_details.type_diet_renal',
                    'diet_request_details.type_diet_de_viaje'
                )
                ->get();

        $total_c1_ala1 = DB::table('diet_request_details')
                ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',1)
                ->get();

        $conteo_c1_ala2_totales = DB::table('diet_request_details')
                ->select(
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',2)
                ->groupBy('diet_request_details.iddiet')
                ->get();

        $conteo_c1_ala2_semp = DB::table('diet_request_details')
                ->select(
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',2)
                ->whereIn('diet_request_details.type_pack', ['0','1','2'])
                ->groupBy(
                    'diet_request_details.iddiet',
                    'diet_request_details.type_diet_1',
                    'diet_request_details.type_diet_hiposodicas',
                    'diet_request_details.type_diet_renal',
                    'diet_request_details.type_diet_de_viaje')
                ->get();
        $conteo_c1_ala2_emp = DB::table('diet_request_details')
                ->select(
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',2)
                ->whereIn('diet_request_details.type_pack', ['3','4','5'])
                ->groupBy(
                    'diet_request_details.iddiet',
                    'diet_request_details.type_diet_1',
                    'diet_request_details.type_diet_hiposodicas',
                    'diet_request_details.type_diet_renal',
                    'diet_request_details.type_diet_de_viaje')
                ->get();

        $total_c1_ala2 = DB::table('diet_request_details')
                ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->where('services.ala_cocineta',2)
                ->get();

        $total_c1_sum_alas = DB::table('diet_request_details')
                ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'),
                        DB::raw('diet_request_details.iddiet AS dieta'), )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->groupBy('diet_request_details.iddiet')
                ->get();
    
        $total_c1 = DB::table('diet_request_details')
                ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',1)
                ->get();
        
        $data = [
            'conteo_c1_ped_totales' => $conteo_c1_ped_totales,
            'conteo_c1_ped_semp' => $conteo_c1_ped_semp,
            'conteo_c1_ped_emp' => $conteo_c1_ped_emp,
            'total_c1_ped' => $total_c1_ped,
            'conteo_c1_ala1_totales' => $conteo_c1_ala1_totales,
            'conteo_c1_ala1_semp' => $conteo_c1_ala1_semp,
            'conteo_c1_ala1_emp' => $conteo_c1_ala1_emp,
            'total_c1_ala1' => $total_c1_ala1,
            'conteo_c1_ala2_totales' => $conteo_c1_ala2_totales,
            'conteo_c1_ala2_semp' => $conteo_c1_ala2_semp,
            'conteo_c1_ala2_emp' => $conteo_c1_ala2_emp,
            'total_c1_ala2' => $total_c1_ala2,
            'total_c1_sum_alas' => $total_c1_sum_alas,
            'total_c1' => $total_c1
        ];

        return $data;
        
    }

    public function calcularCocineta2($hoy,$jornada,$estado_solicitud){
        $conteo_c2_ala1_totales = DB::table('diet_request_details')
            ->select(   DB::raw('diet_request_details.iddiet AS dieta'), DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',1)
            ->groupBy('diet_request_details.iddiet')
            ->get();
        $conteo_c2_ala1_semp = DB::table('diet_request_details')
            ->select(   DB::raw('services.name AS servicio'), 
                        DB::raw('diet_request_details.type_pack AS carac1'), 
                        DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                        DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                        DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                        DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',1)
            ->whereIn('diet_request_details.type_pack', ['0','1','2'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();
        $conteo_c2_ala1_emp = DB::table('diet_request_details')
            ->select(   DB::raw('services.name AS servicio'), 
                        DB::raw('diet_request_details.type_pack AS carac1'), 
                        DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                        DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                        DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                        DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',1)
            ->whereIn('diet_request_details.type_pack', ['3','4','5'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();

        $total_c2_ala1 = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',1)
            ->get();

        $conteo_c2_ala2_totales = DB::table('diet_request_details')
            ->select(DB::raw('diet_request_details.iddiet AS dieta'), DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',2)
            ->groupBy('diet_request_details.iddiet')
            ->get();
        $conteo_c2_ala2_semp = DB::table('diet_request_details')
            ->select(   DB::raw('services.name AS servicio'), 
                        DB::raw('diet_request_details.type_pack AS carac1'), 
                        DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                        DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                        DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                        DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',2)
            ->whereIn('diet_request_details.type_pack', ['0','1','2'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();
        $conteo_c2_ala2_emp = DB::table('diet_request_details')
            ->select(   DB::raw('services.name AS servicio'), 
                        DB::raw('diet_request_details.type_pack AS carac1'), 
                        DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                        DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                        DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                        DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                        DB::raw('diet_request_details.iddiet AS dieta'), 
                        DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',2)
            ->whereIn('diet_request_details.type_pack', ['3','4','5'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();

        $total_c2_ala2 = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->where('services.ala_cocineta',2)
            ->get();

        $total_c2_sum_alas = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'),
                    DB::raw('diet_request_details.iddiet AS dieta'), )
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->groupBy('diet_request_details.iddiet')
            ->get();

        $total_c2 = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',2)
            ->get();

        
        $data = [
            'conteo_c2_ala1_totales' => $conteo_c2_ala1_totales,
            'conteo_c2_ala1_semp' => $conteo_c2_ala1_semp,
            'conteo_c2_ala1_emp' => $conteo_c2_ala1_emp,
            'total_c2_ala1' => $total_c2_ala1,
            'conteo_c2_ala2_totales' => $conteo_c2_ala2_totales,
            'conteo_c2_ala2_semp' => $conteo_c2_ala2_semp,
            'conteo_c2_ala2_emp' => $conteo_c2_ala2_emp,
            'total_c2_ala2' => $total_c2_ala2,
            'total_c2_sum_alas' => $total_c2_sum_alas,
            'total_c2' => $total_c2
        ];

        return $data;
        
    }

    public function calcularCocinetaEdificioD($hoy,$jornada,$estado_solicitud){
        $conteo_edificiod_sotano_totales = DB::table('diet_request_details')
            ->select(DB::raw('diet_request_details.iddiet AS dieta'), DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',0)
            ->groupBy('diet_request_details.iddiet')
            ->get();
        $conteo_edificiod_sotano_semp = DB::table('diet_request_details')
            ->select(   
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',0)
            ->whereIn('diet_request_details.type_pack', ['0','1','2'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();
        $conteo_edificiod_sotano_emp = DB::table('diet_request_details')
            ->select(   
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',0)
            ->whereIn('diet_request_details.type_pack', ['3','4','5'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();

        $total_edificiod_sotano = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',0)
            ->get();

        $conteo_edificiod_ala1_totales = DB::table('diet_request_details')
            ->select(DB::raw('diet_request_details.iddiet AS dieta'),DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',1)
            ->groupBy('diet_request_details.iddiet')
            ->get();
        $conteo_edificiod_ala1_semp = DB::table('diet_request_details')
            ->select(   
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',1)
            ->whereIn('diet_request_details.type_pack', ['0','1','2'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();
        $conteo_edificiod_ala1_emp = DB::table('diet_request_details')
            ->select(   
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',1)
            ->whereIn('diet_request_details.type_pack', ['3','4','5'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();

        $total_edificiod_ala1 = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',1)
            ->get();


        $conteo_edificiod_ala2_totales = DB::table('diet_request_details')
            ->select(DB::raw('diet_request_details.iddiet AS dieta'),DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',2)
            ->groupBy('diet_request_details.iddiet')
            ->get();
        
        $conteo_edificiod_ala2_semp = DB::table('diet_request_details')
            ->select(   
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',2)
            ->whereIn('diet_request_details.type_pack', ['0', '1','2'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();
        $conteo_edificiod_ala2_emp = DB::table('diet_request_details')
            ->select(   
                    DB::raw('services.name AS servicio'), 
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',2)
            ->whereIn('diet_request_details.type_pack', ['3', '4','5'])
            ->groupBy(
                'diet_request_details.iddiet',
                'diet_request_details.type_diet_1',
                'diet_request_details.type_diet_hiposodicas',
                'diet_request_details.type_diet_renal',
                'diet_request_details.type_diet_de_viaje')
            ->get();
        $total_edificiod_ala2 = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->where('services.ala_cocineta',2)
            ->get();

        $total_edificiod_sum_alas = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'),
                    DB::raw('diet_request_details.iddiet AS dieta'), )
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->groupBy('diet_request_details.iddiet')
            ->get();

        $total_edificiod = DB::table('diet_request_details')
            ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
            ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
            ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
            ->whereDate('diet_requests.created_at', $hoy)
            ->where('diet_request_details.iddiet','<>', 18)
            ->where('diet_requests.idjourney', $jornada)
            ->where('diet_requests.status',$estado_solicitud)
            ->where('services.no_cocineta',3)
            ->get();

        
        $data = [
            'conteo_edificiod_sotano_totales' => $conteo_edificiod_sotano_totales,
            'conteo_edificiod_sotano_semp' => $conteo_edificiod_sotano_semp,
            'conteo_edificiod_sotano_emp' => $conteo_edificiod_sotano_emp,
            'total_edificiod_sotano' => $total_edificiod_sotano,
            'conteo_edificiod_ala1_totales' => $conteo_edificiod_ala1_totales,
            'conteo_edificiod_ala1_semp' => $conteo_edificiod_ala1_semp,
            'conteo_edificiod_ala1_emp' => $conteo_edificiod_ala1_emp,
            'total_edificiod_ala1' => $total_edificiod_ala1,
            'conteo_edificiod_ala2_totales' => $conteo_edificiod_ala2_totales,
            'conteo_edificiod_ala2_semp' => $conteo_edificiod_ala2_semp,
            'conteo_edificiod_ala2_emp' => $conteo_edificiod_ala2_emp,
            'total_edificiod_ala2' => $total_edificiod_ala2,
            'total_edificiod_sum_alas' => $total_edificiod_sum_alas,
            'total_edificiod' => $total_edificiod
        ];

        return $data;
        
    }

    public function calcularCocinetaEmergencia($hoy, $jornada,$estado_solicitud){
        $conteo_emer_totales = DB::table('diet_request_details')
                ->select(DB::raw('diet_request_details.iddiet AS dieta'),DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',4)
                ->groupBy('diet_request_details.iddiet')
                ->get();
        $conteo_emer_semp = DB::table('diet_request_details')
                ->select(
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',4)
                ->whereIn('diet_request_details.type_pack', ['0','1','2'])
                ->groupBy(
                    'diet_request_details.iddiet',
                    'diet_request_details.type_diet_1',
                    'diet_request_details.type_diet_hiposodicas',
                    'diet_request_details.type_diet_renal',
                    'diet_request_details.type_diet_de_viaje')
                ->get();
        $conteo_emer_emp = DB::table('diet_request_details')
                ->select(
                    DB::raw('diet_request_details.type_pack AS carac1'), 
                    DB::raw('diet_request_details.type_diet_1 AS carac2'), 
                    DB::raw('diet_request_details.type_diet_hiposodicas AS carac3'), 
                    DB::raw('diet_request_details.type_diet_renal AS carac4'), 
                    DB::raw('diet_request_details.type_diet_de_viaje AS carac5'), 
                    DB::raw('diet_request_details.iddiet AS dieta'), 
                    DB::raw('COUNT(diet_request_details.iddiet) AS total_dietas')
                )
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',4)
                ->whereIn('diet_request_details.type_pack', ['3','4','5'])
                ->groupBy(
                    'diet_request_details.iddiet',
                    'diet_request_details.type_diet_1',
                    'diet_request_details.type_diet_hiposodicas',
                    'diet_request_details.type_diet_renal',
                    'diet_request_details.type_diet_de_viaje')
                ->get();

        $total_emer = DB::table('diet_request_details')
                ->select(DB::raw('COUNT(diet_request_details.iddiet) AS total'))
                ->join('diet_requests', 'diet_requests.id', '=', 'diet_request_details.iddiet_request')
                ->join('services', 'services.id', '=', 'diet_requests.idapplicant_service')
                ->whereDate('diet_requests.created_at', $hoy)
                ->where('diet_request_details.iddiet','<>', 18)
                ->where('diet_requests.idjourney', $jornada)
                ->where('diet_requests.status',$estado_solicitud)
                ->where('services.no_cocineta',4)
                ->get();

        $data = [
            'conteo_emer_totales' => $conteo_emer_totales,
            'conteo_emer_semp' => $conteo_emer_semp,
            'conteo_emer_emp' => $conteo_emer_emp,
            'total_emer' => $total_emer
        ];

        return $data;
    }

    public function getSnak(){

        /*$sumatoria = DB::table('diet_requests')
                ->select(
                        
                        DB::raw("SUM(diet_requests.total_diets) as suma"))
                ->where('diet_requests.idjourney', 4)
                ->where('diet_requests.status',1)
                ->get();
        return $sumatoria;
        $sumatoria = DietRequest::where('idjourney', 4)->where('status',1)->get();
        return collect($sumatoria)->sum('total_diets');*/ 
        $fecha = Carbon::now()->format('Y-m-d');

        if(Auth::user()->role == 5):
            $solicitud_fuera = DietRequestOut::whereDate('created_at',$fecha)->where('idapplicant', Auth::user()->id)->where('status',1)->first();

            if($solicitud_fuera):

                $solicitud_fuera_tiempo = 1;
                $solicitud_fuera_id = $solicitud_fuera->id;
                $cantidad_dietas = $solicitud_fuera->amount_diets;

                $services = Service::where('type','1')
                        ->where('parent_id', '<>', '2')
                        ->where('unit_id', '1')
                        ->get();

                $snak_requests = DietRequest::where('idjourney', '4')->where('idapplicant', Auth::user()->id)->orderBy('id', 'Asc')->get();

                $data = [
                    'services' => $services,
                    'snak_requests' => $snak_requests,
                    'cantidad_dietas' => $cantidad_dietas,
                    'solicitud_fuera_tiempo' => $solicitud_fuera_tiempo,
                    'solicitud_fuera_id' => $solicitud_fuera_id
                ];

                return view('admin.snak_request.home', $data);
            else:

                $services = Service::where('type','1')
                        ->where('parent_id', '<>', '2')
                        ->where('unit_id', '1')
                        ->get();

                $snak_requests = DietRequest::where('idjourney', '4')->where('idapplicant', Auth::user()->id)->orderBy('id', 'Asc')->get();
                $solicitud_fuera_tiempo = 0;
                $data = [
                    'services' => $services,
                    'snak_requests' => $snak_requests,
                    'solicitud_fuera_tiempo' => $solicitud_fuera_tiempo
                ];

                return view('admin.snak_request.home', $data);
            
            endif;
        else:
                $services = Service::where('type','1')
                        ->where('parent_id', '<>', '2')
                        ->where('unit_id', '1')
                        ->get();

                $snak_requests = DietRequest::where('idjourney', '4')->where('idapplicant', Auth::user()->id)->orderBy('id', 'Asc')->get();
                $solicitud_fuera_tiempo = 0;
                $data = [
                    'services' => $services,
                    'snak_requests' => $snak_requests,
                    'solicitud_fuera_tiempo' => $solicitud_fuera_tiempo
                ];

                return view('admin.snak_request.home', $data);

            
        endif;

        
    }

    public function getSnakCoex(){

        /*$sumatoria = DB::table('diet_requests')
                ->select(
                        
                        DB::raw("SUM(diet_requests.total_diets) as suma"))
                ->where('diet_requests.idjourney', 4)
                ->where('diet_requests.status',1)
                ->get();
        return $sumatoria;
        $sumatoria = DietRequest::where('idjourney', 4)->where('status',1)->get();
        return collect($sumatoria)->sum('total_diets');*/ 
        $fecha = Carbon::now()->format('Y-m-d');

        if(Auth::user()->role == 5):
            $solicitud_fuera = DietRequestOut::whereDate('created_at',$fecha)->where('idapplicant', Auth::user()->id)->where('status',1)->first();

            if($solicitud_fuera):

                $solicitud_fuera_tiempo = 1;
                $solicitud_fuera_id = $solicitud_fuera->id;
                $cantidad_dietas = $solicitud_fuera->amount_diets;

                $services = Service::where('type','1')
                        ->where('parent_id', '=', '2')
                        ->where('unit_id', '1')
                        ->get();

                $snak_requests = DietRequest::where('idjourney', '4')->where('idapplicant', Auth::user()->id)->orderBy('id', 'Asc')->get();

                $data = [
                    'services' => $services,
                    'snak_requests' => $snak_requests,
                    'cantidad_dietas' => $cantidad_dietas,
                    'solicitud_fuera_tiempo' => $solicitud_fuera_tiempo,
                    'solicitud_fuera_id' => $solicitud_fuera_id
                ];

                return view('admin.snak_request.home', $data);
            else:

                $services = Service::where('type','1')
                        ->where('parent_id', '<>', '2')
                        ->where('unit_id', '1')
                        ->get();

                $snak_requests = DietRequest::where('idjourney', '4')->where('idapplicant', Auth::user()->id)->orderBy('id', 'Asc')->get();
                $solicitud_fuera_tiempo = 0;
                $data = [
                    'services' => $services,
                    'snak_requests' => $snak_requests,
                    'solicitud_fuera_tiempo' => $solicitud_fuera_tiempo
                ];

                return view('admin.snak_request.home_coex', $data);
            
            endif;
        else:
                $services = Service::where('type','1')
                        ->where('parent_id', '=', '2')
                        ->where('unit_id', '1')
                        ->get();

                $snak_requests = DietRequest::where('idjourney', '4')->where('idapplicant', Auth::user()->id)->orderBy('id', 'Asc')->get();
                $solicitud_fuera_tiempo = 0;
                $data = [
                    'services' => $services,
                    'snak_requests' => $snak_requests,
                    'solicitud_fuera_tiempo' => $solicitud_fuera_tiempo
                ];

                return view('admin.snak_request.home_coex', $data);

            
        endif;

        
    }

    public function getReports(){
        
        
        $date = Carbon::now()->format('d-m-Y');

        $data = [
            'date' => $date
        ];

        return view('admin.diet_request.reports', $data);
    }

    public function getExportReportDay() 
    {   

        
        return Excel::download(new DietRequestReportExport, 'cuadre_del_dia.xlsx');
    }
}
