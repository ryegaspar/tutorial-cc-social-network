@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('user.partials.userblock')
            <hr/>
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if (Auth::user()->hasFriendRequestPending($user))
                <p>waiting for {{ $user->getNameOrUsername() }} to accept your requests</p>
            @elseif (Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ route('friend.accept', ['username' => $user->username]) }}"
                   class="btn btn-primary"
                >
                    Accept friend request
                </a>
            @elseif (Auth::user()->isFriendsWith($user))
                <p>You and {{ $user->getNameOrUsername() }} are friends</p>
            @elseif (Auth::user()->id !== $user->id)
                <a href="{{ route('friend.add', ['username' => $user->username]) }}"
                   class="btn btn-primary"
                >
                    Add as friend
                </a>
            @endif

            <h4>{{ $user->getFirstNameOrUsername() }}'s</h4>

            @if (!$user->friends()->count())
                <p>{{ $user->getFirstNameOrUsername() }} has no friends.</p>
            @else
                @foreach ($user->friends() as $user)
                    @include('user/partials/userblock')
                @endforeach
            @endif
        </div>
    </div>
@endsection
