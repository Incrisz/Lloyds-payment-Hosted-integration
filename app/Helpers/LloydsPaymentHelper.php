<?php

namespace App\Helpers;

class LloydsPaymentHelper
{
    public static function createExtendedHash($amount, $currency)
    {
        // Define your shared secret
        $sharedSecret = 'AoGvdRPcwizTIJDX6WGCoGK53RR4VnItuXA7Mj6UN2G'; // Replace with the shared secret provided by Lloyds

        // Store ID from Lloyds
        $storeId = '2220541904';

        // Get the current datetime in the required format
        $timestamp = now()->toIso8601String();

        // Create the string to hash
        $stringToHash = "{$storeId}{$amount}{$currency}{$timestamp}";

        // Generate the hash using HMAC SHA256
        return hash_hmac('sha256', $stringToHash, $sharedSecret);
    }
}
