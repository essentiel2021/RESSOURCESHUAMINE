@extends('layouts.auth')

@section('container')

<div class="login-box" style="width:700px;">
  <div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg">{{ $title ?? '' }}</p>
      <form action="{{ route('post.forgot') }}" method="post">
        @csrf
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @error('email')
          <div class="error">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection