<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category, App\Http\Models\Slider, App\Http\Models\Unit;
use Validator;

class ContentController extends Controller
{
    public function getHome($type){

        switch ($type) {
            case '0':
                $units = Unit::where('type_unit', '0')->orderBy('name', 'Asc')->paginate(15);
            break;
            
            case '1':
                $units = Unit::where('type_unit','1')->orderBy('name', 'Asc')->paginate(15);
            break;
            
            case 'todas':
                $units = Unit::orderBy('name', 'Asc')->paginate(15);
            break;
        }

        $data = [
            'units' => $units
        ];

        return view('home', $data);
    }

    public function postUnitSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return redirect('/todas')->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else: 
            $units = Unit::where('name','LIKE', '%'.$request->input('search').'%')->orderBy('name', 'Asc')->paginate(15); 

            $data = ['units' => $units];

            return view('home_Search', $data);
        
        endif;
    }
}
