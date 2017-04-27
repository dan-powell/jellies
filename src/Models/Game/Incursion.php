<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;

class Incursion extends Model
{

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
        'running',
        'points',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /****************
    * Relationships
    ****************/

    public function minions()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Minion', 'incursion_minion', 'incursion_id', 'minion_id');
    }

    public function user()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\User');
    }

    public function encounters()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Encounter');
    }


    /****************
    * Local Scopes
    ****************/

    public function scopeActive($query)
    {
        return $query->has('minions');
    }

    /****************
    * Attributes
    ****************/

    public function getPointsAttribute()
    {
        return $this->encounters->sum('points');
    }

    public function getRoundsAttribute()
    {
        return $this->encounters->sum('rounds');
    }

    public function getActiveAttribute()
    {
        if(count($this->minions)){
            return true;
        } else {
            return false;
        }
    }

    /****************
    * Handy Methods
    ****************/




}
