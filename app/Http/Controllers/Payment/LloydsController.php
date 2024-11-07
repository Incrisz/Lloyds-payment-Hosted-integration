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

        // Concatenate string
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

        // Normally we would need to submit the data to Lloyds via a form submission
        // But instead, we will prepare the POST data and pass it to the Lloyds gateway
        $response = Http::asForm()->post('https://lloyds.mebany.com/hosted/public/process.php', $data);

        // Check if the request is successful and the response is ready
        if ($response->successful()) {
            // If successful, redirect the user to the actual payment gateway page (card details entry)
            return redirect()->to('https://test.ipg-online.com/connect/gateway/processing')->with([
                'data' => $data  // Pass the data to be used in the redirected page
            ]);
        } else {
            // If there's an issue with the request, redirect to failure page
            return redirect()->route('payment.failure');
        }
    }

}
