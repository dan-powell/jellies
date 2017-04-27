<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{

    protected $table = 'enemies';

    protected $fillable = [
        'name',

        'attack',
        'defence',
        'initiative',
        'health',

        'hp'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'level',
        'stats'
    ];

    /****************
    * Attributes
    ****************/

    // Returns just the stats of the character
    public function getStatsAttribute()
    {
        $array = [];
        foreach(config('jellies.enemy.stats') as $stat) {
            $array[$stat] = round($this->$stat);
        }
        return collect($array);
    }

    public function getMaxStatValueAttribute()
    {
        return $this->stats->max();
    }

    public function getLevelAttribute()
    {
        $stats = $this->getStatsAttribute();
        return $stats->sum();
    }

    public function getPointsAttribute()
    {
        return round($this->level / 10);
    }

    // Returns HP limited by the maximum
    public function getHpAttribute($value)
    {
        $hp = min($value, $this->health);

        if($hp < 0) {
            return 0;
        } else {
            return $hp;
        }

    }

    public function getInjuredAttribute()
    {
        if ($this->hp < $this->health/4) {
            return true;
        } else {
            return false;
        }
    }

    public function getAliveAttribute()
    {
        if ($this->hp > 0) {
            return true;
        } else {
            return false;
        }
    }

}
