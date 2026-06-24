@extends('landing.layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<section class="kop-page-header py-14">
	<div class="container">
		<nav class="kop-breadcrumb fs-7 mb-3">
			<a href="{{ route('landing') }}">Beranda</a>
			<span class="mx-2 opacity-50">/</span>
			<span class="opacity-75">Tentang Kami</span>
		</nav>
		<h1 class="text-white fw-bolder mb-0" style="font-size: 2.4rem;">Tentang Kami</h1>
	</div>
</section>

<section class="py-16">
	<div class="container">
		@if($tentang)
		<div class="row g-8">
			<div class="col-lg-8">
				<div class="kop-card p-10 mb-8 h-auto">
					<h3 class="fw-bolder mb-5" style="color: var(--kop-navy);">
						<i class="ki-outline ki-book-open fs-2 me-2" style="color: var(--kop-green);"></i>Sejarah
					</h3>
					<div class="kop-content">{!! $tentang->sejarah !!}</div>
				</div>
				<div class="kop-card p-10 mb-8 h-auto">
					<h3 class="fw-bolder mb-5" style="color: var(--kop-navy);">
						<i class="ki-outline ki-information-3 fs-2 me-2" style="color: var(--kop-green);"></i>Latar Belakang
					</h3>
					<div class="kop-content">{!! $tentang->latarBelakang !!}</div>
				</div>
				<div class="row g-8 mb-8">
					<div class="col-md-6">
						<div class="kop-card p-10 h-100">
							<h3 class="fw-bolder mb-5" style="color: var(--kop-navy);">
								<i class="ki-outline ki-eye fs-2 me-2" style="color: var(--kop-blue);"></i>Visi
							</h3>
							<div class="kop-content">{!! $tentang->Visi !!}</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="kop-card p-10 h-100">
							<h3 class="fw-bolder mb-5" style="color: var(--kop-navy);">
								<i class="ki-outline ki-rocket fs-2 me-2" style="color: var(--kop-blue);"></i>Misi
							</h3>
							<div class="kop-content">{!! $tentang->Misi !!}</div>
						</div>
					</div>
				</div>
				<div class="kop-card p-10 h-auto">
					<h3 class="fw-bolder mb-5" style="color: var(--kop-navy);">
						<i class="ki-outline ki-flag fs-2 me-2" style="color: var(--kop-gold);"></i>Tujuan Utama
					</h3>
					<div class="kop-content">{!! $tentang->tujuanUtama !!}</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="kop-card p-10 mb-8 h-auto">
					<h3 class="fw-bolder mb-5" style="color: var(--kop-navy);">
						<i class="ki-outline ki-heart fs-2 me-2" style="color: var(--kop-green);"></i>Nilai-Nilai Kami
					</h3>
					<div class="kop-content">{!! $tentang->nilai !!}</div>
				</div>
				<div class="kop-card p-10 h-auto">
					<h3 class="fw-bolder mb-5" style="color: var(--kop-navy);">
						<i class="ki-outline ki-shield-tick fs-2 me-2" style="color: var(--kop-blue);"></i>Dasar Hukum
					</h3>
					<div class="kop-content fs-7">{!! $tentang->dasarHukum !!}</div>
				</div>
			</div>
		</div>
		@else
		<div class="text-center py-20">
			<i class="ki-outline ki-information-5 fs-5tx kop-section-sub d-block mb-5"></i>
			<p class="kop-section-sub fs-4">Informasi tentang kami belum tersedia.</p>
		</div>
		@endif
	</div>
</section>

@endsection
