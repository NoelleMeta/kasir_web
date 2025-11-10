<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM Gulai Kakek - Selamat Datang</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Poppins:wght@500;700&display=swap" rel="stylesheet">

    <style>
        /* --- VARIABLE CSS DARI REFERENSI ASSET --- */
        :root {
            --color-black: #242424;
            --color-gray: #5F5F5F;
            --color-light-gray: #F5F5F5;
            --color-white: #FFFFFF;
            --color-primary: #FFC008; /* Kuning */
            --color-accent: #FFF7E2;   /* Kuning Muda */
            --font-heading: 'Poppins', sans-serif;
            --font-body: 'Montserrat', sans-serif;
        }

        /* --- RESET & GLOBAL STYLE --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: var(--font-body);
            color: var(--color-gray);
            background-color: var(--color-white);
            line-height: 1.6;
        }
        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 20px;
        }
        section {
            padding: 100px 0;
        }
        h1, h2, h3, h4 {
            font-family: var(--font-heading);
            color: var(--color-black);
            font-weight: 700;
        }
        h2 {
            font-size: 2.5rem; /* 40px */
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 1rem; /* 16px */
            margin-bottom: 15px;
        }
        .text-center {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-family: var(--font-heading);
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-black);
        }
        .btn-primary:hover {
            opacity: 0.85;
        }

        /* --- 1. HEADER (NAVBAR) --- */
        header {
            background-color: var(--color-white);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-family: var(--font-heading);
            font-size: 1.8rem; /* 28px */
            font-weight: 700;
            color: var(--color-primary);
            text-decoration: none;
        }
        .nav-menu ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .nav-menu li a {
            text-decoration: none;
            color: var(--color-black);
            font-family: var(--font-heading);
            font-weight: 500;
            font-size: 1rem;
            padding: 10px;
            transition: color 0.3s ease;
        }
        .nav-menu li a:hover {
            color: var(--color-primary);
        }
        .nav-menu .btn-admin {
            background-color: var(--color-primary);
            color: var(--color-black);
            border-radius: 8px;
            padding: 10px 20px;
        }
        .nav-menu .btn-admin:hover {
            color: var(--color-black);
            opacity: 0.85;
        }

        /* --- 2. HOME SECTION --- */
        #home {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 120px; /* Jarak untuk fixed navbar */
            padding-bottom: 80px;
            background-color: var(--color-accent); /* Placeholder */
            background-size: cover;
            background-position: center;
        }
        .home-wrapper {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr; /* Kolom kiri sedikit lebih besar */
            align-items: center;
            gap: 50px;
        }
        .home-content h1 {
            font-size: 3.5rem; /* 56px */
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .home-content p {
            font-size: 1.1rem; /* 18px */
            margin-bottom: 30px;
            max-width: 500px; /* Batasi lebar paragraf */
        }
        .home-image-placeholder {
            height: 450px;
            width: 100%;
            border-radius: 10px;
            background-color: var(--color-light-gray); /* Placeholder */
            background-size: cover;
            background-position: center;
        }
        .home-info-boxes {
            display: flex;
            gap: 20px;
            margin-top: 50px;
            flex-wrap: wrap;
        }
        .info-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .info-box-icon {
            width: 40px;
            height: 40px;
            background-color: var(--color-white); /* Placeholder untuk icon */
            border-radius: 50%;
            flex-shrink: 0;
        }
        .info-box-text h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 2px;
        }
        .info-box-text p {
            font-size: 0.9rem;
            margin-bottom: 0;
            line-height: 1.4;
        }

        /* --- 3. ABOUT US SECTION --- */
        #about {
            background-color: var(--color-white);
        }
        .about-wrapper {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        .about-text {
            flex: 1;
        }
        .about-text h3 {
            font-size: 1.8rem; /* 28px */
            font-weight: 500;
            margin-bottom: 15px;
        }
        .about-image-placeholder {
            flex: 1;
            height: 350px;
            border-radius: 10px;
            background-color: var(--color-light-gray); /* Placeholder */
        }

        /* --- 4. MENU UNGGULAN SECTION (UPDATED FOR 2 ITEMS) --- */
        #menu {
            background-color: var(--color-accent); /* Latar kuning muda */
        }
        .menu-grid {
            display: grid;
            /* Tampilkan 2 kolom jika muat, atau 1 kolom jika tidak */
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;

            /* Batasi lebar grid agar 2 item terlihat bagus di tengah */
            max-width: 630px; /* (300px * 2) + 30px gap */
            margin-left: auto;
            margin-right: auto;
        }
        .menu-item {
            height: 300px; /* Tentukan tinggi card */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            background-size: cover;
            background-position: center;
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .menu-content-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.75) 100%);
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .menu-content-overlay h3 {
            font-size: 1.4rem; /* 22px */
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--color-white); /* Teks putih */
        }
        .menu-content-overlay p {
            font-size: 1rem;
            color: var(--color-white); /* Teks putih */
            font-family: var(--font-body);
            font-weight: 400;
            margin-bottom: 0;
        }

        /* --- 5. KONTAK KAMI SECTION --- */
        #kontak {
            background-color: var(--color-white);
        }
        .kontak-wrapper {
            display: flex;
            gap: 50px;
            margin-top: 40px;
        }
        .kontak-form {
            flex: 2;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-family: var(--font-heading);
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--color-black);
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-family: var(--font-body);
            font-size: 1rem;
        }
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        .kontak-info {
            flex: 1;
        }
        .info-item {
            margin-bottom: 25px;
        }
        .info-item h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .info-item p {
            margin-bottom: 0;
            line-height: 1.5;
        }

        /* --- 6. FOOTER --- */
        footer {
            background-color: var(--color-black);
            color: var(--color-light-gray);
            padding: 30px 0;
            text-align: center;
        }
        footer p {
            margin: 0;
            font-family: var(--font-body);
            font-size: 0.9rem;
        }

        /* --- 7. RESPONSIVE CSS --- */
        @media (max-width: 992px) {
            .home-wrapper {
                grid-template-columns: 1fr; /* Stack di layar medium */
                text-align: center;
            }
            .home-image-placeholder {
                order: -1; /* Pindah gambar ke atas di mobile */
                height: 300px;
                margin-bottom: 30px;
            }
            .home-content p {
                max-width: 100%;
            }
            .home-info-boxes {
                justify-content: center; /* Tengahkan info box */
            }
            .about-wrapper {
                flex-direction: column;
            }
            .kontak-wrapper {
                flex-direction: column;
            }
        }

        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                gap: 10px;
            }
            .nav-menu ul {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }
            section {
                padding: 60px 0;
            }
            #home {
                padding-top: 180px; /* Sesuaikan padding untuk navbar yg lebih tinggi */
            }
            .home-content h1 {
                font-size: 2.8rem;
            }
            /* Pastikan grid menu stack di mobile */
            .menu-grid {
                max-width: 100%; /* Hapus max-width di mobile */
                padding: 0 10px; /* Beri sedikit padding */
            }
        }

    </style>
