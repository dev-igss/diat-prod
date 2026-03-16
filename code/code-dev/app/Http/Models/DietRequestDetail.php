<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietRequestDetail extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'diet_request_details';
    protected $hidden = ['created_at', 'updated_at'];

    public function diet_request(){
        return $this->hasOne(DietRequest::class,'iddiet_request', 'id');
    }

    public function diet(){
        return $this->hasOne(Diet::class,'id','iddiet');
    }
}
