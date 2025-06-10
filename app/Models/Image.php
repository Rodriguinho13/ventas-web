<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo; //Tabla polimorfica

class Image extends Model
{
    use HasFactory;

    protected $table = "images";
    protected $fillable = ['url'];

    public function imageable(): MorphTo //tabla polimorfica se agrega able
    {
        return $this->morphTo(Image::class);
    }
}
