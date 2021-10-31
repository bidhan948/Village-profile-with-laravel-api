<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSubmit;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('report.user', compact('users'));
    }

    public function store(UserSubmit $request): RedirectResponse
    {
        user::create($request->validated());
        toast('प्रयोगकर्ता थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(user $user): View
    {
        $users = user::all();
        return view('report.user', compact('user', 'users'));
    }

    public function update(Request $request, user $user): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user)]
        ]);
        toast('प्रयोगकर्ता सच्याउन सफल भयो ', 'success');
        $user->update($validate);
        return redirect()->route('user.index');
    }

    public function show(user $user): View
    {
        $users = User::all();
        $p_user = $user;
        return view('report.user', compact('p_user', 'users'));
    }

    public function switchStatus(user $user): RedirectResponse
    {
        $message = $user->is_active ? 'प्रयोगकर्ता निस्क्रिय हुन सफल भयो' : 'प्रयोगकर्ता सक्रिय हुन सफल भयो';
        $user->update(['is_active' => $user->is_active ? 0 : 1]);
        toast($message, 'success');
        return redirect()->back();
    }
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);
        if (Hash::check($request->password, $user->password)) {
            Alert::error('पासवोर्ड पहिलानै प्रयोग गरिएको छ ');
            return redirect()->back();
        }
        $user->update(['password' => Hash::make($request->password)]);
        toast('प्रयोगकर्ताको पासवोर्ड सच्याउन सफल भयो ', 'success');
        return redirect()->route('user.index');
    }
}
