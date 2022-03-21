@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/css/editors/tinymce.css?ver=2.8.0') }}">
@endpush

@section('content')

<div class="nk-block-head nk-block-head-lg wide-sm">
    <div class="nk-block-head-content">
        <h4 class="nk-block-title fw-normal">Edit Promotion info & Details</h4>
        <div class="nk-block-des">
            <p class="lead">Customize promotion content.</p>
        </div>
    </div>
</div>

<div class="nk-block nk-block-lg">
    <div class="card card-bordered">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Promotion Details</h5>
            </div>

            <form id="edit_promotion" action="{{ route('admin.media.update.promotion', $promotion->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="title">Title</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control form-control-lg  @error('title') is-invalid @enderror" id="title" name="title" value="{{ $promotion->title }}" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="material">Promotion Material</label>
                    <div class="form-control-wrap">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('material') is-invalid @enderror" id="material" name="material">
                            <label class="custom-file-label" for="material">Choose file</label>
                            @error('material')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div data-error="cover" class="error"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary">Edit Promotion</button>
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

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');

        $('#edit_promotion').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 4,
                },
                material: {
                    accept: "image/*,video/*",
                    filesize: 30,
                },
            },
            messages: {
                material: {
                    accept: 'Only Images and Videos file formats are accepted',
                }
            },
        });
    });
</script>
@endpush