<?php

namespace App\Models\meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class invitation_guest extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['meeting_id','name','status'];

    public function Meeting(): BelongsTo
    {
        return $this->belongsTo(meeting::class);
    }
}
