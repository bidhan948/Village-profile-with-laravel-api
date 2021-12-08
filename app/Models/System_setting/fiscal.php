<?php

namespace App\Models\System_setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fiscal extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 0;

    use HasFactory,SoftDeletes;

    protected $fillable = ['fiscal_year','is_current'];

    public function setFiscalYear($value)
    {
        $this->attributes['fiscal_year'] = English($value);
    }
}
