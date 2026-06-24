@extends('admin.layouts.app')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
	<div class="app-container container-xxl">

		{{-- Greeting Card --}}
		<div class="card mb-8" style="background: linear-gradient(135deg, #1e1e2d 0%, #c62a2a 100%); border: none;">
			<div class="card-body py-12 px-10">
				<div class="d-flex align-items-center justify-content-between flex-wrap gap-6">
					<div>
						<p class="text-white opacity-75 fs-6 fw-semibold mb-2" id="greeting_time">
							Selamat datang kembali,
						</p>
						<h1 class="text-white fw-bolder fs-2x mb-3" style="line-height: 1.2;">
							{{ auth()->user()?->name ?? 'Administrator' }}
						</h1>
						<p class="text-white opacity-75 fs-6 mb-0">
							<i class="ki-outline ki-calendar fs-5 me-1 text-white opacity-75"></i>
							<span id="greeting_date"></span>
						</p>
					</div>
					<div class="text-center d-none d-md-block">
						<i class="ki-outline ki-home fs-5tx opacity-10 text-white"></i>
					</div>
				</div>
			</div>
		</div>

		{{-- Quick Access --}}
		<div class="row g-5 g-xl-8">
			<div class="col-sm-6 col-xl-3">
				<a href="{{ route('admin.anggota') }}" class="card card-flush hover-elevate-up text-decoration-none h-100">
					<div class="card-body text-center py-10">
						<div class="symbol symbol-60px mb-5 mx-auto">
							<span class="symbol-label bg-light-primary">
								<i class="ki-outline ki-people fs-2x text-primary"></i>
							</span>
						</div>
						<div class="fw-bold text-gray-800 fs-5">Keanggotaan</div>
						<div class="text-muted fs-7 mt-1">Kelola data anggota</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-xl-3">
				<a href="{{ route('admin.berita') }}" class="card card-flush hover-elevate-up text-decoration-none h-100">
					<div class="card-body text-center py-10">
						<div class="symbol symbol-60px mb-5 mx-auto">
							<span class="symbol-label bg-light-info">
								<i class="ki-outline ki-document fs-2x text-info"></i>
							</span>
						</div>
						<div class="fw-bold text-gray-800 fs-5">Berita</div>
						<div class="text-muted fs-7 mt-1">Kelola artikel berita</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-xl-3">
				<a href="{{ route('admin.pengumuman') }}" class="card card-flush hover-elevate-up text-decoration-none h-100">
					<div class="card-body text-center py-10">
						<div class="symbol symbol-60px mb-5 mx-auto">
							<span class="symbol-label bg-light-warning">
								<i class="ki-outline ki-notification fs-2x text-warning"></i>
							</span>
						</div>
						<div class="fw-bold text-gray-800 fs-5">Pengumuman</div>
						<div class="text-muted fs-7 mt-1">Kelola pengumuman</div>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-xl-3">
				<a href="{{ route('admin.konten') }}" class="card card-flush hover-elevate-up text-decoration-none h-100">
					<div class="card-body text-center py-10">
						<div class="symbol symbol-60px mb-5 mx-auto">
							<span class="symbol-label bg-light-success">
								<i class="ki-outline ki-setting-2 fs-2x text-success"></i>
							</span>
						</div>
						<div class="fw-bold text-gray-800 fs-5">Pengaturan</div>
						<div class="text-muted fs-7 mt-1">Konten & informasi</div>
					</div>
				</a>
			</div>
		</div>

	</div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    var now  = new Date();
    var hour = now.getHours();
    var greetings = ['Selamat malam,', 'Selamat pagi,', 'Selamat siang,', 'Selamat sore,'];
    var idx = hour >= 19 || hour < 4 ? 0 : hour < 11 ? 1 : hour < 15 ? 2 : 3;
    document.getElementById('greeting_time').textContent = greetings[idx];

    var hari  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    var tgl   = hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulan[now.getMonth()] + ' ' + now.getFullYear();
    document.getElementById('greeting_date').textContent = tgl;
})();
</script>
@endsection
