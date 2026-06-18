@extends('profile.layouts.app')

@section('content')
@php
    $siteName = 'GRC Classic Art';
    $waNumber = '0851-5693-2212';
    $waDigits = '6285156932212';
    $waLink = 'https://wa.me/' . $waDigits . '?text=' . urlencode('Halo, saya ingin konsultasi material GRC. Terima kasih.');
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap');
:root{
    --gold:#C9A84C;
    --gold-light:#E8CC80;
    --gold-dark:#8B6914;
    --cream:#FAF6EE;
    --cream-dark:#F0E8D6;
    --brown:#1F1409;
    --brown-mid:#5A3F1C;
    --green-dark:#070707;
    --green-mid:#171717;
    --white:#FFFFFF;
    --text-body:#2A1D0D;
    --radius-lg:16px;
    --radius-xl:24px;
}
*{box-sizing:border-box;margin:0;padding:0;}
body{
    font-family:'DM Sans',sans-serif;
    background:var(--white);
    color:var(--text-body);
    overflow-x:hidden;
}
h1,h2,h3{font-family:'Playfair Display',serif;}
.container{max-width:1200px;margin:0 auto;padding:0 24px;}
.ornament-divider{text-align:center;color:var(--gold);font-size:20px;letter-spacing:10px;margin:8px 0;opacity:.7;}

/* ===================== NAVBAR ===================== */
.navbar{
    position:fixed;
    top:0;left:0;right:0;
    z-index:1000;
    background:rgba(250,246,238,0.97);
    backdrop-filter:blur(12px);
    border-bottom:1px solid rgba(201,168,76,0.25);
    height:72px;
}
.navbar-inner{
    display:flex;
    align-items:center;
    justify-content:space-between;
    height:72px;
    max-width:1200px;
    margin:0 auto;
    padding:0 24px;
    position:relative;
}

/* BRAND — logo langsung tanpa kotak */
.brand{
    display:flex;
    align-items:center;
    text-decoration:none;
    flex-shrink:0;

    /* dibuat nempel persis namun tetap aman untuk responsive */
    gap:1px;
    line-height:1;
}
.brand img{
    height:58px;        /* ukuran logo — sesuaikan jika perlu */
    width:auto;
    max-width:180px;
    object-fit:contain;
    display:block;
}
.brand-title{
    font-family:'Playfair Display',serif;
    font-weight:700;
    letter-spacing:-0.02em;
    color:var(--gold);
    white-space:nowrap;
    font-size:18px;
    line-height:1;

    /* hilangkan shadow blur */
    text-shadow: none;

    /* kerangka (outline) hitam - tipis */
    -webkit-text-stroke: 0.6px rgba(0,0,0,.85);

    /* rata tengah (lebih stabil untuk 1 baris) */
    display:block;
    text-align:center;

    /* fallback outline kalau stroke tidak didukung - tipis */
    text-shadow:
        -0.6px 0 rgba(0,0,0,.85),
         0.6px 0 rgba(0,0,0,.85),
         0 -0.6px rgba(0,0,0,.85),
         0  0.6px rgba(0,0,0,.85);
}
@media(max-width:900px){
    .brand-title{font-size:16px;}
}
@media(max-width:600px){
    .brand-title{font-size:14px;}
}

/* NAV LINKS */
.nav-menu{display:flex;align-items:center;gap:28px;}
.nav-menu a{
    text-decoration:none;
    color:var(--brown-mid);
    font-size:13px;font-weight:500;
    letter-spacing:.4px;
    position:relative;
    transition:color .2s;
    white-space:nowrap;
}
.nav-menu a::after{
    content:'';position:absolute;
    bottom:-4px;left:0;
    width:0;height:1.5px;
    background:var(--gold);
    transition:width .25s;
}
.nav-menu a:hover{color:var(--gold-dark);}
.nav-menu a:hover::after{width:100%;}
.nav-cta{
    background:var(--gold)!important;
    color:var(--white)!important;
    padding:8px 20px!important;
    border-radius:50px!important;
    white-space:nowrap;
}
.nav-cta::after{display:none!important;}

/* HAMBURGER — hidden desktop */
.mobile-menu-btn{
    display:none;
    width:44px;height:44px;
    border-radius:14px;
    border:1px solid rgba(201,168,76,.35);
    background:rgba(255,255,255,.7);
    backdrop-filter:blur(10px);
    align-items:center;
    justify-content:center;
    flex-direction:column;
    gap:4px;
    cursor:pointer;
    flex-shrink:0;
    padding:0;
}
.mobile-menu-btn span{
    display:block;
    width:18px;height:2px;
    background:#8B6914;
    border-radius:999px;
    transition:all .25s;
}

