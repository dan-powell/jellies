<?php

namespace DanPowell\Jellies\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OwnedByUserScope implements Scope
{

    private $intermediary;

    public function __construct($intermediary = null)
    {
        $this->intermediary = $intermediary;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(auth()->user()) {
            if($this->intermediary) {
                $builder->whereHas($this->intermediary, function ($builder) {
                    $builder->whereHas('user', function ($query) {
                        $query->where('id', '=', auth()->user()->id);
                    });
                });
            } else {
                $builder->whereHas('user', function ($query) {
                    $query->where('id', '=', auth()->user()->id);
                });
            }
        } else {
            
        }
    }
}
