@extends('email.layout')

@section('content')
    <div class="content">
        <div class="content-header content-header--blue">
            Welcome to QuikService!
        </div>
        <div class="content-body">
            <p>Hi {{ $user->name }},</p>

            <div class="text-center">
                Click <a href="{{ url("verify-email/{$token}?email=".$user->email) }}" target="_blank" class="btn btn-default">here</a> Verify your email.
            </div>

            <div class="hr-line"></div>

            <p>We are committed to offering not just a Convenience but a Choice Driven by Technology.</p>

            <ul>
                <li>Choice of genuine and verified vendors</li>
                <li>No hidden charges</li>
                <li>Secured online payment</li>
            </ul>
        </div>
    </div>
@endsection
