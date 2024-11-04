<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\LloydsPaymentHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LloydsCardnetController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        // Validate the request data if necessary
        
        return redirect()->to('https://test.ipg-online.com/connect/gateway/processing')
            ->withInput($request->except('chargetotal')); // Exclude sensitive data from session
    }
}
