<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table='customer';
    protected $guarded=[];
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function TopUp(){
    	return $this->hasMany(TopUp::class);
    }
}
