<?php

namespace App\Models\Setting;

use App\Models\api\surveyData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class gender extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name'];

    public function surveys(): HasMany
    {
        return $this->hasMany(SurveyData::class)->where('is_sync',1);
    }
}
