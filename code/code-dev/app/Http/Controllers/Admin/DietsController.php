<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Diet, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth;

class DietsController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions'); 
    }

    public function getHome(){
        $diets = Diet::get();      
        
        $data = [
            'diets' => $diets
        ];

    	return view('admin.diets.home', $data);
    }

    public function postDietAdd(Request $request){
    	$rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la dieta.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else:
            $d = new Diet;
            $d->name = e($request->input('name'));
            
            if($d->save()):

                $b = new Bitacora;
                $b->action = "Creación de Dieta ".$d->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Dieta creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getDietEdit($id){
        
        $diet = Diet::find($id);

        $data = [
            'diet' => $diet,
        ];

        return view('admin.diets.edit', $data);
    }

    public function postDietEdit(Request $request, $id){
        $rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la dieta.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                ->with('typealert', 'danger');
        else:
            
            $d = Diet::find($id);
            $d->name = e($request->input('name'));

            if($d->save()):
                $b = new Bitacora;
                $b->action = "Actualización de datos de la dieta ".$d->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Dieta actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getDietDelete($id){
        $d = Diet::find($id);
        if($d->delete()):
            $b = new Bitacora;
            $b->action = "Eliminación de dieta ".$d->name;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Dieta borrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getDiets(){
        $dietas = Diet::whereIn('id', [13,14,15])->get();

        //return $cant_citas;
        return response()->json($dietas);
    }
}
