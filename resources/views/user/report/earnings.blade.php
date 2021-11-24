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
                            Earnings Report
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home mr-2"></i>Home</a></li>
                            <li class="breadcrumb-item active">Earnings</li>
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
                <div class=" p-4 mb-3" style="display: inline-block;">
                    <span>Wallet Balance:</span>
                    <h1 class="text-dark">&#8358;{{ $balance }}</h1>
                    <button data-balance="{{ $balance }}" id="payout" class="btn btn-outline-primary">Payout</button>
                </div>
                <table id="earnings_table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Video</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Watched at</th>
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
        $('#payout').click(function () { 
            if ($(this).attr('data-balance') > 0) {
                $.post("{{ route('user.request.payout') }}",
                    {
                        "_token": `{{ csrf_token() }}`,
                        balance: `{{ $balance }}`,
                    },
                    function (data, textStatus, jqXHR) {
                        if (data.success) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: `&#8358;{{ $balance }} has been approved for payout`,
                                showConfirmButton: false,
                                timer: 3500,
                            })
                        }

                        if (data.error) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'danger',
                                title: `Unable to process payout`,
                                showConfirmButton: false,
                                timer: 3500,
                            })
                        }
                    },
                    "json"
                );
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: `Insufficient Balance`,
                    showConfirmButton: false,
                    timer: 3500,
                })
            }
        });


        $('#earnings_table').DataTable({
            searching: false,
            ajax: {
                url: `{{ route('ajax.get.user.video.logs', auth()->guard('web')->user()->id) }}`,
                dataSrc: 'video_logs'
            },
            buttons: [
                {
                    text: 'Reload',
                    className: 'btn reload px-2 btn-primary btn-sm',
                    action: function(e, dt, node, config) {
                        dt.ajax.reload();
                    },
                },
            ],
            columns: [
                {
                    data: 'video',
                    className: 'nk-tb-col tb-col-md'
                },
                {
                    data: 'amount',
                    className: 'nk-tb-col tb-col-md',
                    render: data => `&#8358;${data}`
                },
                {
                    data: 'status',
                    className: 'nk-tb-col tb-col-md',
                    render: (data) => {
                        var stat = "";
                        if (data == '1') {
                            stat += `<span class="badge badge-success">Paid</span>`;
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