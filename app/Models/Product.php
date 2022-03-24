<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Blameable;
class Product extends Model
{
    use HasFactory;
    protected $table='product';
    protected $guarded=[];
    use Blameable;
}
