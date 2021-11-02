<?php

namespace App\Models;

use App\Models\api\surveyData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class survey_transfer_detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['from', 'to', 'survey_data_id', 'remarks', 'contact_no', 'user_id'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function surveyData(): BelongsTo
    {
        return $this->belongsTo(surveyData::class);
    }
}
