@extends('layouts.auth')

@section('content')

<!-- Log-in  -->
<section class="position-relative pb-0">
    <div class="gen-login-page-background" style="background-image: url({{ asset('app/images/background/asset-54.jpg') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <form name="pms_login" id="pms_login" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h4>{{ __('Login') }}</h4>
                        <p class="login-username">
                            <label for="email">Email Address</label>
                            <input type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus size="20">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <p class="login-password">
                            <label for="user_pass">Password</label>
                            <input type="password" name="password" id="user_pass" class="input form-control @error('password') is-invalid @enderror" required autocomplete="current-password" size="20">
                        </p>
                        <p class="login-remember">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> 
                                Remember Me 
                            </label>
                        </p>
                        <p class="login-submit">
                            <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary"
                                value="Log In">
                            <input type="hidden" name="redirect_to">
                        </p>
                        <input type="hidden" name="pms_login" value="1">
                        <input type="hidden" name="pms_redirect">

                        @if (Route::has('password.request'))
                            <a href="{{ route('register') }}">Register</a> | <a href="{{ route('password.request') }}">Lost your password?</a>
                        @endif
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Log-in  -->
@endsection

@push('scripts')
    <script src="{{ asset('app/js/jquery.validate.min.js') }}"></script>

    <script>
        $(function() {
            $.validator.setDefaults({
                errorElement: "div",
                errorClass: 'invalid-feedback',
                highlight: function highlight(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function unhighlight(element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function errorPlacement(error, element) {
                    error.insertAfter(element);
                }
            });

            $('#pms_login').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    }
                }
            });
        });
    </script>
@endpush