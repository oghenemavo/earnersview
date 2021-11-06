@extends('layouts.app')

@section('content')
<!-- Reset-Password  -->
<section class="position-relative pb-0">
    <div class="gen-login-page-background" style="background-image: url({{ asset('app/images/background/asset-54.jpg') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <form id="pms_login" class="password_request" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <h4>{{ __('Reset Password') }}</h4>

                        <input type="hidden" name="token" value="{{ $token }}">

                        <p class="login-username">
                            <label for="email">Email Address</label>
                            <input type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autofocus size="20">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>

                        <p class="login-username">
                            <label for="password">Password</label>
                            <input type="password" class="input form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>

                        <p class="login-username">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="input form-control @error('password_confirmation') is-invalid @enderror" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>

                        <button type="submit" class="button button-primary my-3">
                            {{ __('Reset Password') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Reset-Password  -->

@endsection
