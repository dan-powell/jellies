<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;
use Illuminate\Database\Eloquent\SoftDeletes;

use Utilities;

class Minion extends Model
{

    use SoftDeletes;

    public $health = null;

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

    /****************
    * Local Scopes
    ****************/



    /****************
    * Attributes
    ****************/

    public function getLevelAttribute()
    {
        return $this->types->sum('pivot.quantity');
    }

    public function getHealthAttribute()
    {

        if(isset($this->types) && count($this->types)) {
            $this->health = $this->types->sum('pivot.quantity');
        } else {
            $this->health = 1;
        }

        return $this->health;
    }

    public function getStat($stat)
    {
        return $this->calcAttribute($stat, 10);
    }

    // Returns just the stats of the character
    public function getStatsAttribute()
    {
        $array = [];
        foreach(config('jellies.minion.stats') as $stat) {
            $array[$stat] = round($this->getStat($stat));
        }
        return collect($array);
    }

    public function getMaxStatValueAttribute()
    {
        return $this->stats->max();
    }

    public function setHealthAttribute($value)
    {
        $this->health = $value;
    }

    public function alive()
    {
        if($this->health > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function adjustHealth($value, $subtract = true)
    {
        if($subtract) {
            $this->setHealthAttribute(max($this->health - $value, 0));
        } else {
            $this->setHealthAttribute(max($this->health + $value, 0));
        }
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
                            case '+%':
                                $change = $base + \MathHelper::percentage($modifier->value, $base);
                                break;
                            case '-%':
                                $change = $base - \MathHelper::percentage($modifier->value, $base);
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
