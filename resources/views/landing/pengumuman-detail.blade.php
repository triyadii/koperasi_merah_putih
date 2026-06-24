@extends('landing.layouts.app')

@section('title', $pengumuman->judul)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($pengumuman->keterangan), 150))

@section('content')

<section class="kop-page-header py-14">
	<div class="container">
		<nav class="kop-breadcrumb fs-7 mb-3">
			<a href="{{ route('landing') }}">Beranda</a>
			<span class="mx-2 opacity-50">/</span>
			<a href="{{ route('landing.pengumuman') }}">Pengumuman</a>
			<span class="mx-2 opacity-50">/</span>
			<span class="opacity-75">{{ \Illuminate\Support\Str::limit($pengumuman->judul, 50) }}</span>
		</nav>
		<h1 class="text-white fw-bolder mb-4" style="font-size: 2.2rem; max-width: 860px;">{{ $pengumuman->judul }}</h1>
		<span class="text-white opacity-75 fs-7">
			<i class="ki-outline ki-calendar fs-6 me-1 text-white opacity-75"></i>{{ $pengumuman->created_at->locale('id')->translatedFormat('l, d F Y') }}
		</span>
	</div>
</section>

<section class="py-16">
	<div class="container">
		<div class="row g-10">
			<div class="col-lg-8">
				<article class="kop-card p-10">
					@if($pengumuman->gambar)
					<img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}"
						class="w-100 mb-8" style="border-radius: .75rem; max-height: 440px; object-fit: cover;" />
					@endif
					<div class="kop-content">{!! $pengumuman->keterangan !!}</div>
				</article>
				<div class="mt-8">
					<a href="{{ route('landing.pengumuman') }}" class="kop-btn-outline text-decoration-none">
						<i class="ki-outline ki-arrow-left fs-5 me-1"></i>Kembali ke Daftar Pengumuman
					</a>
				</div>
			</div>
			<div class="col-lg-4">
				@if($lainnya->isNotEmpty())
				<h4 class="fw-bolder mb-6" style="color: var(--kop-navy);">Pengumuman Lainnya</h4>
				<div class="d-flex flex-column gap-5">
					@foreach($lainnya as $item)
					<a href="{{ route('landing.pengumuman.detail', $item) }}" class="text-decoration-none">
						<div class="kop-card p-6 d-flex flex-row align-items-center">
							<div class="kop-icon-circle me-5" style="width:48px;height:48px;">
								<i class="ki-outline ki-notification-on fs-3 text-white"></i>
							</div>
							<div>
								<span class="kop-section-sub fs-9 d-block mb-1">{{ $item->created_at->locale('id')->translatedFormat('d F Y') }}</span>
								<span class="fw-bold fs-7 d-block" style="color: var(--kop-navy);">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</span>
							</div>
						</div>
					</a>
					@endforeach
				</div>
				@endif
			</div>
		</div>
	</div>
</section>

@endsection
