<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Lloyds Payment Gateway</title>
</head>
<body>
    <h1>Redirecting to the Lloyds Payment Gateway...</h1>
    <form id="paymentForm" action="https://test.ipg-online.com/connect/gateway/processing" method="POST">
        @foreach ($data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script type="text/javascript">
        // Automatically submit the form once it's loaded
        document.getElementById('paymentForm').submit();
    </script>
</body>
</html>
