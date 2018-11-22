<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
    ];

    /**
     * Get the members group.
     */
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    /**
     * Get member wishlist items.
     */
    public function wishlistitems()
    {
        return $this->hasMany('App\Wishlistitem');
    }
}
