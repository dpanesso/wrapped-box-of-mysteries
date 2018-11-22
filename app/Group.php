<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'invite_code',
        'name',
    ];

    /**
     * Get the members that belong to group.
     */
    public function members()
    {
        return $this->hasMany('App\Member');
    }
}
