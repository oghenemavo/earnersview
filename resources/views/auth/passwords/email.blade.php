@extends('layouts.auth')

@section('content')
<!-- Reset-Password  -->
<section class="position-relative pb-0">
    <div class="gen-login-page-background" style="background-image: url({{ asset('app/images/background/asset-54.jpg') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <form id="pms_login" class="password_request" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h4>{{ __('Reset Password') }}</h4>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="login-username">
                            <label for="email">Email Address</label>
                            <input type="email" class="input form-control @error('email') is-invalid @enderror" name="email" required autofocus size="20">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>

                        <button type="submit" class="button button-primary my-3">
                            {{ __('Send Password Reset Link') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Reset-Password  -->
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

            $('.password_request').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });
        });
    </script>
@endpush