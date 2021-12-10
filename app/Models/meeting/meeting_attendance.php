<?php

namespace App\Models\meeting;

use App\Models\api\surveyData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class meeting_attendance extends Model
{
    use HasFactory,SoftDeletes;

    const PRESENT = 1;
    const ABSENT = 0;

    protected $fillable = ['survey_data_id','meeting_id','is_present'];


    public function Meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function Surveydata(): BelongsTo
    {
        return $this->belongsTo(surveyData::class);
    }
}
