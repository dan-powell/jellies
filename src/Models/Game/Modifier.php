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

    public function type()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Type');
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
