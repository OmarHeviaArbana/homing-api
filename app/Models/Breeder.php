<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Breeder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'logo_url',
        'address',
        'location',
        'description',
        'phone',
        'email_breeder',
        'certification'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
