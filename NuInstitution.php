<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NuInstitution extends Model
{
    protected $fillable = ['name', 'leader', 'description', 'phone', 'status'];
}
