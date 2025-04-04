@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ __('Register Member') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">

            <div class="panel-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="role" id="type"  autofocus>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>

                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone')}}</label>
                        <div class="col-md-6">
                            <input id="phone" type="text" name="phone" class="form-control @error('phone')is-invalid @enderror" value="{{ old('phone')}}">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address')}}</label>
                        <div class="col-md-6">
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address')}}</textarea>
                            @error('address')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender')}}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image')}}</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('image')is-invalid @enderror" name="image">
                            @error('image')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Login if already registered') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .invalid-feedback {
    color: red !important; /* Ensures error text is red */
}
</style>