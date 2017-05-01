<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{

    protected $fillable = [
        'name',
        'encounters',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /****************
    * Relationships
    ****************/

    public function realm()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Game\Realm');
    }

    public function incursions()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Incursion');
    }

    public function enemies()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Enemy', 'zone_enemies', 'zone_id', 'enemy_id');
    }


    /****************
    * Local Scopes
    ****************/

    // public function scopeActive($query)
    // {
    //     return $query->has('minions');
    // }

    /****************
    * Attributes
    ****************/

    // public function getPointsAttribute()
    // {
    //     return $this->encounters->sum('points');
    // }
    //
    // public function getRoundsAttribute()
    // {
    //     return $this->encounters->sum('rounds');
    // }
    //
    // public function getActiveAttribute()
    // {
    //     if(count($this->minions)){
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    /****************
    * Handy Methods
    ****************/




}
