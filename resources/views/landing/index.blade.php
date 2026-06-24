@extends('landing.layouts.app')

@section('title', ($konten->namaKoperasi ?? 'Koperasi') . ' — Beranda')

@section('content')

{{-- ===== Hero ===== --}}
<section class="kop-hero py-15 py-lg-20 d-flex align-items-center" style="min-height: 85vh;">
	<div class="container position-relative" style="z-index: 1;">
		<div class="row align-items-center justify-content-between g-10">
			<div class="col-lg-6 text-center text-lg-start">
				<div class="mb-5">
					<span class="badge px-4 py-2" style="background: rgba(255,255,255,.15); color: #ffe9a8; border-radius: 50px; font-size: 0.95rem; font-weight: 500; backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.1);">
						<i class="ki-outline ki-verify fs-5 me-2" style="color:#ffe9a8;"></i>Koperasi Resmi &amp; Terpercaya
					</span>
				</div>
				
				<h1 class="text-white fw-bolder mb-6" style="font-size: clamp(2.5rem, 5vw, 4rem); line-height: 1.2;">
					{{ $konten->namaKoperasi ?? 'Koperasi Merah Putih' }}
				</h1>
				
				@if($konten?->tagline)
				<div class="text-white fs-4 opacity-90 mb-10 mx-auto mx-lg-0" style="max-width: 600px; line-height: 1.6;">
					{!! strip_tags($konten->tagline, '<strong><em><b><i>') !!}
				</div>
				@endif
				
				<div class="d-flex flex-column flex-sm-row flex-wrap gap-4 justify-content-center justify-content-lg-start">
					<a href="{{ route('landing.tentang') }}" class="kop-btn-green text-decoration-none px-8 py-4 fs-5 fw-bold d-inline-flex align-items-center justify-content-center rounded-3">
						Kenali Kami <i class="ki-outline ki-arrow-right fs-4 ms-2 text-white"></i>
					</a>
					<a href="#unit-usaha" class="text-decoration-none px-8 py-4 fs-5 fw-bold text-white d-inline-flex align-items-center justify-content-center rounded-3" style="border: 2px solid rgba(255,255,255,.4); transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.8)';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='rgba(255,255,255,.4)';">
						Unit Usaha
					</a>
				</div>
			</div>
			<div class="col-lg-5 text-center d-none d-lg-block">
				<div class="p-6 rounded-4" style="background: rgba(255,255,255,0.95); box-shadow: 0 24px 64px rgba(0,0,0,.25); display: inline-block;">
					<img src="{{ asset('assets/media/logos/logo-koperasi.png') }}" alt="Logo" class="img-fluid"
						style="max-height: 380px; object-fit: contain;" />
				</div>
			</div>
		</div>
	</div>
</section>

{{-- ===== Visi & Misi singkat ===== --}}
<section id="tentang-kami" class="py-16 py-lg-18">
	<div class="container">
		<div class="text-center mb-12">
			<h2 class="kop-section-title" style="font-size: 2rem;">Visi &amp; Misi</h2>
			<p class="kop-section-sub fs-5 mt-4">Arah dan komitmen kami untuk kesejahteraan bersama</p>
		</div>
		@if($tentang)
		<div class="row g-8">
			<div class="col-lg-6">
				<div class="kop-card p-10">
					<div class="d-flex align-items-center mb-6">
						<div class="kop-icon-circle me-5"><i class="ki-outline ki-eye fs-2x text-white"></i></div>
						<h3 class="fw-bolder mb-0" style="color: var(--kop-navy);">Visi</h3>
					</div>
					<div class="kop-content">{!! $tentang->Visi !!}</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="kop-card p-10">
					<div class="d-flex align-items-center mb-6">
						<div class="kop-icon-circle me-5"><i class="ki-outline ki-rocket fs-2x text-white"></i></div>
						<h3 class="fw-bolder mb-0" style="color: var(--kop-navy);">Misi</h3>
					</div>
					<div class="kop-content">{!! $tentang->Misi !!}</div>
				</div>
			</div>
		</div>
		<div class="text-center mt-10">
			<a href="{{ route('landing.tentang') }}" class="kop-btn-outline text-decoration-none">
				Selengkapnya Tentang Kami <i class="ki-outline ki-arrow-right fs-5 ms-1"></i>
			</a>
		</div>
		@else
		<div class="text-center py-10">
			<i class="ki-outline ki-information-5 fs-5tx kop-section-sub d-block mb-5"></i>
			<p class="kop-section-sub fs-4">Informasi Visi & Misi belum tersedia.</p>
		</div>
		@endif
	</div>
