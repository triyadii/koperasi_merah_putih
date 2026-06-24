@extends('landing.layouts.app')

@section('title', 'Berita')

@section('content')

<section class="kop-page-header py-14">
	<div class="container">
		<nav class="kop-breadcrumb fs-7 mb-3">
			<a href="{{ route('landing') }}">Beranda</a>
			<span class="mx-2 opacity-50">/</span>
			<span class="opacity-75">Berita</span>
		</nav>
		<h1 class="text-white fw-bolder mb-0" style="font-size: 2.4rem;">Berita</h1>
	</div>
</section>

<section class="py-16">
	<div class="container">
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
							<p class="kop-section-sub mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($item->keterangan), 120) }}</p>
							<span class="kop-link mt-auto">Baca Selengkapnya <i class="ki-outline ki-arrow-right fs-6"></i></span>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>

		@if($beritas->hasPages())
		<div class="d-flex justify-content-center mt-12">
			<ul class="pagination kop-pagination">
				<li class="page-item {{ $beritas->onFirstPage() ? 'disabled' : '' }}">
					<a href="{{ $beritas->previousPageUrl() ?? '#' }}" class="page-link">&laquo;</a>
				</li>
				@foreach($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
				<li class="page-item {{ $page == $beritas->currentPage() ? 'active' : '' }}">
					<a href="{{ $url }}" class="page-link">{{ $page }}</a>
				</li>
				@endforeach
				<li class="page-item {{ !$beritas->hasMorePages() ? 'disabled' : '' }}">
					<a href="{{ $beritas->nextPageUrl() ?? '#' }}" class="page-link">&raquo;</a>
				</li>
			</ul>
		</div>
		@endif

		@else
		<div class="text-center py-20">
			<i class="ki-outline ki-document fs-5tx kop-section-sub d-block mb-5"></i>
			<p class="kop-section-sub fs-4">Belum ada berita yang dipublikasikan.</p>
		</div>
		@endif
	</div>
</section>

@endsection
