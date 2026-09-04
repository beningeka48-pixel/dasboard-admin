<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NuActivity extends Model
{
    protected $fillable = ['title', 'description', 'category', 'activity_date', 'location', 'organizer', 'status', 'image'];
}
