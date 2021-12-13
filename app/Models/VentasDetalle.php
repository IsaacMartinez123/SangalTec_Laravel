<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasDetalle extends Model
{
    use HasFactory;

    protected $table = "ventasdetalles";

    protected $fillable = [
        'producto_id',
        'venta_id',
        'cantidad',
        'sub_total'
        
    ];

    public $timestamps = false;

    
}
