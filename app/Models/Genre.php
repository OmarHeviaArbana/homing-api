<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    protected $table = 'genres';
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'genre_id');
    }
}
