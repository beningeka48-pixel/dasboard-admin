<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable =['nik', 'name', 'gender', 'brith_place', 'birth_date', 'address', 'phone_number', 'occupation', 'religion','marital_status'];
}
