@extends('layouts.base')

@section('title')
    Verify Identity | QuikService
@endsection

@include('layouts.header')

@section('header')
    <style type="text/css">
        .flash-close {
            display: none !important;
        }
    </style>
@endsection

@section('content')

    @include('partials.flash-message', ['type' => 'warn',
    'message' => "<h4> Please verify your email address to access all of QuikService’s features. </h4>An email containing verification instructions was sent to $email."
    ])

<div class="setup-header setup-org">
        <h1>Welcome to QuikService</h1>
        <p class="lead">
            You've taken your first step into a larger world, <strong>{{ $email }}</strong>.<br>
        </p>

        <!-- Show steps for the signup flow -->
        <ol class="steps">
            <li class="complete text-center text-md-left">
                <svg height="32" class="octicon octicon-check float-none float-md-left mx-auto mr-md-3" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"></path></svg>
                <strong class="step">Completed</strong>
                Set up an account
            </li>
            <li class="current text-center text-md-left">
                <svg height="32" class="octicon octicon-versions float-none float-md-left mx-auto mr-md-3" viewBox="0 0 14 16" version="1.1" width="28" aria-hidden="true"><path fill-rule="evenodd" d="M13 3H7c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zm-1 8H8V5h4v6zM4 4h1v1H4v6h1v1H4c-.55 0-1-.45-1-1V5c0-.55.45-1 1-1zM1 5h1v1H1v4h1v1H1c-.55 0-1-.45-1-1V6c0-.55.45-1 1-1z"></path></svg>
                <strong class="step">Step 2:</strong>
                Verify Account
            </li>
            <li class="step-dashboard text-center text-md-left">
                <svg height="32" class="octicon octicon-gear float-none float-md-left mx-auto mr-md-3" viewBox="0 0 14 16" version="1.1" width="28" aria-hidden="true"><path fill-rule="evenodd" d="M14 8.77v-1.6l-1.94-.64-.45-1.09.88-1.84-1.13-1.13-1.81.91-1.09-.45-.69-1.92h-1.6l-.63 1.94-1.11.45-1.84-.88-1.13 1.13.91 1.81-.45 1.09L0 7.23v1.59l1.94.64.45 1.09-.88 1.84 1.13 1.13 1.81-.91 1.09.45.69 1.92h1.59l.63-1.94 1.11-.45 1.84.88 1.13-1.13-.92-1.81.47-1.09L14 8.75v.02zM7 11c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path></svg>
                <strong class="step">Step 3:</strong>
                Tailor your experience
            </li>
        </ol>
    </div>
@endsection
