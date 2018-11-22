<?php

namespace App\Http\Controllers;

use App\Wishlistitem;
use Illuminate\Http\Request;

class WishlistitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wishlistitem  $wishlistitem
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlistitem $wishlistitem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wishlistitem  $wishlistitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlistitem $wishlistitem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wishlistitem  $wishlistitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlistitem $wishlistitem)
    {
        $wishlistitem->claimed_user_id = $request->claimed_user_id;
        $wishlistitem->save();

        $message = $request->claimed_user_id ? 'Wishlist item claimed' : 'Wishlist item updated';

        return redirect()->back()->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlistitem  $wishlistitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlistitem $wishlistitem)
    {
        //
    }
}
