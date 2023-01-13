<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeService extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "employe_service";
    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function departement()
    {
        return $this->belongsToThrough(Departement::class, Service::class);
    }

    public function succursale()
    {
        return $this->belongsToThrough(Succursale::class, Departement::class, Service::class);
    }
}
