<?php

namespace App\Models\meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class invitation_guest extends Model
{
    use HasFactory,SoftDeletes;

    const INVITED = 0;
    const SPECIAL_INVITED = 1;
    const OTHER = 2;

    protected $fillable = ['meeting_id','name','status','contact_no'];

    public function Meeting(): BelongsTo
    {
        return $this->belongsTo(meeting::class);
    }
}
