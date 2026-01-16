<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status', 'message'];

    public function getFormattedUpdatedAtAttribute(): string
    {
        return Carbon::parse($this->updated_at)->setTimezone('Europe/Stockholm')->translatedFormat('j F Y \k\l. H:i');
    }
}
