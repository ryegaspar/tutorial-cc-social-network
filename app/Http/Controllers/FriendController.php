<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index', compact('friends', 'requests'));
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if (! $user) {
            return redirect()
                ->route('home')
                ->with('info', 'That user could not be found');
        }

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()->route('profile.index', ['username' => $user->username])
                ->with('info', 'Friend request already pending.');
        }

        if (Auth::user()->isFriendsWith($user)) {
            return redirect()->route('profile.index', ['username' => $user->username])
                ->with('info', 'You are already friends');
        }

        Auth::user()->addFriend($user);

        return redirect()
            ->route('profile.index', ['username' => $user->username])
            ->with('info', 'Friend request sent');
    }
}
