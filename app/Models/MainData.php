<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainData extends Model
{
    use HasFactory;

    protected $table = 'main_data';

    protected $guarded = [];

    // relations start
    public function mappingData()
    {
        return $this->hasMany(MappingData::class);
    }

    public function matchingDataMapping()
    {
        return $this->hasManyThrough(MatchingData::class,MatchingDataMapping::class);
    }
    // relations end
}
