@extends('layouts.app')

@section('content')
@if (session('success')) <div class="alert success">{{ session('success') }}</div> @endif
<div class="toolbar"><div class="page-head"><div class="eyebrow">Account management</div><h1>Customer Accounts</h1><p>Customer records managed through validated Laravel forms.</p></div><a class="button" href="{{ route('customers.create') }}">+ Add Customer</a></div>
<div class="table-wrap"><table class="data"><thead><tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Action</th></tr></thead><tbody>
@foreach ($customers as $customer)
<tr><td class="id">{{ $customer->id }}</td><td>{{ $customer->full_name }}</td><td>{{ $customer->email }}</td><td>{{ $customer->phone ?: '—' }}</td><td><a class="table-link" href="{{ route('customers.edit', $customer) }}">Edit</a></td></tr>
@endforeach
</tbody></table></div>
@endsection
