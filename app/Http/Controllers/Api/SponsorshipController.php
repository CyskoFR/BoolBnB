<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SponsorshipRequest;

class SponsorshipController extends Controller
{
    public function generate(Request $request, Gateway $gateway) {
        $token = $gateway->clientToken()->generate();
        $data = [ 
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function makePayment(SponsorshipRequest $request,  Gateway $gateway) {
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success) {
            $data = [ 
                'success' => true,
                'messagge' => "Transazione eseguita con successo bro ;)"
            ];
            return response()->json($data, 200);
        }else{
            $data = [ 
                'success' => false,
                'message' => "Trasanzione fallita bro :("
            ];
            return response()->json($data, 401);
        }
    }
}
