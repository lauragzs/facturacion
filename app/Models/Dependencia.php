<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    use HasFactory;
    protected $primaryKey="id";
    protected $fillable=['nombre', 'tipo', 'region'];
    protected $hidden=['id'];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
