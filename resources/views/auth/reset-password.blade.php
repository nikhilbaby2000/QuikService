@extends('layouts.base')

@section('title')
    Reset Password | QuikService
@endsection

@section('content')

<div class="logged-out env-production page-responsive min-width-0 session-authentication">

    <div role="main" class="application-main forgot-password">

        <div>
            <div class="auth-form px-3">

                <form action="{{ route('reset_password', ['token' => $token]) }}" accept-charset="UTF-8" method="post" >
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

                    <div class="auth-form-body mt-3">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control input-block" tabindex="2" autocomplete="off">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control input-block" tabindex="2" autocomplete="off">

                        <input type="submit" name="commit" value="Reset password" tabindex="3" class="btn btn-primary btn-block" data-disable-with="Signing in…">
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