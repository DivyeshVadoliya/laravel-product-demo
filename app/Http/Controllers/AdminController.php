<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function showUser(): View
    {
        $users = User::query()
            ->simplePaginate(10, '*', 'users');
        return view('admin.user', ['users' => $users]);
    }

    public function checkLogin(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }
}
