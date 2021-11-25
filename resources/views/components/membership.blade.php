@if(is_null(auth()->guard('web')->user()->membership))
  <!-- Customized bootstrap alert with icons -->
  <div classs="container p-5">
    <div class="alert alert-warning shadow" role="alert" style="border-left:#856404 5px solid;  border-radius: 0px">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" style="color:#856404">&times;</span>
      </button>
      <div class="row">
          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="m-1 bi bi-cone-striped" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M9.97 4.88l.953 3.811C10.159 8.878 9.14 9 8 9c-1.14 0-2.158-.122-2.923-.309L6.03 4.88C6.635 4.957 7.3 5 8 5s1.365-.043 1.97-.12zm-.245-.978L8.97.88C8.718-.13 7.282-.13 7.03.88L6.275 3.9C6.8 3.965 7.382 4 8 4c.618 0 1.2-.036 1.725-.098zm4.396 8.613a.5.5 0 0 1 .037.96l-6 2a.5.5 0 0 1-.316 0l-6-2a.5.5 0 0 1 .037-.96l2.391-.598.565-2.257c.862.212 1.964.339 3.165.339s2.303-.127 3.165-.339l.565 2.257 2.391.598z"/>
          </svg>
          <p style="font-size:16px" class="mb-0 font-weight-light"><b class="mr-1">Subscription:</b> Kindly make your one time subscription to enjoy the full benefits. make payments <a href="{{ route('user.pay.membership') }}" class="btn btn-sm btn-danger">here</a></p>
      </div>
    </div>
  </div>
  <!-- Customized bootstrap alert with icons -->
@endif