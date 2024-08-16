<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;
    protected $table = "images"; //a que tabla hace referencia de las migraciones

    //creando relaciones polinomicas
    public function imageable() : MorphTo
    {
        return $this->morphTo(Image::class);
    }
}
