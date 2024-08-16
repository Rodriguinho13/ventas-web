<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;
    protected $table = "sales"; //referenciando a la tabla que usaremos

    //una venta tiene muchos productos
    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    //una venta pertenece a un cliente
    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    //una venta lo realiza un usuario
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
