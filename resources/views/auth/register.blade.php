@extends('layouts.app')
@section('title', 'Potted Pan - Sign Up')
@section('content')
<style>
    #form-sign-up {
        margin: 2rem;
        padding: 1rem;
    }

    .card {
        border: none;
    }

    body {
        background: white;
    }

    footer {
        position: absolute !important;
    }
</style>
<section id="form-sign-up">
    <div class="container d-flex justify-content-center">
        <div class="card col-lg-6">
            <!-- Default form register -->
            <form class="text-center" method="POST" action="{{ route('register') }}">
               {{ csrf_field() }}
                <p class="h4 mb-4">Sign up</p>

                <div class="form-row mb-4">
                    <div class="col">
                        <!-- First name -->
                        <input type="text" class="form-control" placeholder="First name" name="fname" required
                            autocomplete="first_name" autofocus>
                    </div>
                    <div class="col">
                        <!-- Last name -->
                        <input type="text" class="form-control" placeholder="Last name" name="lname" required
                            autocomplete="last_name" autofocus>
                    </div>
                </div>

                <!-- E-mail -->
                <input type="email" id="defaultRegisterFormEmail"
                    class="form-control mb-4 @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span id="error_email"></span>
                <!-- Phone number -->
                <input type="text" id="defaultRegisterPhonePassword" class="form-control mb-4"
                    placeholder="Phone number" name="phone" required autocomplete="phone_number" autofocus>

                <!-- Password -->
                <input type="password" id="defaultRegisterFormPassword"
                    class="form-control mb-4 @error('password') is-invalid @enderror" placeholder="Password"
                    name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!-- Confirm Password -->
                <input type="password" class="form-control mb-4"
                    placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">




                <div class="d-flex">
                    <a href="{{route('login')}}">Already have accounts?</a>
                </div>
                <!-- Sign up button -->
                <button id="register" class="btn btn-info my-4 btn-block" type="submit">Sign Up</button>

            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $('#defaultRegisterFormEmail').blur(function(){
            var error_email = '';
            var _token = $('input[name="_token"]').val();
            var email = $('#defaultRegisterFormEmail').val();


            $.ajax({
                url:"{{route('checkEmail')}}",
                type: "GET",
                data:{email:email, _token:_token},

                success:function(result){
                    if(result == "unique"){
                        $('#error_email').html('<label class="text-success"> Email Available </label>');
                        $('#defaultRegisterFormEmail').removeClass("has-error");
                        $('#register').attr('disable', false);

                    }
                    else{
                        $('#error_email').html('<label class="text-danger"> Email is not Available </label>');
                        $('#defaultRegisterFormEmail').addClass('has-error');
                        $('#register').attr('disable', 'disable');

                    }
                }
            });
        });

    });
</script>
@endsection
