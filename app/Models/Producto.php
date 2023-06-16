<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre', 'imagen', 'precio', 'descripcion', 'stock', 'estado', 'almacenamiento', 'liberacion', 'color', 'categoria_id', 'marca_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class);
    }
}
