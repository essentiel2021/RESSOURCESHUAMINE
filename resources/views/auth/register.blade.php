@extends('layouts.auth')

@section('container')

<div class="register-box" style="width:700px;">
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">{{ $title ?? '' }}</p>
       
      <form action="{{ route('post.register') }}" method="post">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
         {{-- <div class="alert alert-success">{{ session('success') }}</div> --}}
        @csrf
         @error('name')
            <div class="error">{{ $message }}</div>
          @enderror
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" value="{{ old('name') }}"placeholder="Nom">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('lastName')
            <div class="error">{{ $message }}</div>
          @enderror
        <div class="input-group mb-3">
          <input type="text" name="lastName" class="form-control" value="{{ old('lastName') }}"placeholder="Prénom">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
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
            <div class="error">{{ $message }}</div>
         @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Mot de passe">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Créer</button>
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

@endsection