<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /****************
    * Relationships
    ****************/

    public function types()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Type');
    }

    /****************
    * Attributes
    ****************/



}
