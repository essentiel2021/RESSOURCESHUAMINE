<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(TypeContrat::class);

    }
    public function employe(){
        return $this->belongsTo(Employe::class);
    }
}