/* MOBILE NAV */
.mobile-nav{
    display:none;
    position:fixed;
    top:72px;left:0;right:0;
    z-index:999;
    background:rgba(250,246,238,.99);
    border-top:1px solid rgba(201,168,76,.25);
    border-bottom:1px solid rgba(201,168,76,.15);
    padding:10px 0;
    box-shadow:0 8px 24px rgba(59,42,20,.08);
}
.mobile-nav.is-open{display:block;}
.mobile-nav a{
    display:block;
    padding:13px 24px;
    color:#6B4C28;
    font-size:14px;font-weight:600;
    border-bottom:1px solid rgba(201,168,76,.10);
    transition:background .18s,color .18s;
}
.mobile-nav a:last-child{border-bottom:0;}
.mobile-nav a:hover{background:rgba(201,168,76,.08);color:#8B6914;}

/* ===================== HERO ===================== */
#home{
    position:relative;
    min-height:100vh;
    padding-top:72px;
    display:flex;align-items:center;
    overflow:hidden;
    background:linear-gradient(160deg,var(--green-dark) 0%,var(--green-mid) 55%,#3A5C40 100%);
}
#home::before{
    content:'';position:absolute;inset:0;
    background-image:
        radial-gradient(circle at 20% 50%,rgba(201,168,76,.08) 0%,transparent 55%),
        radial-gradient(circle at 80% 20%,rgba(201,168,76,.06) 0%,transparent 45%),
        url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(201,168,76,0.07)' stroke-width='0.8'%3E%3Cpolygon points='40,4 76,22 76,58 40,76 4,58 4,22'/%3E%3Cpolygon points='40,14 66,28 66,52 40,66 14,52 14,28'/%3E%3Cline x1='40' y1='4' x2='40' y2='76'/%3E%3Cline x1='4' y1='22' x2='76' y2='58'/%3E%3Cline x1='76' y1='22' x2='4' y2='58'/%3E%3C/g%3E%3C/svg%3E");
    background-size:auto,auto,80px 80px;
}
.hero-grid{position:relative;z-index:1;display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;padding:80px 0;}
.hero-text .label-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(201,168,76,.18);border:1px solid rgba(201,168,76,.4);color:var(--gold-light);font-size:11px;font-weight:500;letter-spacing:2px;text-transform:uppercase;padding:6px 16px;border-radius:50px;margin-bottom:24px;}
.hero-title{font-family:'Playfair Display',serif;font-size:clamp(32px,4.5vw,54px);font-weight:700;color:var(--white);line-height:1.18;margin-bottom:20px;text-shadow:0 10px 30px rgba(0,0,0,.35);}
.hero-title em{font-style:normal;color:var(--gold-light);}
.hero-desc{color:rgba(255,255,255,.72);font-size:15px;line-height:1.78;max-width:480px;margin-bottom:36px;}
.hero-actions{display:flex;gap:14px;flex-wrap:wrap;}
.btn-gold{display:inline-flex;align-items:center;gap:8px;background:var(--gold);color:var(--brown);font-weight:600;font-size:14px;padding:13px 28px;border-radius:50px;text-decoration:none;transition:all .25s;box-shadow:0 4px 24px rgba(201,168,76,.35);}
.btn-gold:hover{background:var(--gold-light);transform:translateY(-2px);}
.btn-outline{display:inline-flex;align-items:center;gap:8px;border:1.5px solid rgba(255,255,255,.4);color:rgba(255,255,255,.9);font-weight:500;font-size:14px;padding:13px 26px;border-radius:50px;text-decoration:none;transition:all .25s;}
.btn-outline:hover{border-color:var(--gold-light);color:var(--gold-light);}
.hero-stats{display:flex;gap:24px;margin-top:48px;}
.stat-badge{text-align:center;}
.stat-badge strong{display:block;font-family:'Playfair Display',serif;font-size:30px;color:var(--gold-light);line-height:1;}
.stat-badge span{font-size:11px;color:rgba(255,255,255,.55);display:block;margin-top:4px;}
.stat-sep{width:1px;background:rgba(255,255,255,.15);align-self:stretch;}
.hero-visual{position:relative;display:flex;align-items:center;justify-content:center;}

/* ===================== MARQUEE ===================== */
.marquee-strip{background:var(--gold);padding:13px 0;overflow:hidden;white-space:nowrap;border-top:1px solid rgba(0,0,0,.05);border-bottom:1px solid rgba(0,0,0,.05);}
.marquee-inner{display:inline-flex;animation:marquee 24s linear infinite;gap:0;}
.marquee-item{font-family:'Playfair Display',serif;font-size:13px;font-weight:500;color:var(--brown);padding:0 24px;}
@keyframes marquee{from{transform:translateX(0);}to{transform:translateX(-50%);}}

