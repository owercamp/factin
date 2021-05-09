@extends('layouts.app')

@section('title', 'Factin Online Service')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 p-3 col-form-label text-md-right bg-warining"> {{ __('Correo') }} </label>
                            <div class="col-md-6 emaIcon emaIconBg">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="example@correo.com.co"><span class="icon-envelope-open"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="margin-top: 35px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 p-3 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                            <div class="col-md-6 passIcon passIconBg">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><span class="icon-key"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="margin-top: 35px">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
