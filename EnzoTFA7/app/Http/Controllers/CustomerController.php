<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::query()->orderBy('id')->get();

        return view('customers', compact('customers'));
    }

    public function create(): View
    {
        return view('customers.create', ['title' => 'Add Customer']);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        Customer::create($validated);

        return redirect()->route('customers')->with('success', 'Customer account created successfully.');
    }

    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer') + ['title' => 'Edit Customer']);
    }

    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $customer->update($validated);

        return redirect()->route('customers')->with('success', 'Customer account updated successfully.');
    }
}
