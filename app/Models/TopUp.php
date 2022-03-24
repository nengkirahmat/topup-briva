<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Blameable;
class TopUp extends Model
{
    use HasFactory;
    protected $table='topup';
    protected $guarded=[];
    use Blameable;

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }
}
