@extends('layouts.base')

@section('title')
    Sign in to QuikService
@endsection

@section('content')

<div class="logged-out env-production page-responsive min-width-0 session-authentication">
    <div class="position-relative js-header-wrapper ">
        <div id="js-pjax-loader-bar" class="pjax-loader-bar"><div class="progress"></div></div>

        {{--<div class="header header-logged-out width-full pt-5 pb-4" role="banner">
            <div class="container clearfix width-full text-center">
                <a class="header-logo" href="/" aria-label="Homepage">
                    <img src="{{ asset('car-wash-logo.png') }}" height="50px">
                </a>
            </div>
        </div>--}}

    </div>
    <div role="main" class="application-main">

        <div>
            <div class="auth-form px-3">

                <form action="{{ route('login') }}" accept-charset="UTF-8" method="post" novalidate>
                    {{ csrf_field() }}
                    <div class="auth-form-header p-0">
                        <h1>Sign in to QuikService</h1>
                    </div>

                    <?php
                    $isEmail = get_flash('by_email');
                    ?>

                    <div id="js-flash-container">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <?php $isEmail = substr_exist($error, 'email') ? 'email' : ''; ?>
                                @include('partials.flash-message', ['type' => 'error', 'message' => $error])
                            @endforeach
                        @endif
                        @if (get_flash('error'))
                            @include('partials.flash-message', ['type' => 'error', 'message' => get_flash('error')])
                        @endif
                        @if (get_flash('success'))
                            @include('partials.flash-message', ['type' => 'success', 'message' => get_flash('success')])
                        @endif
                    </div>

                    <div class="auth-form-body mt-3 login-email" @if(!(!empty($isEmail) && $isEmail == 'email')) style="display: none;" @endif>

                        <label for="email">Email address</label>
                        <input type="text" name="email" id="email" class="form-control input-block" tabindex="1" autocomplete="off">

                        <label for="password">
                            Password <a class="label-link forgot-login" href="{{ route('forgot_password') }}">Forgot password?</a>
                        </label>
                        <input type="password" name="password" id="password" class="form-control form-control input-block" tabindex="2" autocomplete="off">
                        <a class="label-link login-alternative" href="javascript:$('.login-email').slideUp(); $('.login-otp').slideDown();">Login with OTP?</a>

                        <input type="submit" value="Sign in" tabindex="3" class="btn btn-primary btn-block">
                    </div>

                    <div class="auth-form-body mt-3 login-otp" @if($isEmail == 'email') style="display: none;" @endif>

                        <div class="request-otp">
                            <label for="mobile">Mobile number</label>
                            <input type="number" max="10" name="mobile" id="mobile" class="form-control input-block" tabindex="1" autocomplete="off">
                            <a class="label-link login-alternative" href="javascript:$('.login-otp').slideUp(); $('.login-email').slideDown();">Login with Email?</a>
                            <input type="button" name="commit" value="Request OTP" class="btn btn-primary btn-block">
                        </div>

                        <div class="submit-otp" style="display: none;">
                            <label for="otp">
                                OTP <a class="label-link login-alternative" href="javascript:$('.login-otp').slideUp(); $('.login-email').slideDown();">Login with email?</a>
                            </label>
                            <input type="number" max="6" name="otp" id="otp" class="form-control form-control input-block" tabindex="2" autocomplete="off">

                            <input type="submit" name="commit" value="Sign in" tabindex="3" class="btn btn-primary btn-block">
                        </div>
                    </div>


                </form>

                <p class="auth-alternative mt-3 text-center">
                    <i class="fa fa-google fa-2x" aria-hidden="true"></i>
                    <i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
                </p>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('.request-otp input[type=button]').click(function () {
            ajax('{{ route('request_otp') }}',
                {mobile: $('#mobile').val()},
                function (response) {
                    if (!response.data.error) {
                        $('.request-otp').slideUp();
                        $('.submit-otp').slideDown();
                        message(response.success, 'success');
                    } else {
                        message(response.data.error, 'error');

                    }
                },
            function (jqxhr) {
                message(jqxhr.responseJSON.message, 'error');
            })
        });

    });
</script>
@endsection