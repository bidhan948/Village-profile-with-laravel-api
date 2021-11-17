<?php

namespace App\Models\api;

use App\Models\committee_post;
use App\Models\group_code;
use App\Models\Setting\district;
use App\Models\Setting\gender;
use App\Models\Setting\municipality;
use App\Models\Setting\province;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'relation_id',
        'municipality_id',
        'province_id',
        'district_id',
        'ward_id',
        'toll_name',
        'user_id',
        'gps_latitude',
        'gps_longitude',
        'remark',
        'mobile_id',
        'is_sync',
        'is_transfer'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function groupCode() : HasOne
    {
        return $this->hasOne(group_code::class);
    }
    public function gender() : BelongsTo
    {
        return $this->belongsTo(gender::class);
    }
    public function province() : BelongsTo
    {
        return $this->belongsTo(province::class,'province_id');
    }
    public function municipality() : BelongsTo
    {
        return $this->belongsTo(municipality::class);
    }
    public function district() : BelongsTo
    {
        return $this->belongsTo(district::class);
    }
    public function committee_posts(): HasMany
    {
        return $this->hasMany(committee_post::class);
    }
}
