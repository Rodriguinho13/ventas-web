<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $table = "products"; //referenciando a la tabla que usaremos

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class); //retorna la categoria a la que pertence un producto
    }

    //un producto tiene muchas compras
    public function buys(): BelongsToMany
    {
        return $this->belongsToMany(Buy::class);
    }
}
