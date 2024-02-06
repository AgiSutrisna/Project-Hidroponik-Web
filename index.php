<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sayur</title>
    <!-- Tambahkan tautan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous">
    <style>
        .bungkus {
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 60px;
        }

        /* CSS untuk menyesuaikan navbar di bagian bawah */
        .navbar-bottom {
            position: fixed;
            bottom: 0;
            z-index: 1000;
            /* Menentukan z-index navbar agar lebih tinggi */
            width: 100%;
            background-color: #f8f9fa;
            /* warna latar belakang */
            border-top: 1px solid #dee2e6;
            /* garis atas */
            border-radius: 15px 15px 0 0;
            /* Atur sudut atas menjadi bulat */
        }

        /* Atur lebar navbar sesuai dengan lebar container */
        .navbar-bottom .container {
            width: 100%;
            max-width: 100%;
            /* agar tidak melebihi lebar container */
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>

</head>

<body>
    <div class="bungkus">
        <h1 class="mt-3">Sadaya Farm</h1>
        <div class="input-group md-form form-sm form-2 pl-0">
            <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <span class="input-group-text red lighten-3" id="basic-text1"><i
                        class="fa-solid fa-magnifying-glass text-grey" aria-hidden="true"></i></span>
            </div>
        </div>
        <!-- Tombol Checkout -->
        <!-- <button id="cartButton" onclick="goToChart()" class="btn btn-success fa-solid fa-cart-shopping mt-3"></button> -->

        <!-- Tambahkan elemen cart -->
        <div id="cart" class="d-none"></div>

        <div id="carouselExampleIndicators" class="carousel slide mt-3">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="slide_1.jpg" class="d-block w-100 rounded" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="slide_2.jpg" class="d-block w-100 rounded" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="slide_2.jpg" class="d-block w-100 rounded" alt="...">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <h3 class="mt-3">Produk Populer</h3>
        <div class="row gap-2 justify-content-center">
            <div class="col-md-6 col-lg-2 card my-3" style="width: 10rem;">
                <img src="img_1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Selada</h5>
                    <p class="card-text">Rp. 25.000</p>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="decreaseQuantity('quantity1')"><i class="fas fa-minus"></i></button>
                        <input type="number" id="quantity1" name="quantity1" class="form-control" min="1" value="1">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="increaseQuantity('quantity1')"><i class="fas fa-plus"></i></button>
                    </div>
                    <button onclick="addToCart('Selada', 25000, 'quantity1')" class="btn btn-primary mt-2"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 card my-3" style="width: 10rem;">
                <img src="img_1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Selada</h5>
                    <p class="card-text">Rp. 25.000</p>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="decreaseQuantity('quantity2')"><i class="fas fa-minus"></i></button>
                        <input type="number" id="quantity2" name="quantity2" class="form-control" min="1" value="1">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="increaseQuantity('quantity2')"><i class="fas fa-plus"></i></button>
                    </div>
                    <button onclick="addToCart('Selada', 25000, 'quantity2')" class="btn btn-primary mt-2"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 card my-3" style="width: 10rem;">
                <img src="img_1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Selada</h5>
                    <p class="card-text">Rp. 25.000</p>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="decreaseQuantity('quantity3')"><i class="fas fa-minus"></i></button>
                        <input type="number" id="quantity3" name="quantity3" class="form-control" min="1" value="1">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="increaseQuantity('quantity3')"><i class="fas fa-plus"></i></button>
                    </div>
                    <button onclick="addToCart('Selada', 25000, 'quantity3')" class="btn btn-primary mt-2"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 card my-3" style="width: 10rem;">
                <img src="img_1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Selada</h5>
                    <p class="card-text">Rp. 25.000</p>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="decreaseQuantity('quantity4')"><i class="fas fa-minus"></i></button>
                        <input type="number" id="quantity4" name="quantity4" class="form-control" min="1" value="1">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="increaseQuantity('quantity4')"><i class="fas fa-plus"></i></button>
                    </div>
                    <button onclick="addToCart('Selada', 25000, 'quantity4')" class="btn btn-primary mt-2"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 card my-3" style="width: 10rem;">
                <img src="img_1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Selada</h5>
                    <p class="card-text">Rp. 25.000</p>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="decreaseQuantity('quantity5')"><i class="fas fa-minus"></i></button>
                        <input type="number" id="quantity5" name="quantity5" class="form-control" min="1" value="1">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="increaseQuantity('quantity5')"><i class="fas fa-plus"></i></button>
                    </div>
                    <button onclick="addToCart('Selada', 25000, 'quantity5')" class="btn btn-primary mt-2"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 card my-3" style="width: 10rem;">
                <img src="img_1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Selada</h5>
                    <p class="card-text">Rp. 25.000</p>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="decreaseQuantity('quantity6')"><i class="fas fa-minus"></i></button>
                        <input type="number" id="quantity6" name="quantity6" class="form-control" min="1" value="1">
                        <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="increaseQuantity('quantity6')"><i class="fas fa-plus"></i></button>
                    </div>
                    <button onclick="addToCart('Selada', 25000, 'quantity6')" class="btn btn-primary mt-2"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar di bagian bawah -->
    <nav class="navbar navbar-dark navbar-expand navbar-bottom">
        <ul class="navbar-nav nav-justified w-100">
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                    <i class="fa-solid fa-house fa-lg" style="color: #000000;"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-list fa-lg" style="color: #000000;"></i>
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" onclick="goToChart()" class="nav-link position-relative">
                    <i class="fa-solid fa-cart-shopping fa-lg" style="color: #000000;"></i>
                    <!-- Tambahkan notifikasi jumlah barang di sini -->
                    <span id="cartNotification"
                        class="position-absolute top-0 start-70 translate-middle badge rounded-pill bg-danger"></span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Skrip JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cart = [];
        let cartButton = document.getElementById('cartButton');

        function addToCart(product, price, quantityId) {
            const quantity = document.getElementById(quantityId).value;
            const total = price * quantity;
            cart.push({ product, price, quantity, total });
            updateCart();
            showNotification();
        }

        function updateCart() {
            // Tampilkan notifikasi angka pada tombol keranjang
            const cartNotification = document.getElementById('cartNotification');
            cartNotification.textContent = cart.length > 0 ? cart.length : ''; // Tampilkan jumlah item di keranjang

            // Atur notifikasi jumlah barang di halaman chart.php
            localStorage.setItem('cartItemCount', cart.length);
        }

        function goToChart() {
            // Simpan data keranjang di Local Storage untuk mentransfer ke halaman chart
            localStorage.setItem('cartData', JSON.stringify(cart));

            // Pindah ke halaman chart
            window.location.href = 'chart.php';
        }

        function showNotification() {
            // Tampilkan notifikasi titik merah
            cartButton.classList.add('notification-dot');
        }

        function increaseQuantity(quantityId) {
            const input = document.getElementById(quantityId);
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQuantity(quantityId) {
            const input = document.getElementById(quantityId);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>