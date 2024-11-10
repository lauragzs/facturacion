<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    use HasFactory;
    protected $table="contribuyentes";
    protected $primaryKey="id";
    protected $filliable=['Descripcion_Producto_Contribuyente', 'Precio', 'Unidad_de_Medida'];
    protected $hidde=['id'];
    
    public function productos(){
        return $this->belongsTo(Producto::class);
    }
}
