@extends('templates.default')

@section('content')
    <h3>Sign Up</h3>
    <div class="row">
        <div class="col-xl-6">
            <form class="form-vertical" role="form" method="post" action="{{ route('auth.signup') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="col-form-label">Your email address</label>
                    <input type="text"
                           name="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           id="email"
                           value="{{ Request::old('email') ?: ''}}"
                    >
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="username" class="col-form-label">Choose a username</label>
                    <input type="text"
                           name="username"
                           class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                           id="username"
                           value="{{ Request::old('username') ?: ''}}"
                    >
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">Choose a password</label>
                    <input type="password"
                           name="password"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           id="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Sign up</button>
                </div>
            </form>
        </div>
    </div>
@endsection
