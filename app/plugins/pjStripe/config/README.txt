pjStripe - Stripe Checkout (hosted payment page)
-----------------------------------------------
No Stripe SDK is required, only PHP cURL (or allow_url_fopen). No webhook is used.

1. Install
	- Copy this folder to app/plugins/pjStripe/
	- Add 'pjStripe' to $CONFIG['plugins'] in app/config/options.inc.php
	- Existing installation: run app/config/updates/update_2026_10_13_10_00_00.sql
	- Fresh installation: the installer imports app/config/database.sql and this plugin's config/database.sql

2. Configure (admin: Options > Submissions)
	- Allow payments with Stripe checkout = Yes
	- Stripe secret key (sk_test_... for testing, sk_live_... for real payments)
	- Stripe public key (pk_test_... / pk_live_...)

3. How it works
	pjAdminProperties::pjActionStripeCheckout   creates the Checkout Session, the owner is redirected to Stripe
	pjListings::pjActionConfirmStripe           success_url, verifies the session with Stripe (paid + amount + currency)
	                                            and extends the property expiry date once

Note: without a webhook, the expiry date is extended only when the owner returns from Stripe.
If an owner pays and closes the browser before returning, the property is not extended;
find the payment in the Stripe Dashboard (the Checkout Session reference is "<property id>-<period id>")
and extend the property manually.
