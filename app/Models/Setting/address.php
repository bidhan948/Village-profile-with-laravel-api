<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','address_id'];

    public function subAddress()
    {
        return $this->hasMany(address::class, 'address_id')->with('subAddress');
    }
}
