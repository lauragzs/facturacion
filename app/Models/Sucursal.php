<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table="sucursales";
    protected $primaryKey="id";
    protected $fillable=['Nombre','Ubicacion'];
    protected $hidde=['id'];
}
