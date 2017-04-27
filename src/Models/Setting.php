<?php

namespace DanPowell\Jellies\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'value',
    ];

    protected $casts = [
        'value' => 'integer',
    ];

    public $incrementing = false;

}
