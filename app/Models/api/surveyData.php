<?php

namespace App\Models\api;

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
        'municipal_id',
        'province_id',
        'ward_id',
        'toll_name',
        'gps_latitude',
        'gps_longitude',
        'remark',
        'group_code',
    ];
}
