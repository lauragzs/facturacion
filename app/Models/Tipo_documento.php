<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_documento extends Model
{
    use HasFactory;
    protected $table="tipo_documentos";
    protected $primaryKey="id";
    protected $fillable=['Nombre','Codigo_doc'];
    protected $hidden=['id'];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
