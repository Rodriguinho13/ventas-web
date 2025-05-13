<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;
    protected $table = "sales";

    //Una venta pertenece un cliente
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    //una venta tiene varios productos
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    //UNA VENTA LO REALIZA UN USUARIO
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
