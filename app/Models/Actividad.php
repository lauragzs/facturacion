<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $table="actividades";
    protected $primaryKey="id";
    protected $fillable=['Codigo_Producto_SIN', 'Codigo_Actividad_CAEB', 'Descripcion_o_producto_SIN'];
    protected $hidden=['id'];
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
