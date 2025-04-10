<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(Animal::class, 'status_id');
    }
}
