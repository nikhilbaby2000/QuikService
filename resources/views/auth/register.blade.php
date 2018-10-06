@extends('layouts.base')

@section('title')
    Register | QuikService
@endsection

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/basic.css') }}">
@endsection

@include('layouts.header')

@section('content')

<div class="logged-out env-production page-responsive min-width-0 session-authentication">
    <div class="position-relative js-header-wrapper ">

    </div>
    <div role="main" class="application-main " style="margin-top: 50px">

        <div id="js-pjax-container" data-pjax-container="">


            <div class="auth-form px-3" id="login">

                <form action="{{ route('register') }}" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓">
                    {{ csrf_field() }}
                    <div class="auth-form-header p-0">
                        <h1>Sign up to QuikService</h1>
                    </div>

                    <div id="js-flash-container">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                @include('partials.flash-message', ['type' => 'error', 'message' => $error])
                            @endforeach
                        @endif
                    </div>

                    <div class="auth-form-body mt-3">

                        <label for="email">Email address</label>
                        <input type="email" name="email" id="email" class="form-control input-block" tabindex="1" autocapitalize="off" autocorrect="off" autofocus="autofocus" autocomplete="off">

                        <label for="password">
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control form-control input-block" tabindex="2" autocomplete="off">
                        <label for="password_confirmation">
                            Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control input-block" tabindex="2" autocomplete="off">

                        <input type="submit" name="commit" value="Sign up" tabindex="3" class="btn btn-primary btn-block" data-disable-with="Signing in…">
                    </div>
                </form>
            </div>


        </div>

    </div>
</div>

@endsection