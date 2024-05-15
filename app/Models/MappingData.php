<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingData extends Model
{
    use HasFactory;

    protected $table = 'mapping_data';

    protected $guarded = [];

    // relations start
    public function mainData()
    {
        return $this->belongsTo(MainData::class);
    }

    public function matchingData()
    {
        return $this->hasMany(MatchingData::class);
    }
    // relations end
}
