@extends('layouts.app')

@section('content')
@if (session('success')) <div class="alert success">{{ session('success') }}</div> @endif
<div class="toolbar"><div class="page-head"><div class="eyebrow">Account management</div><h1>User Accounts</h1><p>User records with prepared avatar thumbnails.</p></div><a class="button" href="{{ route('users.create') }}">+ Add User</a></div>
<div class="table-wrap"><table class="data"><thead><tr><th>ID</th><th>Avatar</th><th>Username</th><th>Full Name</th><th>Action</th></tr></thead><tbody>
@foreach ($users as $user)
<tr><td class="id">{{ $user->id }}</td><td>@if ($user->avatar)<img class="avatar" src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar of {{ $user->full_name }}">@else<div class="avatar avatar-placeholder" aria-label="No avatar">{{ strtoupper(substr($user->full_name, 0, 1)) }}</div>@endif</td><td>{{ $user->username }}</td><td>{{ $user->full_name }}</td><td><a class="table-link" href="{{ route('users.edit', $user) }}">Edit</a></td></tr>
@endforeach
</tbody></table></div>
@endsection
