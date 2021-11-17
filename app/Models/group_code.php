<?php

namespace App\Models;

use App\Models\api\surveyData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class group_code extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'survey_data_id', 'remarks', 'people_count', 'samuha_count'];

    public function surveyData(): BelongsTo
    {
        return $this->belongsTo(surveyData::class);
    }
}
