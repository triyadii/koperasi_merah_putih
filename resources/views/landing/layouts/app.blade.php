@php
	$konten = $konten ?? \App\Models\Konten::first();
	$namaKoperasi = $konten->namaKoperasi ?? 'Koperasi Merah Putih';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
	<title>@yield('title', $namaKoperasi)</title>
	<meta charset="utf-8" />
	<meta name="description" content="@yield('meta_description', 'Website resmi ' . $namaKoperasi)" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/media/logos/logo-koperasi.png') }}" />
	<link rel="icon" type="image/png" href="{{ asset('assets/media/logos/logo-koperasi.png') }}" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" />
	<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<style>
		:root {
			--kop-green:      #7AC143;
			--kop-green-dark: #5FA32E;
			--kop-blue:       #0E76BC;
			--kop-blue-dark:  #0A5C94;
			--kop-gold:       #C19A26;
			--kop-navy:       #233E7F;
		}
		html { scroll-behavior: smooth; }
		body { 
			background-color: #ffffff; 
			padding-top: 84px; /* Kompensasi untuk fixed navbar */
		}

		/* ===== Navbar ===== */
		.kop-navbar {
			background: #ffffff;
			box-shadow: 0 2px 12px rgba(35, 62, 127, .08);
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			z-index: 1030;
		}
		.kop-navbar .nav-link {
			color: var(--kop-navy);
			font-weight: 600;
			padding: .65rem 1rem;
			border-radius: .5rem;
			transition: all .2s;
		}
		.kop-navbar .nav-link:hover,
		.kop-navbar .nav-link.active {
			color: var(--kop-blue);
			background: rgba(14, 118, 188, .08);
		}
		.kop-btn-green {
			background: var(--kop-green);
			color: #fff !important;
			font-weight: 700;
			border: none;
			border-radius: .5rem;
			padding: .65rem 1.5rem;
			transition: background .2s;
		}
		.kop-btn-green:hover { background: var(--kop-green-dark); color: #fff; }
		.kop-btn-blue {
			background: var(--kop-blue);
			color: #fff !important;
			font-weight: 700;
			border: none;
			border-radius: .5rem;
			padding: .65rem 1.5rem;
			transition: background .2s;
		}
		.kop-btn-blue:hover { background: var(--kop-blue-dark); color: #fff; }
		.kop-btn-outline {
			background: transparent;
			color: var(--kop-blue) !important;
			font-weight: 700;
			border: 2px solid var(--kop-blue);
			border-radius: .5rem;
			padding: .55rem 1.4rem;
			transition: all .2s;
		}
		.kop-btn-outline:hover { background: var(--kop-blue); color: #fff !important; }

		/* ===== Hero ===== */
		.kop-hero {
			background: linear-gradient(120deg, var(--kop-blue) 0%, var(--kop-blue-dark) 45%, var(--kop-green-dark) 100%);
			color: #fff;
			position: relative;
			overflow: hidden;
		}
		.kop-hero::after {
			content: '';
			position: absolute;
			right: -120px; top: -120px;
			width: 420px; height: 420px;
			border-radius: 50%;
			background: rgba(255, 255, 255, .07);
		}
		.kop-hero::before {
			content: '';
			position: absolute;
			left: -80px; bottom: -140px;
			width: 320px; height: 320px;
			border-radius: 50%;
			background: rgba(122, 193, 67, .18);
		}

		/* ===== Sections ===== */
		.kop-section-title {
			color: var(--kop-navy);
			font-weight: 800;
			position: relative;
			display: inline-block;
			padding-bottom: .75rem;
			margin-bottom: 0;
		}
		.kop-section-title::after {
			content: '';
			position: absolute;
			left: 0; bottom: 0;
			width: 64px; height: 4px;
			border-radius: 4px;
			background: linear-gradient(90deg, var(--kop-green), var(--kop-blue));
		}
		.kop-section-sub { color: #6c7a99; }
		.kop-bg-soft { background: #f4f8fb; }

		/* ===== Cards ===== */
		.kop-card {
			border: 1px solid #e7eef5;
			border-radius: 1rem;
			overflow: hidden;
			background: #fff;
			transition: transform .25s, box-shadow .25s;
			height: 100%;
			display: flex;
			flex-direction: column;
		}
		.kop-card:hover {
			transform: translateY(-6px);
			box-shadow: 0 14px 36px rgba(35, 62, 127, .12);
		}
		.kop-card .card-img-wrap {
			height: 200px;
			background: linear-gradient(135deg, rgba(14,118,188,.10), rgba(122,193,67,.12));
			display: flex; align-items: center; justify-content: center;
			overflow: hidden;
		}
		.kop-card .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
		.kop-badge-green {
			background: rgba(122,193,67,.15);
			color: var(--kop-green-dark);
			font-weight: 700;
			border-radius: .4rem;
			padding: .3rem .7rem;
			font-size: .8rem;
		}
		.kop-badge-blue {
			background: rgba(14,118,188,.12);
			color: var(--kop-blue);
			font-weight: 700;
			border-radius: .4rem;
			padding: .3rem .7rem;
			font-size: .8rem;
		}
		.kop-badge-gold {
			background: rgba(193,154,38,.14);
			color: var(--kop-gold);
			font-weight: 700;
			border-radius: .4rem;
			padding: .3rem .7rem;
			font-size: .8rem;
		}
		.kop-icon-circle {
			width: 64px; height: 64px;
			border-radius: 50%;
			display: flex; align-items: center; justify-content: center;
			background: linear-gradient(135deg, var(--kop-green), var(--kop-blue));
			color: #fff;
			flex-shrink: 0;
		}
		.kop-link { color: var(--kop-blue); font-weight: 700; text-decoration: none; }
		.kop-link:hover { color: var(--kop-green-dark); }

		/* ===== Konten HTML dari CKEditor ===== */
		.kop-content { color: #3a4a6b; line-height: 1.85; font-size: 1.05rem; }
		.kop-content h1, .kop-content h2, .kop-content h3, .kop-content h4 { color: var(--kop-navy); font-weight: 700; margin-top: 1.5rem; }
		.kop-content ul, .kop-content ol { padding-left: 1.5rem; }
		.kop-content li { margin-bottom: .4rem; }
		.kop-content table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
		.kop-content table th, .kop-content table td { border: 1px solid #dbe4ee; padding: .6rem .9rem; }
		.kop-content table th { background: #f4f8fb; color: var(--kop-navy); }
		.kop-content img { max-width: 100%; border-radius: .75rem; }

		/* ===== Footer ===== */
		.kop-footer { background: var(--kop-navy); color: rgba(255,255,255,.85); }
		.kop-footer a { color: rgba(255,255,255,.85); text-decoration: none; transition: color .2s; }
		.kop-footer a:hover { color: var(--kop-green); }
		.kop-footer-bottom { background: #1a2f63; }

		/* ===== Page header (halaman dalam) ===== */
		.kop-page-header {
			background: linear-gradient(120deg, var(--kop-blue) 0%, var(--kop-green-dark) 100%);
			color: #fff;
		}
		.kop-breadcrumb a { color: rgba(255,255,255,.8); text-decoration: none; }
		.kop-breadcrumb a:hover { color: #fff; }

		/* ===== Pagination ===== */
		.kop-pagination .page-link { color: var(--kop-blue); border-radius: .5rem; margin: 0 .15rem; border: 1px solid #e7eef5; }
		.kop-pagination .page-item.active .page-link { background: var(--kop-blue); border-color: var(--kop-blue); color: #fff; }
	</style>
	@yield('styles')
</head>
<body>

	{{-- ===== Navbar ===== --}}
	<nav class="kop-navbar py-3">
		<div class="container d-flex align-items-center justify-content-between flex-wrap gap-3">
			<a href="{{ route('landing') }}" class="d-flex align-items-center text-decoration-none">
				<img src="{{ asset('assets/media/logos/logo-koperasi.png') }}" alt="{{ $namaKoperasi }}" style="height:48px;width:auto;" class="me-3" />
				<span class="fw-bolder fs-4" style="color: var(--kop-navy);">{{ $namaKoperasi }}</span>
			</a>
			<div class="d-flex align-items-center flex-wrap gap-1">
				<a href="{{ route('landing') }}" class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</a>
				<a href="{{ route('landing') }}#tentang-kami" class="nav-link">Tentang Kami</a>
				<a href="{{ route('landing') }}#unit-usaha" class="nav-link">Unit Usaha</a>
				<a href="{{ route('landing') }}#berita" class="nav-link">Berita</a>
				<a href="{{ route('landing') }}#pengumuman" class="nav-link">Pengumuman</a>
				<a href="{{ request()->routeIs('landing') ? '#kontak' : route('landing').'#kontak' }}" class="nav-link">Kontak</a>
				<a href="{{ route('pendaftaran') }}" class="kop-btn-outline ms-2 text-decoration-none" style="padding: .45rem 1rem; border-width: 1px;">Daftar Anggota</a>
				<a href="{{ route('login') }}" class="kop-btn-green ms-2 text-decoration-none">Masuk</a>
			</div>
		</div>
	</nav>

	@yield('content')

	{{-- ===== Footer ===== --}}
	<footer id="kontak" class="kop-footer pt-16 mt-0">
		<div class="container pb-10">
			<div class="row g-8">
				<div class="col-lg-5">
					<div class="d-flex align-items-center mb-5">
						<img src="{{ asset('assets/media/logos/logo-koperasi.png') }}" alt="{{ $namaKoperasi }}" style="height:56px;width:auto;background:#fff;border-radius:.75rem;padding:.35rem;" class="me-3" />
						<span class="fw-bolder fs-3 text-white">{{ $namaKoperasi }}</span>
					</div>
					@if($konten?->tagline)
					<div class="fs-6 opacity-75">{!! strip_tags($konten->tagline, '<strong><em><b><i>') !!}</div>
					@endif
				</div>
				<div class="col-lg-3 col-md-6">
					<h5 class="text-white fw-bold mb-5">Tautan</h5>
					<div class="d-flex flex-column gap-3">
						<a href="{{ route('landing') }}#tentang-kami">Tentang Kami</a>
						<a href="{{ route('landing') }}#unit-usaha">Unit Usaha</a>
						<a href="{{ route('landing') }}#berita">Berita</a>
						<a href="{{ route('landing') }}#pengumuman">Pengumuman</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<h5 class="text-white fw-bold mb-5">Hubungi Kami</h5>
					<div class="d-flex flex-column gap-3">
						@if($konten?->kontak)
						<a href="tel:{{ $konten->kontak }}" class="d-flex align-items-center">
							<i class="ki-outline ki-phone fs-3 me-3" style="color: var(--kop-green);"></i>{{ $konten->kontak }}
						</a>
						<a href="https://wa.me/62{{ ltrim($konten->kontak, '0') }}" target="_blank" rel="noopener" class="d-flex align-items-center">
							<i class="ki-outline ki-whatsapp fs-3 me-3" style="color: var(--kop-green);"></i>WhatsApp
						</a>
						@endif
						@if($konten?->lokasi)
						<a href="{{ $konten->lokasi }}" target="_blank" rel="noopener" class="d-flex align-items-center">
							<i class="ki-outline ki-geolocation fs-3 me-3" style="color: var(--kop-green);"></i>Lihat Lokasi di Google Maps
						</a>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="kop-footer-bottom py-5">
			<div class="container text-center fs-7 opacity-75">
				&copy; {{ date('Y') }} {{ $namaKoperasi }}. Seluruh hak cipta dilindungi.
			</div>
		</div>
	</footer>

	@yield('scripts')
</body>
</html>
