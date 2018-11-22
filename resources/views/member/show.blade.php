@extends('layouts.app')

@section('title', $member->name . '\'s Wishlist')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('group.show', $member->group->id) }}">{{ $member->group->name }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $member->name }}</li>
@endsection

@section('content')
<h2>Wishlist</h2>

@if ($member->wishlistitems->isEmpty())
    @if (Auth::id() == $member->user_id)
        <div class="alert alert-danger" role="alert">
            You don't have a wishlist yet. Add an item to your wishlist below.
        </div>
    @else
        <div class="alert alert-info" role="alert">
            This user does not have a wishlist yet.
        </div>
    @endif
@else
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Description</th>
                <th scope="col">Approx Price</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($member->wishlistitems as $item)
                <tr>
                    <td>
                        @if(!empty($item->link))
                            <a href="{{ $item->link }}" target="_blank">
                        @endif
                        {!! nl2br(htmlspecialchars($item->description)) !!}
                        @if(!empty($item->link))
                            </a>
                        @endif
                    </td>
                    <td>{{ $item->price }}</td>
                    <td>
                        @if (Auth::id() != $member->user_id)
                            @if (!is_null($item->claimed_user_id))
                                @if ($item->claimed_user_id == Auth::id())
                                    {{ Form::model($item, ['route' => ['wishlistitem.update', $item->id], 'method' => 'patch']) }}
                                    {{ Form::hidden('claimed_user_id', '') }}
                                    {{ Form::submit('Unclaim', ['class' => 'btn btn-secondary']) }}
                                    {{ Form::close() }}
                                @else
                                    {{ Form::model($item, ['route' => ['wishlistitem.update', $item->id], 'method' => 'patch']) }}
                                    {{ Form::submit('Claimed', ['class' => 'btn btn-secondary', 'disabled']) }}
                                    {{ Form::close() }}
                                @endif
                            @else
                                {{ Form::model($item, ['route' => ['wishlistitem.update', $item->id], 'method' => 'patch']) }}
                                {{ Form::hidden('claimed_user_id', Auth::id()) }}
                                {{ Form::submit('Claim', ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if (Auth::id() == $member->user_id)
    <hr />

    <h2>Add Wishlist Item</h2>
    {{ Form::open(['route' => ['member.store_wishlist_item', $member->id]]) }}
        <div class="form-group">
            {{ Form::label('description', 'Item Description') }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) }}
        </div>
        <div class="form-group">
            {{ Form::label('price', 'Approximate Price (optional)') }}
            {{ Form::text('price', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('link', 'Link (optional)') }}
            {{ Form::text('link', null, ['class' => 'form-control']) }}
        </div>
        {{ Form::submit('Add Item', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endif
@endsection
