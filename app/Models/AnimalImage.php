<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalImage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'animal_id',
        'image_url',
        'principal',
    ];

    public function animal() {return $this->belongsTo(Animal::class); }
}
