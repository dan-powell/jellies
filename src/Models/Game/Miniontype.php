<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

use Utilities;

class Miniontype extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
        'attack',
        'defence',
        'initiative',
        'health',
        'cost',
    ];

    /****************
    * Relationships
    ****************/

    public function minions()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Minion');
    }

    /****************
    * Attributes
    ****************/

    // Returns just the stats of the character
    public function getStatsAttribute()
    {
        $array = [];
        foreach(config('jellies.minion.stats') as $stat) {
            $array[$stat] = round($this->$stat);
        }
        return collect($array);
    }

    public function getMaxStatValueAttribute()
    {
        return $this->stats->max();
    }

}
