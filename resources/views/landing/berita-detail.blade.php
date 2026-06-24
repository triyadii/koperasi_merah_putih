@extends('landing.layouts.app')

@section('title', $berita->judul)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($berita->keterangan), 150))

@section('content')

<section class="kop-page-header py-14">
	<div class="container">
		<nav class="kop-breadcrumb fs-7 mb-3">
			<a href="{{ route('landing') }}">Beranda</a>
			<span class="mx-2 opacity-50">/</span>
			<a href="{{ route('landing.berita') }}">Berita</a>
			<span class="mx-2 opacity-50">/</span>
			<span class="opacity-75">{{ \Illuminate\Support\Str::limit($berita->judul, 50) }}</span>
		</nav>
		<h1 class="text-white fw-bolder mb-4" style="font-size: 2.2rem; max-width: 860px;">{{ $berita->judul }}</h1>
		<div class="d-flex align-items-center flex-wrap gap-4">
			@if($berita->tag)
			<span class="kop-badge-gold" style="background: rgba(255,255,255,.15); color: #ffe9a8;">{{ $berita->tag }}</span>
			@endif
			<span class="text-white opacity-75 fs-7">
				<i class="ki-outline ki-calendar fs-6 me-1 text-white opacity-75"></i>{{ $berita->created_at->locale('id')->translatedFormat('l, d F Y') }}
			</span>
		</div>
	</div>
</section>

<section class="py-16">
	<div class="container">
		<div class="row g-10">
			<div class="col-lg-8">
				<article class="kop-card p-10">
					@if($berita->gambar)
					<img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
						class="w-100 mb-8" style="border-radius: .75rem; max-height: 440px; object-fit: cover;" />
					@endif
					<div class="kop-content">{!! $berita->keterangan !!}</div>
				</article>
				<div class="mt-8">
					<a href="{{ route('landing.berita') }}" class="kop-btn-outline text-decoration-none">
						<i class="ki-outline ki-arrow-left fs-5 me-1"></i>Kembali ke Daftar Berita
					</a>
				</div>
			</div>
			<div class="col-lg-4">
				@if($lainnya->isNotEmpty())
				<h4 class="fw-bolder mb-6" style="color: var(--kop-navy);">Berita Lainnya</h4>
				<div class="d-flex flex-column gap-5">
					@foreach($lainnya as $item)
					<a href="{{ route('landing.berita.detail', $item) }}" class="text-decoration-none">
						<div class="kop-card p-6 d-flex flex-row align-items-center">
							<div class="flex-shrink-0 me-5" style="width:72px;height:72px;border-radius:.6rem;overflow:hidden;background:linear-gradient(135deg, rgba(14,118,188,.10), rgba(122,193,67,.12));display:flex;align-items:center;justify-content:center;">
								@if($item->gambar)
								<img src="{{ asset('storage/' . $item->gambar) }}" alt="" style="width:100%;height:100%;object-fit:cover;" />
								@else
								<i class="ki-outline ki-document fs-2x" style="color: var(--kop-green); opacity:.4;"></i>
								@endif
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
