<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Species extends Model
{
    protected $table = 'species';
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'species_id');
    }
}
