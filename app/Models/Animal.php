<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'weight',
        'height',
        'species_id',
        'status_id',
        'agecategory_id',
        'genre_id',
        'housing_stage_id',
        'size_id',
        'energylevel_id',
        'identifier',
        'vaccines',
        'sterilization',
        'care'
    ];

    public function species() { return $this->belongsTo(Species::class); }
    public function status() { return $this->belongsTo(Status::class); }
    public function ageCategory() { return $this->belongsTo(AgeCategory::class, 'agecategory_id'); }
    public function genre() { return $this->belongsTo(Genre::class); }
    public function housingStage() { return $this->belongsTo(HousingStage::class); }
    public function size() { return $this->belongsTo(Size::class); }
    public function energyLevel() { return $this->belongsTo(EnergyLevel::class, 'energylevel_id'); }
    public function favorites() {return $this->hasMany(Favorite::class); }
    public function images() { return $this->hasMany(AnimalImage::class); }

}
