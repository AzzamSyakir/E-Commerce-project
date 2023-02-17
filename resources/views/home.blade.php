<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payments gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="my-3">test payment</h1>
    </div>
    <div class="card" style="width: 18rem;">
        <img src="{{asset('assets/img/gambar.jpeg')}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">semi realistic </h5>
            <p class="card-text">gambar semi realistic</p>
            <form action="/checkout" method="post">
                @csrf
                <form>
                    <div class="mb-3">
                        <label for="qty" class="form-label">mau berapa?</label>
                        <input type="number" name="qty" class="form-control" id="qty" placeholder="gambar yang mau dipesan">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">name?</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder=" name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">email?</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder=" emailnya ">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">no telponya</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder=" no telponnya ">
                    </div>
                    <button type="submit" class="btn btn-primary">checkout</button>
                </form>

            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
