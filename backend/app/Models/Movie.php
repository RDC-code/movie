<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating; // Add this line to import the Rating model

class Movie extends Model
{
    use HasFactory; // Add this if you're using model factories

    protected $fillable = ['title', 'description', 'thumbnail', 'link'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
