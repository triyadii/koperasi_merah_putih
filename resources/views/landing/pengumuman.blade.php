@extends('landing.layouts.app')

@section('title', 'Pengumuman')

@section('content')

<section class="kop-page-header py-14">
	<div class="container">
		<nav class="kop-breadcrumb fs-7 mb-3">
			<a href="{{ route('landing') }}">Beranda</a>
			<span class="mx-2 opacity-50">/</span>
			<span class="opacity-75">Pengumuman</span>
		</nav>
		<h1 class="text-white fw-bolder mb-0" style="font-size: 2.4rem;">Pengumuman</h1>
	</div>
</section>

<section class="py-16">
	<div class="container">
		@if($pengumumans->isNotEmpty())
		<div class="row g-6">
			@foreach($pengumumans as $item)
			<div class="col-12">
				<a href="{{ route('landing.pengumuman.detail', $item) }}" class="text-decoration-none d-block">
					<div class="kop-card p-8 d-flex flex-row align-items-start">
						<div class="kop-icon-circle me-7">
							<i class="ki-outline ki-notification-on fs-2x text-white"></i>
						</div>
						<div class="flex-grow-1">
							<span class="kop-section-sub fs-8 d-block mb-2">
								<i class="ki-outline ki-calendar fs-7 me-1"></i>{{ $item->created_at->locale('id')->translatedFormat('d F Y') }}
							</span>
							<h4 class="fw-bolder mb-3" style="color: var(--kop-navy);">{{ $item->judul }}</h4>
							<p class="kop-section-sub mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($item->keterangan), 180) }}</p>
						</div>
						<i class="ki-outline ki-arrow-right fs-2 ms-5 mt-3 d-none d-md-block" style="color: var(--kop-blue);"></i>
					</div>
				</a>
			</div>
			@endforeach
		</div>

		@if($pengumumans->hasPages())
		<div class="d-flex justify-content-center mt-12">
			<ul class="pagination kop-pagination">
				<li class="page-item {{ $pengumumans->onFirstPage() ? 'disabled' : '' }}">
					<a href="{{ $pengumumans->previousPageUrl() ?? '#' }}" class="page-link">&laquo;</a>
				</li>
				@foreach($pengumumans->getUrlRange(1, $pengumumans->lastPage()) as $page => $url)
				<li class="page-item {{ $page == $pengumumans->currentPage() ? 'active' : '' }}">
					<a href="{{ $url }}" class="page-link">{{ $page }}</a>
				</li>
				@endforeach
				<li class="page-item {{ !$pengumumans->hasMorePages() ? 'disabled' : '' }}">
					<a href="{{ $pengumumans->nextPageUrl() ?? '#' }}" class="page-link">&raquo;</a>
				</li>
			</ul>
		</div>
		@endif

		@else
		<div class="text-center py-20">
			<i class="ki-outline ki-notification fs-5tx kop-section-sub d-block mb-5"></i>
			<p class="kop-section-sub fs-4">Belum ada pengumuman yang dipublikasikan.</p>
		</div>
		@endif
	</div>
</section>

@endsection