/* ===================== ABOUT ===================== */
#about{background:#ffffff;padding:96px 0;}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;}
.about-timeline{display:flex;flex-direction:column;gap:0;}
.tl-item{display:flex;gap:16px;position:relative;}
.tl-item:not(:last-child) .tl-line{position:absolute;left:15px;top:32px;bottom:0;width:1.5px;background:rgba(201,168,76,.25);}
.tl-dot{width:32px;height:32px;border-radius:50%;background:var(--green-dark);border:2.5px solid var(--gold);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.tl-dot span{font-size:9px;color:var(--gold-light);font-weight:700;}
.tl-body{padding-bottom:28px;}
.tl-body strong{display:block;font-family:'Playfair Display',serif;font-size:16px;color:var(--brown);margin-bottom:4px;}
.tl-body p{font-size:13px;color:var(--brown-mid);line-height:1.65;}
.about-text .eyebrow{margin-bottom:12px;}
.about-text h2{font-size:clamp(26px,3.5vw,36px);color:var(--brown);line-height:1.25;margin-bottom:16px;}
.about-text p{color:var(--brown-mid);font-size:14px;line-height:1.8;margin-bottom:14px;}
.about-badge{display:flex;gap:16px;margin-top:24px;flex-wrap:wrap;}
.badge-box{background:var(--cream);border:1px solid rgba(201,168,76,.25);border-radius:var(--radius-lg);padding:16px 20px;flex:1;min-width:120px;}
.badge-box strong{display:block;font-family:'Playfair Display',serif;font-size:26px;color:var(--gold-dark);}
.badge-box span{font-size:12px;color:var(--brown-mid);}

/* ===================== SECTION SHARED ===================== */
section{padding:88px 0;}
.section-head{text-align:center;margin-bottom:56px;}
.eyebrow{display:inline-block;font-size:11px;font-weight:600;letter-spacing:3px;text-transform:uppercase;color:var(--gold-dark);background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.3);padding:4px 14px;border-radius:50px;margin-bottom:16px;}
.section-head h2{font-size:clamp(26px,3.5vw,38px);color:var(--brown);line-height:1.25;margin-bottom:12px;}
.section-head p{color:var(--brown-mid);font-size:15px;max-width:560px;margin:0 auto;line-height:1.7;}

/* ===================== SERVICES ===================== */
#services{background:#ffffff;}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
.service-card{background:var(--white);border:1px solid rgba(201,168,76,.2);border-radius:var(--radius-xl);padding:32px 26px;transition:all .28s;position:relative;overflow:hidden;}
.service-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--gold-dark),var(--gold-light));transform:scaleX(0);transform-origin:left;transition:transform .3s;}
.service-card:hover{border-color:rgba(201,168,76,.5);transform:translateY(-4px);box-shadow:0 12px 40px rgba(59,42,20,.08);}
.service-card:hover::before{transform:scaleX(1);}
.icon-box{width:50px;height:50px;border-radius:14px;background:rgba(201,168,76,.15);display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:18px;border:1px solid rgba(201,168,76,.25);}
.service-card h3{font-size:17px;color:var(--brown);margin-bottom:10px;}
.service-card p{font-size:13px;color:var(--brown-mid);line-height:1.7;}

/* ===================== PROJECTS ===================== */
#projects{background:var(--white);}
.project-card{border-radius:var(--radius-xl);overflow:hidden;background:#ffffff;border:1px solid rgba(201,168,76,.25);transition:all .28s;}
.project-card:hover{transform:translateY(-5px);box-shadow:0 16px 48px rgba(59,42,20,.1);}
.project-img{width:100%;height:190px;object-fit:cover;display:block;background:#0f0f0f;}
.card-body{padding:20px 22px 24px;}
.tag{display:inline-block;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:var(--gold-dark);background:rgba(201,168,76,.12);padding:3px 10px;border-radius:50px;margin-bottom:10px;}
.card-body h3{font-size:16px;color:var(--brown);margin-bottom:8px;}
.card-body p{font-size:13px;color:var(--brown-mid);line-height:1.65;}

/* ===================== GALLERY ===================== */
#gallery{background:var(--white);}
.gallery-img{width:100%;height:200px;object-fit:cover;display:block;background:#0f0f0f;}

/* ===================== LOCATIONS ===================== */
#locations{background:#ffffff;}
.locations-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
.loc-card{background:var(--white);border:1px solid rgba(201,168,76,.2);border-radius:var(--radius-xl);padding:28px 24px;position:relative;overflow:hidden;transition:all .28s;}
.loc-card:hover{border-color:rgba(201,168,76,.45);transform:translateY(-3px);box-shadow:0 10px 36px rgba(59,42,20,.08);}
.loc-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--gold-dark),var(--gold-light));}
.loc-num{font-family:'Playfair Display',serif;font-size:42px;color:rgba(201,168,76,.18);font-weight:700;line-height:1;margin-bottom:4px;}
.loc-city{font-family:'Playfair Display',serif;font-size:20px;color:var(--brown);font-weight:700;margin-bottom:8px;}
.loc-addr{font-size:13px;color:var(--brown-mid);line-height:1.7;margin-bottom:16px;}
.loc-badge{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--gold-dark);background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.3);padding:4px 12px;border-radius:50px;}

/* ===================== CONTACT ===================== */
.contact-section{background:linear-gradient(160deg,#050505 0%,var(--green-mid) 80%);position:relative;overflow:hidden;}
.contact-section::before{content:'';position:absolute;inset:0;background-image:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(201,168,76,0.07)' stroke-width='0.8'%3E%3Cpolygon points='30,3 57,16.5 57,43.5 30,57 3,43.5 3,16.5'/%3E%3C/g%3E%3C/svg%3E");background-size:60px 60px;}
.contact-box{position:relative;z-index:1;display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;}
.contact-box .eyebrow{color:var(--gold-light);background:rgba(201,168,76,.15);border-color:rgba(201,168,76,.3);}
.contact-box h2{font-size:clamp(24px,3vw,36px);color:var(--white);margin:14px 0 16px;}
.contact-box p{color:rgba(255,255,255,.65);font-size:15px;line-height:1.75;margin-bottom:28px;}
.contact-item{display:flex;align-items:flex-start;gap:10px;margin-top:14px;color:rgba(255,255,255,.75);font-size:14px;}
.contact-section h2,.contact-section .eyebrow,.contact-section p{color:inherit;}
.contact-item small{color:var(--gold);font-weight:700;font-size:11px;letter-spacing:1px;text-transform:uppercase;min-width:36px;margin-top:2px;}
.map-wrapper{border-radius:var(--radius-xl);overflow:hidden;border:1.5px solid rgba(201,168,76,.25);box-shadow:0 8px 40px rgba(0,0,0,.3);}
.map-wrapper iframe{width:100%;height:300px;display:block;border:none;}
.map-link-row{background:rgba(255,255,255,.05);padding:12px 18px;display:flex;align-items:center;justify-content:space-between;}
.map-link-row small{color:var(--gold);font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;}
.map-link-row a{color:var(--gold-light);font-size:13px;font-weight:500;text-decoration:none;}

/* ===================== FOOTER ===================== */
footer{background:var(--brown);padding:32px 24px;text-align:center;color:rgba(255,255,255,.4);font-size:13px;}
footer strong{color:var(--gold);}

/* ===================== RESPONSIVE ===================== */
@media(max-width:900px){
    .mobile-menu-btn{display:inline-flex;}
    .nav-menu{display:none;}
    .hero-grid,.about-grid,.contact-box{grid-template-columns:1fr;gap:40px;}
    .hero-visual{display:none;}
    .grid-3,.locations-grid{grid-template-columns:1fr 1fr;}
    .hero-stats{flex-wrap:wrap;}

    /* logo sedikit lebih kecil di mobile */
    .brand img{height:46px;}
}
@media(max-width:600px){
    .grid-3,.locations-grid{grid-template-columns:1fr;}
    .brand img{height:40px;}
}
</style>

{{-- ===== NAVBAR ===== --}}
<header class="navbar">
    <div class="navbar-inner">

        {{-- Hamburger (mobile only, hidden desktop via CSS) --}}
        <button type="button" class="mobile-menu-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-nav">
            <span></span><span></span><span></span>
        </button>

        {{-- LOGO — langsung img, TANPA div brand-icon --}}
        <a href="{{ route('home') }}" class="brand" aria-label="{{ $siteName }}">
            <img
                src="{{ asset('fixlogo.png') }}"
                alt="{{ $siteName }}"
                loading="eager"
                onerror="this.style.display='none';"
            />
            <span class="brand-title">GRC Classic Art</span>
        </a>

        {{-- Desktop nav --}}
        <nav class="nav-menu" aria-label="Main menu">
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#projects">Projects</a>
            <a href="#gallery">Gallery</a>
            <a href="#locations">Lokasi</a>
            <a href="{{ route('products.index') }}">Product</a>
            <a href="{{ $waLink }}" class="nav-cta" target="_blank" rel="noopener">💬 Konsultasi</a>
        </nav>

        {{-- Mobile dropdown --}}
        <nav class="mobile-nav" id="mobile-nav" role="navigation" aria-label="Mobile menu">
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#projects">Projects</a>
            <a href="#gallery">Gallery</a>
            <a href="#locations">Lokasi</a>
            <a href="{{ route('products.index') }}">Product</a>
            <a href="{{ $waLink }}" target="_blank" rel="noopener">💬 Konsultasi</a>
        </nav>

    </div>
</header>

<script>
(function () {
    const btn  = document.querySelector('.mobile-menu-btn');
    const menu = document.getElementById('mobile-nav');
    if (!btn || !menu) return;

    btn.addEventListener('click', function () {
        const isOpen = menu.classList.toggle('is-open');
        btn.setAttribute('aria-expanded', String(isOpen));
    });
    menu.addEventListener('click', function (e) {
        if (e.target.closest('a')) {
            menu.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
        }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            menu.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
        }
    });
})();
</script>

{{-- ===== HERO ===== --}}
<section id="home">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-text">
                <div class="label-tag">✦ Produsen & Aplikator Material GRC Sejak 2002</div>
                <h1 class="hero-title">
                    Keindahan <em>Arsitektur</em><br>Dimulai dari Material yang Tepat
                </h1>
                <p class="hero-desc">
                    {{ $siteName }} adalah perusahaan industri konstruksi terpercaya — produsen sekaligus aplikator material GRC (Glassfibre Reinforced Cement) untuk ornamen masjid, fasad gedung, hunian mewah, dan berbagai kebutuhan konstruksi dekoratif.
                </p>
                <div class="hero-actions">
                    <a href="#projects" class="btn-gold">✦ Lihat Portofolio</a>
                    <a href="#about" class="btn-outline">Tentang Kami</a>
                </div>
                <div class="hero-stats">
                    <div class="stat-badge"><strong>22+</strong><span>Tahun Pengalaman</span></div>
                    <div class="stat-sep"></div>
                    <div class="stat-badge"><strong>3</strong><span>Kota Operasional</span></div>
                    <div class="stat-sep"></div>
                    <div class="stat-badge"><strong>{{ $projects->count() }}+</strong><span>Proyek Selesai</span></div>
                    <div class="stat-sep"></div>
                    <div class="stat-badge"><strong>100%</strong><span>Bergaransi</span></div>
                </div>
            </div>
            <div class="hero-visual">
                <svg width="460" height="420" viewBox="0 0 460 420" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="230" cy="210" r="190" stroke="rgba(201,168,76,0.12)" stroke-width="1"/>
                    <circle cx="230" cy="210" r="165" stroke="rgba(201,168,76,0.08)" stroke-width="0.7"/>
                    <rect x="90" y="240" width="280" height="100" rx="4" fill="rgba(201,168,76,0.12)" stroke="rgba(201,168,76,0.35)" stroke-width="1.2"/>
                    <rect x="110" y="255" width="18" height="85" rx="2" fill="rgba(201,168,76,0.18)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <rect x="150" y="255" width="18" height="85" rx="2" fill="rgba(201,168,76,0.18)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <rect x="332" y="255" width="18" height="85" rx="2" fill="rgba(201,168,76,0.18)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <rect x="372" y="255" width="18" height="85" rx="2" fill="rgba(201,168,76,0.18)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <rect x="200" y="280" width="60" height="60" rx="30" fill="rgba(20,20,20,0.6)" stroke="rgba(201,168,76,0.5)" stroke-width="1.5"/>
                    <ellipse cx="230" cy="240" rx="70" ry="20" fill="rgba(15,15,15,0.8)" stroke="rgba(201,168,76,0.4)" stroke-width="1.2"/>
                    <path d="M160 240 Q165 170 230 150 Q295 170 300 240 Z" fill="rgba(15,15,15,0.85)" stroke="rgba(201,168,76,0.5)" stroke-width="1.5"/>
                    <circle cx="230" cy="150" r="8" fill="rgba(201,168,76,0.3)" stroke="rgba(201,168,76,0.7)" stroke-width="1.5"/>
                    <line x1="230" y1="142" x2="230" y2="128" stroke="rgba(201,168,76,0.7)" stroke-width="1.5"/>
                    <path d="M224 128 L230 118 L236 128" fill="rgba(201,168,76,0.5)" stroke="rgba(201,168,76,0.8)" stroke-width="1"/>
                    <rect x="110" y="180" width="30" height="65" rx="4" fill="rgba(20,20,20,0.8)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <ellipse cx="125" cy="178" rx="15" ry="6" fill="rgba(15,15,15,0.9)" stroke="rgba(201,168,76,0.5)" stroke-width="1"/>
                    <path d="M113 178 Q120 155 125 145 Q130 155 137 178 Z" fill="rgba(15,15,15,0.9)" stroke="rgba(201,168,76,0.5)" stroke-width="1"/>
                    <line x1="125" y1="145" x2="125" y2="132" stroke="rgba(201,168,76,0.7)" stroke-width="1.5"/>
                    <path d="M120 132 L125 124 L130 132" fill="rgba(201,168,76,0.5)" stroke="rgba(201,168,76,0.8)" stroke-width="1"/>
                    <rect x="120" y="195" width="10" height="14" rx="5" fill="rgba(201,168,76,0.15)" stroke="rgba(201,168,76,0.35)" stroke-width="0.8"/>
                    <rect x="120" y="220" width="10" height="14" rx="5" fill="rgba(201,168,76,0.15)" stroke="rgba(201,168,76,0.35)" stroke-width="0.8"/>
                    <rect x="320" y="180" width="30" height="65" rx="4" fill="rgba(20,20,20,0.8)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <ellipse cx="335" cy="178" rx="15" ry="6" fill="rgba(15,15,15,0.9)" stroke="rgba(201,168,76,0.5)" stroke-width="1"/>
                    <path d="M323 178 Q330 155 335 145 Q340 155 347 178 Z" fill="rgba(15,15,15,0.9)" stroke="rgba(201,168,76,0.5)" stroke-width="1"/>
                    <line x1="335" y1="145" x2="335" y2="132" stroke="rgba(201,168,76,0.7)" stroke-width="1.5"/>
                    <path d="M330 132 L335 124 L340 132" fill="rgba(201,168,76,0.5)" stroke="rgba(201,168,76,0.8)" stroke-width="1"/>
                    <rect x="330" y="195" width="10" height="14" rx="5" fill="rgba(201,168,76,0.15)" stroke="rgba(201,168,76,0.35)" stroke-width="0.8"/>
                    <rect x="330" y="220" width="10" height="14" rx="5" fill="rgba(201,168,76,0.15)" stroke="rgba(201,168,76,0.35)" stroke-width="0.8"/>
                    <rect x="20" y="285" width="80" height="72" rx="10" fill="rgba(201,168,76,0.12)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <text x="60" y="310" text-anchor="middle" font-family="Playfair Display,serif" font-size="11" fill="rgba(201,168,76,0.9)" font-weight="700">GRC</text>
                    <text x="60" y="326" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9" fill="rgba(255,255,255,0.55)">Material</text>
                    <text x="60" y="340" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9" fill="rgba(255,255,255,0.55)">Ornamen</text>
                    <text x="60" y="350" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="8" fill="rgba(201,168,76,0.7)">since 2002</text>
                    <rect x="360" y="280" width="82" height="72" rx="10" fill="rgba(26,50,34,0.7)" stroke="rgba(201,168,76,0.4)" stroke-width="1"/>
                    <text x="401" y="305" text-anchor="middle" font-family="Playfair Display,serif" font-size="22" fill="rgba(201,168,76,0.9)" font-weight="700">✦</text>
                    <text x="401" y="323" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9" fill="rgba(255,255,255,0.65)">Bergaransi</text>
                    <text x="401" y="338" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="9" fill="rgba(255,255,255,0.65)">Berkualitas</text>
                </svg>
            </div>
        </div>
    </div>
</section>

{{-- ===== MARQUEE ===== --}}
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-inner">
        @for ($i = 0; $i < 2; $i++)
            <span class="marquee-item">✦ Ornamen GRC Masjid</span>
            <span class="marquee-item">·</span>
            <span class="marquee-item">Fasad Gedung</span>
            <span class="marquee-item">·</span>
            <span class="marquee-item">Panel Dekoratif</span>
            <span class="marquee-item">·</span>
            <span class="marquee-item">Kaligrafi Relief</span>
            <span class="marquee-item">·</span>
            <span class="marquee-item">Kubah & Mimbar</span>
            <span class="marquee-item">·</span>
            <span class="marquee-item">Ornamen Eksterior</span>
            <span class="marquee-item">·</span>
            <span class="marquee-item">Custom Order</span>
            <span class="marquee-item">·</span>
            <span class="marquee-item">Aplikator Profesional</span>
            <span class="marquee-item">·</span>
        @endfor
    </div>
</div>

{{-- ===== ABOUT ===== --}}
<section id="about">
    <div>
        <div class="section-head">
            <span class="eyebrow">About Us</span>
            <div class="ornament-divider">⸻ ✦ ⸻</div>
            <h2>Sejarah & Perjalanan {{ $siteName }}</h2>
            <p>Dari workshop kecil di Jakarta hingga menjadi produsen & aplikator material GRC terkemuka dengan ratusan proyek di seluruh Indonesia.</p>
        </div>
    </div>
    <div class="container">
        <div class="about-grid">
            <div>
                <div class="about-timeline">
                    <div class="tl-item">
                        <div class="tl-line"></div>
                        <div class="tl-dot"><span>2002</span></div>
                        <div class="tl-body">
                            <strong>Berdiri di Jakarta</strong>
                            <p>GRC Classic Art didirikan sebagai workshop kecil spesialis ornamen dekoratif berbahan GRC di Jakarta, melayani proyek masjid dan hunian.</p>
                        </div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-line"></div>
                        <div class="tl-dot"><span>2008</span></div>
                        <div class="tl-body">
                            <strong>Ekspansi ke Tangerang Selatan</strong>
                            <p>Kapasitas produksi meningkat pesat. Membuka fasilitas produksi & showroom di Tangerang Selatan untuk melayani kawasan Jabodetabek.</p>
                        </div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-line"></div>
                        <div class="tl-dot"><span>2015</span></div>
                        <div class="tl-body">
                            <strong>Hadir di Yogyakarta</strong>
                            <p>Merambah pasar Jawa Tengah & DIY dengan membuka cabang produksi di Yogyakarta, menjangkau proyek-proyek besar di seluruh Pulau Jawa.</p>
                        </div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot"><span>Kini</span></div>
                        <div class="tl-body">
                            <strong>Lebih dari 300 Proyek Selesai</strong>
                            <p>Menjadi salah satu produsen & aplikator material GRC terpercaya di Indonesia dengan ratusan proyek masjid, gedung, dan hunian di seluruh Nusantara.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-text" style="text-align:center;">
                <h2>Dua Dekade Membangun Keindahan Arsitektur Indonesia</h2>
                <p>Sejak tahun 2002, GRC Classic Art telah menjadi mitra terpercaya dalam industri konstruksi Indonesia. Kami bukan sekadar produsen material — kami adalah aplikator profesional yang hadir dari awal hingga akhir proyek Anda.</p>
                <p>Spesialisasi kami pada material GRC (Glassfibre Reinforced Cement) memungkinkan kami menghasilkan ornamen dekoratif dengan detail tinggi, tahan cuaca, dan bobot ringan — ideal untuk eksterior masjid, fasad gedung komersial, hotel, maupun hunian premium.</p>
                <p>Dengan tiga titik operasional di Jakarta, Tangerang Selatan, dan Yogyakarta, kami siap melayani proyek di seluruh Jawa dan luar Jawa dengan respons cepat dan standar kualitas yang konsisten.</p>
                <div class="about-badge">
                    <div class="badge-box"><strong>22+</strong><span>Tahun Berpengalaman</span></div>
                    <div class="badge-box"><strong>3</strong><span>Kota Operasional</span></div>
                    <div class="badge-box"><strong>300+</strong><span>Proyek Selesai</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SERVICES ===== --}}
