<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class crop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'crop_id'];

    public function children()
    {
        return $this->hasMany(crop::class, 'crop_id');
    }
}
