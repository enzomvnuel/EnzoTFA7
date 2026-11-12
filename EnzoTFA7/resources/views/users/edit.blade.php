@extends('layouts.app')
@section('content')
<div class="form-shell"><div class="page-head"><div class="eyebrow">User accounts</div><h1>Edit User</h1><p>Update account details and optionally replace the profile picture.</p></div>
@include('partials.form-errors')
<form class="form-card" method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">@csrf @method('PATCH') @include('partials.user-form')
<div class="field"><label for="avatar">Profile picture <span class="optional">Optional · JPG or PNG · max 2MB</span></label><input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png">@error('avatar') <small class="field-error">{{ $message }}</small> @enderror</div>
@if ($user->avatar)<div class="current-avatar"><img src="{{ asset('storage/'.$user->avatar) }}" alt="Current avatar"><span>Current profile picture</span></div>@endif
<div class="form-actions"><a class="button secondary" href="{{ route('users') }}">Cancel</a><button class="button" type="submit">Update User</button></div></form></div>
@endsection
