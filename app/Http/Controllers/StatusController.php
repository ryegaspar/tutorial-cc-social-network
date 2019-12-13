<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|max:1000',
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        return redirect()
            ->route('home')
            ->with('info', 'Status posted');
    }

    public function postReply(Request $request, $statusId)
    {
        $validatedData = $request->validate([
            "reply-{$statusId}" => 'required|max:1000'
        ], [
            'required' => 'The reply body is required'
        ]);

        $status = Status::notReply()->find($statusId);

        if (! $status) {
            return redirect()->route('home');
        }

        if (! Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
            return redirect()->route('home');
        }

        $reply = Status::create([
            'body'    => $validatedData["reply-{$statusId}"],
            'user_id' => Auth::user()->id
        ]);

//        not working
//        $reply = Status::create([
//            'body' => $validatedData["reply-{$statusId}"],
//        ])
//            ->user()
//            ->associate(Auth::user());

        $status->replies()->save($reply);

        return redirect()->back();
    }

    public function getLike($statusId)
    {
        $status = Status::find($statusId);

        if (! $status) {
            return redirect()->route('home');
        }

        if (! Auth::user()->isFriendsWith($status->user)) {
            return redirect()->route('home');
        }

        if (Auth::user()->hasLikedStatus($status)) {
            return redirect()->back();
        }

        $like = $status->likes()->create([
            'user_id' => Auth::user()->id
        ]);
//        Auth::user()->likes()->save($like);

        return redirect()->back();
    }
}
