<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituationMatrimoniale extends Model
{
    use HasFactory;
    protected $table= "situation_matrimoniales";
    
    public function employes(){
        return $this->hasMany(Employe::class);
    }
}
