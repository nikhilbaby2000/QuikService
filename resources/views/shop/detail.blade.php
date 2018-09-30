@extends('layouts.base')

@section('title')
    Shop Details
@endsection

@section('header')
    <style type="text/css">

    </style>
@endsection

@section('content')
    <div class="position-ref full-height">
        <div class="">

            <h3 class="shop-name">{{ $name }}</h3>

            <ul class="services">
                <li>
                    <span class="service-name">Full Wash</span>
                    <span class="service-amount">250</span>
                </li>
                <li>
                    <span class="service-name">Wax</span>
                    <span class="service-amount">89</span>
                </li>
            </ul>
        </div>
    </div>
@endsection

