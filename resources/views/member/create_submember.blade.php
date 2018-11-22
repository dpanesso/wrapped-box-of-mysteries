@extends('layouts.app')

@section('title', 'Add Member - ' . $member->group->name)

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('group.show', $member->group->id) }}">{{ $member->group->name }}</a></li>
<li class="breadcrumb-item active" aria-current="page">Add Member's Wishlist</li>
@endsection

@section('content')
<h1>Add Another Person's Wishlist</h1>
<p class="lead">
    This page is ment to add members to the group who can not create an account. This includes children and people who do not own a computer.
</p>

{{ Form::open(['route' => ['member.store_submember', $member->id]]) }}
    <div class="form-group">
        {{ Form::label('name', 'Wishlist Member\'s Name') }}
        {{ Form::text('name', null, ['class' => 'form-control', 'autofocus' => '']) }}
    </div>
    {{ Form::submit('Add Member', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection
