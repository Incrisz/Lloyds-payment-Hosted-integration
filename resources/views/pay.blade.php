<!DOCTYPE HTML>
<html>
<head>
    <title>IPG Connect Sample for PHP</title>
</head>
<body>
    <h1>Order Form</h1>
    <?php
// Fields based on your provided details
$storeId = "2220541904";
$timezone = "Europe/London";
$txntype = "sale";
$chargetotal = "13.00";
$currency = "826";
$txndatetime = gmdate("Y:m:d-H:i:s");
$responseSuccessURL = "https://lloyds.mebany.com/success.php";
$responseFailURL = "https://lloyds.mebany.com/failure.php";
$checkoutoption = "combinedpage";
$hash_algorithm = "HMACSHA256"; // Ensure this is set

// Secret from a secure source
$sharedSecret = "p}m67qc/DN"; 

// the concatenated string
$stringToHash = $chargetotal . "|" . $checkoutoption . "|" . $currency . "|" . $hash_algorithm . "|" .
    $responseFailURL . "|" . $responseSuccessURL . "|" . $storeId . "|" .
    $timezone . "|" . $txndatetime . "|" . $txntype;

// Display the concatenated string for comparison
echo "Concatenated String: " . $stringToHash . "<br>";

// Generate the hash
$hash = hash_hmac('sha256', $stringToHash, $sharedSecret, true);
$hashOutput = base64_encode($hash);

// Display the generated hash for verification
echo "Generated Hash: " . $hashOutput . "<br>";
?>


    <form method="post" action="https://test.ipg-online.com/connect/gateway/processing">
        <p><label for="storename">Store ID:</label>
           <input type="text" name="storename" value="<?php echo $storeId; ?>" /></p>
        <p><label for="timezone">Timezone:</label>
           <input type="text" name="timezone" value="<?php echo $timezone; ?>" /></p>
        <p><label for="txntype">Transaction Type:</label>
           <input type="text" name="txntype" value="<?php echo $txntype; ?>" /></p>
        <p><label for="chargetotal">Transaction Amount:</label>
           <input type="text" name="chargetotal" value="<?php echo $chargetotal; ?>" /></p>
        <p><label for="currency">Currency (ISO4217):</label>
           <input type="text" name="currency" value="<?php echo $currency; ?>" /></p>
        <p><label for="txndatetime">Transaction DateTime:</label>
           <input type="text" name="txndatetime" value="<?php echo $txndatetime; ?>" /></p>
        <p><label for="responseSuccessURL">Response Success URL:</label>
           <input type="text" name="responseSuccessURL" value="<?php echo $responseSuccessURL; ?>" /></p>
        <p><label for="responseFailURL">Response Fail URL:</label>
           <input type="text" name="responseFailURL" value="<?php echo $responseFailURL; ?>" /></p>
           <p>
    <label for="hashExtended">Hash Extended:</label>
    <input type="text" name="hashExtended" value="<?php echo $hashOutput; ?>" readonly="readonly" />
</p>
<p>
    <label for="hash_algorithm">Hash Algorithm:</label>
    <input type="text" name="hash_algorithm" value="<?php echo $hash_algorithm; ?>" readonly="readonly" />
</p>


        <p><label for="checkoutoption">Checkout Option:</label>
           <input type="text" name="checkoutoption" value="<?php echo $checkoutoption; ?>" /></p>
        <input type="submit" value="Submit">
    </form>
</body>
</html>