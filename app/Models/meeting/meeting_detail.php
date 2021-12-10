<?php

namespace App\Models\meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class meeting_detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['meeting_id', 'propsal', 'detail', 'decision'];

    public function Meeting(): BelongsTo
    {
        return $this->belongsTo(meeting::class);
    }
}
