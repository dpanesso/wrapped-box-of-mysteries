<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get members that belong to the user.
     */
    public function members()
    {
        return $this->hasMany('App\Member');
    }

    /**
    * Get groups the users members blong to.
    */
    public function groups()
    {
        return $this->belongsToMany('App\Group', 'members');
    }

    /**
    * Get wishlist items claimed by user.
    */
    public function wishlistitems()
    {
        return $this->hasMany('App\Wishlistitem', 'claimed_user_id');
    }
}
