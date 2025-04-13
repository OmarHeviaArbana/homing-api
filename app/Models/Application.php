<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'reason',
        'housing_stage_id',
        'animal_id',
        'user_id',
        'shelter_id',
        'breeder_id',
    ];

    public function user(){ return $this->belongsTo(User::class); }
    public function animal() { return $this->belongsTo(Animal::class); }
    public function shelter() { return $this->belongsTo(Shelter::class); }
    public function breeder() { return $this->belongsTo(Breeder::class); }
    public function housingStage() { return $this->belongsTo(HousingStage::class); }
}
