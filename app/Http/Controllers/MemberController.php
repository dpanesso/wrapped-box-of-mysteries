<?php

namespace App\Http\Controllers;

use App\Group;
use App\Member;
use App\Wishlistitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('index');
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
        $group = Group::where('invite_code', $request->invite_code)->first();

        $new_member = new Member;
        $new_member->name = $request->name;
        $new_member->user_id = Auth::id();
        $new_member->group_id = $group->id;
        $new_member->type = 3;
        $new_member->save();

        return redirect()->route('group.show', $group->id)->with('status', 'Group joined');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view(
            'member.show',
            [
                'member' => $member,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'string|max:255',
            'type' => 'integer',
        ]);

        $member->fill($request->all())->save();

        return redirect()->back()->with('status', 'Member details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->back()->with('status', 'Member deleted');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_wishlist_item(Request $request, Member $member)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $item = new Wishlistitem;
        $item->member_id = $member->id;
        $item->fill($request->all());
        $item->save();

        return redirect()->route('member.show', $member->id)->with('status', 'Wishlist item added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_submember(Request $request, Member $member)
    {
        return view(
            'member.create_submember',
            [
                'member' => $member,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_submember(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $new_member = new Member;
        $new_member->name = $request->name;
        $new_member->user_id = Auth::id();
        $new_member->group_id = $member->group_id;
        $new_member->type = 3;
        $new_member->save();

        return redirect()->route('group.show', $new_member->group_id)->with('status', 'Wishlist added');
    }
}
