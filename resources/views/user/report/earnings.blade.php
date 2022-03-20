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
                <div class="py-4 mb-3" style="display: inline-block;">
                    <span>Wallet Balance:</span>
                    <h1 class="text-dark">&#8358;{{ $balance }}</h1>
                    <button data-min="{{ $min }}" data-balance="{{ $balance }}" id="payout" class="btn btn-outline-primary">Payout</button>
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

<!-- promotions Start -->
<section class="pt-0 pb-0 mb-4 gen-section-padding-2 home-singal-silder">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <h4 class="gen-heading-title">Promotions</h4>
                </div>

                <div class="col-12">
                    <div class="gen-banner-movies">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="true" data-nav="false"
                            data-desk_num="1" data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="true" data-loop="true" data-margin="30" data-video="true">

                            @foreach($promotions as $promo)
                                @if ($filetype($promo->material))
                                    <div class="item" style="background: url('{{ $promo->material_path }}')">
                                @else
                                    <div class="item">
                                        <video class="owl-video-frame" controls>
                                            <source src="{{ $promo->material_path }}" type="video/mp4">
                                        </video>
                                @endif
                                <div class="gen-movie-contain h-100">
                                    <div class="container h-100">
                                        <div class="row align-items-center h-100">
                                            <div class="col-xl-6">
                                                @if ($current_time->diffInHours($promo->created_at) < 120 )
                                                <div class="gen-tag-line">
                                                    <span>New Realease</span>
                                                </div>
                                                @endif
                                                <div class="gen-movie-info">
                                                    <h3>{{ $promo->title }}</h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>{{ $promo->created_at->format('M Y') }}</li>
                                                        <li><a href="#"><span>ads</span></a></li>
                                                    </ul>
                                                    <p>
                                                        Earners View ads.
                                                    </p>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <!-- <div class="gen-btn-container button-1">
                                                        <a href="single-movie.html" class="gen-button">
                                                            <i aria-hidden="true" class="ion ion-play"></i> 
                                                            <span class="text">Play now</span>
                                                        </a>
                                                    </div> -->
                                                    <!-- <div class="gen-btn-container button-2">
                                                        <a href="https://www.youtube.com/watch?v=hG4lT4fxj8M"
                                                            class="gen-button popup-youtube popup-vimeo popup-gmaps gen-button-link">
                                                            <span class="text">Watch Trailer</span>
                                                        </a>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- promotions End -->
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
            let balance = parseFloat(`{{ $balance }}`);
            let min = parseFloat(`{{ $min }}`);

            if (balance >= min) {
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
                    title: `Insufficient Balance, Min Payout is &#8358;{{ $min }} `,
                    showConfirmButton: false,
                    timer: 3500,
                })
            }
        });

        $('#earnings_table').DataTable({
            searching: false,
            lengthChange: false,
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