<section id="services">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Our Services</span>
            <div class="ornament-divider">⸻ ✦ ⸻</div>
            <h2>Layanan Konstruksi & Ornamen Dekoratif</h2>
            <p>Dari produksi material hingga pemasangan di lapangan — kami menangani semuanya dengan tim terlatih dan berpengalaman.</p>
        </div>
        <div class="grid-3">
            @forelse($services as $service)
                <article class="service-card">
                    <div class="icon-box">{{ $service->icon ?? '✦' }}</div>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($service->description ?? 'Deskripsi layanan belum tersedia.', 150) }}</p>
                </article>
            @empty
                <article class="service-card"><div class="icon-box">🕌</div><h3>Ornamen Masjid & Mushola</h3><p>Produksi dan pemasangan ornamen GRC untuk kubah, mimbar, mihrab, fasad masjid, dan kaligrafi relief dengan motif islami yang otentik.</p></article>
                <article class="service-card"><div class="icon-box">🏗️</div><h3>Fasad Gedung & Komersial</h3><p>Panel GRC dekoratif untuk eksterior gedung perkantoran, hotel, mall, dan fasilitas publik. Tahan cuaca, presisi tinggi.</p></article>
                <article class="service-card"><div class="icon-box">🏠</div><h3>Ornamen Hunian Premium</h3><p>Elemen dekoratif eksterior dan interior untuk perumahan dan vila mewah — pilar, lisplang, lis profil, pagar, dan elemen kustom.</p></article>
                <article class="service-card"><div class="icon-box">⚗️</div><h3>Produksi Material GRC</h3><p>Kami produsen material GRC dengan kapasitas besar, menyediakan panel, cetakan, dan komponen siap pasang untuk kontraktor.</p></article>
                <article class="service-card"><div class="icon-box">🔧</div><h3>Aplikator & Pemasangan</h3><p>Tim aplikator bersertifikat menangani pemasangan langsung di lapangan — memastikan setiap detail terpasang sempurna.</p></article>
                <article class="service-card"><div class="icon-box">✏️</div><h3>Desain & Custom Order</h3><p>Layanan desain konsultasi penuh untuk mewujudkan ornamen kustom dari sketsa awal hingga produk jadi siap pasang.</p></article>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== PROJECTS ===== --}}
