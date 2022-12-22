@extends('layouts.auth')

@section('container')

    <div class="row p-4 pt-5">
        <div class="card card-primary" style="width:700px;">
            <div class="card-header">
            <h3 class="card-title m-2">Bonjour {{ userFullName() }}</h3>
            </div>
            <form action="{{ route('post.user')}}" method="POST">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success m-4">{{ session('success') }}</div>
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" value="{{ old('name',$user->name) }}" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Entrez votre nom">
                        @error("name")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastName">Prénom</label>
                        <input type="text" value="{{ old('lastName',$user->lastName) }}"  class="form-control @error('lastName') is-invalid @enderror" name="lastName" placeholder="Entrez votre prénom">
                        @error("lastName")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" value="{{ old('email',$user->email) }}"  class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email">
                        @error("email")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
        
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <a href="{{ route('home') }}" class="btn btn-danger">Revenir au menu principal</a>
                </div>
            </form>
            <div class="m-4"><a href="{{ route('user.password') }}">Modifier mon mot de passe</a></div>
        </div>
    </div>
@endsection
