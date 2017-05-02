<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;

class Encounter extends Model
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
        static::addGlobalScope(new OwnedByUserScope('incursion'));
    }

    protected $fillable = [
        'minions_before',
        'minions_after',
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

    public function zone()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Game\Zone');
    }

    /****************
    * Mutators
    ****************/

    public function setMinionsBeforeAttribute($value)
    {
        $this->attributes['minions_before'] = json_encode($value);
    }

    public function setMinionsAfterAttribute($value)
    {
        $this->attributes['minions_after'] = json_encode($value);
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

    public function getMinionsBeforeAttribute($value)
    {
        return json_decode($value);
    }

    public function getMinionsAfterAttribute($value)
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
