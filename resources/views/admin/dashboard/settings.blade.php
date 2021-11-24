@extends('layouts.admin')

@section('content')
<!-- main content -->
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Admin Settings</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-aside-wrap">
                <div class="card-content">
                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#password"><em class="icon ni ni-lock-alt"></em><span>Password</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#email"><em class="icon ni ni-user"></em><span>Account</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings"><em class="icon ni ni-setting"></em><span>Site Settings</span></a>
                        </li>
                    </ul><!-- .nav-tabs -->

                    <div class="card-inner">
                        <div class="tab-content">
                            <div class="tab-pane active" id="password">
                                <form id="update_password" action="{{ route('admin.update.password') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="current">Current Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control form-control-lg  @error('current') is-invalid @enderror"
                                            id="current" name="current" autofocus>
                                            
                                            @error('current')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">New Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control form-control-lg  @error('password') is-invalid @enderror"
                                            id="password" name="password">
                                            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="repeat">Repeat Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control form-control-lg  @error('repeat') is-invalid @enderror"
                                            id="repeat" name="repeat">
                                            
                                            @error('repeat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-primary"><em class="icon ni ni-lock-alt"></em> Update Password</button>
                                </form>
                            </div>

                            <div class="tab-pane" id="email">
                                <form id="update_email" action="{{ route('admin.update.email') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="email" class="form-control form-control-lg  @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ auth()->guard('admin')->user()->email }}" autofocus>
                                            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-primary"><em class="icon ni ni-user"></em> Update Email</button>
                                </form>
                            </div>

                            <div class="tab-pane" id="settings">
                                <form id="update_site_settings" action="{{ route('admin.update.site.settings') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    
                                    @foreach($site_settings as $settings)
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="{{ $settings->slug }}">{{ $settings->name }}</label>
                                            </div>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control form-control-lg  @error('{{ $settings->slug }}') is-invalid @enderror"
                                                id="{{ $settings->slug }}" name="{{ $settings->slug }}" value="{{ $settings->meta }}">
                                                
                                                @error('{{ $settings->slug }}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-note">{{ $settings->description }}</div>
                                        </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-lg btn-primary"><em class="icon ni ni-setting"></em> Update Site Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div><!-- .card-content -->
            </div><!-- .card-aside-wrap -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
<!-- main content -->
@endsection


@push('scripts')
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

            $('#update_password').validate({
                rules: {
                    current: {
                        required: true,
                        minlength: 5,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    repeat: {
                        equalTo: '#password'
                    }
                },
            });

            $('#update_email').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                },
            });
        });
    </script>
@endpush