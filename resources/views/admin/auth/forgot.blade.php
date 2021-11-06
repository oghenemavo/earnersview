@extends('layouts.protected')

@section('content')

<div class="card-inner card-inner-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Forgot Password</h4>
            <div class="nk-block-des">
                <p>Request for reset of forgotten password.</p>
            </div>
        </div>
    </div>
    <form action="html/index.html">
        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="default-01">Email</label>
            </div>
            <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address">
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block">Request Password Reset</button>
        </div>
    </form>
</div>
@endSection