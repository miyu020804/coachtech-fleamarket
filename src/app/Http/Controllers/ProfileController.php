<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user =
            Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $user->load('address');
        return view('mypage.profile.edit', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $user->avatar_path =
                $request->file('avatar')->store('avatars', 'public');
        }
        $user->save();
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'postal_code',
                'address_line1',
                'address_line2'
            ])
        );
        return redirect()->route('items.index');
    }
}
