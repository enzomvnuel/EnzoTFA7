@extends('layouts.app')

@section('content')
<div class="page-head"><div class="eyebrow">Project overview</div><h1>About the application</h1><p>This page explains the purpose and structure of the Laravel POS foundation.</p></div>
<div class="about-grid">
    <div class="card"><h3>What this demonstrates</h3><p>The application transfers the MVC responsibilities learned in CodeIgniter into Laravel. A route receives the request, a controller prepares the response, and a Blade view renders the page.</p></div>
    <div class="card"><h3>Temporary data source</h3><p>Customer and user records are stored as PHP arrays while the project is being built. The data layer can later be replaced with an Eloquent model and database tables.</p></div>
    <div class="card"><h3>Application pages</h3><p>Use the navigation to open the landing page, this about page, the Customer Accounts listing, and the User Accounts listing.</p></div>
    <div class="card"><h3>Technology</h3><p>Laravel, PHP, Blade templates, named routes, controllers, migration structure, and a database seeder are included.</p></div>
</div>
@endsection
