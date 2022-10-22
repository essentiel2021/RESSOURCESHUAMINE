<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    public function fonction ()
    {
        return $this->belongsTo(Fonction::class);
    }
    public function employe()
    {
        return $this->belongsTo(SituationMatrimoniale::class);
    }
    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}
