<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_factura extends Model
{
    use HasFactory;
    protected $table="detalle_facturas";
    protected $primaryKey="id";
    protected $fillable=['cantidad','descuento','desc_ad','id_factura', 'id_producto'];
    protected $hidden=['id'];

    public function factura(){
        return $this->belongsToMany(Factura::class, 'detalle_facturas');
    }
}
