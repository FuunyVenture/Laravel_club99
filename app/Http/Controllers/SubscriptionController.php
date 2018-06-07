<?php

namespace App\Http\Controllers;

use App\Address;
use App\Coupon;
use App\GiftCard;
use App\Invoice;
use App\Package;
use App\PaymentGateways\PnP;
use App\StorePayment;
use App\Subscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    /**
     * SubscriptionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSubscribe($package_id)
    {
        $package = Package::findOrfail($package_id);

        if (\Auth::user()->subscribed('MEMBERSHIP') || $package->id == getSetting('DEFAULT_PACKAGE_ID')) {
            return view('member.confirm_subscription')->with(compact('package'));
        } else {
            return view('member.card_configuration')->with(compact('package'));
        }
    }

    public function getCard()
    {
        if (\Auth::user()->subscribed('MEMBERSHIP')) {
            return view('member.card_configuration');
        } else {
            return back()->with('error', ' You must have a Stripe Subscription to continue');
        }
    }

    public function postCard(Request $request)
    {
        $creditCardToken = $request->input('creditCardToken');

        $user = \Auth::user();

        $user->updateCard($creditCardToken);

        $user->save();

        return redirect('member/profile')->with('success', 'Your Card Details Updated Successfully');
    }

    public function postSetSubscriptionCreditCard(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {

                /**
                 * Credit Card expire date validation
                 */
                $exp_date = preg_replace('/\s+/', '', $request->input('expire_date'));
                $card_date = Carbon::createFromFormat('m/y', $exp_date);
                if(!$card_date->gt(Carbon::today())) {
                    throw new Exception('Your Credit Card has expired!');
                }

                $couponValue = 0;

                /**
                 * Store in database
                 */
                $package = Package::findOrFail($request->input('package'));

                if($request->has('coupon_code')) {
                    $coupon = Coupon::whereCode($request->input('coupon_code'))->whereStatus('available')->first();

                    if (isset($coupon)) {
                        if($coupon->type == 'percentage') {
                            $couponValue = ($coupon->value / 100 * $package->cost);
                        } else {
                            $couponValue = $coupon->value;
                        }

                        $coupon->status = 'used';
                        $coupon->save();
                    }
                }

                $amountToPay = $package->cost - $couponValue;
                if($amountToPay < 0) $amountToPay = 0;

                if($amountToPay > 0) {
                    $invoice = new Invoice();
                    $invoice->total = $package->cost;
                    $invoice->user()->associate(Auth::user()->id);
                    $invoice->status = 'paid';
                    $invoice->save();

                    $invoice->name = 'Invoice-' . $invoice->id;
                    $invoice->save();

                    $invoice->products()->attach($package->product);

                    /*if($request->has('coupon_code')) {
                        $invoice->products()->attach($coupon->product);
                    }*/
                }

                $subscription = new Subscription();
                $subscription->package_id = $package->id;
                /*$subscription->invoice_id = $invoice->id;*/
                $subscription->ends_at = Carbon::now()->addYear();
                $subscription->save();

                $user = \Auth::user();
                $user->subscription_id = $subscription->id;
                $user->save();

                $billingAddress = new Address();
                $billingAddress->user_id = $user->id;
                $billingAddress->address1 = $request->input('address_line1');
                $billingAddress->address2 = $request->input('address_line2');
                $billingAddress->city = $request->input('city');
                $billingAddress->state = $request->input('state');
                $billingAddress->zip_code = $request->input('zipcode');
                $billingAddress->country = $request->input('country');
                $billingAddress->type = 'bill';
                $billingAddress->save();

                /**
                 * Make Credit Card Payment
                 */
                $p = new PnP();
                $result = $p->auth(
                    array(
                        'card-number' => preg_replace('/\s+/', '', $request->input('card_number')),
                        'card-name' => $request->input('card_name'),
                        'card-amount' => $amountToPay,
                        'card-exp' => $exp_date,
                        'ship-name' => $request->input('card_name'),
                        'card-cvv' => $request->input('cvc'),
                        'card-address1' => $request->input('address_line1'),
                        'card-address2' => $request->input('address_line2'),
                        'card-city' => $request->input('city'),
                        'card-state' => $request->input('state'),
                        'card-zip' => $request->input('zipcode'),
                        'card-country' => $request->input('country'),
                        'email' => Auth::user()->email
                    )
                );


                Log::info((array)$result);
                /**
                 * Throw error if Credit Card Payment response not success.
                 */
                if($result->FinalStatus != 'success') {
                    throw new Exception('Credit Card payment failed!');
                }
                Session::set('profile_completed', false );

            });
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }

        return ['message' => 'success'];

    }

    public function postSetSubscriptionCashInStore(Request $request)
    {
        DB::transaction(function () use ($request) {

            $package = Package::findOrFail($request->input('package'));

            $storeCode = new StorePayment();
            $storeCode->code = $request->input('receipt_code');
            $storeCode->save();

            $subscription = new Subscription();
            /*$subscription->user_id = Auth::user()->id;*/
            $subscription->ends_at = Carbon::now()->addYear();
            $subscription->package_id = $package->id;
            $subscription->status = 'pending';
            $subscription->store_payment()->associate($storeCode);
            $subscription->save();

            $user = \Auth::user();
            $user->subscription_id = $subscription->id;
            $user->save();

            Session::set('profile_completed', false );

        });

        return ['message' => 'success'];
    }

    public function postSetSubscriptionGiftCardCoupon(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $package = Package::findOrFail($request->input('package'));
                $giftCard = Auth::user()->gift_cards->where('code', $request->input('gift_card_number'))->first();
                $couponValue = 0;

                if($request->has('coupon_code')) {
                    $coupon = Coupon::whereCode($request->input('coupon_code'))->whereStatus('available')->first();

                    if (isset($coupon)) {
                        if($coupon->type == 'percentage') {
                            $couponValue = ($coupon->value / 100 * $package->cost);
                        } else {
                            $couponValue = $coupon->value;
                        }

                        $coupon->status = 'used';
                        $coupon->save();
                    }
                }

                if(!isset($giftCard)) {
                    throw new Exception('Invalid Gift Card!');
                }

                if (!($package->cost - $couponValue - $giftCard->value < 0)) {
                    throw new Exception('Not enough funds!');
                }

                /*$invoice = new Invoice();
                $invoice->total = $package->cost;
                $invoice->save();
                $invoice->name = 'Invoice-' . $invoice->id;
                $invoice->save();*/

                $subscription = new Subscription();
                $subscription->user_id = Auth::user()->id;
                $subscription->package_id = $package->id;
                $subscription->ends_at = Carbon::now()->addYear();
                $subscription->save();

                $user = \Auth::user();
                $user->subscription_id = $subscription->id;
                $user->save();

                Session::set('profile_completed', false );
            });
        } catch (Exception $e) {
            return ['error' => 'Not enough funds!'];
        }

        return ['message' => 'success'];
    }

    public function postVerifyCoupon(Request $request)
    {
        Log::info($request->all());

        $coupon = Coupon::whereCode($request->input('coupon_code'))
            ->whereStatus('available')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        Log::info($coupon);

        if (isset($coupon)) {
            return ['coupon' => $coupon];
        }
        return
            [
                'error' =>
                    [
                        'message' => 'Invalid coupon!'
                    ]
            ];

    }

    public function postCreateSubscriptionProfile(Request $request)
    {
        $user = \Auth::user();

        Log::info($request->all());

        DB::transaction(function () use ($request, $user) {
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->birthday = Carbon::createFromDate($request->input('birthday_birth')['year'],
                $request->input('birthday_birth')['month'],
                $request->input('birthday_birth')['day']);
            $user->save();

            $homeAddress = new Address();
            $homeAddress->user_id = $user->id;
            $homeAddress->home_number = $request->input('home_number');
            $homeAddress->mobile_number = $request->input('mobile_number');
            $homeAddress->address1 = $request->input('address_line1');
            $homeAddress->address2 = $request->input('address_line2');
            $homeAddress->city = $request->input('city');
            $homeAddress->state = $request->input('state');
            $homeAddress->zip_code = $request->input('zipcode');
            $homeAddress->country = $request->input('country');
            $homeAddress->type = 'home';
            $homeAddress->save();
        });

        return ['message' => 'success'];
    }

    public function postSwapSubscription(Request $request)
    {
        $package = Package::findOrFail($request->input('package_id'));

        $user = \Auth::user();
        if ($package->id == getSetting('DEFAULT_PACKAGE_ID')) {
            /**
             * this handle changing package to free package
             */
            if ($user->subscribed('MEMBERSHIP')) {
                $user->subscription('MEMBERSHIP')->cancel();
            }
            $user->package_id = getSetting('DEFAULT_PACKAGE_ID');

            $user->save();

            return redirect('member/profile')->with('success', $package->name . ' Package has been selected Successfully');
        } elseif ($user && $user->subscribed('MEMBERSHIP')) {

            $user->subscription('MEMBERSHIP')->swap($package->plan);

            $user->package_id = $package->id;

            $user->save();

            return redirect('member/profile')->with('success', $package->name . ' Package has been selected Successfully');
        } else {
            return redirect('member/profile')->with('error', 'you are facing some errors');
        }
    }

    public function getInvoices(Request $request)
    {
        $user = \Auth::user();

        $invoices = [];

        if ($user->stripe_id) {
            $invoices = $user->invoices();
        }

        return view('member.invoices')->with(compact('invoices'));
    }

    public function getDownloadInvoice($invoice)
    {
        return \Auth::user()->downloadInvoice($invoice, [
            'vendor' => getSetting('SITE_TITLE'),
            'product' => getSetting('SITE_TITLE'),
        ]);
    }

    public function getCancel()
    {
        return view('member.confirm_cancel_subscription');
    }

    public function deleteCancel()
    {
        $user = \Auth::user();

        $package = Package::findOrfail($user->package->id);

        if ($user->subscribed('MEMBERSHIP')) {
            $user->subscription('MEMBERSHIP')->cancel();
        }

        $user->package_id = 0;

        $user->save();

        return redirect('member/profile')->with('success', $package->name . ' Package has been cancelled Successfully');
    }

}
