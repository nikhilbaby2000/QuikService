<div class="setup-form-container currency-container js-details-container Details plans-wrapper">

    <input type="hidden" name="coupon" id="coupon" class="form-control">

    <h2 class="f2-light mb-3">
        Choose your plan
    </h2>

    <div class="d-flex gutter-spacious mb-4">
        <div class="col-8 mb-5 mb-md-0">
            <div class="Box box-shadow">
                <label class="d-flex flex-wrap flex-items-baseline Box-row js-plan-choice-label open" aria-live="polite">
                    <input type="radio" class="mr-2 js-plan-choice" name="organization[plan]" value="free" checked>
                    <span class="col-3 f3-light text-right" style="order:3">₹ 0</span>
                    <span class="col-8 mb-2">
                      <strong class="d-block">Free</strong>
                      <span class="d-block text-normal"><span class="d-block text-normal">Unlimited users and public repositories</span>
                      </span>
                    </span>
                </label>

                <label class="d-flex flex-wrap flex-items-baseline Box-row js-plan-choice-label" aria-live="polite">
                    <input type="radio" class="mr-2 js-plan-choice form-checkbox-details-trigger" name="organization[plan]" value="business">
                    <span class="col-3 f3-light text-right lh-condensed" style="order:3;">
                      ₹ 9
                      <span class="text-small d-block text-normal">/ month</span>
                    </span>
                    <span class="col-8 mb-2">
                      <span class="d-block mb-1 lh-condensed">
                        <strong class="d-block">Business</strong>
                      </span>
                      <span class="d-block text-normal">Unlimited public repositories</span>
                      <span class="d-block text-normal">Unlimited private repositories</span>
                    </span>
                </label>

                <label class="d-flex flex-wrap flex-items-baseline Box-row js-plan-choice-label" aria-live="polite">
                    <input type="radio" class="mr-2 form-checkbox-details-trigger js-plan-choice" name="organization[plan]" value="executive">
                    <span class="col-3 f3-light text-right lh-condensed" style="order:3">
                        ₹ 21
                        <span class="text-small d-block text-normal">/ month</span>
                    </span>
                    <span class="col-8 mb-2">
                        <span class="d-block mb-1 lh-condensed">
                          <strong class="d-block">Business Plus</strong>
                          <span class="text-normal text-small text-gray">
                              Includes everything in the <b>Business plan</b>, plus:
                          </span>
                        </span>
                        <span class="d-block text-normal">SAML based single sign-on (SSO)</span>
                        <span class="d-block text-normal">Access provisioning</span>
                    </span>

                    {{--<span class="d-block col-12 mb-2 text-small" style="order:5;">--}}
                        {{--Learn more about our <a href="/pricing/business-cloud">Business Plan</a> or--}}
                        {{--<a href="https://quikservice.com/plans/business">contact our team.</a>--}}
                    {{--</span>--}}

                </label>
            </div>
        </div>

        <div class="col-4">
            <p class="text-gray mt-md-n6">The plan you choose will be billed to the shop.</p>
        </div>
    </div>

    <div class="flash flash-warn my-4 d-none js-contact-us">
        Please contact us at
        <a href="mailto:sales@quikservice.com">sales@quikservice.com</a>
        for pricing and purchasing information.
    </div>

    <p class="note billing-note-block">
        Charges to your shop will be made in <strong>Indian Rupees (INR)</strong>.
    </p>
</div>