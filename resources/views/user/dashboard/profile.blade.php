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
                            Profile
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                
                <!-- notifications alert -->
                @foreach(['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'gray', 'light'] as $alert)
                    @if(session()->has($alert))
                    <x-alert type="{{ $alert }}" :message="session()->get($alert)"/>
                    @endif
                @endforeach
                <!-- notifications alert -->
                
                <x-membership/>

            </div>

            <div class="col-lg-8 offset-lg-2">
                <form>
                    @csrf
                    <div class="profile">
                        <h2>Profile</h2>

                        <div class="form-group">
                            <label for="current">Name</label>
                            <input type="text" id="current" class="form-control" readonly value="{{ auth()->user()->name }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" class="input form-control" readonly value="{{ auth()->user()->email }}">
                        </div>

                        <div class="form-group">
                            <label for="referral">Referral Code</label>
                            <input type="text" id="referral" class="input form-control" value="{{ auth()->user()->referral_code }}"  readonly >
                        </div>

                        <div class="form-group">
                            <label for="bank">Bank Name</label>
                            <input type="text" id="bank" class="input form-control" value="{{ auth()->user()->bank_account ?? 'Not filled' }}" readonly >
                        </div>

                        <div class="form-group">
                            <label for="account">Account Number</label>
                            <input type="text" id="account" class="input form-control" value="{{ auth()->user()->account_name ?? 'Not filled' }}" readonly>
                        </div>

                        <a href="{{ route('user.account') }}" class="btn btn-outline-primary mt-3"><i class="fas fa-edit mr-2"></i>Edit Profile</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Register -->


@endsection

@push('scripts')
    <script>
        $(function() {
            var res = new Promise(function (resolve, reject) {
                $.ajax({
                    url: `{{ asset('app/js/banks.json') }}`,
                    dataType: "json",
                    success: function (response) {
                        resolve(response);
                    },
                    error: function (err) {
                        reject(err);
                    }
                });
            });

            res.then(data => {
                if (!$.isEmptyObject(data)) {
                    $.each(data.data, function(key, value) {
                        // if (value.code) {
                        //     bank_account.append($('<option selected></option>').val(value.code).text(value.name));
                        // } else {
                        //     bank_account.append($('<option></option>').val(value.code).text(value.name));
                        // }
                        if (value.code == `{{ auth()->user()->bank_code }}`) {
                            $('#bank').val(value.name);
                        }
                    });
                }
            });
        });
    </script>
@endpush