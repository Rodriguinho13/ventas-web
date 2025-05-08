<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;//se usa para cuando es una relación uno a uno
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);//retorna la categoria a la cual pertenece el producto
    }

    public function buys(): BelongsToMany
    {
        return $this->belongsToMany(Buy::class);
    }
}
