<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="my-3">Test Midtrans</h1>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Invoice</h5>
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
                <tr> </tr>
                <td>Status pesananan</td>
                <td> : {{$payment->status}}</td>
                <tr>


            </table>
            </form>

            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
