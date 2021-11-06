@extends('layouts.app')

@section('content')
<!-- breadcrumb -->
<div class="gen-breadcrumb" style="background-image: url('images/background/asset-25.jpeg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <div class="gen-breadcrumb-title">
                        <h1>
                            Settings
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i
                                        class="fas fa-home mr-2"></i>Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->

<!-- Register -->
<section class="gen-section-padding-3 gen-library">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form id="change_setttings" method="POST" action="{{ route('user.change.settings') }}">
                    @csrf
                    @method('PUT')
                    <div class="gen-register-form">
                        <h2>Change Settings</h2>

                        <div class="form-group">
                            <label for="current">Old Password</label>
                            <input type="password" class="input form-control @error('current') is-invalid @enderror" name="current" >
                            @error('current')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="input form-control @error('password') is-invalid @enderror" name="password" >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="input form-control @error('password_confirmation') is-invalid @enderror" >
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <button class="mt-3" type="submit">{{ __('Change Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Register -->


@endsection


@push('scripts')
    <script src="{{ asset('app/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app/js/additional-methods.min.js') }}"></script>

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

            $('#change_setttings').validate({
                rules: {
                    current: {
                        required: true,
                        minlength: 5,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                        equalTo: '#password'
                    }
                },
            });
        });
    </script>
@endpush