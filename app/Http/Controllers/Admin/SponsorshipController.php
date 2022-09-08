<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Sponsorship;
use Carbon\Carbon;
use DateTime;
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

        //sponsorizzazione completata , da verificare il check sulla sponsorizzazione attiva
        $apartment->sponsorships()->save($sponsorship, ['expiration_date'=>Carbon::now()->addHours($sponsorship['duration']) ]);
        dd($request);
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
            // aggiungi il messaggio nella pivot con expireday
            $apartment->sponsorships()->save($sponsorship, ['expiration_date'=>Carbon::now()->addDay($sponsorship['duration']/24) ]);
            return view('admin.sponsorships.transactionResult',compact('transaction'));
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
