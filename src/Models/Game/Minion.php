<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;
use Illuminate\Database\Eloquent\SoftDeletes;

use Utilities;

class Minion extends Model
{

    use SoftDeletes;

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
    //     static::addGlobalScope(new OwnedByUserScope());
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

    /****************
    * Local Scopes
    ****************/



    /****************
    * Attributes
    ****************/

    // Returns just the stats of the character
    public function getStatsAttribute()
    {
        $array = [];
        foreach(config('jellies.minion.stats') as $stat) {
            $array[$stat] = round($this->$stat);
        }
        return collect($array);
    }

    public function getMaxStatValueAttribute()
    {
        return $this->stats->max();
    }

    public function getLevelAttribute($value)
    {
        return $this->types->sum('pivot.quantity');
    }

    public function getAttackAttribute()
    {
        return $this->calcAttribute('attack', 10);
    }

    public function getDefenceAttribute()
    {
        return $this->calcAttribute('defence', 10);
    }

    public function getInitiativeAttribute()
    {
        return $this->calcAttribute('initiative', 10);
    }

    private function calcAttribute($attribute, $base = 1) {
        $array = [];
        foreach($this->types as $type) {
            foreach($type->modifiers as $modifier) {
                if ($modifier->attribute == $attribute) {
                    for($i = 0; $i < $type->pivot->quantity; $i++) {
                        switch ($modifier->adjustment) {
                            case '+':
                                $change = $base + $modifier->value;
                                break;
                            case '-':
                                $change = $base - $modifier->value;
                                break;
                            case '*':
                                $change = $base * $modifier->value;
                                break;
                            case '/':
                                $change = $base / $modifier->value;
                                break;
                            default:
                                $change = $base;
                        }

                        $array[] = $change - $base;

                    }
                }
            }
        }
        return $base + array_sum($array);
    }


    /****************
    * Handy Methods
    ****************/




}
