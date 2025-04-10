<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgeCategory extends Model
{
    public $timestamps = false;

    protected $table = 'agecategories';
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'agecategory_id');
    }
}
