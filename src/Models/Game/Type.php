<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    public $timestamps = false;

    protected $fillable = [
        // Details
        'name',
    ];

    protected $dates = [

    ];

    protected $appends = [

    ];

    /****************
    * Relationships
    ****************/

    public function effective()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Type', 'type_effective', 'type_id', 'against_id');
    }

    public function ineffective()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Type', 'type_ineffective', 'type_id', 'against_id');
    }

    public function modifiers()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Modifier');
    }

    /****************
    * Local Scopes
    ****************/


    /****************
    * Attributes
    ****************/



    /****************
    * Handy Methods
    ****************/




}
