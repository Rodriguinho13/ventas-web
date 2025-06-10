<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buy extends Model
{
    use HasFactory;
    protected $table = "buys";

    //UNA COMPRA TIENE VARIOS PRODUCTOS
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    //UNA COMPRA PERTENECE A UN PROVEEDOR
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    //UNA COMPRA LO REALIZA UN USUARIO
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
