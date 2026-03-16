<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Municipality;

class MunicipalitiesController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getMunicipality(){
        $municipalities = Municipality::get();

        $data = [
            'municipalities' => $municipalities
        ];

        return view('admin.municipalities.home',$data);
    }
}
