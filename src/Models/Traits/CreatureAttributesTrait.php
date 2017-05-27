<?php namespace DanPowell\Jellies\Models\Traits;

trait CreatureAttributesTrait {

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
    }

    private function getHp()
    {
        if($this->hp === null) {
            if(count($this->materials())) {
                $this->hp = config('jellies.minion.base_hp') + $this->materials->sum('pivot.quantity');
            } else {
                $this->hp = config('jellies.minion.base_hp');
            }
        }
        return $this->hp;
    }

    public function getLevelAttribute()
    {
        return $this->materials->sum('pivot.quantity') + 1;
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
        foreach($this->materials as $material) {
            foreach($material->modifiers as $modifier) {
                if ($modifier->attribute == $attribute) {
                    for($i = 0; $i < $material->pivot->quantity; $i++) {
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

        foreach($this->materials as $key => $material) {
            if(count($material->effective)) {
                foreach($material->effective->keyBy('id') as $id => $effective) {
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

        foreach($this->materials as $key => $material) {
            if(count($material->ineffective)) {
                foreach($material->ineffective->keyBy('id') as $id => $ineffective) {
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
}
