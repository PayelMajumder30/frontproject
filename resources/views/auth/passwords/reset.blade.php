@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ __('Reset Password') }}</h1>
        </div>
    </div>     

    <div class="row">
        <div class="panel panel-default">  
            <div class="panel-body">
                
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('Email Address')}}</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')}}">
                        @error('email')
                            <small class="text-danger">{{ $message}}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">{{ __('New Password')}}</label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                        @error('password')
                            <small class="text-danger">{{ $message}}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    {{-- <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div> --}}

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Reset Password') }}
                            </button>
                            <a href="{{ route('login') }}">{{ __('Back to Login') }}</a>
                        </div>                        
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
