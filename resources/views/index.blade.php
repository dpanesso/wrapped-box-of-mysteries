@extends('layouts.app')

@section('title', 'Wrapped Box Of Mysteries')

@section('content')
<h2>What is Wrapped Box of Mysteries?</h2>
<p>
    Wrapped Box of Mysteries is a website where you can create groups of friends and family!<br />
    Then create and add to your wishlist. Adding a wishlist allows your friends and family to claim gifts off your wishlist.<br />
    It is the easiest way to coordinate gift wishlists!
</p>

<h2>How to get started</h2>
<ol>
    <li><a href="{{ route('register') }}">Register</a> an account</li>
    <li>Create a group</li>
    <li>Invite friends and family</li>
    <li>Create a wishlist</li>
    <li>Claim gifts off others wishlists</li>
</ol>
@endsection
