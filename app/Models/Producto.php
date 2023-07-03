<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = ['nombre', 'precio', 'color', 'stock', 'imagen', 'descripcion', 'estado_id', 'marca_id', 'capacidad_id', 'categoria_id', 'liberacion_id'];
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    public function capacidad()
    {
        return $this->belongsTo(Capacidad::class, 'capacidad_id');
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function liberacion()
    {
        return $this->belongsTo(Liberacion::class, 'liberacion_id');
    }
}