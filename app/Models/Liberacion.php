<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liberacion extends Model
{
    use HasFactory;
    protected $table = 'liberaciones';

    protected $fillable = [
        'nombre'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'liberacion_id');
    }
}
