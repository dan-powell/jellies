<?php

namespace DanPowell\Jellies\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Ui\Message');
    }

    public function minions()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Minion');
    }

    public function incursions()
    {
        return $this->hasMany('DanPowell\Jellies\Models\Game\Incursion');
    }


    /****************
    * Attributes
    ****************/




}