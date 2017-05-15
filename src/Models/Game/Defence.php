<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;

class Defence extends Model
{

    protected $fillable = [
        'successful',
        'log',
        'minion'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [

    ];

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

    /****************
    * Relationships
    ****************/

    public function user()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\User');
    }

    public function attacker()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\User');
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
