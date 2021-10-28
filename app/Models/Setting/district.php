<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    use HasFactory;
    
    protected $fillable = ['NepaliName','EnglishName'];
}
