<?php

namespace DanPowell\Jellies\Models\Ui;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{

    use SoftDeletes;

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
        'subject',
        'message',
        'action_name',
        'action_url',
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
