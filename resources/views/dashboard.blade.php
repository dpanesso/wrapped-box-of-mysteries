@extends('layouts.app')

@section('title', 'Wrapped Box of Mysteries')

@section('content')
<h1>Dashboard</h1>

<div class="row mb-4">
    <div class="col">
        <h2>Groups</h2>
        @if ($groups->isEmpty())
            <div class="alert alert-info" role="alert">
                You are not in any groups yet. Ask your group leader for a link to join a group or create your own.
            </div>
        @else
            <table class="table">
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>
                                <a href="{{ route('group.show', $group->id) }}">{{ $group->name }}</a>
                            </td>
                            <td>{{ $group->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="/group/create" class="btn btn-primary">Create Group</a>
    </div>
</div>

<hr />

<div class="row">
    <div class="col">
        <h2>Claimed Gifts</h2>
        @if ($claimed_wishlistitems->isEmpty())
            <div class="alert alert-info" role="alert">
                You have not claimed any gifts yet! Join some groups and help spread some cheer.
            </div>
        @else
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Group</th>
                        <th scope="col">Member</th>
                        <th scope="col">Description</th>
                        <th scope="col">Approx Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($claimed_wishlistitems as $item)
                        <tr>
                            <td>
                                <a href="{{ route('group.show', $item->member->group->id) }}">{{ $item->member->group->name }}</a>
                            </td>
                            <td>
                                <a href="{{ route('member.show', $item->member->id) }}">{{ $item->member->name }}</a>
                            </td>
                            <td>
                                @if ($item->link)
                                    <a href="{{ $item->link }}" target="_blank">
                                        {{ $item->description }}
                                    </a>
                                @else
                                    {{ $item->description }}
                                @endif
                            </td>
                            <td>
                                {{ $item->price }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
    </div>
</div>
@endsection
