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
                        <label class="form-label" for="url">Video Url</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="url" class="form-control form-control-lg  @error('url') is-invalid @enderror"
                        id="url" name="url" value="{{ $video->url }}">
                        
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="length">Video Length</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="number" class="form-control form-control-lg @error('length') is-invalid @enderror"
                        id="length" name="length" value="{{ $video->length }}">
                        
                        @error('length')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="description">Video Description</label>
                    </div>
                    <div class="form-control-wrap">
                        <textarea class="tinymce-toolbar form-control @error('description') is-invalid @enderror" id="description" name="description">{{ htmlspecialchars_decode($video->description) }}</textarea>
                        
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div data-error="description" class="error"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="charges">Vendor Charges</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="number" class="form-control form-control-lg  @error('charges') is-invalid @enderror"
                        id="charges" name="charges" value="{{ $video->charges }}" min="1" step="0.01">
                        
                        @error('charges')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="earnable">Earnable</label>
                    </div>
                    <div class="form-control-wrap">
                        <!-- <div class="form-icon form-icon-left">
                            <em class="icon ni ni-sign-kobo-alt"></em>
                        </div> -->
                        <input type="number" class="form-control form-control-lg  @error('earnable') is-invalid @enderror"
                        id="earnable" name="earnable" value="{{ $video->earnable }}" min="1" step="0.01">
                        
                        @error('earnable')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="earned_after">Earn After</label>
                    <div class="form-control-wrap number-spinner-wrap">
                        <button type="button" class="btn btn-icon btn-primary number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>
                        <input type="number" id="earned_after" name="earned_after" class="form-control number-spinner @error('earnable') is-invalid @enderror" value="{{ $video->earned_after }}">
                        <button type="button" class="btn btn-icon btn-primary number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>
                    
                        @error('earned_after')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
    <script src="{{ asset('app/js/jquery.form.js') }}"></script>

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
                    url: {
                        required: true,
                        minlength: 4,
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
        });
    </script>
@endpush