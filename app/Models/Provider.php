<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Provider extends Model
{
    use HasFactory;
    protected $table = "providers"; //referenciando a la tabla que usaremos

    //un proveedor realiza varias compras
    public function buys() : HasMany
    {
        return $this->hasMany(Buy::class);
    }

    //un proveedor tiene una imagen
    public function imagen() : MorphOne
    {
        return $this->morphOne(Image::class, 'imageable'); //representacion de la imagen uno a uno
    }
}
