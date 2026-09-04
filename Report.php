<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['title', 'description', 'author', 'report_date', 'category', 'status','address'];
    protected $casts = ['report_date' => 'date'];
}
