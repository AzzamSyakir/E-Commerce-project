<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key')}}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <title>Jual waifu bro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="my-3">Test payment</h1>
    </div>
    <div class="card" style="width: 18rem;">
    <img src="{{asset('assets/img/gambar.jpeg')}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">detail pesananan</h5>
            <table>
                <tr>
                    <td>name</td>
                    <td> : {{$payment->name}}</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td> : {{$payment->email}}</td>

                </tr>
                <tr>
                    <td>phone</td>
                    <td> : {{$payment->phone}}</td>
                </tr>
                <td>qty</td>
                <td> : {{$payment->qty}}</td>
                <tr>
                </tr>
                <td>total harga</td>
                <td> : {{$payment->total_price}}</td>
                <tr>
                </tr>
                <td>status pesanan</td>
                <td> : {{$payment->status}}</td>
                <tr>


            </table>
            <button type="submit" class="btn btn-primary" mt-3 id="pay-button">bayar sekarang</button>
            </form>

            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{$snapToken}}', {
                onSuccess: function (result) {
                    /* You may add your own implementation here */
                    window.location.href = '/invoice/{{$payment->id}}'
                    alert("lunas makasih :)");
                    console.log(result);
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("nunggu uang masuk!");
                    console.log(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("gagal cuy coba ulang!");
                    console.log(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });

    </script>
</body>

</html>
