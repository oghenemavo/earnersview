@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
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
                            Referrals Report
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home mr-2"></i>Home</a></li>
                            <li class="breadcrumb-item active">Referrals</li>
                        </ol>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->

<!-- Transactions -->
<section class="gen-section-padding-3 gen-library">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h5>Referral ID: {{ auth()->guard('web')->user()->referral_code }}</h5>
                <p class="text-primary">Referral Link: {{ url('signup/'. auth()->guard('web')->user()->referral_code) }}</p>
                <table id="referrals_table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Referred</th>
                            <th>Amount</th>
                            <th>Bonus at</th>
                            <th>Status</th>
                            <th>Referred at</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Transactions -->
@endsection


@push('scripts')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#referrals_table').DataTable({
            searching: false,
            lengthChange: false,
            ajax: {
                url: `{{ route('ajax.get.user.referrals') }}`,
                dataSrc: 'referrals'
            },
            buttons: [{
                text: 'Reload',
                className: 'btn reload px-2 btn-primary btn-sm',
                action: function(e, dt, node, config) {
                    dt.ajax.reload();
                },
            }, ],
            columns: [{
                    data: 'referred',
                    className: 'nk-tb-col tb-col-md'
                },
                {
                    data: 'bonus',
                    className: 'nk-tb-col tb-col-md',
                    render: data => `&#8358;${data}`
                },
                {
                    data: 'bonus_at',
                    className: 'nk-tb-col tb-col-lg',
                    render: function(data) {
                        return data == null ? `<span>${moment(data).format('DD-MM-YYYY')}</span>` : 'Not Subscribed';
                    }
                },
                {
                    data: 'status',
                    className: 'nk-tb-col tb-col-md',
                    render: (data) => {
                        var stat = "";
                        if (data == '2') {
                            stat += `<span class="badge badge-success">Bonus Received</span>`;
                        } else if (data == '1') {
                            stat += `<span class="badge badge-info">Bonus in</span>`;
                        } else {
                            stat += `<span class="badge badge-primary">Pending</span>`;
                        }
                        return stat;
                    }
                },
                {
                    data: 'created_at',
                    className: 'nk-tb-col tb-col-lg',
                    render: function(data) {
                        return `<span>${moment(data).format('DD-MM-YYYY')}</span>`;
                    }
                },
            ]
        });
    });
</script>
@endpush