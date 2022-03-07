@extends('layouts.auth')

@section('content')
<!-- register -->
<section class="position-relative pb-0">
    <div class="gen-register-page-background" style="background-image: url({{ asset('app/images/background/asset-3.jpeg') }});">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <form id="pms_register-form" class="pms-form"  method="POST" action="{{ route('user.create') }}">
                        @csrf
                        <h4>{{ __('Register') }}</h4>

                        <input type="hidden" name="referral" value="{{ $referral ?? null }}">

                        <div class="row">
                            <div class="col">
                                <label for="pms_first_name">Name *</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="email">E-mail *</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="password">Password *</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="password_confirmation">Repeat Password *</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="password_confirmation">
                                
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button class="mt-3" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- register -->
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

            $('#pms_register-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 4,
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: `{{ route('ajax.validate.email') }}`,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        equalTo: '#password'
                    }
                },
                messages: {
                    email: {
                        remote: 'Email already taken'
                    }
                },
            });
        });
    </script>
@endpush
