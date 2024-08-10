<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripePost(Request $request)

    {
        $postDate = $request->all();
        try{
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));  
            $striptCharge = Stripe\Charge::create ([

                    "amount" => $postDate['price'] * 100,

                    "currency" => "usd",

                    "source" => $request->stripeToken,

                    "description" => $postDate['name'] 

            ]);
            Session::flash('success', 'Payment successful!');
            return back();
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return back();

        }
    }
}
