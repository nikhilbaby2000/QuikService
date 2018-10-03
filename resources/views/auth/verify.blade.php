@extends('layouts.base')

@include('layouts.header')

@section('content')

    @include('partials.flash-message', ['type' => 'warn',
    'message' => "<h4> Please verify your email address to access all of QuikService’s features. </h4>An email containing verification instructions was sent to $email."
    ])

    <style type="text/css">
        .flash-close {
            display: none;
        }
        .setup-header {
            margin-right: 144px!important;
            margin-left: 144px!important;
            padding: 16px;
        }
        .setup-header h1 {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 45px;
            font-weight: 400;
            line-height: 1.1;
            letter-spacing: -1px;
        }
        .setup-header .lead {
            margin-top: 2px;
            margin-bottom: 0;
            font-size: 21px;
        }
        .lead {
            margin-bottom: 30px;
            font-size: 20px;
            font-weight: 300;
            color: #586069;
        }
        .steps {
            display: table;
            width: 100%;
            padding: 0;
            margin: 30px auto 0;
            overflow: hidden;
            list-style: none;
            border: 1px solid #dfe2e5;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(27,31,35,0.05);
        }
        .steps li:first-child {
            border-left: 0;
        }
        .steps .complete {
            color: #586069;
        }
        .steps li {
            display: table-cell;
            width: 33.3%;
            padding: 10px 15px;
            color: #c6cbd1;
            cursor: default;
            background-color: #fafbfc;
            border-left: 1px solid #dfe2e5;
        }
        @media (min-width: 768px) {
            .text-md-left {
                text-align: left!important;
            }
        }
        .steps li.current {
            color: #24292e;
            background-color: #fff;
        }
        .steps .complete .octicon {
            color: #28a745;
        }
        .steps li .octicon {
            float: left;
            margin-right: 15px;
            margin-bottom: 5px;
        }
        svg:not(:root) {
            overflow: hidden;
        }
        .steps li .step {
            display: block;
        }

    </style>

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
