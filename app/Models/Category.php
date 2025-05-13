<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";//tabla a la que se hace referencia de la base de datos

    public function products(): HasMany //Una categoria tiene muchos productos
    {
        return $this->hasMany(Product::class); //retorna todos los productos de esa categoria
    }

}
