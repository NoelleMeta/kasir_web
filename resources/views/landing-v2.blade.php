<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>RM Gulai Kakek - Selamat Datang (Nuansa Minangkabau)</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* --- VARIABLE CSS --- */
        :root {
            --color-black: #292929;
            --color-gray: #333333;
            --color-light-gray: #f5f5f5;
            --color-white: #FFFFFF;
            --color-primary: #FFD700; /* Kuning */
            --color-accent: #FFF5E6;   /* Krem muda */

            /* Warna tema baru */
            --color-red: #8d0303; /* Merah */
            --color-dark-gray: #2c2828; /* Abu-abu tua */

            --font-heading: 'Poppins', sans-serif;
            --font-body: 'Montserrat', sans-serif;
            --font-traditional: 'Great Vibes', cursive;
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
            line-height: 1.6;
            overflow-x: hidden;
            background-color: var(--color-dark-gray);
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23FFD700' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        /* Kontainer utama dengan border khas */
        main {
            background-color: var(--color-accent);
            max-width: 1440px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.7);
            position: relative;
            z-index: 5;
            border: 12px solid var(--color-black);
            border-top: none;
            border-bottom: none;
        }

        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 20px;
        }

        section {
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        h1, h2, h3, h4 {
            font-family: var(--font-heading);
            color: var(--color-black);
            font-weight: 700;
        }

        h2 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 15px;
        }

        h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background-color: var(--color-primary);
        }

        p {
            font-size: 1rem;
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

        /* Tombol dengan gaya baru */
        .btn-minang {
            background-color: var(--color-primary);
            color: var(--color-black);
            border: 2px solid var(--color-primary);
            position: relative;
            overflow: hidden;
        }

        .btn-minang::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: var(--color-red);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-minang:hover::before {
            left: 0;
        }

        .btn-minang:hover {
            color: var(--color-white);
            border-color: var(--color-red);
        }

        /* --- 1. HEADER (NAVBAR) --- */
        header {
            background-color: #000000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            will-change: transform;
            transition: transform 0.3s ease-out;
            border-bottom: 3px solid var(--color-primary);
        }

        header.header-hidden {
            transform: translateY(-100%);
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

        .nav-menu ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-menu li a {
            text-decoration: none;
            color: var(--color-white);
            font-family: var(--font-heading);
            font-weight: 500;
            font-size: 1rem;
            padding: 8px;
            position: relative;
            transition: color 0.2s ease;
        }

        .nav-menu li a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--color-primary);
            transition: width 0.3s ease;
        }

        .nav-menu li a:hover {
            color: var(--color-primary);
        }

        .nav-menu li a:hover::after {
            width: 100%;
        }

        .nav-menu .btn-admin {
            background-color: var(--color-primary);
            color: var(--color-black);
            border-radius: 8px;
            padding: 10px 20px;
            border: 2px solid var(--color-primary);
        }

        .nav-menu .btn-admin:hover {
            background-color: var(--color-accent);
            color: var(--color-black);
            border-color: var(--color-primary);
        }

        .nav-menu .btn-admin::after {
            display: none; /* Hapus underline effect untuk tombol admin */
        }

        /* --- 2. HOME SECTION --- */
        #home {
            /* Background netral untuk slideshow */
            background-color: #1a1a1a;
            padding-top: 180px;
            padding-bottom: 120px;
            text-align: center;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Slideshow container */
        .slideshow-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        /* Overlay untuk memastikan teks terbaca */
        #home::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
        }

        .hero-title {
            font-family: lobster;
            font-size: 64px;
            line-height: 1.1;
            color: var(--color-primary);
            text-shadow: 0 4px 10px rgba(0,0,0,0.8);
            margin-bottom: 20px;
        }

        .hero-sub {
            font-family: var(--font-heading);
            font-size: 18px;
            letter-spacing: 2px;
            color: var(--color-white);
            margin-top: 15px;
            text-transform: uppercase;
            text-shadow: 0 2px 5px rgba(0,0,0,0.8);
        }

        .rumah-gadang-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23FFD700'%3E%3Cpath d='M12 3L2 12h3v8h14v-8h3L12 3zm0 2.5L19 12v7h-5v-5h-4v5H5v-7l7-6.5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,0.8));
        }

        /* --- 3. ABOUT US SECTION --- */
        #about {
            background-color: var(--color-red);
            position: relative;
            color: var(--color-white);
        }

        #about::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-white) 50%, var(--color-primary) 100%);
        }

        .about-wrapper {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 48px;
            align-items: center;
        }

        .about-image {
            position: relative;
        }

        .about-image::before {
            content: "";
            position: absolute;
            top: -15px;
            left: -15px;
            right: -15px;
            bottom: -15px;
            border: 2px solid var(--color-primary);
            z-index: -1;
            transform: rotate(-2deg);
        }

        .about-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: 5px solid var(--color-white);
        }

        .about-text {
            color: var(--color-white);
        }

        .about-text .section-title {
            color: var(--color-primary);
            font-size: 2.5rem;
            text-transform: uppercase;
            font-family: var(--font-heading);
            margin-bottom: 10px;
        }

        .about-text .section-subtitle {
            font-family: var(--font-traditional);
            font-size: 32px;
            color: var(--color-white);
            margin-bottom: 25px;
        }

        .about-text p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* --- 4. MENU UNGGULAN SECTION --- */
        #menu {
            background-color: var(--color-black);
            position: relative;
            padding: 100px 0 120px;
        }

        #menu::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red) 50%, var(--color-primary) 100%);
        }

        #menu::after {
            display: none;
        }

        .menu-inner {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
        }

        #menu .menu-header {
            text-align: center;
            max-width: 900px;
            margin: 0 auto 50px;
        }

        #menu .menu-title {
            color: var(--color-primary);
        }

        #menu .menu-subtitle {
            font-family: var(--font-traditional);
            font-size: 28px;
            color: var(--color-white);
            margin-bottom: 15px;
        }

        #menu .menu-description {
            color: var(--color-light-gray);
            font-size: 1.1rem;
        }

        .menu-unggulan-grid {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: row;
            gap: 20px;
            width: 100%;
            padding: 0 20px;
            margin-top: 40px;
            overflow-x: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .menu-unggulan-grid::-webkit-scrollbar {
            height: 8px;
        }

        .menu-unggulan-grid::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
        }

        .menu-unggulan-grid::-webkit-scrollbar-thumb {
            background: var(--color-primary);
            border-radius: 4px;
        }

        .menu-unggulan-item {
            background: var(--color-accent);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            cursor: pointer;
            flex: 0 0 250px;
            min-width: 250px;
        }

        .menu-unggulan-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red) 100%);
        }

        .menu-unggulan-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        .menu-unggulan-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .menu-unggulan-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .menu-unggulan-item:hover .menu-unggulan-image img {
            transform: scale(1.1);
        }

        .menu-unggulan-content {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .menu-unggulan-content h3 {
            font-family: var(--font-heading);
            color: var(--color-red);
            font-size: 1.3rem;
            margin: 0;
            font-weight: 700;
        }

        .menu-unggulan-content p {
            display: none; /* Hidden in card view */
        }

        /* Modal Styles */
        .menu-modal {
            display: none;
            position: fixed;
            /* [PERBAIKAN UTAMA] Z-Index sangat tinggi agar selalu di atas */
            z-index: 99999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            overflow: auto;
            animation: fadeIn 0.3s ease;
        }

        .menu-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .menu-modal-content {
            background: var(--color-accent);
            border-radius: 12px;
            width: 90%;
            max-width: 450px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            position: relative;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .menu-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 28px;
            font-weight: bold;
            color: var(--color-gray);
            cursor: pointer;
            z-index: 10001;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .menu-modal-close:hover {
            background: var(--color-red);
            color: var(--color-white);
            transform: rotate(90deg);
        }

        .menu-modal-image {
            width: 100%;
            height: auto;
            background-color: transparent;
            text-align: center;
            padding-top: 20px;
        }

        .menu-modal-image img {
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 350px;
            object-fit: contain;
            border-radius: 4px;
        }

        .menu-modal-body {
            padding: 30px;
        }

        .menu-modal-body h3 {
            font-family: var(--font-heading);
            color: var(--color-red);
            font-size: 2rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .menu-modal-body p {
            color: var(--color-gray);
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Modal Responsive */
        @media (max-width: 768px) {
            .menu-modal-content {
                max-width: 95%;
                margin: 10px;
            }

            .menu-modal-image {
                height: auto;
            }

            .menu-modal-body {
                padding: 20px;
            }

            .menu-modal-body h3 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 600px) {
            .menu-modal-content {
                max-width: 100%;
                margin: 0;
                border-radius: 0;
                max-height: 100vh;
            }

            .menu-modal-image {
                height: auto;
            }

            .menu-modal-image img {
                max-height: 250px;
            }

            .menu-modal-body {
                padding: 15px;
            }

            .menu-modal-body h3 {
                font-size: 1.3rem;
            }

            .menu-modal-body p {
                font-size: 0.9rem;
            }
        }

        .menu-cta {
            text-align: center;
            margin-top: 50px;
        }

        .btn-daftar {
            background: var(--color-primary);
            color: var(--color-black);
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
            position: relative;
            overflow: hidden;
        }

        .btn-daftar::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: var(--color-red);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-daftar:hover::before {
            left: 0;
        }

        .btn-daftar:hover {
            color: var(--color-white);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.5);
        }

        /* --- 5. KONTAK KAMI SECTION --- */
        #kontak {
            background-color: var(--color-red);
            position: relative;
            color: var(--color-white);
        }

        #kontak::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-white) 50%, var(--color-primary) 100%);
        }

        .kontak-wrapper {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 40px;
            align-items: center;
        }

        .kontak-map {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
            border: 5px solid var(--color-primary);
            position: relative;
        }

        .kontak-map::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23FFD700' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            z-index: 1;
            pointer-events: none;
        }

        .kontak-map iframe {
            width: 100%;
            height: 320px;
            border: 0;
            display: block;
            position: relative;
            z-index: 2;
        }

        .kontak-info {
            color: var(--color-white);
        }

        .kontak-info h3 {
            color: var(--color-primary);
            font-size: 24px;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .kontak-info h3::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--color-white);
        }

        .kontak-info .info-item {
            display: flex;
            gap: 15px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .kontak-info .info-item .icon {
            width: 40px;
            height: 40px;
            background: var(--color-white);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-red);
            font-weight: 700;
            flex-shrink: 0;
        }

        .kontak-info p, .kontak-info a {
            color: var(--color-white);
            text-decoration: none;
            font-size: 1rem;
        }

        .kontak-info .socials {
            margin-top: 25px;
        }

        .kontak-info .socials a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 15px;
            margin-bottom: 15px;
            padding: 8px 15px;
            background-color: var(--color-black);
            color: var(--color-white);
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .kontak-info .socials a:hover {
            background-color: var(--color-primary);
            color: var(--color-black);
            transform: translateY(-3px);
        }

        /* --- 6. FOOTER --- */
        footer {
            background-color: var(--color-black);
            color: var(--color-light-gray);
            padding: 30px 0;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red) 50%, var(--color-primary) 100%);
        }

        footer p {
            margin: 0;
            font-family: var(--font-body);
            font-size: 0.9rem;
        }

        .footer-traditional-pattern {
            display: none;
        }



        /* --- 7. RESPONSIVE CSS --- */
        @media (max-width: 992px) {
            .about-wrapper {
                grid-template-columns: 1fr;
            }

            .kontak-wrapper {
                grid-template-columns: 1fr;
            }

            .menu-unggulan-item {
                flex: 0 0 220px;
                min-width: 220px;
            }
        }

        @media (max-width: 768px) {
            /* Reduce header size on mobile */
            header {
                padding: 10px 0;
                border-bottom-width: 2px;
            }

            header .container {
                flex-direction: column;
                gap: 10px;
                align-items: center;
                justify-content: center;
                margin: 0;
                width: 100%;
                max-width: 100%;
                padding: 0 20px;
            }

            .site-logo {
                height: 40px;
            }

            .nav-menu ul {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .nav-menu li a {
                font-size: 0.9rem;
                padding: 6px;
            }

            /* Hide admin button on mobile */
            .nav-menu .btn-admin {
                display: none;
            }

            section {
                padding: 60px 0;
            }

            #home {
                padding-top: 150px;
                min-height: 80vh;
            }

            .hero-title {
                font-size: 48px;
            }
        }

        @media (max-width: 600px) {
            /* Further reduce header size on small mobile */
            header {
                padding: 8px 0;
                border-bottom-width: 2px;
            }

            header .container {
                padding: 0 12px;
                gap: 8px;
            }

            .site-logo {
                height: 36px;
            }

            .nav-menu ul {
                gap: 8px;
            }

            .nav-menu li a {
                font-size: 0.85rem;
                padding: 5px;
            }

            #home {
                padding-top: 120px;
                min-height: 70vh;
            }

            .hero-title {
                font-size: 36px;
            }

            .about-wrapper {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .menu-unggulan-item {
                flex: 0 0 200px;
                min-width: 200px;
            }

            .kontak-wrapper {
                grid-template-columns: 1fr;
            }

            section {
                padding: 40px 0;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <a href="#home" class="logo">
                <img src="{{ asset('images/logo_rm_gulai_kambing_kakek-removebg-preview.png') }}" alt="RM Gulai Kakek" class="site-logo">
            </a>
            <nav class="nav-menu">
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                    <li><a href="{{ route('login') }}" class="btn-admin">Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="home">
            <div class="slideshow-container">
                @php
                    $bg1 = isset($settings) && $settings->get('bg_home_1') && $settings->get('bg_home_1')->value
                        ? \App\Models\LandingPageSetting::getImageSrc($settings->get('bg_home_1')->value, 'images/bg_home_1.jpg')
                        : asset('images/bg_home_1.jpg');
                    $bg2 = isset($settings) && $settings->get('bg_home_2') && $settings->get('bg_home_2')->value
                        ? \App\Models\LandingPageSetting::getImageSrc($settings->get('bg_home_2')->value, 'images/bg_home_2.jpg')
                        : asset('images/bg_home_2.jpg');
                    $bg3 = isset($settings) && $settings->get('bg_home_3') && $settings->get('bg_home_3')->value
                        ? \App\Models\LandingPageSetting::getImageSrc($settings->get('bg_home_3')->value, 'images/bg_home_3.jpeg')
                        : asset('images/bg_home_3.jpeg');
                @endphp
                <div class="slide active" style="background-image: url('{{ $bg1 }}');"></div>
                <div class="slide" style="background-image: url('{{ $bg2 }}');"></div>
                <div class="slide" style="background-image: url('{{ $bg3 }}');"></div>
            </div>

            <div class="hero-content container">
                <h1 class="hero-title" data-aos="zoom-in">Rasa Legendaris dari Dapur Kakek</h1>
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
                        <div class="about-titles">
                            <div class="section-title" data-aos="fade-right" data-aos-delay="180">TENTANG KAMI</div>
                            <div class="section-subtitle" data-aos="fade-right" data-aos-delay="220">Warisan Turun-temurun</div>
                        </div>
                        <div class="about-description">
                            <p>{{ isset($settings) && $settings->get('about_text_1') && $settings->get('about_text_1')->value ? $settings->get('about_text_1')->value : 'Di RM Gulai Kakek, kami percaya bahwa masakan yang enak berasal dari resep yang tulus. Berdiri pada tahun 2024, kami membawa misi sederhana: menghadirkan gulai kambing seenak buatan "Kakek" di rumah—penuh cinta, kaya rempah, dan tak terlupakan.' }}</p>
                            <p>{{ isset($settings) && $settings->get('about_text_2') && $settings->get('about_text_2')->value ? $settings->get('about_text_2')->value : 'Kami adalah rumah bagi para pencinta hidangan kambing. Dengan bangga, kami menempatkan Gulai Kepala Kambing dan Gulai Kambing sebagai bintang utama di dapur kami. Dibuat dari bahan-bahan segar dan daging pilihan, kami menjamin tekstur yang empuk dan bumbu yang meresap hingga ke tulang.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="menu">
            <div class="container">
                <div class="menu-inner">
                    <div class="menu-header" data-aos="fade-down" data-aos-delay="100">
                        <h2 class="menu-title">MENU UNGGULAN</h2>
                        <div class="menu-subtitle">Spesial dari Dapur Kami</div>
                        <p class="menu-description">
                            {{ $settings->get('menu_unggulan_deskripsi') && $settings->get('menu_unggulan_deskripsi')->value ? $settings->get('menu_unggulan_deskripsi')->value : 'Dengan bangga kami persembahkan hidangan terbaik kami. Menu ini adalah alasan mengapa para tamu selalu kembali. Silakan cicipi dedikasi dan cita rasa khas yang kami tuang dalam setiap porsi.' }}
                        </p>
                    </div>

                    <div class="menu-unggulan-grid">
                        @if($menuItems && count($menuItems) > 0)

                            @if(isset($menuUnggulan1) && $menuUnggulan1)
                                <div class="menu-unggulan-item"
                                     data-aos="fade-up"
                                     data-aos-delay="100"
                                     data-menu-image="{{ $menuUnggulan1->getImageSrc('images/menu_unggulan_1.jpg') }}"
                                     data-menu-nama="{{ $menuUnggulan1->nama }}"
                                     data-menu-deskripsi="{{ $menuUnggulan1->deskripsi }}">
                                    <div class="menu-unggulan-image">
                                        <img src="{{ $menuUnggulan1->getImageSrc('images/menu_unggulan_1.jpg') }}" alt="{{ $menuUnggulan1->nama }}" loading="lazy">
                                    </div>
                                    <div class="menu-unggulan-content">
                                        <h3>{{ $menuUnggulan1->nama }}</h3>
                                    </div>
                                </div>
                            @endif

                            @if(isset($menuUnggulan2) && $menuUnggulan2)
                                <div class="menu-unggulan-item"
                                     data-aos="fade-up"
                                     data-aos-delay="150"
                                     data-menu-image="{{ $menuUnggulan2->getImageSrc('images/menu_unggulan_2.jpg') }}"
                                     data-menu-nama="{{ $menuUnggulan2->nama }}"
                                     data-menu-deskripsi="{{ $menuUnggulan2->deskripsi }}">
                                    <div class="menu-unggulan-image">
                                        <img src="{{ $menuUnggulan2->getImageSrc('images/menu_unggulan_2.jpg') }}" alt="{{ $menuUnggulan2->nama }}" loading="lazy">
                                    </div>
                                    <div class="menu-unggulan-content">
                                        <h3>{{ $menuUnggulan2->nama }}</h3>
                                    </div>
                                </div>
                            @endif

                            @if(isset($menuUnggulan3) && $menuUnggulan3)
                                <div class="menu-unggulan-item"
                                     data-aos="fade-up"
                                     data-aos-delay="200"
                                     data-menu-image="{{ $menuUnggulan3->getImageSrc('images/menu_unggulan_3.jpg') }}"
                                     data-menu-nama="{{ $menuUnggulan3->nama }}"
                                     data-menu-deskripsi="{{ $menuUnggulan3->deskripsi }}">
                                    <div class="menu-unggulan-image">
                                        <img src="{{ $menuUnggulan3->getImageSrc('images/menu_unggulan_3.jpg') }}" alt="{{ $menuUnggulan3->nama }}" loading="lazy">
                                    </div>
                                    <div class="menu-unggulan-content">
                                        <h3>{{ $menuUnggulan3->nama }}</h3>
                                    </div>
                                </div>
                            @endif

                            @if(isset($menuUnggulan4) && $menuUnggulan4)
                                <div class="menu-unggulan-item"
                                     data-aos="fade-up"
                                     data-aos-delay="300"
                                     data-menu-image="{{ $menuUnggulan4->getImageSrc('images/menu_unggulan_4.jpg') }}"
                                     data-menu-nama="{{ $menuUnggulan4->nama }}"
                                     data-menu-deskripsi="{{ $menuUnggulan4->deskripsi }}">
                                    <div class="menu-unggulan-image">
                                        <img src="{{ $menuUnggulan4->getImageSrc('images/menu_unggulan_4.jpg') }}" alt="{{ $menuUnggulan4->nama }}" loading="lazy">
                                    </div>
                                    <div class="menu-unggulan-content">
                                        <h3>{{ $menuUnggulan4->nama }}</h3>
                                    </div>
                                </div>
                            @endif

                        @else
                            <div style="text-align: center; color: #fff; padding: 40px; width: 100%;">
                                <p>Menu unggulan belum ditambahkan. Silakan akses halaman admin untuk menambahkan menu.</p>
                            </div>
                        @endif
                    </div>

                    <div class="menu-cta" data-aos="fade-up" data-aos-delay="250">
                        <p style="color: var(--color-light-gray); margin-bottom: 20px;">
                            Selain menu unggulan, kami juga menyediakan beragam pilihan lezat lainnya. Silakan lihat daftar menu lengkap kami.
                        </p>
                        <a href="{{ route('menu.daftar') }}" class="btn btn-daftar" target="_blank" rel="noopener">DAFTAR MENU LENGKAP</a>
                    </div>
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
                                <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="currentColor" d="M8 0C5.243 0 3 2.243 3 5c0 3.75 4.5 9.5 4.707 9.74.17.195.47.195.64 0C8.5 14.5 13 8.75 13 5c0-2.757-2.243-5-5-5zm0 7.5A2.5 2.5 0 1 1 8 2.5a2.5 2.5 0 0 1 0 5z" />
                                </svg>
                            </div>
                            <div>
                                <strong>{{ isset($settings) && $settings->get('kontak_alamat') && $settings->get('kontak_alamat')->value ? $settings->get('kontak_alamat')->value : 'Jl. Lintas Padang-Solok, Lubuk Selasih' }}</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="currentColor" d="M3.654 1.328a.678.678 0 0 1 .737-.098l2.522 1.26c.27.135.43.418.39.712l-.288 2.01a.678.678 0 0 1-.606.56l-1.01.105c.6 1.172 1.64 2.212 2.812 2.812l.105-1.01a.678.678 0 0 1 .56-.606l2.01-.288c.294-.04.577.12.712.39l1.26 2.522a.678.678 0 0 1-.098.737l-1.2 1.2c-.53.53-1.35.666-2.03.356-2.02-1.02-4.36-3.36-5.38-5.38-.31-.68-.174-1.5.356-2.03l1.2-1.2z" />
                                </svg>
                            </div>
                            <div>
                                <strong>{{ isset($settings) && $settings->get('kontak_telepon') && $settings->get('kontak_telepon')->value ? $settings->get('kontak_telepon')->value : '0813-6345-4213' }}</strong>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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

                        <div class="socials">
                             @php
                                $tiktok_handle = isset($settings) && $settings->get('kontak_tiktok') && $settings->get('kontak_tiktok')->value ? $settings->get('kontak_tiktok')->value : '@gulaikambiangkakek';
                                $instagram_handle = isset($settings) && $settings->get('kontak_instagram') && $settings->get('kontak_instagram')->value ? $settings->get('kontak_instagram')->value : '@rm.gulai_kambiang_kakek';
                                $tiktok_username = ltrim($tiktok_handle, '@');
                                $instagram_username = ltrim($instagram_handle, '@');
                                $tiktok_url = $tiktok_username ? "https://www.tiktok.com/@" . $tiktok_username : null;
                                $instagram_url = $instagram_username ? "https://www.instagram.com/" . $instagram_username : null;
                            @endphp

                            @if($tiktok_url)
                            <a href="{{ $tiktok_url }}" target="_blank" rel="noopener">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="currentColor" d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                                {{ $tiktok_handle }}
                            </a>
                            @endif

                            @if($instagram_url)
                            <a href="{{ $instagram_url }}" target="_blank" rel="noopener">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                {{ $instagram_handle }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="menuModal" class="menu-modal">
        <div class="menu-modal-content">
            <span class="menu-modal-close">&times;</span>
            <div class="menu-modal-image">
                <img id="modalMenuImage" src="" alt="">
            </div>
            <div class="menu-modal-body">
                <h3 id="modalMenuNama"></h3>
                <p id="modalMenuDeskripsi"></p>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 RM Gulai Kakek. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.AOS) {
                AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true });
            }
        });
    </script>

    <script>
        // Smooth scroll for internal anchor links (nav)
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('a[href^="#"]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    var href = link.getAttribute('href');
                    if (!href || href === '#') return;
                    var target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        var scrollBlock = 'start';
                        target.scrollIntoView({ behavior: 'smooth', block: scrollBlock, inline: 'nearest' });
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

    <script>
        // Slideshow functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[index].classList.add('active');
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            // Change slide every 5 seconds
            setInterval(nextSlide, 5000);
        });
    </script>

    <script>
        // Menu Modal Functionality
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('menuModal');
            const closeBtn = document.querySelector('.menu-modal-close');
            const menuItems = document.querySelectorAll('.menu-unggulan-item');

            // Open modal when menu item is clicked
            menuItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    const image = this.getAttribute('data-menu-image');
                    const nama = this.getAttribute('data-menu-nama');
                    const deskripsi = this.getAttribute('data-menu-deskripsi');

                    document.getElementById('modalMenuImage').src = image;
                    document.getElementById('modalMenuImage').alt = nama;
                    document.getElementById('modalMenuNama').textContent = nama;
                    document.getElementById('modalMenuDeskripsi').textContent = deskripsi;

                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden'; // Prevent background scrolling
                });
            });

            // Close modal when close button is clicked
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('active');
                document.body.style.overflow = ''; // Restore scrolling
            });

            // Close modal when clicking outside the modal content
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = ''; // Restore scrolling
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    modal.classList.remove('active');
                    document.body.style.overflow = ''; // Restore scrolling
                }
            });
        });
    </script>

</body>
</html>
