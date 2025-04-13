<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Favorite extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'animal_id',
        'created_at'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function animal() { return $this->belongsTo(Animal::class); }
}
