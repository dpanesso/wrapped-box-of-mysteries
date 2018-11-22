@extends('layouts.app')

@section('title', $group->name)

@section('content')
<div class="row">
    <div class="col">
        <h1>{{ $group->name }}</h1>
    </div>
    <div class="col text-right">
        @if ($member->type <= 2)
            <a href="{{ route('group.edit', $group->id) }}" class="btn btn-secondary">
                <i class="fa fa-cog"></i>
            </a>
        @endif
    </div>
</div>
<p class="lead">
    {!! nl2br(htmlspecialchars($group->description)) !!}
</p>

@if ($member->type <= 2)
    <div class="alert alert-info" role="alert">
        Use this link to invite new people {{ route('join', $group->invite_code) }}<br />
        Or use the <a href="{{ route('group.invite', $group->id) }}">Invite Members</a> page to invite new people.
    </div>
@endif

<h2>Members</h2>

<div class="alert alert-info" role="alert">
    You can edit your wishlist by clicking on your name in the members list.
</div>

<ul class="list-group list-group-flush mb-2">
    @foreach($group->members as $m)
        <li class="list-group-item">
            <a href="{{ route('member.show', $m->id) }}">{{ $m->name }}</a>
        </li>
    @endforeach
</ul>
@if ($member->type <= 2)
    <a href="{{ route('group.edit', $group->id) }}#manage-memebers" class="btn btn-primary">Manage Members</a>
@endif
<a href="{{ route('member.create_submember', $member->id) }}" class="btn btn-primary">Add another person's wishlist</a>
@endsection
