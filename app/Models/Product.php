<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;//se usa para cuando es una relación uno a uno
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    use HasFactory;

    //UN PRODUCTO TIENE UNA CATEGORIA
    protected $table = "products";

    protected $fillable = ['name', 'sale_price', 'quantity', 'status', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);//retorna la categoria a la cual pertenece el producto
    }

    //UN PRODUCTO TIENE VARIAS COMPRAS
    public function buys(): BelongsToMany
    {
        return $this->belongsToMany(Buy::class);
    }

    //RELACIÓN UNO A UNO CON EL MODELO IMAGEN
    public function image() : MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    //UN PRODUCTO TIENE VARIAS VENTAS
    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class);
    }
}
