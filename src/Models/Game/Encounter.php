<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;

class Encounter extends Model
{

    protected $fillable = [
        'minions',
        'enemies',
        'log',
        'victory',
        'minion_damage',
        'enemy_damage',
        'rounds',
        'points'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /****************
    * Relationships
    ****************/

    public function incursion()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Game\Incursion');
    }

    /****************
    * Mutators
    ****************/

    public function setMinionsAttribute($value)
    {
        $this->attributes['minions'] = json_encode($value);
    }

    public function setEnemiesAttribute($value)
    {
        $this->attributes['enemies'] = json_encode($value);
    }

    public function setLogAttribute($value)
    {
        $this->attributes['log'] = json_encode($value);
    }

    /****************
    * Attributes
    ****************/

    public function getMinionsAttribute($value)
    {
        return json_decode($value);
    }

    public function getEnemiesAttribute($value)
    {
        return json_decode($value);
    }

    public function getLogAttribute($value)
    {
        return json_decode($value);
    }




    /****************
    * Handy Methods
    ****************/




}
