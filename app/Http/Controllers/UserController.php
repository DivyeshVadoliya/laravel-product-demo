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

        return redirect()->route('user.show')
            ->with('success', 'Create user Successfully !..');
    }

    public function edit(User $user): View
    {
        return view('admin.user.form', ['user' => $user]);
    }

    public function update(CreateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        ($data['password'] == null) ?
            $data['password'] = $user->password :
            $data['password'] = Hash::make($request->password);

        $user->update($data);
        return redirect()->route('user.show')
            ->with('massage', 'User Updated successfully!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('user.show')
            ->with('massage', 'User deleted successfully!');
    }
}
