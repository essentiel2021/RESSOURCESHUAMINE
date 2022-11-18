<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceIdentite extends Model
{
    use HasFactory;

    protected $table = "piece_identites";

    public function employes(){
        return $this->hasMany(Employe::class);
    }
}
