<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'size_id');
    }
}
