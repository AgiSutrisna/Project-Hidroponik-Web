<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Pembelian</title>

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
    </style>
</head>

<body>
    <div class="bungkus">
        <h1 class="mt-3">Transaksi Pembelian</h1>

        <!-- Formulir Nama, Alamat, dan Metode Pembayaran -->
        <form id="orderForm">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="metodePembayaran" class="form-label">Metode Pembayaran:</label>
                <select id="metodePembayaran" name="metodePembayaran" class="form-select"
                    onchange="showPaymentDetails()">
                    <option value="" selected>Pilih cara pembayaran</option>
                    <option value="COD">COD (Cash On Delivery)</option>
                    <option value="DANA">DANA</option>
                </select>
                <div id="paymentDetails" class="mt-2"></div>
            </div>

            <!-- Daftar Produk di Chart -->
            <ul id="cart" class="list-group mt-4"></ul>

            <!-- Total Pembayaran -->
            <div id="total" class="mt-3"></div>

            <!-- Tombol Kembali ke Halaman Utama -->
            <button onclick="goBack()" class="btn btn-primary mt-3">Kembali</button>

            <!-- Tombol Checkout -->
            <button type="button" onclick="formChanges.pembayaranClicked = true; validateAndCheckout()"
                class="btn btn-success mt-3" id="checkoutButton" disabled>Order</button>
        </form>
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
        // Ambil data keranjang dari Local Storage
        const cartData = localStorage.getItem('cartData');
        const cart = cartData ? JSON.parse(cartData) : [];

        // Membuat objek untuk menyimpan status validasi setiap elemen formulir
        const formValidation = {
            nama: false,
            alamat: false,
            metodePembayaran: false
        };

        // Membuat objek untuk menyimpan status perubahan pada setiap elemen formulir
        const formChanges = {
            nama: false,
            alamat: false,
            metodePembayaran: false,
            pembayaranClicked: false
        };

        let totalPayment = 0;

        function updateCart() {
            const cartList = document.getElementById('cart');
            const totalContainer = document.getElementById('total');

            cartList.innerHTML = '';
            totalPayment = 0; // Reset total pembayaran

            cart.forEach((item, index) => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                const formattedPrice = formatCurrency(item.price);
                const formattedTotal = formatCurrency(item.total);
                listItem.textContent = `${item.product} - ${item.quantity} x ${formattedPrice} = ${formattedTotal}`;

                // Tambahkan tombol hapus untuk setiap item
                const deleteButton = document.createElement('button');
                deleteButton.className = 'btn btn-danger btn-sm ms-2';
                deleteButton.textContent = 'X';
                deleteButton.addEventListener('click', () => {
                    removeItemFromCart(index);
                });

                listItem.appendChild(deleteButton);
                cartList.appendChild(listItem);

                // Tambahkan total pembayaran dari produk saat ini ke totalPayment
                totalPayment += item.total;
            });

            // Tampilkan total pembayaran di bawah daftar produk
            totalContainer.textContent = `Total Pembayaran: ${formatCurrency(totalPayment)}`;
        }

        // Tambahkan fungsi untuk menghapus item dari keranjang
        function removeItemFromCart(index) {
            // Hapus item dari keranjang berdasarkan indeks
            cart.splice(index, 1);
            // Perbarui tampilan daftar produk dan total pembayaran
            updateCart();
            // Perbarui notifikasi jumlah barang di navbar
            updateCartNotification();
            // Lakukan validasi dan perbarui tombol checkout
            validateAndCheckout();
        }

        function validateAndCheckout() {
            // Ambil data dari formulir
            const nama = document.getElementById('nama').value;
            const alamat = document.getElementById('alamat').value;
            const metodePembayaran = document.getElementById('metodePembayaran').value;

            // Lakukan validasi
            formValidation.nama = validateField(nama);
            formValidation.alamat = validateField(alamat);
            formValidation.metodePembayaran = validateField(metodePembayaran);

            // Periksa apakah semua elemen formulir sudah divalidasi dan terjadi perubahan
            const isFormValid = Object.values(formValidation).every(Boolean) &&
                Object.values(formChanges).some(Boolean);

            // Aktifkan atau nonaktifkan tombol pembayaran berdasarkan status validasi formulir
            document.getElementById('checkoutButton').disabled = !isFormValid;

            // Jika formulir valid dan tombol pembayaran diklik, lanjutkan dengan proses pembayaran
            if (isFormValid && formChanges.pembayaranClicked) {
                checkout();
            }
        }

        function validateField(value) {
            // Validasi sederhana: cek apakah nilai tidak kosong
            return value.trim() !== '';
        }

        function checkout() {
            // Ambil data dari formulir
            const nama = document.getElementById('nama').value;
            const alamat = document.getElementById('alamat').value;
            const metodePembayaran = document.getElementById('metodePembayaran').value;

            // Validasi tambahan sebelum membuka WhatsApp
            if (!nama || !alamat || !metodePembayaran || totalPayment === 0) {
                alert('Mohon lengkapi formulir dan pilih metode pembayaran sebelum melanjutkan.');
                return;
            }

            // Konversi pesanan ke format teks
            const orderText = `Nama: ${nama}\nAlamat: ${alamat}\nMetode Pembayaran: ${metodePembayaran}\n\nPesanan:\n${cart.map(item => `${item.product} - ${item.quantity} x ${formatCurrency(item.price)} = ${formatCurrency(item.total)}`).join('\n')}\n\nTotal Pembayaran: ${formatCurrency(totalPayment)}`;

            // Integrasi ke WhatsApp
            const url = "https://wa.me/+6285974051546?text=" +
                encodeURIComponent(orderText);

            // Buka tautan WhatsApp di tab baru
            window.open(url, '_blank').focus();
        }

        function formatCurrency(amount) {
            // Format angka ke dalam format mata uang (Rupiah) tanpa dua nol di belakang koma
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(amount);
        }

        function goBack() {
            // Kembali ke halaman utama
            window.location.href = 'index.php';
        }

        function showPaymentDetails() {
            const metodePembayaran = document.getElementById('metodePembayaran').value;
            const paymentDetailsContainer = document.getElementById('paymentDetails');

            if (metodePembayaran === 'COD') {
                paymentDetailsContainer.innerHTML = '<p>Cara Pembayaran: Anda akan membayar dengan uang tunai saat pengiriman (COD).</p>';
            } else if (metodePembayaran === 'DANA') {
                paymentDetailsContainer.innerHTML = '<p>Cara Pembayaran: Silakan transfer ke rekening DANA (089xxxxxxx) sesuai dengan jumlah yang tertera. Kirim bukti pembayaran setelah order.</p>';
            } else {
                paymentDetailsContainer.innerHTML = '';
            }

            // Setel status perubahan untuk metode pembayaran
            formChanges.metodePembayaran = true;

            // Jalankan validasi setelah terjadi perubahan pada metode pembayaran
            validateAndCheckout();
        }

        // Tampilkan data produk saat halaman pertama kali dimuat
        updateCart();

        // Tambahkan event listener untuk setiap elemen formulir
        document.getElementById('nama').addEventListener('input', () => {
            formChanges.nama = true;
            validateAndCheckout();
        });

        document.getElementById('alamat').addEventListener('input', () => {
            formChanges.alamat = true;
            validateAndCheckout();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>
