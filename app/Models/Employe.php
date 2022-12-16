<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function serviceEmploye(){
        return $this->hasMany(EmployeService::class);
    }
    public function situation(){
        return $this->belongsTo(SituationMatrimoniale::class,"situation_matrimoniale_id","id");
    }
    public function commune(){
        return $this->belongsTo(Commune::class,"commune_id","id");
    }
    public function piece(){
        return $this->belongsTo(PieceIdentite::class,"piece_identite_id","id");
    }
    public function services(){
        return $this->belongsToMany(Service::class, 'employe_service', 'employe_id', 'service_id');
    }
}
