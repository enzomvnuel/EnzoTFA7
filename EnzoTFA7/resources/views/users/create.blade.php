@extends('layouts.app')
@section('content')
<div class="form-shell"><div class="page-head"><div class="eyebrow">User accounts</div><h1>Add User</h1><p>Create a new user account with a unique username.</p></div>
@include('partials.form-errors')
<form class="form-card" method="POST" action="{{ route('users.store') }}">@csrf @include('partials.user-form')<div class="form-actions"><a class="button secondary" href="{{ route('users') }}">Cancel</a><button class="button" type="submit">Save User</button></div></form></div>
@endsection
