<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    use HasFactory;
    protected $table = "products"; //referenciando a la tabla que usaremos

    protected $fillable = ['name', 'sale_price', 'quantity', 'status', 'category_id'];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class); //retorna la categoria a la que pertence un producto
    }

    //un producto tiene muchas compras
    public function buys(): BelongsToMany
    {
        return $this->belongsToMany(Buy::class);
    }
    //una imagen tiene un producto
    public function image() : MorphOne
    {
        return $this->morphOne(Image::class, 'imageable'); //representacion de la imagen uno a uno
    }
    //un producto tiene muchas ventas
    public function sales() : BelongsToMany
    {
        return $this->belongsToMany(Sale::class);
    }
}