</section>

{{-- ===== Program Unggulan (bannerProgram) ===== --}}
@if($konten?->bannerProgram)
<section class="kop-bg-soft py-16 py-lg-18">
	<div class="container">
		<div class="row align-items-center g-10">
			<div class="col-lg-5">
				<h2 class="kop-section-title" style="font-size: 2rem;">Program Kami</h2>
				<p class="kop-section-sub fs-5 mt-4 mb-0">Berbagai program dan layanan yang dirancang untuk meningkatkan kesejahteraan anggota.</p>
			</div>
			<div class="col-lg-7">
				<div class="kop-card p-10">
					<div class="kop-content">{!! $konten->bannerProgram !!}</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endif

{{-- ===== Unit Usaha ===== --}}
<section id="unit-usaha" class="py-16 py-lg-18">
	<div class="container">
		<div class="text-center mb-12">
			<h2 class="kop-section-title" style="font-size: 2rem;">Unit Usaha</h2>
			<p class="kop-section-sub fs-5 mt-4">Layanan dan usaha yang kami kelola untuk anggota dan masyarakat</p>
		</div>
		@if($unitUsahas->isNotEmpty())
		<div class="row g-8">
			@foreach($unitUsahas as $unit)
			<div class="col-md-6 col-lg-4">
				<a href="{{ route('landing.unitUsaha.detail', $unit) }}" class="text-decoration-none d-block h-100">
					<div class="kop-card">
						<div class="card-img-wrap">
							@if($unit->foto)
							<img src="{{ asset('storage/' . $unit->foto) }}" alt="{{ $unit->namaUsaha }}" />
							@else
							<i class="ki-outline ki-shop fs-5tx" style="color: var(--kop-blue); opacity: .35;"></i>
							@endif
						</div>
						<div class="p-7 d-flex flex-column flex-grow-1">
							<h4 class="fw-bolder mb-3" style="color: var(--kop-navy);">{{ $unit->namaUsaha }}</h4>
							<p class="kop-section-sub mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($unit->keterangan), 110) }}</p>
							<span class="kop-link mt-auto">Lihat Detail <i class="ki-outline ki-arrow-right fs-6"></i></span>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
		@else
		<div class="text-center py-10">
			<i class="ki-outline ki-shop fs-5tx kop-section-sub d-block mb-5"></i>
			<p class="kop-section-sub fs-4">Belum ada unit usaha yang ditambahkan.</p>
		</div>
		@endif
	</div>
</section>

{{-- ===== Berita Terbaru ===== --}}
<section id="berita" class="kop-bg-soft py-16 py-lg-18">
	<div class="container">
		<div class="d-flex align-items-end justify-content-between flex-wrap gap-4 mb-12">
			<div>
				<h2 class="kop-section-title" style="font-size: 2rem;">Berita Terbaru</h2>
				<p class="kop-section-sub fs-5 mt-4 mb-0">Kabar dan informasi terkini dari koperasi</p>
			</div>
			<a href="{{ route('landing.berita') }}" class="kop-btn-outline text-decoration-none">Semua Berita</a>
		</div>
		@if($beritas->isNotEmpty())
		<div class="row g-8">
			@foreach($beritas as $item)
			<div class="col-md-6 col-lg-4">
				<a href="{{ route('landing.berita.detail', $item) }}" class="text-decoration-none d-block h-100">
					<div class="kop-card">
						<div class="card-img-wrap">
							@if($item->gambar)
							<img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" />
							@else
							<i class="ki-outline ki-document fs-5tx" style="color: var(--kop-green); opacity: .35;"></i>
							@endif
						</div>
						<div class="p-7 d-flex flex-column flex-grow-1">
							<div class="d-flex align-items-center gap-3 mb-4">
								@if($item->tag)
								<span class="kop-badge-green">{{ $item->tag }}</span>
								@endif
								<span class="kop-section-sub fs-8">{{ $item->created_at->locale('id')->translatedFormat('d F Y') }}</span>
							</div>
							<h4 class="fw-bolder mb-3" style="color: var(--kop-navy);">{{ $item->judul }}</h4>
							<p class="kop-section-sub mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($item->keterangan), 100) }}</p>
							<span class="kop-link mt-auto">Baca Selengkapnya <i class="ki-outline ki-arrow-right fs-6"></i></span>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
		@else
		<div class="text-center py-10">
			<i class="ki-outline ki-document fs-5tx kop-section-sub d-block mb-5"></i>
			<p class="kop-section-sub fs-4">Belum ada berita yang dipublikasikan.</p>
		</div>
		@endif
	</div>
