@extends('layouts.app')

@section('title', $group->name)

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('group.show', $group->id) }}">{{ $group->name }}</a></li>
<li class="breadcrumb-item active" aria-current="page">Manage</li>
@endsection

@section('content')
<h1>Manage {{ $group->name }}</h1>

<h2>Group Settings</h2>
{{ Form::model($group, ['route' => ['group.update', $group->id], 'method' => 'put']) }}
    <div class="form-group">
        {{ Form::label('name', 'Group Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Group Description') }}
        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Party times, addresses, dollar limits, anything you want really', 'rows' => '3']) }}
    </div>
    {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

<hr />

<h2 id="manage-memebers">Manage Members</h2>
<h3>Permissions</h3>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Member Type</th>
            <th scope="col">Modify Group</th>
            <th scope="col">Invite/Remove Members</th>
            <th scope="col">Create Wishlist</th>
            <th scope="col">Claim WL Items</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Owner</td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
        </tr>
        <tr>
            <td>Admin</td>
            <td class="text-danger text-center"><i class="fa fa-times"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
        </tr>
        <tr>
            <td>Member</td>
            <td class="text-danger text-center"><i class="fa fa-times"></i></td>
            <td class="text-danger text-center"><i class="fa fa-times"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
            <td class="text-success text-center"><i class="fa fa-check"></i></td>
        </tr>
    </tbody>
</table>
<h3>Members</h3>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Member Type</th>
            <th scope="col" class="col-1"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($group->members as $member)
            @if ($member->type == 1)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>Owner</td>
                    <td>
                        <button class="btn btn-danger" disabled>Remove</button>
                    </td>
                </tr>
            @else
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>
                        {{ Form::model($member, ['route' => ['member.update', $member->id], 'class' => 'form-inline', 'method' => 'patch']) }}
                            {{ Form::select('type', ['2' => 'Admin', '3' => 'Member'], null, ['class' => 'form-control']) }}
                            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </td>
                    <td>
                        {{ Form::model($member, ['route' => ['member.destroy', $member->id], 'method' => 'delete']) }}
                            {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
@endsection
