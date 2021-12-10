<?php

namespace App\Models\meeting;

use App\Models\api\surveyData;
use App\Models\Setting\post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class meeting extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = 
    [
        'baithak_id',
        'group_code',
        'subject',
        'dateBs',
        'time',
        'venue',
        'status',
        'meeting_count',
        'post_id',
        'survey_data_id',
    ];

    public function Post(): HasMany
    {
        return $this->hasMany(post::class);
    }

    public function Surveydata(): HasMany
    {
        return $this->hasMany(surveyData::class);
    }
}
