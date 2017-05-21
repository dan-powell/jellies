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

    public function zone()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Game\Zone');
    }

    public function previous_zones()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Zone', 'incursion_previouszones', 'incursion_id', 'zone_id')->withTimestamps()->orderByDesc('pivot_created_at');
    }

    public function encounters()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Encounter');
    }

    public function types()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Type', 'incursion_type')->withPivot('quantity');
    }


    /****************
    * Local Scopes
    ****************/

    public function scopeActive($query)
    {
        return $query->has('minions')->has('zone');
    }

    public function scopeWaiting($query)
    {
        return $query->has('minions')->doesntHave('zone');
    }

    public function scopeDefeated($query)
    {
        return $query->doesntHave('minions');
    }

    /****************
    * Attributes
    ****************/

    public function getPointsAttribute() {
        return $this->types->sum('pivot.quantity');
    }

    public function getRoundsAttribute()
    {
        return $this->encounters->sum('rounds');
    }

    public function getActiveAttribute()
    {
        if(count($this->minions) && $this->zone){
            return true;
        } else {
            return false;
        }
    }

    public function getWaitingAttribute()
    {
        if(count($this->minions) && !$this->zone){
            return true;
        } else {
            return false;
        }
    }

    public function getDefeatedAttribute()
    {
        if(count($this->minions) < 1){
            return true;
        } else {
            return false;
        }
    }

    /****************
    * Handy Methods
    ****************/




}
