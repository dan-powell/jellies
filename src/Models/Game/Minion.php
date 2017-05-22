<?php

namespace DanPowell\Jellies\Models\Game;

use Illuminate\Database\Eloquent\Model;
use DanPowell\Jellies\Models\Scopes\OwnedByUserScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Minion extends Model
{

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
                $this->hp = config('jellies.minion.base_hp') + $this->types->sum('pivot.quantity');
            } else {
                $this->hp = config('jellies.minion.base_hp');
            }
        }
        return $this->hp;
    }

    public function getLevelAttribute()
    {
        return $this->types->sum('pivot.quantity') + 1;
    }

    public function getStat($stat)
    {
        return $this->calcAttribute($stat, config('jellies.minion.base_stats.' . $stat));
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

    public function getEffectiveAttribute()
    {
        $collection = collect([]);

        foreach($this->types as $key => $type) {
            if(count($type->effective)) {
                foreach($type->effective->keyBy('id') as $id => $effective) {
                    if(!$collection->contains(function ($value, $key) use ($id){
                        return $key == $id;
                    })) {
                        $collection->put($id, $effective->name);
                    }
                }
            }
        }

        return $collection;
    }

    public function getIneffectiveAttribute()
    {
        $collection = collect([]);

        foreach($this->types as $key => $type) {
            if(count($type->ineffective)) {
                foreach($type->ineffective->keyBy('id') as $id => $ineffective) {
                    if(!$collection->contains(function ($value, $key) use ($id){
                        return $key == $id;
                    })) {
                        $collection->put($id, $ineffective->name);
                    }
                }
            }
        }

        return $collection;
    }




    /****************
    * Handy Methods
    ****************/




}
