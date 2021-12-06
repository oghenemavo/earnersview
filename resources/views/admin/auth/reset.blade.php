@extends('layouts.protected')

@section('content')

<div class="card-inner card-inner-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Reset Password</h4>
            <div class="nk-block-des">
                <p>Reset your password.</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.reset.password') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password">
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="repeat_password">Repeat Password</label>
            </div>
            <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="repeat_password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg @error('repeat_password') is-invalid @enderror" id="repeat_password" name="repeat_password" placeholder="Repeat your password">
            </div>
            @error('repeat_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block">Reset Password</button>
        </div>
    </form>
</div>
@endSection