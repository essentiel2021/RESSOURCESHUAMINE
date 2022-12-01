<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function situation(){
        return $this->belongsTo(SituationMatrimoniale::class,"situation_matrimoniale_id","id");
    }
    public function commune(){
        return $this->belongsTo(Commune::class,"commune_id","id");
    }
    public function piece(){
        return $this->belongsTo(PieceIdentite::class,"piece_identite_id","id");
    }
}
