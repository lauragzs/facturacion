<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosF extends Model
{
    use HasFactory;
    protected $table="tipo_documentos_fiscales";
    protected $primaryKey="id";
    protected $fillable=['Nombre','Descripcion','Estado'];
    protected $hidde=['id'];
    public function documentoss(){
        return $this->belongsTo(DocumentoSector::class);
    }
}
