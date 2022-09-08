<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Sponsorship;
use Illuminate\Http\Request;
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
class SponsorshipController extends Controller
{
    public function index(Apartment $apartment, Sponsorship $sponsorship)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
        $token = $gateway->ClientToken()->generate();
        $sponsorships = Sponsorship::all();
        return view('admin.sponsorships.index', compact('apartment','token','sponsorships'));
    }

    public function checkout(Apartment $apartment, Sponsorship $sponsorship , Request $request)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship['price'],
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $apartment->user['first_name'],
                'lastName' => $apartment->user['last_name'],
                'email' => $apartment->user['email'],
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    
        if ($result->success) {
            $transaction = $result->transaction;
            return view('admin.sponsorships.transactionResult',compact('transaction'));//->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            $errorsArray = $result->errors;
            return view('admin.sponsorships.transactionResult',compact('errorsArray'));
        }

        //return view('admin.sponsorships.checkout', compact('result'));
    }
}
