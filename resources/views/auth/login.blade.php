@extends('layouts.auth')

@section('container')

<div class="login-box" style="width:700px;">
  <div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg">{{ $title ?? '' }}</p>
      <form action="{{ route('post.login') }}" method="post">
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
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        @error('password')
          <div class="error">{{ $message}}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Mot de passe">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        {{-- <div class="icheck-primary">
          <input type="checkbox" id="remember" name="remember" value="1" >
          <label for="remember">Se souvenir de moi</label>
        </div> --}}
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
        </div>
      </form>

      {{-- <p class="mb-1 mt-3">
        <a href="forgot-password.html">Mot de passe Oublié</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection