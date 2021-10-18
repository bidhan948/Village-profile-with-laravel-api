<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class foreign_country extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name'];
}
