@extends('backend.layouts.auth.auth_layout')

@section('content')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <a class="text-center" href="index.html"><h4>Rosella</h4></a>

                                <form method="POST" action="{{ route('register') }}" class="mt-5 mb-5 login-input">
                                    @csrf

                                    <div class="form-group">
                                        <input id="name" type="text" placeholder="Name" class="form-control" name="name"
                                               value="{{ old('name') }}"  autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                               </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" placeholder="Email"
                                               class="form-control" name="email"
                                               value="{{ old('email') }}"  autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password"
                                               class="form-control" name="password" placeholder="Password"
                                               autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">

                                        <input id="password-confirm" placeholder="Confirm Password" type="password"
                                               class="form-control"
                                               name="password_confirmation"  autocomplete="new-password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Register</button>
                                </form>
                                <p class="mt-5 login-form__footer">Have account <a href="{{route('login')}}"
                                                                                   class="text-primary">Login </a> now
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('title')
    Register

@endsection
