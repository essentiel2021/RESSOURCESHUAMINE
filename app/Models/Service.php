<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['libelle','departement_id'];
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    public function employes(){
        return $this->belongsToMany(Employe::class, 'employe_service', 'service_id', 'employe_id');
    }
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('libelle')
    //         ->saveSlugsTo('slug')
    //         ->doNotGenerateSlugsOnUpdate();
    // }
}
