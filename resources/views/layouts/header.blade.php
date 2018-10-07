<style type="text/css">
    .application-main {
        margin-top: 50px  !important;
    }
</style>


<div class="logged-out page-responsive min-width-0 signup">
    <div class="position-relative js-header-wrapper ">

        <header class="Header header-logged-out js-details-container Details position-relative f4 py-3" role="banner">
            <div class="container-lg d-lg-flex p-responsive">
                <div class="d-flex flex-justify-between flex-items-center">
                    <a class="header-logo-invertocat my-0" href="/" aria-label="Homepage">
                        QuikService
                    </a>
                </div>

                <div class="HeaderMenu d-lg-flex flex-justify-between flex-auto">
                    <nav class="mt-3 mt-lg-0">
                        <ul class="d-lg-flex list-style-none">
                            <li class="ml-lg-2">
                                <a class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0" href="/features">
                                    Features
                                </a>
                            </li>
                            <li class="ml-lg-4">
                                <a class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0" href="/business">
                                    Business
                                </a>
                            </li>

                            <li class="ml-lg-4">
                                <a class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0" href="/explore">
                                    Explore
                                </a>
                            </li>

                            <li class="ml-lg-4">
                                <a class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0" href="/marketplace">
                                    Marketplace
                                </a>
                            </li>
                            <li class="ml-lg-4">
                                <a class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0" href="/pricing">
                                    Pricing
                                </a>
                            </li>
                        </ul>
                    </nav>

                    @if(!isset($user))
                    <div class="d-lg-flex HeaderNavlinkDiv">

                        <span class="d-block d-lg-inline-block">
                            <div class="HeaderNavlink px-0 py-2 m-0">
                              <a class="text-bold text-white no-underline" href="{{ route('login_view') }}">Sign in</a>
                                <span class="text-shady">or</span>
                                <a class="text-bold text-white no-underline" href="{{ route('register_view') }}">Sign up</a>
                            </div>
                        </span>
                    </div>
                    @else
                        @include('partials.header-account')
                    @endif
                </div>
            </div>
        </header>

    </div>
</div>