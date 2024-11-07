<!DOCTYPE html>
<html>
<head>
    <title>Select Payment Gateway</title>
</head>
<body>
    <h1>Select Payment Gateway</h1>
    <form method="post" action="{{ route('payment.process') }}">
        @csrf
        <label for="gateway">Choose Payment Gateway:</label>
        <select name="gateway" id="gateway">
            <option value="lloyds">Lloyds</option>
        </select>
        <input type="submit" value="Proceed to Payment">
    </form>
</body>
</html>
