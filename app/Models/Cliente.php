<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'razon_social', 
        'nit', 
        'email', 
        'celular', 
        'telefono', 
        'complemento', 
        'tipodoc_id'
    ];

    public function tipo_documento()
    {
        return $this->belongsTo(Tipo_documento::class, 'tipodoc_id');
    }
}
