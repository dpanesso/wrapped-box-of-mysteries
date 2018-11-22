@extends('layouts.app')

@section('title', $group->name)

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('group.show', $group->id) }}">{{ $group->name }}</a></li>
<li class="breadcrumb-item active" aria-current="page">Invite Members</li>
@endsection

@section('content')
<h1>Invite Members</h1>

{{ Form::open(['route' => ['group.invite', $group->id]]) }}
    <div class="form-group">
        {{ Form::label('emails', 'Email addresses of people to invite. Put a comma between each email address or put each email address on a separate line.') }}
        {{ Form::textarea('emails', null, ['class' => 'form-control', 'placeholder' => 'Party times, addresses, dollar limits, anything you want really', 'rows' => '3']) }}
    </div>
    {{ Form::submit('Invite People', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection
