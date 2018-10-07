@extends('layouts.base')

@section('title')
    Home | QuikService
@endsection

@include('layouts.header')

@section('header')
<style type="text/css">
    .avatar-upload {
        display: none;
    }
    .avtar-left:hover .avatar-upload {
        display: block;
    }
</style>
@endsection

@section('content')

    <div role="main" class="application-main ">

        <div id="js-pjax-container" data-pjax-container="">

            <div class="container-lg clearfix px-3 mt-4">

                <div class="h-card col-3 float-left pr-3" itemscope="" itemtype="http://schema.org/Person">

                    <div class="user-profile-sticky-bar js-user-profile-sticky-bar">
                        <div class="user-profile-mini-vcard d-table">
                            <span class="user-profile-mini-avatar d-table-cell v-align-middle lh-condensed-ultra pr-2">
                              <img class="rounded-1" height="32" width="32" src="{{ avatar($user) }}">
                            </span>
                            {{--<span class="d-table-cell v-align-middle lh-condensed js-user-profile-following-mini-toggle">
                              <strong>nikhilbaby2000</strong>
                            </span>--}}
                        </div>
                    </div>

                    <a class="u-photo d-block tooltipped tooltipped-s avtar-left" aria-label="Change your avatar" href="/account">
                        <img alt="" width="230" height="230" class="avatar width-full rounded-2" src="{{ avatar($user) }}">
                        <div class="avatar-upload" style="margin-top: -51px; background: transparent;">
                            <label class="position-relative btn button-change-avatar mt-3 width-full text-center" style="background: transparent;">
                                Upload new picture
                                <input id="upload-profile-picture" type="file" class="manual-file-chooser width-full height-full ml-0 js-manual-file-chooser" >
                            </label>

                            <div class="upload-state loading">
                                <button type="button" class="btn mt-3 width-full text-center" disabled="">
                                    Uploading...
                                </button>
                            </div>
                        </div>
                    </a>


                    <div class="vcard-names-container py-3 js-user-profile-sticky-fields is-placeholder" style="visibility: hidden; display: none; height: 86px;"></div><div class="vcard-names-container py-3 js-sticky js-user-profile-sticky-fields" style="position: static; top: 0px; left: 184.5px; width: 229px;">
                        <h1 class="vcard-names">
                            <span class="p-name vcard-fullname d-block overflow-hidden" itemprop="name">Nikhil Baby</span>
                            {{--<span class="p-nickname vcard-username d-block" itemprop="additionalName">nikhilbaby2000</span>--}}
                        </h1>
                    </div>

                    <div class="p-note user-profile-bio js-user-profile-bio mb-3">
                        <div class="d-inline-block mb-3 js-user-profile-bio-contents">
                            <div>One of the best service center for Audi cars!</div>
                        </div>
                        <button type="button" class="btn width-full js-user-profile-bio-toggle">
                            Edit bio
                        </button>
                    </div>

                    <form class="d-none js-user-profile-bio-form mb-3" action="/my_bio" accept-charset="UTF-8" method="post">
                        <input name="utf8" type="hidden" value="✓">
                        <input type="hidden" name="_method" value="put">
                        <p class="flash flash-error js-update-bio-error p-2 d-none">
                        </p>
                        <div class="js-length-limited-input-container">
                            <textarea class="form-control js-length-limited-input js-quick-submit js-user-profile-bio-field mb-2 width-full" name="user[profile_bio]" placeholder="Add a bio" aria-label="Add a bio" rows="5" data-input-max-length="160" data-warning-text=" remaining">One of the best service center for Audi cars!</textarea>

                            <div class="d-flex flex-justify-between flex-items-center">
                                <div>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                    <button type="reset" class="btn btn-sm js-user-profile-bio-toggle">Cancel</button>
                                </div>
                                <span class="d-none js-length-limited-input-warning user-profile-bio-message m-0"></span>
                            </div>
                        </div>
                    </form>

                    <ul class="vcard-details">

                        <li itemprop="homeLocation" show_title="false" aria-label="Home location" class="vcard-detail pt-1 css-truncate css-truncate-target">
                            @include('partials.svg-location', ['location' => 'Kerala'])
                        </li>
                        <li itemprop="email" aria-label="Email" class="vcard-detail pt-1 css-truncate css-truncate-target">
                            @include('partials.svg-email', ['email' => $user->email])
                        </li>

                    </ul>


                    {{--<div class="border-top py-3 clearfix">
                        <h2 class="mb-1 h4">Branches</h2>
                        <a aria-label="Clusterz" itemprop="follows" class="tooltipped tooltipped-n avatar-group-item" href="/Clusterz">
                            <img src="https://avatars1.githubusercontent.com/u/13992241?s=70&amp;v=4" class="avatar" width="35" height="35" alt="@Clusterz">
                        </a>
                    </div>--}}
                </div>

                <div class="col-9 float-left pl-2">

                    <div class="UnderlineNav user-profile-nav top-0 is-placeholder" style="visibility: hidden; display: none; height: 55px;"></div>
                    <div class="UnderlineNav user-profile-nav js-sticky top-0" >
                        <nav class="UnderlineNav-body" data-pjax="" role="navigation">
                            <a href="/" class="UnderlineNav-item selected" aria-selected="true" role="tab" title="Overview">Overview</a>
                            <a href="/?tab=services" class="UnderlineNav-item " aria-selected="false" role="tab" title="Repositories">Services <span class="Counter">9</span></a>
                            <a href="/nikhilbaby2000?tab=stars" class="UnderlineNav-item " aria-selected="false" role="tab" title="Stars">Jobs <span class="Counter"> 0 </span></a>
                            <a href="/nikhilbaby2000?tab=followers" class="UnderlineNav-item " aria-selected="false" role="tab" title="Followers">Schedules <span class="Counter"> 0 </span></a>
                        </nav>
                    </div>

                    <div class="position-relative">

                        @include('user.pinned.shops')

                        <div class="mt-4">
                            @include('user.yearly-activity')
                            @include('user.recent-activity')

                        </div>

                        <div id="pinned-repos-modal-wrapper"></div>

                    </div>
                </div>
            </div>

        </div>
        <div class="modal-backdrop js-touch-events"></div>
    </div>

@endsection