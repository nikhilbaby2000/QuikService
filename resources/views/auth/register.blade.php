@extends('layouts.base')

@section('title')
    Sign in to QuikService
@endsection

@include('layouts.header')

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
        width: 980px;
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
        background-color: #f9f9f9 !important;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        font-size: 14px;
        line-height: 1.5;
        color: #24292e;
        margin: 0 !important
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
        text-decoration: none;
    }
    a {
        background-color: transparent;
    }

</style>

<div class="logged-out env-production page-responsive min-width-0 session-authentication">
    <div class="position-relative js-header-wrapper ">

        {{--<div class="header header-logged-out width-full" role="banner">--}}
            {{--<div class="container clearfix width-full text-center">--}}
                {{--<a class="header-logo" href="https://github.com/" aria-label="Homepage" data-ga-click="(Logged out) Header, go to homepage, icon:logo-wordmark">--}}
                    {{--<img src="{{ asset('car-wash-logo.png') }}" height="50px">--}}
                    {{--<svg height="48" class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" width="48" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}


    </div>
    <div role="main" class="application-main " style="margin-top: 50px">

        <div id="js-pjax-container" data-pjax-container="">


            <div class="auth-form px-3" id="login">

                <form action="{{ route('login') }}" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓">
                    {{ csrf_field() }}
                    <div class="auth-form-header p-0">
                        <h1>Sign in to QuikService</h1>
                    </div>

                    <div id="js-flash-container"></div>

                    <div class="auth-form-body mt-3">

                        <label for="login_field">Email address</label>
                        <input type="text" name="login" id="login_field" class="form-control input-block" tabindex="1" autocapitalize="off" autocorrect="off" autofocus="autofocus" autocomplete="off">

                        <label for="password">
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control form-control input-block" tabindex="2" autocomplete="off">
                        <label for="confirm_password">
                            Confirm Password
                        </label>
                        <input type="confirm_password" name="confirm_password" id="confirm_password" class="form-control form-control input-block" tabindex="2" autocomplete="off">

                        <input type="submit" name="commit" value="Sign up" tabindex="3" class="btn btn-primary btn-block" data-disable-with="Signing in…">
                    </div>
                </form>

            </div>

        </div>
        <div class="modal-backdrop js-touch-events"></div>
    </div>
</div>

@endsection