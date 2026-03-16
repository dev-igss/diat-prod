<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietRequestOut extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'diet_requests_out_time';
    protected $hidden = ['created_at', 'updated_at'];

    public function journey(){
        return $this->hasOne(Journey::class,'id', 'idjourney');
    }

}
