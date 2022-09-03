<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PasswordChangeController extends Controller
{
    public function edit(): View
    {
        return view('admin.password.change');
    }

    public function update(PasswordRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $currentUser = auth()->user();
        if(Hash::check($data['oldPassword'], $currentUser->password)){
            $currentUser->update([
               'password' => bcrypt($data['newPassword']),
            ]);
            return redirect(route('admin.dashboard'))->with('success', 'Change Password successfully!');
        }else{
            return redirect(route('password.change.edit'))->with('error', 'Old password wrong insert!..');
        }
    }
}
