<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
        $user = User::where('username', $username)->first();

        if (! $user) {
            abort(404);
        }

        $statuses = $user->statuses()->notReply()->get();
        $authUserIsFriend = Auth::user()->isFriendsWith($user);

        return view('profile.index', compact('user', 'statuses', 'authUserIsFriend'));
    }

    public function getEdit()
    {
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'alpha|max:50',
            'last_name'  => 'alpha|max:50',
            'location'   => 'max:20'
        ]);

        Auth::user()->update([
            'first_name' => $validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            'location'   => $validatedData['location']
        ]);

        return redirect()->route('profile.edit')
            ->with('info', 'Your profile has been updated');
    }
}
