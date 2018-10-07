<div class="mt-4">

    <div class="js-pinned-repos-reorder-container">
        <details class="details-reset details-overlay details-overlay-dark" id="choose-pinned-repositories">
            <summary class="btn-link muted-link float-right mt-1 pinned-repos-setting-link" aria-haspopup="dialog">Customize your pinned Services</summary>
            <details-dialog class="anim-fade-in fast Box Box--overlay d-flex flex-column" role="dialog">
                <div class="Box-header">
                    <button class="Box-btn-octicon btn-octicon float-right" type="button" aria-label="Close dialog" data-close-dialog="">
                        <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>
                    </button>
                    <h3>Customize your pinned Services</h3>
                    <p class="text-gray mb-0">
                        Select up to six services/shops you’d like to show.
                    </p>
                </div>
                <form class="js-pinned-repos-selection-form d-flex flex-column height-full overflow-hidden" action="/user/set-pinned-services" accept-charset="UTF-8" method="post">
                    <input name="utf8" type="hidden" value="✓">
                    <input type="hidden" name="_method" value="put">
                    <div class="Box-body">
                        <input type="search" class="form-control width-full js-pinned-repos-filter" placeholder="Filter Services" autofocus="autofocus">
                    </div>
                    <div class="Box-body overflow-auto">
                        <ul class="list-style-none position-relative js-pinned-repos-selection-list" data-max-repo-count="6">
                            <li class="js-pinned-repos-selection css-truncate js-owned-repo public source no-description d-block">
                                <input type="checkbox" name="repo_ids[]" value="150937939" id="pinned-item-150937939" class="pinned-repo-checkbox m-2 position-absolute">
                                <label class="pinned-repo-name d-flex pl-5 p-1" for="pinned-item-150937939">
                                    <strong class="css-truncate-target width-fit flex-auto js-repo">QuikService</strong>
                                    <span class="stars">1
                                      <svg aria-label="star" class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16" role="img">
                                          <path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path>
                                      </svg>
                                    </span>
                                </label>
                            </li>
                            <li class="text-gray m-1 js-no-repos-message d-none">No Services found.</li>
                        </ul>
                    </div>
                    <div class="Box-footer text-right">
                        <span class="js-remaining-pinned-repos-count float-left text-small float-left pt-3 lh-condensed-ultra " data-remaining-label="remaining">1 remaining</span>
                        <button type="submit" class="btn btn-primary">Save pinned repositories</button>
                    </div>
                </form>
            </details-dialog>
        </details>

        <h2 class="f4 mb-2 text-normal">Popular Services</h2>

        <ol class="pinned-repos-list mb-4">
            @include('user.pinned.shop', ['name' => 'Full Service', 'trust' => 4])
            @include('user.pinned.shop', ['name' => 'Tyre Change', 'trust' => 2])
            @include('user.pinned.shop', ['name' => 'Wheel Alignment', 'trust' => 4])
            @include('user.pinned.shop', ['name' => 'Repaint', 'trust' => 3.5])
        </ol>

    </div>

</div>