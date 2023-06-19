<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    use HasFactory;

    public function persona(){
        return $this->belongsTo(Persona::class, 'id_persona', 'id');
    }
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