<section id="projects">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Our Projects</span>
            <div class="ornament-divider">⸻ ✦ ⸻</div>
            <h2>Portofolio Proyek Unggulan</h2>
            <p>Setiap proyek adalah bukti komitmen kami terhadap kualitas, ketepatan waktu, dan keindahan arsitektur.</p>
        </div>
        <div class="grid-3">
            @forelse($projects as $project)
                <article class="project-card">
                    @if($project->thumbnail)
                        <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->title }}" class="project-img">
                    @else
                        <div class="project-img" style="display:flex;align-items:center;justify-content:center;color:rgba(201,168,76,0.4);font-size:36px;background:linear-gradient(135deg,#1A3222,#2E5038);">✦</div>
                    @endif
                    <div class="card-body">
                        @if($project->client_name)<span class="tag">{{ $project->client_name }}</span>@endif
                        <h3>{{ $project->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($project->short_description ?? $project->description ?? '', 135) }}</p>
                    </div>
                </article>
            @empty
                <article class="project-card"><div class="project-img" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1A3222,#2E5038);font-size:36px;color:rgba(201,168,76,0.4);">✦</div><div class="card-body"><span class="tag">Masjid</span><h3>Ornamen Kubah Masjid</h3><p>Produksi dan pemasangan kubah GRC lengkap dengan ornamen kaligrafi relief.</p></div></article>
                <article class="project-card"><div class="project-img" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#2A1A3B,#3D2855);font-size:36px;color:rgba(201,168,76,0.4);">✦</div><div class="card-body"><span class="tag">Gedung</span><h3>Fasad GRC Hotel Bintang Lima</h3><p>Panel fasad GRC 3D untuk hotel mewah di Jakarta — 4.200 m².</p></div></article>
                <article class="project-card"><div class="project-img" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1A2B3B,#1E3D50);font-size:36px;color:rgba(201,168,76,0.4);">✦</div><div class="card-body"><span class="tag">Hunian</span><h3>Ornamen Eksterior Vila Mewah</h3><p>Pilar GRC, lisplang, dan panel dekoratif untuk kompleks vila premium.</p></div></article>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== GALLERY ===== --}}
