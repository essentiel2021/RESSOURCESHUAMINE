<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Departement extends Model
{
    use HasFactory;
    use HasSlug;
    public function succursale()
    {
        return $this->belongsTo(Succursale::class);
    }
    
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('libelle')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
