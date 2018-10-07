@if(empty($activities))
<div class="contribution-activity-listing float-left col-10">
    <div class="profile-timeline discussion-timeline width-full pb-4">
        <h3 class="profile-timeline-month-heading bg-grey d-inline-block h6 pr-2 py-1">
            {{ $month }} <span class="text-gray">{{ $year }}</span>
        </h3>

        <div class="text-center text-gray pt-3">
              <span class="text-gray m-0">
                  You have activity yet for this period.
              </span>
        </div>
    </div>
</div>
@else
@foreach($activities as $activity)
<div class="contribution-activity-listing float-left col-10">
        <div class="profile-timeline discussion-timeline width-full pb-4">
            <h3 class="profile-timeline-month-heading bg-grey d-inline-block h6 pr-2 py-1">
                {{ $month }} <span class="text-gray">{{ $year }}</span>
            </h3>

            <div class="profile-rollup-wrapper py-4 pl-4 position-relative ml-3 js-details-container Details open">
                <span class="discussion-item-icon">
                  <svg class="octicon octicon-repo-push" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true">
                      <path fill-rule="evenodd" d="M4 3H3V2h1v1zM3 5h1V4H3v1zm4 0L4 9h2v7h2V9h2L7 5zm4-5H1C.45 0 0 .45 0 1v12c0 .55.45 1 1 1h4v-1H1v-2h4v-1H2V1h9.02L11 10H9v1h2v2H9v1h2c.55 0 1-.45 1-1V1c0-.55-.45-1-1-1z"></path>
                  </svg>
                </span>
                <button type="button" class="btn-link f4 muted-link no-underline lh-condensed width-full js-details-target" aria-expanded="false">
                  <span class="float-left">
                    {{ $activity['desc'] }}
                  </span>
                    <span class="d-inline-block float-right">
                        <span class="profile-rollup-toggle-closed float-right" aria-label="Collapse">
                          <svg class="octicon octicon-fold" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true">
                              <path fill-rule="evenodd" d="M7 9l3 3H8v3H6v-3H4l3-3zm3-6H8V0H6v3H4l3 3 3-3zm4 2c0-.55-.45-1-1-1h-2.5l-1 1h3l-2 2h-7l-2-2h3l-1-1H1c-.55 0-1 .45-1 1l2.5 2.5L0 10c0 .55.45 1 1 1h2.5l1-1h-3l2-2h7l2 2h-3l1 1H13c.55 0 1-.45 1-1l-2.5-2.5L14 5z"></path>
                          </svg>
                        </span>
                        <span class="profile-rollup-toggle-open float-right" aria-label="Expand">
                          <svg class="octicon octicon-unfold" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true">
                              <path fill-rule="evenodd" d="M11.5 7.5L14 10c0 .55-.45 1-1 1H9v-1h3.5l-2-2h-7l-2 2H5v1H1c-.55 0-1-.45-1-1l2.5-2.5L0 5c0-.55.45-1 1-1h4v1H1.5l2 2h7l2-2H9V4h4c.55 0 1 .45 1 1l-2.5 2.5zM6 6h2V3h2L7 0 4 3h2v3zm2 3H6v3H4l3 3 3-3H8V9z"></path>
                          </svg>
                        </span>
                    </span>
                </button>

                <ul class="profile-rollup-content list-style-none">
                    <li class="ml-0 py-1">
                        <div class="d-inline-block col-8 css-truncate css-truncate-target lh-condensed">
                            <a href="/shops/{{ slug($activity['shop_name']) }}">{{ $activity['shop_name'] }}</a>
                            <a href="/shops/{{ slug($activity['shop_name']) }}/history?author=nikhilbaby2000&amp;since=2018-08-31T18:30:00Z&amp;until=2018-09-30T18:30:00Z" class="f6 muted-link ml-1">
                                ₹ {{ $activity['cost'] }}
                            </a>
                        </div>
                    </li>
                </ul>

            </div>

        </div>
    </div>
@endforeach
@endif
