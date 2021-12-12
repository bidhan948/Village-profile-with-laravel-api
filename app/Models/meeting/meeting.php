<?php

namespace App\Models\meeting;

use App\Models\api\surveyData;
use App\Models\Setting\post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class meeting extends Model
{
    use HasFactory,SoftDeletes;

    const OPERATE_MODE = 0;
    const DECISION_MODE = 1;
    const SUCCESS_MODE = 2;

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

    public function Post(): BelongsTo
    {
        return $this->belongsTo(post::class);
    }

    public function Surveydata(): BelongsTo
    {
        return $this->belongsTo(surveyData::class);
    }

    public function MeetingDetail(): HasMany
    {
        return $this->hasMany(meeting_detail::class);
    }

    public function InvitationGuest(): HasMany
    {
        return $this->hasMany(invitation_guest::class);
    }

    public function Attendance(): HasMany
    {
        return $this->hasMany(meeting_attendance::class);
    }
}