</head>
<body>

    <header>
        <div class="container">
            <a href="#home" class="logo">RM Gulai Kakek</a>
            <nav class="nav-menu">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                    <li><a href="/admin" class="btn-admin">Masuk Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="home">
            <div class="container">
                <div class="home-wrapper">
                    <div class="home-content">
                        <h1>RM Gulai Kakek</h1>
                        <p>Cita rasa autentik, resep warisan turun temurun yang menggugah selera. Nikmati kelezatan gulai kami hari ini.</p>
                        <a href="#menu" class="btn btn-primary">Pesan Sekarang</a>
                        <div class="home-info-boxes">
                            <div class="info-box">
                                <div class="info-box-icon">
                                    </div>
                                <div class="info-box-text">
                                    <h4>Lokasi</h4>
                                    <p>Jl. Raya Padang...</p>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="info-box-icon">
                                    </div>
                                <div class="info-box-text">
                                    <h4>Jam Buka</h4>
                                    <p>Senin - Minggu</p>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="info-box-icon">
                                    </div>
                                <div class="info-box-text">
                                    <h4>Telepon</h4>
                                    <p>+62 812 3456...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="home-image-placeholder">
                        </div>
                </div>
            </div>
        </section>

        <section id="about">
            <div class="container">
                <h2 class="text-center">About Us</h2>
                <div class="about-wrapper">
                    <div class="about-text">
                        <h3>Cerita Di Balik RM Gulai Kakek</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                    </div>
                    <div class="about-image-placeholder">
                        </div>
                </div>
            </div>
        </section>

        <section id="menu">
            <div class="container">
                <h2 class="text-center">Menu Unggulan</h2>
                <p class="text-center" style="max-width: 600px; margin-left: auto; margin-right: auto;">Berikut adalah beberapa menu favorit pilihan pelanggan kami yang wajib Anda coba.</p>

                <div class="menu-grid">

                    <div class="menu-item" style="background-image: url('{{ asset('images/gulai-kambing.jpg') }}');">
                        <div class="menu-content-overlay">
                            <h3>Gulai Kambing Spesial</h3>
                            <p>Rp 35.000</p>
                        </div>
                    </div>

                    <div class="menu-item" style="background-image: url('{{ asset('images/rendang.jpg') }}');">
                        <div class="menu-content-overlay">
                            <h3>Rendang Daging</h3>
                            <p>Rp 25.000</p>
                        </div>
                    </div>

                    </div>
            </div>
        </section>

        <section id="kontak">
            <div class="container">
                <h2 class="text-center">Kontak Kami</h2>
                <div class="kontak-wrapper">
                    <form action="#" method="POST" class="kontak-form">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="pesan">Pesan</label>
                            <textarea id="pesan" name="pesan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>

                    <div class="kontak-info">
                        <div class="info-item">
                            <h3>Alamat</h3>
                            <p>Jl. Raya Padang-Bukittinggi No. 123,<br>Payakumbuh, Sumatera Barat</p>
                        </div>
                        <div class="info-item">
                            <h3>Email</h3>
                            <p>info@gulaikakek.com</p>
                        </div>
                        <div class="info-item">
                            <h3>No. HP / WhatsApp</h3>
                            <p>+62 812 3456 7890</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 RM Gulai Kakek. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
