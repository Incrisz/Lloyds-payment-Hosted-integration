<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\LloydsPaymentHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LloydsCardnetController extends Controller
{
    public function showPaymentForm()
    {
            // Load data from environment/config
            $storeId = env('LLOYDS_STORE_ID'); // Retrieve from .env with a default value
            $timezone = 'Europe/London';
            $txntype = 'sale';
            $chargetotal = '13.00';
            $currency = '826';
            $txndatetime = gmdate('Y:m:d-H:i:s');
            $responseSuccessURL = 'https://lloyds.mebany.com/success.php';
            $responseFailURL = 'https://lloyds.mebany.com/failure.php';
            $checkoutoption = 'combinedpage';
            $hash_algorithm = 'HMACSHA256';
            $sharedSecret = env('LLOYDS_SECRET'); // Retrieve from .env

            // Construct the concatenated string
            $stringToHash = $chargetotal . '|' . $checkoutoption . '|' . $currency . '|' . $hash_algorithm . '|' .
                $responseFailURL . '|' . $responseSuccessURL . '|' . $storeId . '|' .
                $timezone . '|' . $txndatetime . '|' . $txntype;

            // Generate the hash
            $hash = hash_hmac('sha256', $stringToHash, $sharedSecret, true);
            $hashOutput = base64_encode($hash);

            // Pass data to the view
            return view('payment', compact('storeId', 'timezone', 'txntype', 'chargetotal', 'currency', 'txndatetime', 'responseSuccessURL', 'responseFailURL', 'checkoutoption', 'hash_algorithm', 'hashOutput'));
    }

    public function processPayment(Request $request)
    {
        // Validate the request data if necessary
        
        return redirect()->to('https://test.ipg-online.com/connect/gateway/processing')
            ->withInput($request->except('chargetotal')); // Exclude sensitive data from session
    }
}
