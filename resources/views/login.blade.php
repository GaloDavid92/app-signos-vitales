@extends('app')

@section('content')
<div class="container w-25 border p-4 mt-4">
    <form action="" method="post">
        @csrf
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        <div class="mb-3">
            <h2>Login</h2>
            <label for="email" class="form-label">Correo</label>
            <input type="email" value="{{ old('email') }}" class="form-control" name="email" required>
            @error('email')<h6 class="alert alert-danger">{{ $message }}</h6>@enderror
            <br>
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" required>
            @error('password')<h6 class="alert alert-danger">{{ $message }}</h6>@enderror
            <br>
            <label for="remember" class="form-label">
                <input type="checkbox" name="remember">
                Recordar usuario
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>
@endsection
