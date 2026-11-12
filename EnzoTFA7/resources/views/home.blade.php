@extends('layouts.app')

@section('content')
<section class="hero">
    <div>
        <div class="eyebrow">Laravel forms and file uploads</div>
        <h1>EnzoTFA7 account management.</h1>
        <p>A Laravel POS application with validated customer and user forms, edit workflows, and prepared profile avatars.</p>
        <a class="button" href="{{ url('/customers') }}">View customer accounts</a>
    </div>
    <div class="hero-card"><div class="mini">SYSTEM STATUS</div><div class="metric">04</div><div class="metric-label">connected application pages</div></div>
</section>
<section class="grid">
    <div class="card"><h3>Validated forms</h3><p>Laravel rejects invalid data while preserving old input and displaying field errors.</p></div>
    <div class="card"><h3>Edit workflows</h3><p>Existing customer and user records can be loaded, edited, validated, and updated.</p></div>
    <div class="card"><h3>Safe avatars</h3><p>JPG and PNG uploads are limited to 2MB, resized to 300px, and stored on the public disk.</p></div>
</section>
@endsection
