<?php

namespace DanPowell\Jellies\Models\Ui;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;

class Message extends Model
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
        static::addGlobalScope(new OwnedByUserScope());
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'type',
        'read'
    ];


    protected $casts = [
        'read' => 'boolean'
    ];

    /****************
     * Relationships
     ****************/

    public function user()
	{
		return $this->belongsTo('DanPowell\Jellies\Models\User');
	}

    /****************
    * Attributes
    ****************/

    // Returns just the stats of the character
    // public function getResourcesAttribute()
    // {
    //     $array = [];
    //     foreach(config('group.resources') as $resource) {
    //         $array[$resource] = $this->$resource;
    //     }
    //     return collect($array);
    // }


}
