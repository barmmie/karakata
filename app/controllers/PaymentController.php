<?php use Omnipay\Omnipay;

class PaymentController extends Controller
{

    public function displayItemReceipt($id)
    {

        $item = Item::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->with('picture')
            ->firstOrFail();

        if (Setting::get('allow_premium_payment', '0') == '0') {
            flashError('Payment not allowed on platform', 'Contact administrator to enable payment');

            return Redirect::route('dash.myitems');
        }

        if ($item->isRejected()) {
            flashError('That item has been rejected', 'You can not pay for an item that has been rejected');

            return Redirect::route('dash.myitems');
        }

        $data['product'] = trans('phrases.pay_for_premium') . ' on ' . Setting::get('site_name');
        $data['productImage'] = asset($item->mainThumbnail());
        $data['price'] = Setting::get('premium_amount', '10.00');
        $data['currency'] = Setting::get('paypal_currency', 'USD');
        $data['description'] = "Premium placement of ad '{$item->title}'";

        return View::make('payments.create', compact('item', 'data'));
    }

    public function postPayment()
    {

        $params = array(
            'cancelUrl' => route('payments.cancel', Input::get('item_id')),
            'returnUrl' => route('payments.success', Input::get('item_id')),
            'name' => Input::get('name'),
            'description' => Input::get('description'),
            'amount' => number_format(Setting::get('premium_amount', '40.00'), 2),
            'currency' => Setting::get('paypal_currency', 'USD')
        );

        Session::put('params', $params);
        Session::save();

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(Setting::get('paypal_username'));
        $gateway->setPassword(Setting::get('paypal_password'));
        $gateway->setSignature(Setting::get('paypal_signature'));
        $gateway->setTestMode(false);
        $response = $gateway->purchase($params)->send();

        if ($response->isSuccessful()) {
            //print_r($response);
        } elseif ($response->isRedirect()) {
            $response->redirect();
        } else {

            echo $response->getMessage();
        }
    }

    public function cancel($id)
    {
        flashError('Transaction cancelled', 'Transaction was cancelled by user on app');

        return Redirect::route('items.payment', $id);
    }

    public function success($id)
    {
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(Setting::get('paypal_username'));
        $gateway->setPassword(Setting::get('paypal_password'));
        $gateway->setSignature(Setting::get('paypal_signature'));
        $gateway->setTestMode(false);

        $params = Session::get('params');
        $response = $gateway->completePurchase($params)->send();
        $paypalResponse = $response->getData(); // this is the raw response object

        if (isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {

            $item = Item::findOrFail($id);
            $item->markAsPremium();

            flashSuccess('Transaction successful', 'Item has now been marked as premium');

            return Redirect::route('items.show', $item->slug);

        } else {
            flashError('Processing error', 'Could not process transaction');

            return Redirect::route('items.payment', $id);

        }
    }

    public function showStripeForm($id) {

        $item = Item::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->with('picture')
            ->firstOrFail();

        if (Setting::get('allow_stripe_premium_payment', '0') == '0') {
            flashError('Stripe payment not allowed on platform', 'Contact administrator to enable stripe payment');

            return Redirect::route('dash.myitems');
        }

        if ($item->isRejected()) {
            flashError('That item has been rejected', 'You can not pay for an item that has been rejected');

            return Redirect::route('dash.myitems');
        }

        $data['product'] = trans('phrases.pay_for_premium') . ' on ' . Setting::get('site_name');
        $data['productImage'] = asset($item->mainThumbnail());
        $data['price'] = Setting::get('premium_amount', '10.00');
        $data['currency'] = Setting::get('paypal_currency', 'USD');
        $data['description'] = "Premium placement of ad '{$item->title}'";

        return View::make('payments.stripe_form', compact('item', 'data'));

    }

    public function processExistingStripePayment($id) {
        try {
            DB::transaction(function() use ($id) {
                \Stripe\Stripe::setApiKey(Setting::get('stripe_api_secret_key'));

                \Stripe\Charge::create(array(
                        "amount" => number_format(Setting::get('premium_amount', '10.00'), 2) * 100, // amount in cents, again
                        "currency" => Setting::get('stripe_currency'),
                        "customer" => Auth::user()->stripe_customer_id)
                );

	            $item = Item::findOrFail($id);
	            $item->markAsPremium();
            });



            flashSuccess(trans('phrases.operation_successful'));
            return Redirect::route('dash.myitems');
        } catch(Exception $e) {
            flashError(trans('phrases.operation_successful'), $e->getMessage());
            return Redirect::route('items.stripe_form', $id);
        }
    }

    public function processStripeForm($id) {


        try {
            \Stripe\Stripe::setApiKey(Setting::get('stripe_api_secret_key'));

            $token = Input::get('stripeToken');


            DB::transaction(function() use ($token, $id){
                $customer = \Stripe\Customer::create(array(
                        "source" => $token,
                        "description" => Auth::user()->full_name.' | '.Auth::user()->email)
                );

                $user = User::find(Auth::user()->id);
                $user->updateStripeCustomer($customer);

                \Stripe\Charge::create(array(
                        "amount" => number_format(Setting::get('premium_amount', '40.00'), 2) * 100, // amount in cents, again
                        "currency" => Setting::get('stripe_currency'),
                        "customer" => $customer->id)
                );
                $item = Item::findOrFail($id);
                $item->markAsPremium();


            });

            flashSuccess(trans('phrases.operation_successful'));
            return Redirect::route('dash.myitems');
        } catch(Exception $e) {
            flashError(trans('phrases.operation_successful'), $e->getMessage());
            return Redirect::route('items.stripe_form', $id);
        }

    }
}