@extends('layouts.app')
@section('content')
<div class="form-shell"><div class="page-head"><div class="eyebrow">Customer accounts</div><h1>Edit Customer</h1><p>Update the selected customer record.</p></div>
@include('partials.form-errors')
<form class="form-card" method="POST" action="{{ route('customers.update', $customer) }}">@csrf @method('PATCH') @include('partials.customer-form')<div class="form-actions"><a class="button secondary" href="{{ route('customers') }}">Cancel</a><button class="button" type="submit">Update Customer</button></div></form></div>
@endsection
