<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;
use Illuminate\Database\Eloquent\SoftDeletes;

use Utilities;

class Minion extends Model
{

    use SoftDeletes;

    /**
    * The "booting" method of the model.
    *
    * @return void
    */
    protected static function boot()
    {
        parent::boot();

        // Only return characters that are owned by user
        static::addGlobalScope(new OwnedByUserScope());
    }

    protected $fillable = [
        // Details
        'name',

        // Stats
        'attack',
        'defence',
        'initiative',
        'health',

        'hp',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
        'level',
    ];

    /****************
    * Relationships
    ****************/

    public function user()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\User');
    }

    public function miniontype()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Game\Miniontype');
    }

    public function incursions()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Incursion', 'incursion_minion', 'minion_id', 'incursion_id');
    }

    /****************
    * Local Scopes
    ****************/

    public function scopeAvailable($query)
    {
        return $query->doesntHave('incursions');
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

    public function getLevelAttribute()
    {
        $stats = $this->getStatsAttribute();
        return $stats->sum();
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

    public function getPointsAttribute()
    {
        return 1;
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

    public function getActiveAttribute()
    {
        $incursions = $this->incursions;

        foreach($incursions as $incursion) {
            if($incursion->active) {
                return true;
            }
        }
        return false;
    }

    /****************
    * Handy Methods
    ****************/




}
