<?php

namespace App\Http\Controllers;

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
}
