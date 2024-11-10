<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table="productos";
    protected $primaryKey="id";
    protected $fillable=['cod_pcontribuyente', 'desc_pcontribuyente', 'precio', 'actividad_id','unidad_id'];
    protected $hidden=['id'];
    public function unidad(){
        return $this->belongsTo(Unidad::class);
    }
    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }
    public function factura(){
        return $this->belongsToMany(Factura::class, 'detalle_facturas');
    }
}
