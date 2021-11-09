@if(is_null(auth()->guard('web')->user()->membership))
<div class="container-fluid w-75">
    <div class="alert alert-warning mt-3" role="alert">
      <strong>Kindly subscribe</strong> <a href="{{ route('user.pay.membership') }}">here</a>.
    </div>
</div>
@endif