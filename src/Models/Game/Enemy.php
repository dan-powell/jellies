<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

use DanPowell\Jellies\Models\Traits\CreatureAttributesTrait;

class Enemy extends Model
{

    use CreatureAttributesTrait;

    public $hp = null;

    protected $fillable = [
        // Details
        'name',
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

    public function zone()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Game\Zone');
    }

    public function types()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Type', 'enemy_type')->withPivot('quantity');
    }

    /****************
    * Local Scopes
    ****************/



    /****************
    * Attributes
    ****************/

    public function setHealthAttribute($value)
    {
        $this->hp = $value;
    }


    /****************
    * Handy Methods
    ****************/




}
