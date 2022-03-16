@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/css/editors/tinymce.css?ver=2.8.0') }}">
@endpush

@section('content')

<div class="nk-block-head nk-block-head-lg wide-sm">
    <div class="nk-block-head-content">
        <h4 class="nk-block-title fw-normal">Edit Video info & Details</h4>
        <div class="nk-block-des">
            <p class="lead">Customize video content.</p>
        </div>
    </div>
</div>

<div class="nk-block nk-block-lg">
    <div class="card card-bordered">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Video Details Setup</h5>
            </div>

            <form id="edit_video" action="{{ route('admin.media.update.video', $video->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="title">Title</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control form-control-lg  @error('title') is-invalid @enderror"
                        id="title" name="title" value="{{ $video->title }}">
                        
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Categories</label>
                    <div class="form-control-wrap">
                        <select data-ui="lg" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            @foreach($categories as $data)
                                <option value="{{ $data->id }}" @if($video->category_id == $data->id) selected @endif>
                                    {{ $data->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div data-error="category_id" class="error"></div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="video_id">Youtube Video ID</label>
                    </div>
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://youtube.com/watch?v=</span>
                            </div>
                            <input type="text" class="form-control form-control-lg  @error('video_id') is-invalid @enderror"
                            id="video_id" name="video_id" value="{{ $video->video_id }}" placeholder="e.g. l7fXRnM121Q">
                            
                            @error('video_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="length">Video Length</label>
                    </div>
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg @error('length') is-invalid @enderror"
                            id="length" name="length" value="{{ $video->length }}" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">seconds</span>
                            </div>
                            @error('length')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-note" data-note="length"></div>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="description">Video Description</label>
                        </div>
                        <div class="form-control-wrap">
                            <textarea class="form-control form-control-lg  @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                           
                           
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="charges">Vendor Charges</label>
                    </div>
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">&#8358;</span>
                            </div>
                            <input type="number" class="form-control form-control-lg  @error('charges') is-invalid @enderror"
                            id="charges" name="charges" value="{{ $video->charges }}" min="1" step="0.01">
                        
                            @error('charges')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="earnable">Earnable</label>
                    </div>
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">&#8358;</span>
                            </div>
                            <input type="number" class="form-control form-control-lg  @error('earnable') is-invalid @enderror"
                            id="earnable" name="earnable" value="{{ $video->earnable }}" min="1" step="0.01">
                            
                            @error('earnable')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="earned_after">Earn After Watching for:</label>
                    </div>
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg @error('earned_after') is-invalid @enderror"
                            id="earned_after" name="earned_after" value="{{ $video->earned_after }}" max="{{ $video->earned_after }}">
                            <div class="input-group-append">
                                <span class="input-group-text">seconds</span>
                            </div>
                            @error('earned_after')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-note" data-note="earned_after"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="cover">Cover Image</label>
                    <div class="form-control-wrap">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('cover') is-invalid @enderror" id="cover" name="cover">
                            <label class="custom-file-label" for="cover">Choose file</label>
                            @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div data-error="cover" class="error"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary">Edit Video</button>
            </form>

        </div>
    </div><!-- card -->
</div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/js/libs/editors/tinymce.js?ver=2.8.0') }}"></script>
    <script src="{{ asset('dashboard/js/editors.js?ver=2.8.0') }}"></script>
    <script src="{{ asset('app/js/additional-methods.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{ asset('app/js/jquery.form.js') }}"></script>

    <script>
        $(function() {
            $('div[data-note="length"]').text(hhmmss(`{{ $video->length }}`)); // on load
            $('div[data-note="earned_after"]').text(hhmmss(`{{ $video->earned_after }}`)); // on load

            $('#earned_after').on('input change keypress', function() {
                if ($(this).attr('max') > 0) {
                    $('div[data-note="earned_after"]').text(hhmmss($(this).val()))
                }
            });

            $('#video_id').on('input', function() {
                const video_id = $(this).val();
                if (video_id.length == 11) {
                    fetchVideoInfo(`https://www.googleapis.com/youtube/v3/videos?id=${video_id}&part=contentDetails&key={{ env('YOUTUBE_KEY') }}`)
                    .then(data => {
                        $('#length').val(`{{ $video->length }}`);
                        $('div[data-note="length"]').text(hhmmss(`{{ $video->length }}`));

                        $('#earned_after').val(`{{ $video->earned_after }}`).attr('readonly', true).removeAttr('max');

                        if (data.pageInfo.totalResults == '1') { // returned a result
                            const iso8601 = data.items[0].contentDetails.duration;
                            const seconds = moment.duration(iso8601).asSeconds();
                            $('#length').val(seconds);
                            $('#earned_after').attr('max', seconds-1).attr('readonly', false);
                            $('div[data-note="length"]').text(hhmmss(seconds));
                            $('#edit_video').find('button[type="submit"]').attr('disabled', false);
                        } else {
                            toastr.clear();
                            NioApp.Toast('The Youtube ID is wrong.', 'warning', {
                                position: 'top-right',
                                ui: 'is-dark',
                            });
                            $('#edit_video').find('button[type="submit"]').attr('disabled', true);
                        }
                    })
                    .catch(error => {
                        console.log()
                        error.message; // 'An error has occurred: 404'
                    });
                }
            });

            async function fetchVideoInfo(url) {
                const response = await fetch(url);
                if (!response.ok) {
                    const message = `An error has occured: ${response.status}`;
                    throw new Error(message);
                }
                return await response.json();
            }


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

            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param * 1000000)
            }, 'File size must be less than {0} MB');

            $('#edit_video').validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 4,
                    },
                    category_id: {
                        required: true,
                    },
                    video_id: {
                        required: true,
                        minlength: 11,
                        maxlength: 11,
                    },
                    length: {
                        required: true,
                    },
                    description: {
                        required: true,
                        minlength: 20,
                    },
                    earnable: {
                        required: true,
                    },
                    earned_after: {
                        required: true,
                    },
                    cover: {
                        accept: "image/*",
                        filesize: 10,
                    },
                },
                messages: {
                    category_id: "Select a Video Category.",
                    body: "Enter Describe your Video here in details",
                    cover: {
                        accept: 'Only Images file formats are accepted',
                    }
                },
            });

            function pad(num) {
                return ("0"+num).slice(-2);
            }
            function hhmmss(secs) {
                var minutes = Math.floor(secs / 60);
                secs = secs%60;
                var hours = Math.floor(minutes/60)
                minutes = minutes%60;
                return `${pad(hours)}:${pad(minutes)}:${pad(secs)}`;
            // return pad(hours)+":"+pad(minutes)+":"+pad(secs); for old browsers
            }
        });
    </script>
@endpush