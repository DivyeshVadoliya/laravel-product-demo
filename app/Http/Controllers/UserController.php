<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(): View
    {
        $users = User::query()
            ->simplePaginate(10, '*', 'users');
        return view('admin.user.list', ['users' => $users]);
    }

    public function create(): View
    {
        return view('admin.user.form');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        User::query()->create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Create user Successfully !..');
    }
}
