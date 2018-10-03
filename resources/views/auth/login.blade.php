@extends('layouts.base')

@section('title')
    Sign in to QuikService
@endsection

@section('content')

<style type="text/css">
    .session-authentication .header-logged-out {
        background-color: transparent;
        border-bottom: 0;
    }
    .pt-5 {
        padding-top: 32px!important;
    }
    .pb-4 {
        padding-bottom: 24px!important;
    }
    .width-full {
        width: 100%!important;
    }
    .text-center {
        text-align: center!important;
    }
    .width-full {
        width: 100%!important;
    }
    .container {
        width: auto;
        margin-right: auto;
        margin-left: auto;
    }
    .clearfix::before {
        display: table;
        content: "";
    }
    .container::before {
        display: table;
        content: "";
    }
    .session-authentication .header-logo {
        color: #333;
    }
    svg:not(:root) {
        overflow: hidden;
    }
    .octicon {
        vertical-align: text-bottom;
    }
    .octicon {
        display: inline-block;
        vertical-align: text-top;
        fill: currentColor;
    }
    .session-authentication .header-logo {
        color: #333;
    }
</style>



<style type="text/css">
    .min-width-0 {
        min-width: 0!important;
    }
    body {
        min-width: 1012px;
        word-wrap: break-word;
        background-color: #ffff0061 !important;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        font-size: 14px;
        line-height: 1.5;
        color: #24292e;
    }
    .auth-form {
        width: 340px;
        margin: 0 auto;
    }
    .px-3 {
        padding-right: 16px!important;
        padding-left: 16px!important;
    }
    .session-authentication .create-account-callout {
        padding: 15px 20px;
        text-align: center;
        border: 1px solid #d8dee2;
        border-radius: 5px;
    }
    .mt-3 {
        margin-top: 16px!important;
    }
    p {
        margin-top: 0;
        margin-bottom: 10px;
    }
    .session-authentication .auth-form-header {
        margin-bottom: 15px;
        color: #333;
        text-align: center;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }
    .session-authentication .auth-form-header {
        margin-bottom: 15px;
        color: #333;
        text-align: center;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }
    .auth-form-header {
        padding: 10px 20px;
        margin: 0;
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0,0,0,0.3);
        background-color: #829aa8;
        border: 1px solid #768995;
        border-radius: 3px 3px 0 0;
    }
    .p-0 {
        padding: 0!important;
    }
    .session-authentication .auth-form-body {
        border-top: 1px solid #d8dee2;
        border-radius: 5px;
        background-color: #e4e4d630;
    }
    .auth-form-body {
        padding: 20px;
        font-size: 14px;
        background-color: #fff;
        border: 1px solid #d8dee2;
        border-top: 0;
        border-radius: 0 0 3px 3px;
    }
    .mt-3 {
        margin-top: 16px!important;
    }
    .session-authentication .auth-form label {
        display: block;
        margin-bottom: 7px;
    }
    label {
        font-weight: 600;
    }

    .auth-form-body .input-block {
        margin-top: 5px;
        margin-bottom: 15px;
    }
    .input-block {
        display: block;
        width: 100%;
    }
    @media (min-width: 768px) {
        .form-control, .form-select {
            font-size: 14px;
        }
    }
    .form-control, .form-select {
        min-height: 34px;
        padding: 6px 8px;
        font-size: 16px;
        line-height: 20px;
        color: #24292e;
        vertical-align: middle;
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: right 8px center;
        border: 1px solid #d1d5da;
        border-radius: 3px;
        outline: none;
        box-shadow: inset 0 1px 2px rgba(27,31,35,0.075);
    }
    input, select, textarea, button {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }
    button, input {
        overflow: visible;
    }
    button, input, select, textarea {
        font: inherit;
        margin: 0;
    }
    * {
            box-sizing: border-box;
        }
    .session-authentication .auth-form label {
        display: block;
        margin-bottom: 7px;
    }
    .auth-form-body .input-block {
        margin-top: 5px;
        margin-bottom: 15px;
    }
    .input-block {
        display: block;
        width: 100%;
    }
    .session-authentication .auth-form .btn {
        margin-top: 20px;
    }
    .btn-block {
        display: block;
        width: 100%;
        text-align: center;
    }
    .btn-primary {
        color: #fff;
        background-color: #28a745;
        background-image: linear-gradient(-180deg,#34d058 0%,#28a745 90%);
    }
    .btn {
        color: #24292e;
        background-color: #eff3f6;
        background-image: linear-gradient(-180deg,#fafbfc 0%,#eff3f6 90%);
    }
    .btn {
        position: relative;
        display: inline-block;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-repeat: repeat-x;
        background-position: -1px -1px;
        background-size: 110% 110%;
        border: 1px solid rgba(27,31,35,0.2);
        border-radius: 0.25em;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    button, html [type="button"], [type="reset"], [type="submit"] {
        -webkit-appearance: button;
    }
    input, select, textarea, button {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }
    button, input {
        overflow: visible;
    }
    button, input, select, textarea {
        font: inherit;
        margin: 0;
    }
    .session-authentication .create-account-callout {
        padding: 15px 20px;
        text-align: center;
        border: 1px solid #d8dee2;
        border-radius: 5px;
    }
    .mt-3 {
        margin-top: 16px!important;
    }
    a {
        color: #0366d6;
        text-decoration: none;
    }
    a {
        background-color: transparent;
    }
    .session-authentication .flash {
        padding: 15px 20px;
        margin: 0 auto;
        margin-bottom: 10px;
        font-size: 13px;
        border-style: solid;
        border-width: 1px;
        border-radius: 5px;
    }
    .flash-full {
        margin-top: -1px;
        border-width: 1px 0;
        border-radius: 0;
    }

    .flash {
        position: relative;
        padding: 16px;
        color: #032f62;
        background-color: #dbedff;
        border: 1px solid rgba(27,31,35,0.15);
        border-radius: 3px;
    }
    .flash-error {
        color: #86181d;
        background-color: #ffdce0;
        border-color: rgba(27,31,35,0.15);
    }
    a.login-alternative {
        font-size: 13px;
    }
    a.forgot-login {
        float: right;
    }
    button, html [type="button"], [type="reset"], [type="submit"] {
        -webkit-appearance: button;
    }
    .flash-close {
        float: right;
        padding: 16px;
        margin: -16px;
        color: inherit;
        text-align: center;
        cursor: pointer;
        background: none;
        border: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        opacity: 0.6;
    }
    body.min-width-0.page-responsive .flash-full .container {
        width: auto;
        max-width: 980px;
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

</style>

<div class="logged-out env-production page-responsive min-width-0 session-authentication">
    <div class="position-relative js-header-wrapper ">
        <div id="js-pjax-loader-bar" class="pjax-loader-bar"><div class="progress"></div></div>

        <div class="header header-logged-out width-full pt-5 pb-4" role="banner">
            <div class="container clearfix width-full text-center">
                <a class="header-logo" href="/" aria-label="Homepage">
                    <img src="{{ asset('car-wash-logo.png') }}" height="50px">
                </a>
            </div>
        </div>


    </div>
    <div role="main" class="application-main ">

        <div>
            <div class="auth-form px-3">

                <form action="{{ route('login') }}" accept-charset="UTF-8" method="post" >
                    {{ csrf_field() }}
                    <div class="auth-form-header p-0">
                        <h1>Sign in to QuikService</h1>
                    </div>

                    <div id="js-flash-container">
                        @if (get_flash('error'))
                            @include('partials.flash-message', ['type' => 'error', 'message' => get_flash('error')])
                        @endif
                    </div>

                    <?php
                        $isEmail = get_flash('by_email');
                    ?>

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
                            <input type="text" name="otp" id="otp" class="form-control form-control input-block" tabindex="2" autocomplete="off">

                            <input type="submit" name="commit" value="Sign in" tabindex="3" class="btn btn-primary btn-block">
                        </div>

                    </div>
                </form>

                {{--<p class="create-account-callout mt-3">--}}
                    {{--New to QuikService?--}}
                    {{--<a data-ga-click="Sign in, switch to sign up" href="{{ route('register_view') }}">Create an account</a>.--}}
                {{--</p>--}}
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