@extends('layouts.auth')

@section('container')
<div class="row p-4 pt-5">
  <div class="card card-primary" style="width:700px;">
    <div class="card-header">
      <h3 class="card-title m-2">Modification de mot de passe</h3>
    </div>
    <form action="{{ route('update.password')}}" method="POST">
          @csrf
        @if(session('success'))
          <div class="alert alert-success m-4">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            <div class="form-group">
              <label for="current">Mot de passe actuel</label>
              <input type="password" name="current" class="form-control @error('current') is-invalid @enderror" placeholder="Entrez le Mot de passe">
              @error("current")
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Nouveau mot de passe</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Entrez le Mot de passe">
              @error("password")
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirmez le mot de passe</label>
              <input type="password" name="password_confirmation" class="form-control">
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ route('user.edit') }}" class="btn btn-danger">Revenir au profile</a>
          </div>
          <div class="m-4"></div>
    </form>
  </div>
</div>
@endsection