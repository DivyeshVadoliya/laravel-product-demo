<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function showUser(): View
    {
        $users = User::query()
            ->simplePaginate(10, '*', 'users');
        return view('admin.user', ['users' => $users]);
    }

    public function login(): View
    {
        return view('admin.login');
    }

    public function checkLogin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    public function createUserForm(): View
    {
        return view('admin.register');
    }

    public function createUser(CreateUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        User::query()->create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Create user Successfully !..');
    }
}
