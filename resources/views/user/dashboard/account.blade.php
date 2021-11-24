@extends('layouts.app')

@push('styles')
    <style>
        select .custom-select {
            /* height: 54px; */
        }
    </style>
@endpush

@section('content')
<!-- breadcrumb -->
<div class="gen-breadcrumb" style="background-image: url('images/background/asset-25.jpeg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <div class="gen-breadcrumb-title">
                        <h1>
                            Edit Account
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home mr-2"></i>Home</a></li>
                            <li class="breadcrumb-item active">Edit Account</li>
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
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Change Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Account</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade pt-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <form id="edit_profile" method="POST" action="{{ route('user.update.profile') }}">
                            @csrf
                            @method('PUT')
                            <div class="gen-register-form">
                                <h2>Change Profile</h2>

                                <div class="form-group pt-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="input form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{auth()->user()->email }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <button class="mt-3" type="submit">{{ __('Change Profile') }}</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade pt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        
                        <form id="financial" method="POST" action="{{ route('user.update.account') }}">
                            @csrf
                            @method('PUT')
                            <div class="gen-register-form">
                                <h2>Change Financial Details</h2>
        
                                <div class="form-group pt-4">
                                    <label for="banks">Bank Account</label>
                                    <select name="banks" id="banks" class="pl-3 custom-select form-control @error('banks') is-invalid @enderror">
                                        <option value="">Select a Bank</option>
                                    </select>
                                    @error('banks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <div class="form-group pt-4">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="input form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ auth()->user()->bank_account }}">
                                    @error('account_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <button class="mt-3" type="submit">{{ __('Change Financial Record') }}</button>
                            </div>
                        </form>
                        
                    </div>
                </div>

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

        let banks_json, banks_promise, banks;
        banks_json = `{{ asset('app/js/banks.json') }}`;
        banks = $('#banks');

        banks_promise = new Promise(function(resolve, reject) {
            $.ajax({
                url: banks_json,
                dataType: 'json',
                success: function(response) {
                    resolve(response);
                },
                error: function(err) {
                    resolve(err);
                }
            });
        });

        banks_promise.then(data => {
            if (!$.isEmptyObject(data)) {
                $.each(data.data, function(key, value) {
                    if (value.code == `{{ auth()->user()->bank_code }}`) {
                        banks.append($('<option selected></option>').val(value.code).text(value.name));
                    } else {
                        banks.append($('<option></option>').val(value.code).text(value.name));
                    }
                });
            }
        });

        console.log(banks.find(':selected').val());


        var response;

        function valid(x) {
            response = x;
        }

        $.validator.addMethod(
            "check_account_number", 
            function(value, element, params) {
                // console.log(value)
                // console.log(element)
                // console.log(params)
                // console.log(banks.find(':selected').val());
                
                let bank_code = banks.find(':selected').val() ?? null;

                let x = $.ajax({
                    url: `{{ route('ajax.validate.bank_account') }}`,
                    type: "POST",
                    async: false,
                    data: {
                        "_token": `{{ csrf_token() }}`,
                        account_number: value, 
                        code: bank_code,
                    },
                    dataType: "json",
                    success: function(rsp)
                    {
                        //If username exists, set response to true
                        // response = ( rsp.status == 'success' ) ? true : false;
                        valid(rsp);
                        // valid(( rsp.status == 'success' ) ? true : false);
                    }
                });
                return ( response.status == 'success' ) ? true : false;
            }, 
            "Sorry, recipient account could not be validated. Please try again"
        );

        $('#financial').validate({
            success: function(label, element) {
                if ($(element).attr('name') == 'account_number') {
                    $(label).text(response.data.account_name);
                }
                $(element).addClass("is-valid");
            },
            rules: {
                account_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    check_account_number: true
                }
            },
        });

        $('#edit_profile').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: `{{ route('ajax.validate.email') }}`,
                        data: {
                            ignore_id: function() {
                                return `{{ auth()->user()->id }}`;
                            }
                        }
                    }
                },
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