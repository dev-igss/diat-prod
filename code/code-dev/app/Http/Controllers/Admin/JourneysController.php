<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Journey, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth;

class JourneysController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){
        $journeys = Journey::where('id', '<>', 4)->get();      
        
        $data = [
            'journeys' => $journeys
        ];

    	return view('admin.journeys.home', $data);
    }

    public function postJourneyAdd(Request $request){
    	$rules = [
    		'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la jornada.',
            'start_time.required' => 'Se require asignar la hora de inicio de la jornada.',
            'end_time.required' => 'Se require asignar la hora de finalización de la jornada.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else:
            $j = new Journey;
            $j->name = e($request->input('name'));
            $j->start_time = $request->input('start_time');
            $j->end_time = $request->input('end_time');
            
            if($j->save()):

                $b = new Bitacora;
                $b->action = "Creación de Jornada ".$j->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Jornada creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getJourneyEdit($id){
        
        $journey = Journey::find($id);

        $data = [
            'journey' => $journey,
        ];

        return view('admin.journeys.edit', $data);
    }

    public function postJourneyEdit(Request $request, $id){
        $rules = [
    		'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la jornada.',
            'start_time.required' => 'Se require asignar la hora de inicio de la jornada.',
            'end_time.required' => 'Se require asignar la hora de finalización de la jornada.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                ->with('typealert', 'danger');
        else:

            $j = Journey::find($id);
            $j->name = e($request->input('name'));
            $j->start_time = $request->input('start_time');
            $j->end_time = $request->input('end_time');

            if($j->save()):
                $b = new Bitacora;
                $b->action = "Actualización de datos de la jornada ".$j->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Jornada actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getJourneyDelete($id){
        $j = Journey::find($id);
        if($j->delete()):
            $b = new Bitacora;
            $b->action = "Eliminación de jornada ".$j->name;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Jornada borrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
