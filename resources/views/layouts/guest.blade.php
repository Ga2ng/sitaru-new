<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SITARU') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&family=playfair-display:400,600,700,900&family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-dark: #0A2D1A;
            --primary-main: #1A5D3F;
            --primary-light: #2E7D55;
            --primary-accent: #3D9970;
            --gold-primary: #DAB660;
            --gold-light: #F2D484;
            --gold-dark: #B8965C;
            --cream: #FFFBF0;
            --warm-white: #FEFEFE;
            --shadow-primary: rgba(26, 93, 63, 0.15);
            --shadow-gold: rgba(218, 182, 96, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        
        .main-container {
            background: linear-gradient(135deg, 
                var(--primary-dark) 0%, 
                var(--primary-main) 25%, 
                #1F6B4A 50%, 
                var(--primary-light) 75%,
                var(--primary-accent) 100%);
            height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        /* Enhanced Background Effects */
        .bg-effects {
            position: absolute;
            inset: 0;
            z-index: 1;
        }
        
        .bg-pattern {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23DAB660' fill-opacity='0.06'%3E%3Cpath d='M50 50c0-27.614 22.386-50 50-50v100c-27.614 0-50-22.386-50-50zM0 50c0 27.614 22.386 50 50 50V0C22.386 0 0 22.386 0 50z'/%3E%3C/g%3E%3Cg fill='%23DAB660' fill-opacity='0.03'%3E%3Ccircle cx='50' cy='50' r='25'/%3E%3Ccircle cx='25' cy='25' r='15'/%3E%3Ccircle cx='75' cy='75' r='15'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-size: 150px 150px;
            animation: float-pattern 40s linear infinite;
        }
        
        .bg-orbs {
            position: absolute;
            inset: 0;
        }
        
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            animation: float-orb 20s ease-in-out infinite;
        }
        
        .bg-orb:nth-child(1) {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--gold-primary) 0%, transparent 70%);
            top: 10%;
            left: -10%;
            animation-delay: 0s;
            opacity: 0.15;
        }
        
        .bg-orb:nth-child(2) {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            top: 60%;
            right: -5%;
            animation-delay: -7s;
            opacity: 0.2;
        }
        
        .bg-orb:nth-child(3) {
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, var(--gold-light) 0%, transparent 70%);
            bottom: 20%;
            left: 20%;
            animation-delay: -14s;
            opacity: 0.1;
        }
        
        @keyframes float-pattern {
            0% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-20px) translateX(10px); }
            50% { transform: translateY(-10px) translateX(-15px); }
            75% { transform: translateY(15px) translateX(5px); }
            100% { transform: translateY(0px) translateX(0px); }
        }
        
        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.1; }
            25% { transform: translate(20px, -30px) scale(1.1); opacity: 0.2; }
            50% { transform: translate(-10px, 20px) scale(0.9); opacity: 0.15; }
            75% { transform: translate(30px, 10px) scale(1.05); opacity: 0.25; }
        }
        
        .content-wrapper {
            position: relative;
            z-index: 10;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .auth-layout {
            width: 100%;
            max-width: 1000px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        
        @media (max-width: 1199px) {
            .auth-layout {
                max-width: 500px;
                height: auto;
            }
            
            .unified-card {
                flex-direction: column;
                height: auto;
            }
            
            .branding-section {
                height: auto;
                padding: 2rem;
            }
            
            .form-section {
                height: auto;
                padding: 2rem;
            }
        }
        
        /* Unified Card Container */
        .unified-card {
            background: linear-gradient(145deg, 
                rgba(255, 255, 255, 0.98) 0%,
                rgba(255, 251, 240, 0.95) 100%);
            backdrop-filter: blur(30px);
            border-radius: 24px;
            box-shadow: 
                0 35px 90px rgba(0, 0, 0, 0.15),
                0 15px 50px var(--shadow-primary),
                0 5px 20px rgba(218, 182, 96, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.6);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            display: flex;
            height: 600px;
        }

        .unified-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(26, 93, 63, 0.02) 0%, 
                transparent 30%, 
                rgba(218, 182, 96, 0.03) 70%,
                transparent 100%);
            pointer-events: none;
        }

        .unified-card::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, 
                var(--gold-primary), 
                var(--primary-light), 
                var(--gold-light),
                var(--primary-main));
            background-size: 400% 400%;
            border-radius: 24px;
            z-index: -1;
            animation: gradient-border 8s ease infinite;
            opacity: 0.3;
        }

        .unified-card:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 45px 110px rgba(0, 0, 0, 0.2),
                0 20px 60px var(--shadow-primary),
                0 10px 30px var(--shadow-gold);
        }

        /* Enhanced Left Content */
        .branding-section {
            color: var(--primary-main);
            text-align: center;
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            flex: 1;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px 0 0 24px;
        }
        
        .logo-container {
            margin-bottom: 2rem;
            position: relative;
        }
        
        .title-main {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, 
                var(--primary-main) 0%, 
                var(--gold-primary) 50%, 
                var(--primary-main) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.05em;
        }
        
        
        .subtitle {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            color: var(--primary-main);
            font-weight: 500;
            letter-spacing: 0.02em;
            font-family: 'Poppins', sans-serif;
        }
        
        .tagline {
            font-size: 0.85rem;
            color: var(--primary-main);
            font-style: italic;
            margin-bottom: 1.2rem;
            font-weight: 300;
            line-height: 1.3;
            opacity: 0.7;
        }
        
        /* Enhanced Traditional Accents */
        .traditional-accent {
            background: linear-gradient(90deg, 
                transparent 0%, 
                var(--gold-primary) 20%, 
                var(--gold-light) 50%, 
                var(--gold-primary) 80%, 
                transparent 100%);
            height: 3px;
            width: 180px;
            margin: 2rem auto;
            opacity: 0.9;
            position: relative;
            border-radius: 2px;
        }
        
        .traditional-accent::before,
        .traditional-accent::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: var(--gold-primary);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .traditional-accent::before { left: -15px; }
        .traditional-accent::after { right: -15px; }
        
        /* Enhanced Maskot Section - Poster Style */
        .maskot-container {
            position: relative;
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        
        .maskot-image {
            width: 160px;
            height: 200px;
            object-fit: cover;
            object-position: center top;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Enhanced Auth Card */
        .form-section {
            position: relative;
            display: flex;
            align-items: center;
            height: 100%;
            flex: 1;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 0 24px 24px 0;
        }
        
        .auth-card-content {
            position: relative;
            z-index: 2;
            width: 100%;
        }
        
        /* Enhanced Button */
        .btn-primary {
            background: linear-gradient(135deg, 
                var(--primary-main) 0%, 
                var(--primary-light) 50%,
                var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 1.2rem 2.5rem;
            border-radius: 16px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px var(--shadow-primary);
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.02em;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255,255,255,0.3), 
                transparent);
            transition: left 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, 
                rgba(218, 182, 96, 0.2) 0%, 
                transparent 50%, 
                rgba(218, 182, 96, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover::after {
            opacity: 1;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 20px 45px var(--shadow-primary),
                0 10px 25px rgba(218, 182, 96, 0.2);
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
            transition-duration: 0.1s;
        }
        
        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-primary:disabled:hover {
            transform: none;
            box-shadow: 0 8px 25px var(--shadow-primary);
        }
        
        /* Enhanced Quote Section */
        .quote-section {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(26, 93, 63, 0.1);
            position: relative;
        }
        
        .quote-text {
            color: var(--primary-main);
            font-size: 0.75rem;
            line-height: 1.4;
            font-style: italic;
            text-align: center;
            font-weight: 300;
            position: relative;
            padding: 0 0.5rem;
            opacity: 0.7;
        }
        
        /* Form Enhancements */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-main);
            font-size: 0.95rem;
        }
        
        .form-input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid rgba(26, 93, 63, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(218, 182, 96, 0.1);
            background: rgba(255, 255, 255, 0.95);
        }
        
        /* Mobile Responsive */
        @media (max-width: 1199px) {
            .maskot-image {
                width: 280px;
                height: 340px;
            }
            
            .auth-card {
                padding: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 0.5rem;
            }
            
            .unified-card {
                height: auto;
                flex-direction: column;
            }
            
            .branding-section {
                border-radius: 24px 24px 0 0;
                padding: 1.5rem;
            }
            
            .form-section {
                border-radius: 0 0 24px 24px;
                padding: 1.5rem;
            }
            
            .title-main {
                font-size: 2.5rem;
            }
            
            .maskot-image {
                width: 150px;
                height: 180px;
            }
        }
        
        @media (max-width: 480px) {
            .title-main {
                font-size: 2rem;
            }
            
            .maskot-image {
                width: 120px;
                height: 150px;
            }
            
            .branding-section,
            .form-section {
                padding: 1rem;
            }
            
            .quote-text {
                font-size: 0.7rem;
                padding: 0 0.5rem;
            }
        }
        
        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-main));
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeOut 1s ease 2s forwards;
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 3px solid rgba(218, 182, 96, 0.3);
            border-top: 3px solid var(--gold-primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes fadeOut {
            to { opacity: 0; pointer-events: none; }
        }
        
        /* Success Animation Styles */
        .success-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-main));
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }
        
        .success-animation.show {
            opacity: 1;
            visibility: visible;
        }
        
        .success-content {
            text-align: center;
            color: white;
            transform: scale(0.8);
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .success-animation.show .success-content {
            transform: scale(1);
        }
        
        .success-icon {
            font-size: 5rem;
            color: var(--gold-primary);
            margin-bottom: 1.5rem;
            animation: bounceIn 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            text-shadow: 0 0 30px rgba(218, 182, 96, 0.5);
        }
        
        .success-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            font-family: 'Poppins', sans-serif;
            animation: slideInUp 1s ease-out 0.3s both;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .success-message {
            font-size: 1.2rem;
            opacity: 0.9;
            font-family: 'Poppins', sans-serif;
            animation: slideInUp 1s ease-out 0.6s both;
            max-width: 400px;
            line-height: 1.6;
        }
        
        .form-slide-out {
            animation: slideOutLeft 0.8s ease-in-out forwards;
        }
        
        .branding-expand {
            animation: expandToFull 1s cubic-bezier(0.4, 0, 0.2, 1) 0.5s both;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
        }
        
        .success-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
            padding: 2rem;
            position: relative;
        }
        
        .success-icon-container {
            margin-bottom: 2rem;
            position: relative;
        }
        
        .success-icon-container i {
            font-size: 5rem;
            color: #DAAF49;
            animation: bounceIn 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            text-shadow: 0 0 40px rgba(218, 175, 73, 0.8);
            filter: drop-shadow(0 0 20px rgba(218, 175, 73, 0.5));
        }
        
        .success-title {
            font-size: 3rem;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 1rem;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: slideInUp 1s ease-out 0.3s both;
        }
        
        .success-subtitle {
            font-size: 1.3rem;
            color: #F7F8F9;
            margin-bottom: 0.5rem;
            font-weight: 500;
            animation: slideInUp 1s ease-out 0.6s both;
        }
        
        .success-message {
            font-size: 1rem;
            color: #E8F5F0;
            opacity: 0.9;
            margin-bottom: 2rem;
            animation: slideInUp 1s ease-out 0.9s both;
            max-width: 400px;
            line-height: 1.6;
        }
        
        .success-progress {
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 1rem;
            animation: slideInUp 1s ease-out 1.2s both;
        }
        
        .success-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #DAAF49, #F2D484, #DAAF49);
            border-radius: 2px;
            animation: progressFill 3s ease-out 1.5s both;
        }
        
        .success-particles-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }
        
        @keyframes slideOutLeft {
            0% {
                transform: translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateX(-100%);
                opacity: 0;
            }
        }
        
        @keyframes expandToFull {
            0% {
                transform: scale(0.8) translateX(-50px);
                opacity: 0;
            }
            100% {
                transform: scale(1) translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes progressFill {
            0% {
                width: 0%;
            }
            100% {
                width: 100%;
            }
        }
        
        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        @keyframes slideInUp {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .success-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--gold-primary);
            border-radius: 50%;
            animation: floatUp 3s ease-out infinite;
        }
        
        @keyframes floatUp {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Success Animation Overlay -->
    <div class="success-animation" id="successAnimation">
        <div class="success-particles" id="particles"></div>
        <div class="success-content">
            <i class="fas fa-check-circle success-icon"></i>
            <h2 class="success-title">Login Berhasil!</h2>
            <p class="success-message">Selamat datang di SITARU. Anda akan diarahkan ke dashboard.</p>
        </div>
    </div>

    <div class="main-container">
        <!-- Enhanced Background Effects -->
        <div class="bg-effects">
            <div class="bg-pattern"></div>
            <div class="bg-orbs">
                <div class="bg-orb"></div>
                <div class="bg-orb"></div>
                <div class="bg-orb"></div>
            </div>
        </div>
        
        <div class="content-wrapper">
            <div class="auth-layout">
                <!-- Unified Card Container -->
                <div class="unified-card">
                    <!-- Left Side - Branding & Maskot -->
                    <div class="branding-section" style="background: linear-gradient(135deg, #155D4F 0%, #1a6b5c 50%, #DAAF49 100%); position: relative; overflow: hidden;">
                        <div class="logo-container">
                            <h1 class="title-main" style="color: #FFFFFF; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">SITARU</h1>
                            <div class="traditional-accent" style="background: #DAAF49; box-shadow: 0 0 20px rgba(218, 175, 73, 0.5);"></div>
                            <p class="subtitle" style="color: #F7F8F9; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Sistem Informasi Terpadu</p>
                            <p class="tagline" style="color: #FFFFFF; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Menggabungkan Tradisi & Teknologi Modern<br>untuk Kemajuan Bersama</p>
                        </div>
                        
                        <!-- Enhanced Maskot Display - Poster Style -->
                        <div class="maskot-container">
                            <div class="maskot-glow" style="background: radial-gradient(circle, rgba(218, 175, 73, 0.3) 0%, transparent 70%);"></div>
                            <img src="/images/maskot.png" alt="SITARU Maskot - Penari Banyuwangi" class="maskot-image" style="filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));">
                        </div>
                        
                        <!-- Enhanced Quote Section -->
                        <div class="quote-section">
                            <div class="traditional-accent" style="background: #DAAF49; box-shadow: 0 0 20px rgba(218, 175, 73, 0.5);"></div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Auth Form -->
                    <div class="form-section">
                        <div class="auth-card-content">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced Interactive Effects
        document.addEventListener('DOMContentLoaded', function() {
            // Parallax effect for background
            document.addEventListener('mousemove', function(e) {
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;
                
                const bgPattern = document.querySelector('.bg-pattern');
                const orbs = document.querySelectorAll('.bg-orb');
                
                if (bgPattern) {
                    bgPattern.style.transform = `translate(${mouseX * 10}px, ${mouseY * 10}px)`;
                }
                
                orbs.forEach((orb, index) => {
                    const speed = (index + 1) * 5;
                    orb.style.transform = `translate(${mouseX * speed}px, ${mouseY * speed}px)`;
                });
            });
            
            // Enhanced form interactions
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
            
            // Form submission handler
            const forms = document.querySelectorAll('form');
            console.log('Found forms:', forms.length);
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    console.log('Form submitted:', form.action);
                    // Check if this is a login form
                    if (form.action.includes('login') || form.querySelector('input[name="email"]')) {
                        console.log('Login form detected, preventing default');
                        e.preventDefault();
                        
                        const button = form.querySelector('button[type="submit"], input[type="submit"], .btn-primary');
                        if (button) {
                            // Disable button to prevent double submission
                            button.disabled = true;
                            const originalText = button.innerHTML;
                            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                            
                            // Get form data
                            const formData = new FormData(form);
                            
                            // Submit form via AJAX
                            fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Show success animation
                                    setTimeout(() => {
                                        showSuccessAnimation(data.redirect);
                                    }, 1000);
                                } else {
                                    // Handle error
                                    button.disabled = false;
                                    button.innerHTML = originalText;
                                    alert('Login gagal. Silakan coba lagi.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                button.disabled = false;
                                button.innerHTML = originalText;
                                alert('Terjadi kesalahan. Silakan coba lagi.');
                            });
                        }
                    }
                });
            });
            
            // Button ripple effect
            const buttons = document.querySelectorAll('.btn-primary, button[type="submit"]');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out forwards;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });
            
            // Success animation function
            window.showSuccessAnimation = function(redirectUrl = '/dashboard') {
                const formSection = document.querySelector('.form-section');
                const brandingSection = document.querySelector('.branding-section');
                const unifiedCard = document.querySelector('.unified-card');
                
                // Slide out form section to the left
                formSection.classList.add('form-slide-out');
                
                // Create new success overlay that expands to fill the entire card
                setTimeout(() => {
                    const successOverlay = document.createElement('div');
                    successOverlay.className = 'branding-expand';
                    successOverlay.style.background = 'linear-gradient(135deg, #155D4F 0%, #1a6b5c 50%, #DAAF49 100%)';
                    successOverlay.style.borderRadius = '24px';
                    successOverlay.style.boxShadow = '0 35px 90px rgba(0, 0, 0, 0.15), 0 15px 50px rgba(21, 93, 79, 0.2)';
                    
                    successOverlay.innerHTML = `
                        <div class="success-content">
                            <div class="success-icon-container">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            
                            <h1 class="success-title">Login Berhasil!</h1>
                            <p class="success-subtitle">Selamat datang di SITARU</p>
                            <p class="success-message">Sistem Informasi Terpadu siap melayani Anda. Anda akan diarahkan ke dashboard dalam beberapa detik.</p>
                            
                            <div class="success-progress">
                                <div class="success-progress-bar"></div>
                            </div>
                            
                            <div class="success-particles-overlay" id="successParticles"></div>
                        </div>
                    `;
                    
                    // Add to unified card
                    unifiedCard.appendChild(successOverlay);
                    
                    // Create particles in the new overlay
                    const particlesContainer = successOverlay.querySelector('#successParticles');
                    createParticles(particlesContainer);
                    
                }, 400);
                
                // Redirect after longer delay to show full animation
                setTimeout(() => {
                    window.location.href = redirectUrl;
                }, 4500); // 4.5 seconds delay
            };
            
            // Create floating particles
            function createParticles(container) {
                for (let i = 0; i < 20; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 3 + 's';
                    particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    container.appendChild(particle);
                }
            }
            
            // Check for success parameter in URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === 'true') {
                setTimeout(() => {
                    showSuccessAnimation();
                }, 1000);
            }
            
            // Fallback: If form still submits normally, show animation on page load
            if (window.location.href.includes('dashboard') && document.referrer.includes('login')) {
                // Go back to login page and show animation
                setTimeout(() => {
                    window.history.back();
                    setTimeout(() => {
                        showSuccessAnimation();
                    }, 500);
                }, 100);
            }
        });
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>