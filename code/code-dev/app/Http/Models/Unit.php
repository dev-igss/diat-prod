<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'units';
    protected $hidden = ['created_at', 'updated_at'];

    public function mun(){
        return $this->hasOne(Municipality::class,'id','municipality_id');
    }

}
