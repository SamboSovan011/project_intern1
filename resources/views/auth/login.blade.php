@extends('layouts.app')
@section('title', 'Potted Pan - Login')
@section('content')
<style>
    #form-login {
        margin: 2rem;
        padding: 1rem;
    }

    .card {
        border: none;
    }

    body {
        background: white;
    }
    footer{
        position: absolute !important;
    }
</style>

<section id="form-login">
    <div class="container d-flex justify-content-center">
        <div class="card col-lg-6">
            <!-- Default form login -->
            <form class="text-center" method="POST" action="{{ route('login') }}">
            @csrf
                <p class="h4 mb-4">Login</p>


                <!-- E-mail -->
                <input type="email" id="defaultRegisterFormEmail"
                    class="form-control mb-4 @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!-- Password -->
                <input type="password" id="defaultRegisterFormPassword"
                    class="form-control mb-4  @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password" placeholder="Password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="d-flex form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="keepSignIn">Remember me</label>
                    @if(Route::has('password.request'))
                        <a class="ml-auto" href="{{ route('password.request') }}">Forget Password?</a>
                    @endif
                </div>

                <!-- Login button -->
                <button class="btn btn-info my-4 btn-block" type="submit">Login</button>
                <div class="d-flex">
                    <a class="ml-auto" href="{{route('register')}}">Sign Up</a>
                </div>

            </form>
        </div>
    </div>
</section>

@endsection
