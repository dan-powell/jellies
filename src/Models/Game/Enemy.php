<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{

    public $hp = null;

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

    public function zone()
    {
        return $this->belongsTo('DanPowell\Jellies\Models\Game\Zone');
    }

    public function types()
    {
        return $this->belongsToMany('DanPowell\Jellies\Models\Game\Type', 'enemy_type')->withPivot('quantity');
    }

    /****************
    * Local Scopes
    ****************/



    /****************
    * Attributes
    ****************/


    public function getHealthAttribute()
    {
        return $this->getHp();
    }

    public function isAlive()
    {
        if($this->getHp() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function adjustHealth($value, $subtract = true)
    {
        if($subtract) {
            $this->setHealthAttribute(max($this->getHp() - $value, 0));
        } else {
            $this->setHealthAttribute(max($this->getHp() + $value, 0));
        }
    }

    public function setHealthAttribute($value)
    {
        $this->hp = $value;
        if($this->hp <= 0) {
            $this->delete();
        }
    }

    private function getHp()
    {
        if($this->hp === null) {
            if(count($this->types())) {
                $this->hp = 10 + $this->types->sum('pivot.quantity');
            } else {
                $this->hp = 10;
            }
        }
        return $this->hp;
    }

    public function getLevelAttribute()
    {
        return $this->types->sum('pivot.quantity');
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
                                $percentage = app('MathHelper')->percentage($modifier->value, $base);
                                $change = $base + $percentage;
                                break;
                            case '-%':
                                $change = $base - app('MathHelper')->percentage($modifier->value, $base);
                                break;
                            default:
                                $change = $base;
                        }

                        $array[] = $change - $base;

                    }
                }
            }
        }
        return max($base + array_sum($array), 0);
    }


    /****************
    * Handy Methods
    ****************/




}