<section id="gallery">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Gallery</span>
            <div class="ornament-divider">⸻ ✦ ⸻</div>
            <h2>Dokumentasi & Galeri Workshop</h2>
            <p>Lihat langsung proses pembuatan dan hasil akhir material GRC berkualitas dari workshop kami.</p>
        </div>
        <div class="grid-3">
            @forelse($galleries as $gallery)
                @php
                    $thumbSrc = null;
                    $coverPath = $gallery->cover_image;
                    if ($coverPath) {
                        $coverPath = trim($coverPath);
                        if (\Illuminate\Support\Str::startsWith($coverPath, ['http://','https://','//'])) {
                            $thumbSrc = $coverPath;
                        } else {
                            $coverPath = preg_replace('#^/?storage/#','', $coverPath);
                            $coverPath = preg_replace('#^/?public/#','', $coverPath);
                            $thumbSrc  = asset('storage/'.ltrim($coverPath,'/'));
                        }
                    }
                @endphp
                <article class="project-card">
                    <a href="{{ route('galleries.show', $gallery) }}">
                        @if($thumbSrc)
                            <img src="{{ $thumbSrc }}" alt="{{ $gallery->title }}" class="gallery-img">
                        @else
                            <div class="gallery-img" style="display:flex;align-items:center;justify-content:center;color:rgba(201,168,76,0.4);font-size:36px;">◎</div>
                        @endif
                    </a>
                    <div class="card-body">
                        <a href="{{ route('galleries.show', $gallery) }}" style="text-decoration:none;color:inherit;">
                            <h3>{{ $gallery->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($gallery->description ?? '', 125) }}</p>
                        </a>
                    </div>
                </article>
            @empty
                <article class="project-card">
                    <div class="gallery-img" style="display:flex;align-items:center;justify-content:center;color:rgba(201,168,76,0.4);font-size:36px;">◎</div>
                    <div class="card-body"><h3>Belum ada gallery</h3><p>Silakan tambahkan data gallery dari dashboard admin.</p></div>
                </article>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== LOCATIONS ===== --}}
