<!DOCTYPE html>
<html>
<head>
    <title>Lloyds Payment</title>
</head>
<body>
    <h1>Order Form</h1>
    <form method="post" action="https://test.ipg-online.com/connect/gateway/processing">
        @csrf
        <input type="hidden" name="txntype" value="sale">
        <input type="hidden" name="timezone" value="Europe/Berlin"/>
        <input type="hidden" name="txndatetime" value="{{ \Carbon\Carbon::now()->toIso8601String() }}"/>
        <input type="hidden" name="hash_algorithm" value="HMACSHA256"/>
        <input type="hidden" name="storename" value="2220541904"/> <!-- Your Store ID -->
        <input type="hidden" name="checkoutoption" value="combinedpage"/>
        <input type="hidden" name="paymentMethod" value="M"/>
        <input type="text" name="chargetotal" value="13.00"/>
        <input type="hidden" name="currency" value="826"/>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
