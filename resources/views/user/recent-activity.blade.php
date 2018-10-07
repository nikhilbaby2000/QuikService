<div id="js-contribution-activity" class="activity-listing contribution-activity" data-pjax-container="">


    <div class="profile-timeline-year-list js-profile-timeline-year-list bg-white float-right col-2 pl-5 is-placeholder" style="visibility: hidden; display: none; height: 210px;"></div>
    <div class="profile-timeline-year-list js-profile-timeline-year-list bg-white js-sticky float-right col-2">
        <ul class="filter-list small">
            <li>
                <a href="/home?tab=overview&amp;from=2018-10-01&amp;to=2018-10-06" id="year-link-2018" class="js-year-link filter-item px-3 py-2 selected" aria-label="Contribution activity in 2018">
                    2018
                </a>
            </li>
            <li>
                <a href="/home?tab=overview&amp;from=2017-12-01&amp;to=2017-12-31" id="year-link-2017" class="js-year-link filter-item px-3 mb-2 py-2 " aria-label="Contribution activity in 2017">
                    2017
                </a>
            </li>
            <li>
                <a href="/home?tab=overview&amp;from=2016-12-01&amp;to=2016-12-31" id="year-link-2016" class="js-year-link filter-item px-3 mb-2 py-2 " aria-label="Contribution activity in 2016">
                    2016
                </a>
            </li>
            <li>
                <a href="/home?tab=overview&amp;from=2015-12-01&amp;to=2015-12-31" id="year-link-2015" class="js-year-link filter-item px-3 mb-2 py-2 " aria-label="Contribution activity in 2015">
                    2015
                </a>
            </li>
            <li>
                <a href="/home?tab=overview&amp;from=2014-12-01&amp;to=2014-12-31" id="year-link-2014" class="js-year-link filter-item px-3 mb-2 py-2 " aria-label="Contribution activity in 2014">
                    2014
                </a>
            </li>
        </ul>
    </div>

    <h2 class="f4 text-normal mb-2">
        Your activity

        <details class="details-reset details-overlay js-dropdown-details float-right dropdown">
            <summary class="f5 select-menu-button muted-link" aria-haspopup="true">
                Jump to
            </summary>

            <div class="f5 dropdown-menu dropdown-menu-sw timeline-jump-to-menu" role="menu">
                <a class="dropdown-item" href="/home?tab=overview&amp;from=2015-08-01&amp;to=2015-08-31#" role="menuitem">
                    First Service
                </a>
                <a class="dropdown-item" href="/home?tab=overview&amp;from=2014-10-01&amp;to=2014-10-31#" role="menuitem">
                    Best Service
                </a>
                <a class="dropdown-item" href="/home?tab=overview&amp;from=2014-10-01&amp;to=2014-10-31#" role="menuitem">
                    Bad Service
                </a>
            </div>
        </details>

    </h2>


    @include('user.activity.month', ['month' => 'October', 'year' => 2018 ])
    @include('user.activity.month', ['month' => 'September', 'year' => 2018, 'activities' => [
        [
            'desc' => 'Had a Tyre Change',
            'shop_name' => 'Phoenix Auto, Ernakulam',
            'cost' => '786',
        ],
    ] ])


    <form class="ajax-pagination-form js-ajax-pagination js-show-more-timeline-form col-10" accept-charset="UTF-8" method="get">
        <p class="text-gray f6 mt-4">
            Seeing something unexpected? Take a look at the
            <a href="info/setting-up-and-managing-your-profile">profile guide</a>.
        </p>
    </form>

</div>