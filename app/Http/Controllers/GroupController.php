<?php

namespace App\Http\Controllers;

use App\Group;
use App\Member;
use App\Notifications\GroupInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('join');
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
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:6|max:255',
            'nickname' => 'required|string|max:255',
        ]);

        $emails = [];
        $bad_emails = [];

        $to_clean = preg_split('/(\r\n|,)/', $request->emails);
        foreach ($to_clean as $tc) {
            $tc = strtolower(trim($tc));

            if (empty($tc)) {
                continue;
            }

            // check if email appears valid
            if (!filter_var($tc, FILTER_VALIDATE_EMAIL)) {
                $bad_emails[] = $tc;
                continue;
            }

            $emails[] = $tc;
        }

        if (!empty($bad_emails)) {
            return redirect()->back()->withErrors(['bad_emails' => count($bad_emails) . ' email(s) were invalid in your list. ' . implode(',', $bad_emails)])->withInput();
        }

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'invite_code' => md5($request->name . time()),
        ]);

        // add current user as owner of group
        $member = new Member;
        $member->name = $request->nickname;
        $member->group_id = $group->id;
        $member->user_id = $request->user()->id;
        $member->type = 1;
        $member->save();

        foreach ($emails as $email) {
            // invite people through mailgun
            Notification::route('mail', $email)
                ->notify(new GroupInvite($member->name, $group->invite_code));
        }

        return redirect()->route('group.show', $group->id)->with('status', 'Group created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {

        $member = Member::where('group_id', $group->id)
            ->where('user_id', Auth::id())
            ->orderBy('type', 'asc')
            ->orderBy('created_at')
            ->first();

        return view(
            'group.show',
            [
                'group' => $group,
                'member' => $member,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view(
            'group.edit',
            [
                'group' => $group,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|min:6|max:255',
        ]);

        $group->fill($request->all())->save();

        return redirect()->route('group.show', $group->id)->with('status', 'Group settings updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }

    /**
     * Show the form for inviting users.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function invite(Group $group)
    {
        return view(
            'group.invite',
            [
                'group' => $group,
            ]
        );
    }

    /**
     * Check if the user is logged in and redirect them to login or register if they are not.
     *
     * @return \Illuminate\Http\Response
     */
    public function join($invite_code)
    {
        // check if group exists with invite code
        $group = Group::where('invite_code', $invite_code)->first();
        if (is_null($group)) {
            abort(404);
        }

        // check if user is logged in
        if (Auth::check()) {
            // check if user already has a member in the group
            $member_count = Auth::user()->members()->where('group_id', $group->id)->count();
            if ($member_count > 0) {
                return redirect()->route('group.show', $group->id)->withErrors(['already_in_group' => 'You are alread in this group']);
            }

            return view(
                'group.join',
                [
                    'group' => $group,
                ]
            );
        }

        // send user to group join page after register or login
        session(['group.join' => route('join', $invite_code)]);

        return redirect()->route('register');
    }

    /**
     * Send invites to specified emails.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function sendinvite(Request $request, Group $group)
    {
        $member = Member::where('user_id', Auth::id())
            ->where('group_id', $group->id)
            ->orderBy('created_at')
            ->first();

        $emails = [];
        $bad_emails = [];

        $to_clean = preg_split('/(\r\n|,)/', $request->emails);
        foreach ($to_clean as $tc) {
            $tc = strtolower(trim($tc));

            if (empty($tc)) {
                continue;
            }

            // check if email appears valid
            if (!filter_var($tc, FILTER_VALIDATE_EMAIL)) {
                $bad_emails[] = $tc;
                continue;
            }

            $emails[] = $tc;
        }

        if (!empty($bad_emails)) {
            return redirect()->back()->withErrors(['bad_emails' => count($bad_emails) . ' email(s) were invalid in your list. ' . implode(',', $bad_emails)])->withInput();
        }

        foreach ($emails as $email) {
            // invite people through mailgun
            Notification::route('mail', $email)
                ->notify(new GroupInvite($member->name, $group->invite_code));
        }

        return redirect()->back()->with('status', 'Members invited!');
    }
}
