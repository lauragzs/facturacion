<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoSector extends Model
{
    use HasFactory;
    protected $table="documentos_sectores";
    protected $primaryKey="id";
    protected $fillable=['Descripcion','Caracteristicas','Tipo_documento'];
    protected $hidde=['id'];
    public function documentosf(){
        return $this->belongsTo(DocumentosF::class, 'Tipo_documento', 'id');
    }
}
