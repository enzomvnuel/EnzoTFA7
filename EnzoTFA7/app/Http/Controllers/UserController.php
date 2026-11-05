<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->orderBy('id')->get();

        return view('users', compact('users'));
    }

    public function create(): View
    {
        return view('users.create', ['title' => 'Add User']);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:80', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
        ]);

        User::create($validated);

        return redirect()->route('users')->with('success', 'User account created successfully.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user') + ['title' => 'Edit User']);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:80', 'unique:users,username,'.$user->id],
            'full_name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        unset($validated['avatar']);

        if ($request->hasFile('avatar')) {
            $newPath = 'avatars/'.uniqid('avatar_', true).'.jpg';
            $absolutePath = storage_path('app/public/'.$newPath);
            Storage::disk('public')->makeDirectory('avatars');
            Image::read($request->file('avatar'))
                ->cover(300, 300)
                ->toJpeg(85)
                ->save($absolutePath);

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $newPath;
        }

        $user->update($validated);

        return redirect()->route('users')->with('success', 'User account updated successfully.');
    }
}
