@extends('layouts.app')

@section('title', 'Join ' . $group->name)

@section('content')
<h1>Join Group</h1>

{{ Form::open(['route' => 'member.store']) }}
    {{ Form::hidden('invite_code', $group->invite_code) }}
    <div class="form-group">
        {{ Form::label('name', 'Your Nickname') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        <small class="form-text text-muted">This should be a name people in your group will recognize you by</small>
    </div>
    {{ Form::submit('Join Group', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection
