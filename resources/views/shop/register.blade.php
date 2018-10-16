@extends('layouts.base')

@section('title')
    Register your Shop | QuikService
@endsection

@include('layouts.header')

@section('header')
@endsection

@section('content')

<div role="main" class="application-main" style="margin-top: 0 !important;">

    <div id="js-pjax-container" data-pjax-container="">
        <div class="container-lg p-responsive py-5">
            <form class="clearfix js-braintree-encrypt setup-form" id="new-organization" action="{{ route('register_shop') }}" accept-charset="UTF-8" method="post">

                {{ csrf_field() }}

                <div class="setup-header setup-org">
                    <h1>Register your Shop</h1>

                    <ol class="steps">
                        <li class="current text-center text-md-left">
                            @include('svg.people', ['class' => 'octicon octicon-organization'])
                            <strong class="step">Step 1:</strong>
                            Set up the Shop
                        </li>
                        <li class="text-center text-md-left">
                            @include('svg.jacket', ['class' => 'octicon octicon-jersey'])
                            <strong class="step">Step 2:</strong>
                            Choose a plan
                        </li>
                        <li class="text-center text-md-left">
                            @include('svg.gear', ['class' => 'octicon octicon-gear'])
                            <strong class="step">Step 3:</strong>
                            Add Shop details
                        </li>
                    </ol>

                </div>

                <div class="d-flex gutter-spacious mb-3">
                    <div class="col-8">
                        <div class="setup-form-container currency-container js-details-container Details">
                            <h2 class="f2-light lh-condensed">Create a Shop account</h2>

                            <div class="col-10">
                                <auto-check src="{{ route('verify_shop') }}">
                                    <dl class="form-group required">
                                        <dt class="input-label">
                                            <label required="required" for="shop_name">Shop name</label>
                                        </dt>
                                        <dd>
                                            <input class="form-control js-new-organization-name" required="required" type="text" name="shop_name" id="shop_name" autocomplete="off" spellcheck="false">
                                            <p class="note">This will be your shop name on https://quikservice.in/.</p>
                                        </dd>
                                    </dl>
                                </auto-check>

                                <dl class="form-group required">
                                    <dt class="input-label">
                                        <label required="required" for="billing_email">Billing email</label>
                                    </dt>
                                    <dd>
                                        <input class="form-control js-new-organization-billing-email" required="required" type="text" name="billing_email" id="billing_email">
                                        <p class="note">We’ll send receipts to this email.</p>
                                    </dd>
                                </dl>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional input if the user is transforming into an organization. -->

                @include('shop.plans')

                    <div class="col-8">
                        <p class="tos-info">By clicking on "Create Shop" below, you are agreeing to the
                            <a href="/site/terms" target="_blank" class="js-tos-link" aria-hidden="false">Terms of Service</a>
                            <a href="/site/corporate-terms" target="_blank" class="js-corp-tos-link d-none" aria-hidden="true">Corporate Terms of Service</a> and the
                            <a href="/site/privacy" target="_blank">Privacy Policy</a><span class="js-company-name-text"></span>.</p>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary js-purchase-button" disabled id="create_shop">Create your Shop</button>
                    </div>

            </form>
        </div>
    </div>

</div>



@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('#shop_name, #billing_email').keypress(function () {
            if ($('#shop_name').val() && $('#billing_email').val()) {
                $('#create_shop').removeAttr('disabled');
            } else {
                $('#create_shop').attr('disabled', 'disabled');
            }
        });

    })
</script>
@endsection
