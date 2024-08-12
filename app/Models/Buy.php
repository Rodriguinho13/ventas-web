<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buy extends Model
{
    use HasFactory;
    protected $table = "buys"; //referenciando a la tabla que usaremos

    // En una compra existen muchos productos
    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    //una compra se realiza de un proveedor
    public function provider() : BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
