@extends('layouts.app')

@section('title', 'Create Group')

@section('content')
<h1>Create Group</h1>

{{ Form::open(['route' => 'group.store']) }}
    <div class="form-group">
        {{ Form::label('name', 'Group Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('nickname', 'Your Nickname') }}
        {{ Form::text('nickname', null, ['class' => 'form-control']) }}
        <small class="form-text text-muted">This should be a name people in your group will recognize you by</small>
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Group Description') }}
        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Party times, addresses, dollar limits, anything you want really', 'rows' => '3']) }}
    </div>
    <div class="form-group">
        {{ Form::label('emails', 'Email addresses of people to invite. Put a comma between each email address or put each email address on a separate line.') }}
        {{ Form::textarea('emails', null, ['class' => 'form-control', 'placeholder' => 'Party times, addresses, dollar limits, anything you want really', 'rows' => '3']) }}
    </div>
    {{ Form::submit('Create Group', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection
