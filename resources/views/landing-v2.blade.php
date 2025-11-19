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
            --color-black: #1a1a1a;
            --color-gray: #4a4a4a;
            --color-light-gray: #f5f5f5;
            --color-white: #FFFFFF;
            --color-primary: #c9a227; /* Emas Minang */
            --color-accent: #f2e6c9;   /* Krem Minang */

            /* Warna Minangkabau */
            --color-red-minang: #8b2c1e; /* Merah Minang */
            --color-brown-minang: #5c3d2e; /* Coklat Minang */
            --color-dark-wood: #3e2723; /* Coklat kayu tua */

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
            background-color: var(--color-dark-wood);
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23c9a227' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        /* Kontainer utama dengan border khas Minang */
        main {
            background-color: var(--color-accent);
            max-width: 1440px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.7);
            position: relative;
            z-index: 5;
            border: 12px solid var(--color-dark-wood);
            border-top: none;
            border-bottom: none;
        }

        /* Ornamen Minangkabau di bagian atas dan bawah */
        main::before, main::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            height: 30px;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='30' viewBox='0 0 100 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 15h20c0-8.284 6.716-15 15-15s15 6.716 15 15h20c0-8.284 6.716-15 15-15s15 6.716 15 15h20' stroke='%23c9a227' stroke-width='2' fill='none'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-size: 100px 30px;
            z-index: 10;
        }

        main::before {
            top: 0;
        }

        main::after {
            bottom: 0;
            transform: rotate(180deg);
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

        /* Tombol dengan gaya Minang */
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
            background-color: var(--color-red-minang);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-minang:hover::before {
            left: 0;
        }

        .btn-minang:hover {
            color: var(--color-white);
            border-color: var(--color-red-minang);
        }

        /* --- 1. HEADER (NAVBAR) --- */
        header {
            background-color: var(--color-dark-wood);
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
            border-radius: 50%;
            border: 2px solid var(--color-primary);
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

        /* --- 2. HOME SECTION --- */
        #home {
            background-color: var(--color-red-minang);
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            padding-top: 180px;
            padding-bottom: 120px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        #home::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0 L100 40 L100 100 L0 100 L0 40 Z' fill='none' stroke='%23c9a227' stroke-width='1' stroke-opacity='0.2'/%3E%3C/svg%3E");
            background-size: 100px 100px;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-family: var(--font-traditional);
            font-size: 64px;
            line-height: 1.1;
            color: var(--color-primary);
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
            margin-bottom: 20px;
        }

        .hero-sub {
            font-family: var(--font-heading);
            font-size: 18px;
            letter-spacing: 2px;
            color: var(--color-white);
            margin-top: 15px;
            text-transform: uppercase;
        }

        .rumah-gadang-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23c9a227'%3E%3Cpath d='M12 3L2 12h3v8h14v-8h3L12 3zm0 2.5L19 12v7h-5v-5h-4v5H5v-7l7-6.5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        /* --- 3. ABOUT US SECTION --- */
        #about {
            background-color: var(--color-accent);
            position: relative;
        }

        #about::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red-minang) 50%, var(--color-primary) 100%);
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border: 5px solid var(--color-white);
        }

        .about-text {
            color: var(--color-gray);
        }

        .about-text .section-title {
            color: var(--color-red-minang);
            font-size: 2.5rem;
            text-transform: uppercase;
            font-family: var(--font-heading);
            margin-bottom: 10px;
        }

        .about-text .section-subtitle {
            font-family: var(--font-traditional);
            font-size: 32px;
            color: var(--color-brown-minang);
            margin-bottom: 25px;
        }

        .about-text p {
            color: var(--color-gray);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* --- 4. MENU UNGGULAN SECTION --- */
        #menu {
            background-color: var(--color-brown-minang);
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
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red-minang) 50%, var(--color-primary) 100%);
        }

        #menu::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='30' viewBox='0 0 100 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 15h20c0-8.284 6.716-15 15-15s15 6.716 15 15h20c0-8.284 6.716-15 15-15s15 6.716 15 15h20' stroke='%23c9a227' stroke-width='2' fill='none'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-size: 100px 30px;
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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            width: 100%;
            padding: 0 20px;
            margin-top: 40px;
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
        }

        .menu-unggulan-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red-minang) 100%);
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
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-unggulan-content h3 {
            font-family: var(--font-heading);
            color: var(--color-red-minang);
            font-size: 1.8rem;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .menu-unggulan-content p {
            color: var(--color-gray);
            line-height: 1.6;
            flex: 1;
        }

        .menu-unggulan-content .price {
            font-family: var(--font-heading);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-top: 15px;
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
            background-color: var(--color-red-minang);
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
            background-color: var(--color-accent);
            position: relative;
        }

        #kontak::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red-minang) 50%, var(--color-primary) 100%);
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
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
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
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23c9a227' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
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
            color: var(--color-gray);
        }

        .kontak-info h3 {
            color: var(--color-red-minang);
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
            background-color: var(--color-primary);
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
            background: var(--color-red-minang);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-primary);
            font-weight: 700;
            flex-shrink: 0;
        }

        .kontak-info p, .kontak-info a {
            color: var(--color-gray);
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
            padding: 8px 15px;
            background-color: var(--color-brown-minang);
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
            background-color: var(--color-dark-wood);
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
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-red-minang) 50%, var(--color-primary) 100%);
        }

        footer p {
            margin: 0;
            font-family: var(--font-body);
            font-size: 0.9rem;
        }

        .footer-traditional-pattern {
            height: 30px;
            margin-bottom: 20px;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='30' viewBox='0 0 100 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 15h20c0-8.284 6.716-15 15-15s15 6.716 15 15h20c0-8.284 6.716-15 15-15s15 6.716 15 15h20' stroke='%23c9a227' stroke-width='2' fill='none'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-size: 100px 30px;
        }

        /* --- 7. RESPONSIVE CSS --- */
        @media (max-width: 992px) {
            .about-wrapper {
                grid-template-columns: 1fr;
            }

            .kontak-wrapper {
                grid-template-columns: 1fr;
            }

            .menu-unggulan-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                gap: 15px;
                align-items: center;
                justify-content: center;
                margin: 0;
                width: 100%;
                max-width: 100%;
                padding: 0 20px;
            }

            .nav-menu ul {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            section {
                padding: 60px 0;
            }

            #home {
                padding-top: 180px;
            }

            .hero-title {
                font-size: 48px;
            }
        }

        @media (max-width: 600px) {
            header .container {
                padding: 0 12px;
            }

            #home {
                padding-top: 140px;
            }

            .hero-title {
                font-size: 36px;
            }

            .about-wrapper {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .menu-unggulan-grid {
                grid-template-columns: 1fr;
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
                <img src="{{ asset('images/logo_rm_gulai_kambing_kakek.jpg') }}" alt="RM Gulai Kakek" class="site-logo">
            </a>
            <nav class="nav-menu">
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="home">
            <div class="hero-content container">
                <div class="rumah-gadang-icon"></div>
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

                        @else
                            <div style="text-align: center; color: #fff; padding: 40px; grid-column: 1 / -1;">
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

    <footer>
        <div class="footer-traditional-pattern"></div>
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

        // Auto-Hide Header
        (function() {
            let lastScrollTop = 0;
            const header = document.querySelector('header');
            const delta = 10;
            const headerHeight = header.offsetHeight;

            window.addEventListener('scroll', function() {
                let scrollTop = window.scrollY || document.documentElement.scrollTop;
                if (Math.abs(lastScrollTop - scrollTop) <= delta) {
                    return;
                }
                if (scrollTop > lastScrollTop && scrollTop > headerHeight){
                    header.classList.add('header-hidden');
                } else {
                    header.classList.remove('header-hidden');
                }
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            }, false);
        })();
    </script>

</body>
</html>
