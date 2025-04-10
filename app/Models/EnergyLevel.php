<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnergyLevel extends Model
{
    protected $table = 'energy_levels';
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'energylevel_id');
    }
}
