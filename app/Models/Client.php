<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients"; //referenciando a la tabla que usaremos

    //un cliente tiene muchas ventas
    public function sales() : HasMany
    {
        return $this->hasMany(Sale::class); //retorna todas las ventas del cliente
    }
}
