<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; //palabra reservada para la relacion uno a muchos



class Category extends Model
{
    use HasFactory;
    protected $table = "categories"; //referenciando a la tabla que usaremos

    public function products() : HasMany //relación uno a muchos
    {
        return $this->hasMany(product::class); //retorna todos los productos de esa categoria
    }
}
