@extends('layouts.app')
@section('content')
<div class="form-shell"><div class="page-head"><div class="eyebrow">Customer accounts</div><h1>Add Customer</h1><p>Create a new customer record. Required fields are checked before saving.</p></div>
@include('partials.form-errors')
<form class="form-card" method="POST" action="{{ route('customers.store') }}">@csrf @include('partials.customer-form')<div class="form-actions"><a class="button secondary" href="{{ route('customers') }}">Cancel</a><button class="button" type="submit">Save Customer</button></div></form></div>
@endsection
