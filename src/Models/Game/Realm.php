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

    public function zones()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Zone');
    }

    public function enemies()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Enemy');
    }

    /****************
    * Attributes
    ****************/



}
