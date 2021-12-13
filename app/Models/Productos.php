<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        'Nombre_Producto',
        'Cantidad',
        'Precio',
        'Categoria',
        'Estado'
    ];

    public $timestamps = false;

    
}



// 'Flash' => Laracasts\Flash\Flash::class,
//Laracasts\Flash\FlashServiceProvider::class,],
//use Laracasts\Flash\Flash


