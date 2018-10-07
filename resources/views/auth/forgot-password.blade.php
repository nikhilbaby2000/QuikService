@extends('layouts.base')

@section('title')
    Forgot Password | QuikService
@endsection

@section('content')

<div class="logged-out env-production page-responsive min-width-0 session-authentication">

    <div role="main" class="application-main forgot-password">

        <div>
            <div class="auth-form px-3">

                <form action="{{ route('forgot_password') }}" accept-charset="UTF-8" method="post" >
                    {{ csrf_field() }}
                    <div class="auth-form-header p-0">
                        <h1>Reset your password</h1>
                    </div>

                    <div id="js-flash-container">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                @include('partials.flash-message', ['type' => 'error', 'message' => $error])
                            @endforeach
                        @endif
                    </div>

                    <?php $passwordReset = get_flash('reset-send') ?>

                    <div class="auth-form-body mt-3">
                        @if(!$passwordReset)
                        <label for="email">Enter your email address and we will send you a link to reset your password.</label>
                        <input type="text" name="email" id="email" class="form-control input-block" tabindex="1" placeholder="Enter your email address">
                            <input type="submit" value="Send password reset email" tabindex="3" class="btn btn-primary btn-block">
                        @else
                            <p>{{ $passwordReset }}</p>
                            <a type="button" href="{{ route('login_view') }}" value="Return to sign in" tabindex="3" class="btn btn-primary btn-block">Return to sign in</a>
                        @endif
                    </div>

                </form>
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