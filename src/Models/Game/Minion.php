<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;
use Illuminate\Database\Eloquent\SoftDeletes;

use DanPowell\Jellies\Models\Traits\CreatureAttributesTrait;

class Minion extends Model
{
    use CreatureAttributesTrait;
    use SoftDeletes;

    private $hp = null;

    /**
    * The "booting" method of the model.
    *
    * @return void
    */
    // protected static function boot()
    // {
    //     parent::boot();
    //
    //     // Only return characters that are owned by user
    //     //static::addGlobalScope(new OwnedByUserScope());
    //
    // }

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

    public function user()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\User');
    }

    public function types()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Type', 'minion_type')->withPivot('quantity');
    }

    public function incursions()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Incursion', 'incursion_minion', 'minion_id', 'incursion_id');
    }

    /****************
    * Local Scopes
    ****************/

    public function scopeAvailable($query)
    {
        return $query->doesntHave('incursions');
    }

    /****************
    * Attributes
    ****************/


    /****************
    * Handy Methods
    ****************/




}
