<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchingData extends Model
{
    use HasFactory;

    protected $table = 'matching_data';

    protected $guarded = [];

    // relations start
    public function matchingDataMapping()
    {
        return $this->hasMany(MatchingDataMapping::class);
    }
    // relations end
}
