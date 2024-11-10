<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $table="unidades";
    protected $primaryKey="id";
    protected $fillable=['Nombre'];
    protected $hidden=['id'];
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
