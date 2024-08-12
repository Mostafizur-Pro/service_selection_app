@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <h1 class="display-4">Welcome to the Service Selection App</h1>
    <p class="lead">Manage services and users, and perform service selection tasks easily.</p>
    <a class="btn btn-primary btn-lg" href="{{ url('/services') }}" role="button">Manage Services</a>
    <a class="btn btn-secondary btn-lg" href="{{ url('/users') }}" role="button">Manage Users</a>
</div>
@endsection