<section id="locations">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Lokasi Kami</span>
            <div class="ornament-divider">⸻ ✦ ⸻</div>
            <h2>Tiga Titik Operasional, Satu Standar Kualitas</h2>
            <p>GRC Classic Art hadir di tiga kota strategis untuk memastikan layanan yang cepat, responsif, dan terjangkau.</p>
        </div>
        <div class="locations-grid">
            <div class="loc-card">
                <div class="loc-num">01</div>
                <div class="loc-city">Jakarta</div>
                <div class="loc-addr">Kantor Pusat & Showroom<br>Jakarta, DKI Jakarta<br>Indonesia</div>
                <div class="loc-badge">🏙️ Kantor Pusat</div>
            </div>
            <div class="loc-card">
                <div class="loc-num">02</div>
                <div class="loc-city">Tangerang Selatan</div>
                <div class="loc-addr">Workshop & Fasilitas Produksi<br>Tangerang Selatan, Banten<br>Indonesia</div>
                <div class="loc-badge">🏭 Workshop Utama</div>
            </div>
            <div class="loc-card">
                <div class="loc-num">03</div>
                <div class="loc-city">Yogyakarta</div>
                <div class="loc-addr">Cabang Produksi & Pemasaran<br>Daerah Istimewa Yogyakarta<br>Indonesia</div>
                <div class="loc-badge">🏛️ Cabang Jogja</div>
            </div>
        </div>
    </div>
</section>

{{-- ===== CONTACT ===== --}}
<section class="contact-section" id="contact">
    <div class="container">
        <div class="contact-box">
            <div>
                <span class="eyebrow">Contact Us</span>
                <h2>Siap Berkolaborasi untuk Proyek Anda?</h2>
                <p>Konsultasikan kebutuhan material GRC dan ornamen dekoratif Anda langsung dengan tim ahli kami.</p>
                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn-gold" style="display:inline-flex;margin-bottom:8px;">
                    💬 WhatsApp Kami Sekarang
                </a>
                <div class="contact-item" style="margin-top:20px;"><small>WA</small><span>{{ $waNumber }}</span></div>
                <div class="contact-item"><small>Jam</small><span>Senin – Sabtu, 08.00 – 17.00 WIB</span></div>
                <div class="contact-item"><small>Kota</small><span>Jakarta · Tangerang Selatan · Yogyakarta</span></div>
            </div>
            <div>
                <div class="map-wrapper">
                    <iframe src="https://maps.google.com/maps?q=Jakarta+Indonesia&output=embed&z=11" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen title="Lokasi GRC Classic Art Jakarta"></iframe>
                    <div class="map-link-row">
                        <small>📍 Workshop Pusat Tangerang Selatan</small>
                        <a href="https://maps.app.goo.gl/BXCfLP6zdTL8gJYa7" target="_blank" rel="noopener">Buka di Google Maps →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== FOOTER ===== --}}
<footer>
    <p>© {{ date('Y') }} <strong>{{ $siteName }}</strong> — Produsen & Aplikator Material GRC Profesional. Berdiri sejak 2002.</p>
</footer>

@endsection