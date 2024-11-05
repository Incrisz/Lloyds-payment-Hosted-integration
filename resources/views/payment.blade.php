<!DOCTYPE HTML>
<html>
<head>
    <title>IPG Connect Sample for Laravel</title>
</head>
<body>
    <h1>Order Form</h1>

    <form method="post" action="https://test.ipg-online.com/connect/gateway/processing">
        @csrf
        <fieldset>
            <legend>IPG Connect Request Details</legend>
            <p><label for="storename">Store ID:</label>
               <input type="text" name="storename" value="{{ $storeId }}" readonly /></p>
            <p><label for="timezone">Timezone:</label>
               <input type="text" name="timezone" value="{{ $timezone }}" readonly /></p>
            <p><label for="txntype">Transaction Type:</label>
               <input type="text" name="txntype" value="{{ $txntype }}" readonly /></p>
            <p><label for="chargetotal">Transaction Amount:</label>
               <input type="text" name="chargetotal" value="{{ $chargetotal }}" readonly /></p>
            <p><label for="currency">Currency (ISO4217):</label>
               <input type="text" name="currency" value="{{ $currency }}" readonly /></p>
            <p><label for="txndatetime">Transaction DateTime:</label>
               <input type="text" name="txndatetime" value="{{ $txndatetime }}" readonly /></p>
            <p><label for="responseSuccessURL">Response Success URL:</label>
               <input type="text" name="responseSuccessURL" value="{{ $responseSuccessURL }}" readonly /></p>
            <p><label for="responseFailURL">Response Fail URL:</label>
               <input type="text" name="responseFailURL" value="{{ $responseFailURL }}" readonly /></p>
            <p><label for="hashExtended">Hash Extended:</label>
               <input type="text" name="hashExtended" value="{{ $hashOutput }}" readonly /></p>
            <p><label for="hash_algorithm">Hash Algorithm:</label>
               <input type="text" name="hash_algorithm" value="{{ $hash_algorithm }}" readonly /></p>
            <p><label for="checkoutoption">Checkout option:</label>
               <input type="text" name="checkoutoption" value="{{ $checkoutoption }}" readonly /></p>
            <p><input type="submit" id="submit" value="Submit" /></p>
        </fieldset>
    </form>
</body>
</html>
