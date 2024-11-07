<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class LloydsController extends Controller
{

    public function showForm()
    {
        // Return a simple form for selecting the payment gateway
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        // Retrieve the store ID and shared secret from the .env file
        $storeId = env('LLOYDS_STORE_ID');
        $sharedSecret = env('LLOYDS_SHARED_SECRET');
    
        // Set transaction details
        $timezone = "Europe/London";
        $txntype = "sale";
        $chargetotal = "13.00";  // This can be dynamic, for example, based on the cart total
        $currency = "826";       // GBP
        $txndatetime = gmdate("Y:m:d-H:i:s");
        $responseSuccessURL = route('payment.success');  // Dynamic route for success
        $responseFailURL = route('payment.failure');    // Dynamic route for failure
        $checkoutoption = "combinedpage";  // Redirect to the Lloyds page for card entry
        $hash_algorithm = "HMACSHA256";    // Ensure this is set
    
        // Concatenate string for hash generation
        $stringToHash = $chargetotal . "|" . $checkoutoption . "|" . $currency . "|" . $hash_algorithm . "|" .
            $responseFailURL . "|" . $responseSuccessURL . "|" . $storeId . "|" .
            $timezone . "|" . $txndatetime . "|" . $txntype;
    
        // Generate the hash
        $hash = hash_hmac('sha256', $stringToHash, $sharedSecret, true);
        $hashOutput = base64_encode($hash);
    
        // Prepare the data to send to the Lloyds endpoint
        $data = [
            'storeId' => $storeId,
            'timezone' => $timezone,
            'txntype' => $txntype,
            'chargetotal' => $chargetotal,
            'currency' => $currency,
            'txndatetime' => $txndatetime,
            'responseSuccessURL' => $responseSuccessURL,
            'responseFailURL' => $responseFailURL,
            'checkoutoption' => $checkoutoption,
            'hashExtended' => $hashOutput,
            'hash_algorithm' => $hash_algorithm
        ];
    
        // Return a view that submits the form automatically
        return view('payment.redirect', compact('data'));
    }
    

}
