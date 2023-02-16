<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Snap Checkout</title>
</head>
<body>
    <button id="pay-button">Pay with Midtrans</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('app.midtrans_client_key') }}"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        snap.pay('{{ $snapToken }}');
    </script>
</body>
</html>
