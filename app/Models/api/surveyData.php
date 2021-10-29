<?php

namespace App\Models\api;

use App\Models\group_code;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class surveyData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'name',
        'contact_no',
        'gender_id',
        'desired_person_name',
        'realtion_id',
        'municipality_id',
        'province_id',
        'district_id',
        'ward_id',
        'toll_name',
        'gps_latitude',
        'gps_longitude',
        'remark',
        'mobile_id',
        'is_sync'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groupCode()
    {
        return $this->hasMany(group_code::class);
    }
    // protected $timestaps = false;
}
