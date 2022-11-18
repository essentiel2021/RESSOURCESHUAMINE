<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    public function situation(){
        return $this->belongsTo(SituationMatrimoniale::class);
    }
    public function commune(){
        return $this->belongsTo(Commune::class);
    }
    public function piece(){
        return $this->belongsTo(PieceIdentite::class);
    }
}
