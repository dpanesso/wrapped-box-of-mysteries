<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlistitem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'price',
        'link',
    ];

    /**
     * Get items member.
     */
    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}
