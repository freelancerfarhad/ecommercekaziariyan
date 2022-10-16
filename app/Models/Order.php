<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];
   
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function division()
    {
        return $this->belongsTo(ShipDivision::class);
    }
    public function district()
    {
        return $this->belongsTo(ShipDistrict::class);
    }
    public function state()
    {
        return $this->belongsTo(Street::class,'steet_id','id');
    }
}
