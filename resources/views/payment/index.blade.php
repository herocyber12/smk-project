<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
</head>
<body>
    @if (session()->has('success_message'))
        <div>{{ session('success_message') }}</div>
    @endif

    @if ($errors->any())
        <div>{{ $errors->first() }}</div>
    @endif

    <form id="payment-form" method="POST" action="{{ route('payment.process') }}">
        @csrf
        <input type="hidden" name="student_id" value="{{ $student->id }}">
        <button id="pay-button">Bayar!</button>
    </form>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function (event) {
            event.preventDefault();
            snap.pay('{{ isset($snapToken) ? $snapToken : null }}', {
                onSuccess: function(result){ console.log(result); },
                onPending: function(result){ console.log(result); },
                onError: function(result){ console.log(result); },
                onClose: function(){ console.log('customer closed the popup without finishing the payment'); }
            });
        });
    </script>
</body>
</html>
