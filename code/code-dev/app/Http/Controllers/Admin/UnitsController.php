<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Unit, App\Http\Models\Municipality, App\Http\Models\Bitacora, App\Http\Models\AssignmentsUnit;
use Validator, Str, Config, Auth;

class UnitsController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){

        $units = Unit::orderBy('name', 'Asc')->get();

        $municipalities = Municipality::get();
        

        $data = [
                'units' => $units, 
                'municipalities' => $municipalities
            ];

    	return view('admin.units.home', $data);
    }

    public function postUnitAdd(Request $request){
    	$rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la unidad.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else: 


            $u = new Unit;
            $u->code = e($request->input('code'));
            $u->name = e($request->input('name'));
            $u->municipality_id = $request->input('municipality_id');
            
            if($u->save()):

                $b = new Bitacora;
                $b->action = "Creación de unidad ".$u->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Unidad creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getUnitEdit($id){
        $unit = Unit::find($id);
        $municipalities = Municipality::pluck('name', 'id');
        $data = [
            'unit' => $unit,
            'municipalities' => $municipalities
        ];
        return view('admin.units.edit', $data);
    }

    public function postUnitEdit(Request $request, $id){
        $rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la unidad.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                ->with('typealert', 'danger');
        else:
            

            $u = Unit::find($id);
            $u->code = e($request->input('code'));
            $u->name = e($request->input('name'));
            $u->municipality_id = $request->input('municipality_id');



            if($u->save()):
                $b = new Bitacora;
                $b->action = "Actualización de datos de unidad ".$u->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Unidad actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getUnitDelete($id){
        $u = Unit::find($id);
        if($u->delete()):
            
            $b = new Bitacora;
            $b->action = "Eliminación de unidad ".$u->name;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Unidad borrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
