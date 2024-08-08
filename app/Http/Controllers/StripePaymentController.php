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
        try{
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Session::flash('success', 'Payment successful!');
            return back();
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return back();

        }
    }
}
