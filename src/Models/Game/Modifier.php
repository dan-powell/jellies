<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{

    public $timestamps = false;

    protected $fillable = [
        // Details
        'attribute',
        'adjustment',
        'value'
    ];

    protected $dates = [

    ];

    protected $appends = [

    ];

    /****************
    * Relationships
    ****************/

    public function material()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Material');
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