</section>

{{-- ===== Pengumuman ===== --}}
<section id="pengumuman" class="py-16 py-lg-18">
	<div class="container">
		<div class="d-flex align-items-end justify-content-between flex-wrap gap-4 mb-12">
			<div>
				<h2 class="kop-section-title" style="font-size: 2rem;">Pengumuman</h2>
				<p class="kop-section-sub fs-5 mt-4 mb-0">Informasi resmi untuk seluruh anggota</p>
			</div>
			<a href="{{ route('landing.pengumuman') }}" class="kop-btn-outline text-decoration-none">Semua Pengumuman</a>
		</div>
		@if($pengumumans->isNotEmpty())
		<div class="row g-6">
			@foreach($pengumumans as $item)
			<div class="col-md-6">
				<a href="{{ route('landing.pengumuman.detail', $item) }}" class="text-decoration-none d-block h-100">
					<div class="kop-card p-7 d-flex flex-row align-items-start">
						<div class="kop-icon-circle me-6" style="width:52px;height:52px;">
							<i class="ki-outline ki-notification-on fs-2 text-white"></i>
						</div>
						<div class="flex-grow-1">
							<span class="kop-section-sub fs-8 d-block mb-2">{{ $item->created_at->locale('id')->translatedFormat('d F Y') }}</span>
							<h5 class="fw-bolder mb-2" style="color: var(--kop-navy);">{{ $item->judul }}</h5>
							<p class="kop-section-sub fs-7 mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($item->keterangan), 90) }}</p>
						</div>
						<i class="ki-outline ki-arrow-right fs-3 ms-4 mt-2" style="color: var(--kop-blue);"></i>
					</div>
				</a>
			</div>
			@endforeach
		</div>
		@else
		<div class="text-center py-10">
			<i class="ki-outline ki-notification fs-5tx kop-section-sub d-block mb-5"></i>
			<p class="kop-section-sub fs-4">Belum ada pengumuman yang dipublikasikan.</p>
		</div>
		@endif
	</div>
</section>

{{-- ===== CTA Kontak ===== --}}
<section class="kop-hero py-14">
	<div class="container position-relative text-center" style="z-index:1;">
		<h2 class="text-white fw-bolder mb-4" style="font-size: 1.9rem;">Tertarik Bergabung Bersama Kami?</h2>
		<p class="text-white opacity-90 fs-5 mb-8">Hubungi kami untuk informasi pendaftaran anggota dan layanan koperasi.</p>
		<div class="d-flex justify-content-center flex-wrap gap-4">
			@if($konten?->kontak)
			<a href="https://wa.me/62{{ ltrim($konten->kontak, '0') }}" target="_blank" rel="noopener" class="kop-btn-green text-decoration-none px-8 py-4 fs-5">
				<i class="ki-outline ki-whatsapp fs-4 me-2 text-white"></i>Hubungi via WhatsApp
			</a>
			@endif
			@if($konten?->lokasi)
			<a href="{{ $konten->lokasi }}" target="_blank" rel="noopener" class="text-decoration-none px-8 py-4 fs-5 fw-bold text-white" style="border: 2px solid rgba(255,255,255,.5); border-radius: .5rem;">
				<i class="ki-outline ki-geolocation fs-4 me-2 text-white"></i>Kunjungi Kantor Kami
			</a>
			@endif
		</div>
	</div>
</section>

@endsection
