<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HousingStage extends Model
{
    protected $table = 'housing_stages';
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'housing_stage_id');
    }
}
