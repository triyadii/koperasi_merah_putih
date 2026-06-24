@extends('landing.layouts.app')

@section('title', $unitUsaha->namaUsaha)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($unitUsaha->keterangan), 150))

@section('content')

<section class="kop-page-header py-14">
	<div class="container">
		<nav class="kop-breadcrumb fs-7 mb-3">
			<a href="{{ route('landing') }}">Beranda</a>
			<span class="mx-2 opacity-50">/</span>
			<a href="{{ route('landing') }}#unit-usaha">Unit Usaha</a>
			<span class="mx-2 opacity-50">/</span>
			<span class="opacity-75">{{ $unitUsaha->namaUsaha }}</span>
		</nav>
		<h1 class="text-white fw-bolder mb-0" style="font-size: 2.2rem;">{{ $unitUsaha->namaUsaha }}</h1>
	</div>
</section>

<section class="py-16">
	<div class="container">
		<div class="row g-10">
			<div class="col-lg-8">
				<article class="kop-card p-10">
					@if($unitUsaha->foto)
					<img src="{{ asset('storage/' . $unitUsaha->foto) }}" alt="{{ $unitUsaha->namaUsaha }}"
						class="w-100 mb-8" style="border-radius: .75rem; max-height: 440px; object-fit: cover;" />
					@endif
					<div class="kop-content">{!! $unitUsaha->keterangan !!}</div>
				</article>
				<div class="mt-8">
					<a href="{{ route('landing') }}#unit-usaha" class="kop-btn-outline text-decoration-none">
						<i class="ki-outline ki-arrow-left fs-5 me-1"></i>Kembali ke Unit Usaha
					</a>
				</div>
			</div>
			<div class="col-lg-4">
				@if($lainnya->isNotEmpty())
				<h4 class="fw-bolder mb-6" style="color: var(--kop-navy);">Unit Usaha Lainnya</h4>
				<div class="d-flex flex-column gap-5">
					@foreach($lainnya as $item)
					<a href="{{ route('landing.unitUsaha.detail', $item) }}" class="text-decoration-none">
						<div class="kop-card p-6 d-flex flex-row align-items-center">
							<div class="flex-shrink-0 me-5" style="width:60px;height:60px;border-radius:.6rem;overflow:hidden;background:linear-gradient(135deg, rgba(14,118,188,.10), rgba(122,193,67,.12));display:flex;align-items:center;justify-content:center;">
								@if($item->foto)
								<img src="{{ asset('storage/' . $item->foto) }}" alt="" style="width:100%;height:100%;object-fit:cover;" />
								@else
								<i class="ki-outline ki-shop fs-2x" style="color: var(--kop-blue); opacity:.4;"></i>
								@endif
							</div>
							<span class="fw-bold fs-7" style="color: var(--kop-navy);">{{ $item->namaUsaha }}</span>
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
