<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM Gulai Kakek - Selamat Datang</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
			background-color: #000000; /* black side background for desktop */
            background-image:
                url('{{ asset("images/marawa_1.png") }}'),
                url('{{ asset("images/marawa_2.png") }}');
            background-size: auto 100%, auto 100%;
            background-position: left center, right center;
            background-repeat: no-repeat, no-repeat;
            background-attachment: fixed, fixed;
            line-height: 1.6;
        }
		@media (max-width: 1199px) {
			body {
				background-image: none;
			}
		}
		/* Boxed frame for desktop */
		.page-frame {
			background: var(--color-white);
            /* Mencegah overflow horizontal dari frame itu sendiri */
            overflow-x: hidden;
			position: relative;
		}
		@media (min-width: 1200px) {
			.page-frame {
				max-width: 1440px; /* frame width */
				margin: 0 auto;    /* center the frame */
				overflow: hidden;  /* keep inner effects contained */
			}
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
            background-color: #0b0b0b; /* black header like design */
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            padding: 12px 0;
            position: fixed; /* <-- INI YANG MEMBUATNYA TETAP ADA (STICKY) */
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            /* Petunjuk render untuk kestabilan */
            will-change: transform;
        }
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .site-logo {
            height: 54px;
            width: auto;
            display: block;
        }
        .logo-text {
            color: var(--color-primary);
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.2rem;
        }
        .nav-menu ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .nav-menu li a {
            text-decoration: none;
            color: var(--color-white);
            font-family: var(--font-heading);
            font-weight: 500;
            font-size: 1rem;
            padding: 8px;
            transition: color 0.2s ease;
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

        /* --- 2. HOME SECTION (UPDATED) --- */
        /* Hero / home full-screen background */
        #home {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 0; /* header handled inside */
            position: relative;
            overflow: hidden;
        }
        /* Slideshow slides that sit behind hero content */
        .home-slides {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none; /* allow clicks through to content */
        }
        .home-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transform: scale(1.02);
            transition: opacity 900ms ease, transform 900ms ease;
        }
        .home-slide.active {
            opacity: 1;
            transform: scale(1);
        }
        /* Dark overlay to make text readable */
        #home::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1;
        }
        .home-inner {
            position: relative;
            z-index: 2;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 120px 20px; /* space from top */
            text-align: center;
            color: #ffffff;
        }
        .hero-title {
            font-family: 'Lobster', cursive;
            font-size: 64px;
            line-height: 1.05;
            color: #ffffff;
            text-shadow: 0 6px 24px rgba(0,0,0,0.6);
            margin-bottom: 12px;
        }
        /* Subtle interactive/hover animations */
        .btn { transition: transform 180ms ease, box-shadow 180ms ease; }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(0,0,0,0.18); }
        .hero-sub {
            font-family: var(--font-heading);
            font-size: 14px;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.85);
            margin-top: 6px;
        }
        /* --- 3. ABOUT US SECTION --- */
        /* About section: full-bleed background with overlay, image card on left */
        #about {
            position: relative;
            background-image: url('{{ isset($settings) && $settings->get("bg_about") && $settings->get("bg_about")->value ? \App\Models\LandingPageSetting::getImageSrc($settings->get("bg_about")->value, "images/bg_about_us.jpg") : asset("images/bg_about_us.jpg") }}');
            background-size: cover;
            background-position: center;
            color: #ffffff;
            padding: 80px 0;
        }
        #about::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 1;
        }
        .about-wrapper {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 48px;
            align-items: start;
        }
        .about-image {
            width: 100%;
        }
        .about-image img {
            width: 100%;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            display: block;
        }
        .about-text {
            color: rgba(255,255,255,0.95);
        }
        .about-text .section-title {
            color: var(--color-primary); /* yellow */
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 8px;
            font-size: 2.5rem;
            text-transform: uppercase;
            font-family: var(--font-heading);
        }
        .about-text .section-subtitle {
            font-family: 'Lobster', cursive;
            font-size: 28px;
            color: #ffffff;
            margin-bottom: 18px;
        }
        .about-text p {
            color: rgba(255,255,255,0.9);
            line-height: 1.8;
        }

        /* --- 4. MENU UNGGULAN SECTION --- */
        #menu {
            position: relative;
            background-image: url('{{ isset($settings) && $settings->get("bg_menu") && $settings->get("bg_menu")->value ? \App\Models\LandingPageSetting::getImageSrc($settings->get("bg_menu")->value, "images/bg_menu_unggulan.jpg") : asset("images/bg_menu_unggulan.jpg") }}');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: #ffffff;
        }
        #menu::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 1;
        }
        #menu .container {
            position: relative;
            height: 100%;
			max-width: 100%; /* allow content to reach frame edges */
        }
        .menu-inner {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Menu Title Section - Top Right */
        .menu-header {
            text-align: center;
        }
        .menu-title {
            font-family: var(--font-heading);
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .menu-subtitle {
            font-family: 'Lobster', cursive;
            font-size: 2rem;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        .menu-description {
            color: rgba(255,255,255,0.95);
            font-size: 1rem;
            line-height: 1.8;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            max-width: 600px; /* Batasi lebar teks deskripsi */
            margin: 0 auto; /* Pusatkan teks deskripsi */
            margin-bottom: 20px; /* Beri jarak ke item menu di bawahnya */
        }
        /* Menu Items Layout */
        .menu-unggulan-grid {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            width: 100%;
            padding: 0 20px; /* Add some padding */
        }
        .menu-unggulan-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 2rem;
            padding-right: 10rem; /* <-- BIANG KEROK OVERFLOW */
        }
        .menu-unggulan-item {
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 50%, #8B4513 100%);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            gap: 20px;
            width: 100%;
            max-width: 700px; /* Constrain width of items */
            transition: transform 260ms cubic-bezier(.2,.9,.2,1), box-shadow 260ms ease;
        }
        .menu-unggulan-item:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 20px 40px rgba(0,0,0,0.35);
        }
        .menu-unggulan-grid > .menu-unggulan-item:nth-child(odd) {
            align-self: flex-start;
        }
        .menu-unggulan-grid > .menu-unggulan-item:nth-child(even) {
            align-self: flex-end;
        }
        .menu-unggulan-image {
            width: 200px;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            border: 3px solid #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .menu-unggulan-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .menu-unggulan-content {
            flex: 1;
        }
        .menu-unggulan-content h3 {
            font-family: 'Lobster', cursive;
            color: #ffffff;
            font-size: 2.2rem;
            margin-bottom: 12px;
            font-weight: 400;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        }
        .menu-unggulan-content p {
            color: rgba(255,255,255,0.95);
            line-height: 1.7;
            font-size: 0.95rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
		/* Call to Action - centered bottom like mock */
        .menu-cta {
            position: absolute;
			bottom: -6.5%;               /* slightly lower */
			left: 45%;
			right: auto;
			margin: 0;                /* use translate centering */
			transform: translateX(-50%);
            z-index: 3;
			max-width: 400px;
			text-align: center;
        }
		/* When CTA is placed inside the header, keep it centered inline */
		.menu-header .menu-cta {
			position: static;
			left: auto;
			right: auto;
			transform: none;
			margin: 12px auto 0;
			max-width: none;
		}
        .menu-cta-text {
            color: #ffffff;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        .btn-daftar {
            background: #000000;
            color: #ffffff;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }
        .btn-daftar:hover {
            background: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.5);
        }
        /* Responsive adjustments for medium screens */
        @media (max-width: 1200px) {
            .menu-header {
                position: static;
                margin-bottom: 40px;
            }
            .menu-unggulan-grid {
                padding: 0 15px;
            }
            .menu-cta {
                position: static;
                margin-top: 40px;
            }
        }
        /* Tablet adjustments */
        @media (max-width: 992px) {
            #menu .container {
                position: relative;
            }
            #menu .menu-inner {
                position: relative;
                min-height: auto;
                padding: 60px 0;
            }
            .menu-header {
                position: static;
                text-align: center;
                max-width: 100%;
                margin-bottom: 40px;
            }
            .menu-title {
                font-size: 2.2rem;
            }
            .menu-subtitle {
                font-size: 1.8rem;
            }
            .menu-unggulan-item {
                flex-direction: column;
                text-align: center;
            }
            .menu-unggulan-item:nth-child(even) {
                flex-direction: column; /* Keep it stacked */
            }
            .menu-unggulan-image {
                width: 180px;
                height: 180px;
                margin-bottom: 1rem;
            }
            .menu-cta {
                position: static;
                text-align: center;
                max-width: 100%;
                margin-top: 30px;
            }

            /* MOBILE: place menu header above the first menu item for better reading order
               Keep desktop layout unchanged. We use flex ordering and column stacking. */
            .menu-unggulan-row {
                /* Stack the header and first item vertically on mobile */
                flex-direction: column;
                align-items: center;
                gap: 1rem;
                padding-right: 0; /* <-- PERBAIKAN BUG OVERFLOW UTAMA ADA DI SINI */
            }
            /* Ensure menu header is always at the top on mobile */
            .menu-unggulan-row .menu-header {
                order: -1;
                width: 100%;
            }
            .menu-unggulan-row .menu-unggulan-item {
                order: 0;
                width: 100%;
            }
        }

        /* --- 5. KONTAK KAMI SECTION --- */
        #kontak {
            position: relative;
            background-image: url('{{ isset($settings) && $settings->get("bg_kontak") && $settings->get("bg_kontak")->value ? \App\Models\LandingPageSetting::getImageSrc($settings->get("bg_kontak")->value, "images/bg_kontak_kami.jpg") : asset("images/bg_kontak_kami.jpg") }}');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: #ffffff;
        }
        #kontak::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 1;
        }
        .kontak-wrapper {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 40px;
            align-items: start;
        }
        .kontak-map {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0,0,0,0.5);
            background: #fff;
        }
        .kontak-map iframe {
            width: 100%;
            height: 320px;
            border: 0;
            display: block;
        }
        .kontak-info {
            color: rgba(255,255,255,0.95);
        }
        .kontak-info h3 {
            color: var(--color-primary);
            font-size: 18px;
            margin-bottom: 12px;
        }
        .kontak-info .info-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 14px;
        }
        .kontak-info .info-item .icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.08);
            border-radius: 8px;
            display:flex; align-items:center; justify-content:center;
            color: var(--color-primary);
            font-weight: 700;
        }
        .kontak-info p, .kontak-info a { color: rgba(255,255,255,0.95); text-decoration: none; }
        .kontak-info .socials { margin-top: 8px; }
        .kontak-halal {
            margin-top: 18px;
            display:flex;
            align-items:center;
            justify-content:flex-end;
        }
        .kontak-halal img { width:120px; height:auto; border-radius:10px; background:#fff; padding:12px; }
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
            background-color: #961616; /* Updated per request */
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
            .about-wrapper {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .kontak-wrapper {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            /* Menu section already handled above in @media (max-width: 992px) */
        }

        /* === PERUBAHAN DESKTOP (SESUAI REQUEST ANDA) === */
        @media (min-width: 992px) {

            /* --- PERUBAHAN BARU: Perkecil #home --- */
            #home {
                min-height: auto; /* Membatalkan 100vh global */
                padding: 100px 0; /* Mengembalikan padding aslinya */
                display: flex;
                align-items: center;
            }

            /* HANYA #menu yang dibuat 100vh */
            #menu {
                min-height: 100vh;
                padding: 0;
                display: flex;
                align-items: center;
            }

            /* HANYA container #menu yang di-style untuk 100vh */
            #menu > .container {
                padding: 80px 0; /* Hapus padding horizontal, ganti ke 0 */
                width: 100%;
                height: 100%;
            }

            /* --- Style lain untuk desktop --- */

            /* Pastikan wrapper #about dan #kontak sekarang "align-items: center" */
            #about .about-wrapper {
                align-items: center;
            }
            #kontak .kontak-wrapper {
                align-items: center;
            }

            /* Style internal #menu 100vh (INI TETAP) */
            #menu .menu-inner {
                height: 100%;
                position: relative;
                justify-content: center; /* Center the content vertically */
                align-items: center;
                display: flex;
                flex-direction: column;
            }

            /* Enlarge assets inside full-height sections */
            /* About image: wider and full height */
            #about .about-wrapper { grid-template-columns: 360px 1fr; }
            #about .about-image img { width: 100%; height: auto; object-fit: cover; border-radius: 14px; }

            /* Menu panel images: bigger on desktop */
            .menu-header { max-width: 450px; }
            .menu-cta { max-width: 450px; }

            /* Kontak map: DIHAPUS agar kembali ke 320px */
            /* .kontak-map iframe { height: 60vh; } <-- BARIS INI DIHAPUS */
            .kontak-halal img { width: 160px; }
        }

        @media (max-width: 768px) {
            header {
                padding: 14px 0;
            }
            header .container {
                flex-direction: column;
                gap: 12px;
                align-items: center;
                justify-content: center;

                /* === PERBAIKAN BUG HEADER MOBILE === */
                margin: 0;
                width: 100%;
                max-width: 100%;
                padding: 0 20px;
                box-sizing: border-box;
            }
            .logo {
                justify-content: center;
            }
            .nav-menu {
                width: 100%;
            }
            .nav-menu ul {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                width: 100%;
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


        }

        /* Small screen tweaks (mobile phones) */
        @media (max-width: 600px) {
            header {
                padding: 16px 0;
            }
            header .container {
                padding: 0 12px; /* <-- Sesuaikan padding di layar kecil */
                flex-direction: column;
                gap: 12px;
                align-items: center;
                justify-content: center;

                /* === PERBAIKAN BUG HEADER MOBILE (Harus ada di kedua media query) === */
                margin: 0;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
            }
            .logo {
                justify-content: center;
            }
            .site-logo { height: 42px; }
            .nav-menu {
                width: 100%;
            }
            .nav-menu ul {
                gap: 8px;
                justify-content: center;
                width: 100%;
            }

            /* Hero adjustments */
            #home { padding-top: 140px; }
            .home-inner { padding: 80px 16px; }
            .hero-title { font-size: 36px; }
            .hero-sub { font-size: 12px; }

            /* Menu section responsive - stack all elements */
            .menu-unggulan-item {
                padding: 1rem;
            }
            .menu-unggulan-image {
                width: 150px;
                height: 150px;
            }
            .menu-unggulan-content h3 {
                font-size: 1.8rem;
            }
            .btn-daftar {
                display: inline-block;
                width: auto;
            }

            /* Kontakt section adjustments */
            .kontak-wrapper { grid-template-columns: 1fr; }
            .kontak-map iframe { height: 220px; }
            .kontak-info { padding: 8px 6px; }
            .kontak-halal img { width: 90px; }

            /* Reduce spacing globally */
            section { padding: 40px 0; }
            h2 { font-size: 1.8rem; }
            p { font-size: 0.95rem; }
            .btn { padding: 10px 14px; }
        }

    </style>
</head>
<body>

    <header>
        <div class="container">
            <a href="#home" class="logo">
                <img src="{{ asset('images/logo_rm_gulai_kambing_kakek.jpg') }}" alt="RM Gulai Kakek" class="site-logo">
            </a>
            <nav class="nav-menu">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

	<div class="page-frame">
	<main>
        <section id="home">
            {{-- Slideshow background slides --}}
            <div class="home-slides" aria-hidden="true">
                <div class="home-slide" style="background-image: url('{{ isset($settings) && $settings->get('bg_home_1') && $settings->get('bg_home_1')->value ? \App\Models\LandingPageSetting::getImageSrc($settings->get('bg_home_1')->value, 'images/bg_home_1.jpg') : asset('images/bg_home_1.jpg') }}')"></div>
                <div class="home-slide" style="background-image: url('{{ isset($settings) && $settings->get('bg_home_2') && $settings->get('bg_home_2')->value ? \App\Models\LandingPageSetting::getImageSrc($settings->get('bg_home_2')->value, 'images/bg_home_2.jpg') : asset('images/bg_home_2.jpg') }}')"></div>
                <div class="home-slide" style="background-image: url('{{ isset($settings) && $settings->get('bg_home_3') && $settings->get('bg_home_3')->value ? \App\Models\LandingPageSetting::getImageSrc($settings->get('bg_home_3')->value, 'images/bg_home_3.jpeg') : asset('images/bg_home_3.jpeg') }}')"></div>
            </div>

            <div class="home-inner container">
                <h1 class="hero-title" data-aos="zoom-in">Rasa Legendaris dari Dapur Kakek!</h1>
                <div class="hero-sub" data-aos="fade-up" data-aos-delay="120">Est. 2024</div>
            </div>
        </section>

        <section id="about">
            <div class="container">
                    <div class="about-wrapper" data-aos="fade-up" data-aos-delay="100">
                    <div class="about-image">
                        <img src="{{ isset($settings) && $settings->get('about_gambar') && $settings->get('about_gambar')->value ? \App\Models\LandingPageSetting::getImageSrc($settings->get('about_gambar')->value, 'images/gambar_about_us.jpg') : asset('images/gambar_about_us.jpg') }}" alt="Gulai Kakek House" data-aos="zoom-in" data-aos-delay="160">
                    </div>
                    <div class="about-text">
                        <div class="section-title" data-aos="fade-right" data-aos-delay="180">ABOUT US</div>
                        <div class="section-subtitle" data-aos="fade-right" data-aos-delay="220">Warisan Turun-temurun</div>

                        <p>{{ isset($settings) && $settings->get('about_text_1') && $settings->get('about_text_1')->value ? $settings->get('about_text_1')->value : 'Di Gulai Kambiang Kakek, kami percaya bahwa masakan yang enak berasal dari resep yang tulus. Berdiri pada tahun 2024, kami membawa misi sederhana: menghadirkan gulai kambing seenak buatan "Kakek" di rumah—penuh cinta, kaya rempah, dan tak terlupakan.' }}</p>

                        <p>{{ isset($settings) && $settings->get('about_text_2') && $settings->get('about_text_2')->value ? $settings->get('about_text_2')->value : 'Kami adalah rumah bagi para pencinta hidangan kambing. Dengan bangga, kami menempatkan Gulai Kepala Kambing dan Gulai Kambing sebagai bintang utama di dapur kami. Dibuat dari bahan-bahan segar dan daging pilihan, kami menjamin tekstur yang empuk dan bumbu yang meresap hingga ke tulang.' }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="menu">
            <div class="container">
                <div class="menu-inner">
                    <div class="menu-unggulan-grid">
                        @if($menuItems && count($menuItems) > 0)

                            <div class="menu-unggulan-row">
                                @if(isset($menuItems[0]) && $menuItems[0])
                                    <div class="menu-unggulan-item" data-aos="fade-up" data-aos-delay="100">
                                        <div class="menu-unggulan-image">
                                            <img src="{{ $menuItems[0]->getImageSrc('images/menu_unggulan_1.jpg') }}" alt="{{ $menuItems[0]->nama }}" loading="lazy">
                                        </div>
                                        <div class="menu-unggulan-content">
                                            <h3>{{ $menuItems[0]->nama }}</h3>
                                            <p>{{ $menuItems[0]->deskripsi }}</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="menu-header" data-aos="fade-down" data-aos-delay="100">
                                    <h2 class="menu-title">MENU UNGGULAN</h2>
                                    <div class="menu-subtitle">Spesial dari Dapur Kami</div>
                                    <p class="menu-description">
                                        {{ $settings->get('menu_unggulan_deskripsi') && $settings->get('menu_unggulan_deskripsi')->value ? $settings->get('menu_unggulan_deskripsi')->value : 'Dengan bangga kami persembahkan hidangan terbaik kami. Menu ini adalah alasan mengapa para tamu selalu kembali. Silakan cicipi dedikasi dan cita rasa khas yang kami tuang dalam setiap porsi.' }}
                                    </p>
                                </div>
                            </div>

                            @if(isset($menuItems[1]) && $menuItems[1])
                                <div class="menu-unggulan-item" data-aos="fade-up" data-aos-delay="150">
                                    <div class="menu-unggulan-image">
                                        <img src="{{ $menuItems[1]->getImageSrc('images/menu_unggulan_2.jpg') }}" alt="{{ $menuItems[1]->nama }}" loading="lazy">
                                    </div>
                                    <div class="menu-unggulan-content">
                                        <h3>{{ $menuItems[1]->nama }}</h3>
                                        <p>{{ $menuItems[1]->deskripsi }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(isset($menuItems[2]) && $menuItems[2])
                                <div class="menu-unggulan-item" data-aos="fade-up" data-aos-delay="200">
                                    <div class="menu-unggulan-image">
                                        <img src="{{ $menuItems[2]->getImageSrc('images/menu_unggulan_3.jpg') }}" alt="{{ $menuItems[2]->nama }}" loading="lazy">
                                    </div>
                                    <div class="menu-unggulan-content">
                                        <h3>{{ $menuItems[2]->nama }}</h3>
                                        <p>{{ $menuItems[2]->deskripsi }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(isset($menuItems[3]) && $menuItems[3])
                                <div class="menu-unggulan-item" data-aos="fade-up" data-aos-delay="300">
                                    <div class="menu-unggulan-image">
                                        <img src="{{ $menuItems[3]->getImageSrc('images/menu_unggulan_4.jpg') }}" alt="{{ $menuItems[3]->nama }}" loading="lazy">
                                    </div>
                                    <div class="menu-unggulan-content">
                                        <h3>{{ $menuItems[3]->nama }}</h3>
                                        <p>{{ $menuItems[3]->deskripsi }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="menu-header" data-aos="fade-up" data-aos-delay="250" style="text-align: center; max-width: 400px;">
                                <p class="menu-description" style="max-width: 100%;">
                                    Selain menu unggulan, kami juga menyediakan beragam pilihan lezat lainnya. Silakan lihat daftar menu lengkap kami.
                                </p>
                                <div class="menu-cta" style="position: static; transform: none; margin-top: 12px; text-align: center;">
                                    <a href="{{ route('menu.daftar') }}" class="btn btn-daftar" target="_blank" rel="noopener">DAFTAR MENU</a>
                                </div>
                            </div>


                        @else
                            <div style="text-align: center; color: #fff; padding: 40px;">
                                <p>Menu unggulan belum ditambahkan. Silakan akses halaman admin untuk menambahkan menu.</p>
                            </div>
                        @endif
                    </div>

                    {{--
                    <div class="menu-cta" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('menu.daftar') }}" class="btn btn-daftar" target="_blank" rel="noopener">DAFTAR MENU</a>
                    </div>
                    --}}
                </div>
            </div>
        </section>

        <section id="kontak">
            <div class="container">
                <div class="kontak-wrapper">
                    <div class="kontak-map" data-aos="fade-up" data-aos-delay="120">
                        <iframe src="{{ route('map.redirect') }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" aria-label="Peta Lokasi RM Gulai Kakek"></iframe>
                    </div>

                    <div class="kontak-info" data-aos="fade-left" data-aos-delay="160">
                        <h3>KONTAK KAMI</h3>
                        <div class="info-item">
                            <div class="icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="currentColor" d="M8 0C5.243 0 3 2.243 3 5c0 3.75 4.5 9.5 4.707 9.74.17.195.47.195.64 0C8.5 14.5 13 8.75 13 5c0-2.757-2.243-5-5-5zm0 7.5A2.5 2.5 0 1 1 8 2.5a2.5 2.5 0 0 1 0 5z" />
                                </svg>
                            </div>
                            <div>
                                <strong>{{ isset($settings) && $settings->get('kontak_alamat') && $settings->get('kontak_alamat')->value ? $settings->get('kontak_alamat')->value : 'Jl. Lintas Padang-Solok, Lubuk Selasih' }}</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="currentColor" d="M3.654 1.328a.678.678 0 0 1 .737-.098l2.522 1.26c.27.135.43.418.39.712l-.288 2.01a.678.678 0 0 1-.606.56l-1.01.105c.6 1.172 1.64 2.212 2.812 2.812l.105-1.01a.678.678 0 0 1 .56-.606l2.01-.288c.294-.04.577.12.712.39l1.26 2.522a.678.678 0 0 1-.098.737l-1.2 1.2c-.53.53-1.35.666-2.03.356-2.02-1.02-4.36-3.36-5.38-5.38-.31-.68-.174-1.5.356-2.03l1.2-1.2z" />
                                </svg>
                            </div>
                            <div>
                                <strong>{{ isset($settings) && $settings->get('kontak_telepon') && $settings->get('kontak_telepon')->value ? $settings->get('kontak_telepon')->value : '0813-6345-4213' }}</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="currentColor" d="M8 3.5a.5.5 0 0 1 .5.5v3.25l2.25 1.35a.5.5 0 1 1-.5.866L7.5 8.0V4a.5.5 0 0 1 .5-.5z" />
                                    <path fill="currentColor" d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16zm0-1A7 7 0 1 0 8 1a7 7 0 0 0 0 14z" />
                                </svg>
                            </div>
                            <div>
                                @php
                                    $jamBuka = isset($settings) && $settings->get('kontak_jam_buka') && $settings->get('kontak_jam_buka')->value ? $settings->get('kontak_jam_buka')->value : 'Senin - Minggu, 07:30 - 22:00';
                                    $jamParts = explode(',', $jamBuka);
                                @endphp
                                <strong>{{ trim($jamParts[0] ?? 'Senin - Minggu') }}</strong>
                                @if(isset($jamParts[1]))
                                <div>{{ trim($jamParts[1]) }}</div>
                                @else
                                <div>07:30 - 22:00</div>
                                @endif
                            </div>
                        </div>

                        <h3 style="margin-top:16px;">IKUTI KAMI</h3>
                        <div class="socials">
                            @php
                                $tiktok = isset($settings) && $settings->get('kontak_tiktok') && $settings->get('kontak_tiktok')->value ? $settings->get('kontak_tiktok')->value : '@gulaikambiangkakek';
                                $instagram = isset($settings) && $settings->get('kontak_instagram') && $settings->get('kontak_instagram')->value ? $settings->get('kontak_instagram')->value : '@rm.gulai_kambiang_kakek';
                            @endphp
                            @if($tiktok)
                            <div class="info-item">
                                <div class="icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path fill="currentColor" d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                </div>
                                <div>{{ $tiktok }}</div>
                            </div>
                            @endif
                            @if($instagram)
                            <div class="info-item">
                                <div class="icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </div>
                                <div>{{ $instagram }}</div>
                            </div>
                            @endif
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
	</div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.AOS) {
                AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true });
            }
        });
    </script>
    <script>
        // Simple hero slideshow: cycles slides every 5 seconds with smooth fade
        (function () {
            const SLIDE_INTERVAL = 5000; // ms
            const slidesContainer = document.querySelector('.home-slides');
            if (!slidesContainer) return;
            const slides = Array.from(slidesContainer.querySelectorAll('.home-slide'));
            if (slides.length === 0) return;

            let current = 0;
            // Set first active
            slides.forEach((s, i) => s.classList.toggle('active', i === 0));

            setInterval(() => {
                const next = (current + 1) % slides.length;
                slides[current].classList.remove('active');
                slides[next].classList.add('active');
                current = next;
            }, SLIDE_INTERVAL);
        })();
    </script>
    <script>
        // Smooth scroll for internal anchor links (nav)
        document.addEventListener('DOMContentLoaded', function () {
            // Only target in-page hash links
            document.querySelectorAll('a[href^="#"]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    var href = link.getAttribute('href');
                    if (!href || href === '#') return;
                    var target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        // Determine scroll behavior based on target section
                        var scrollBlock = 'start'; // default: scroll to top
                        if (href === '#about') {
                            scrollBlock = 'center'; // About Us: scroll to center
                        }
                        target.scrollIntoView({ behavior: 'smooth', block: scrollBlock, inline: 'nearest' });
                        // Update URL hash without jumping
                        if (history && history.pushState) {
                            history.pushState(null, null, href);
                        } else {
                            location.hash = href;
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
