<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login — Koperasi Merah Putih</title>
		<meta charset="utf-8" />
		<meta name="description" content="Login — Panel Administrasi Koperasi" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" type="image/png" href="{{ asset('assets/media/logos/logo-koperasi.png') }}" />
		<link rel="icon" type="image/png" href="{{ asset('assets/media/logos/logo-koperasi.png') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<style>body { background-image: url('{{ asset("assets/media/auth/bg4.jpg") }}'); } [data-bs-theme="dark"] body { background-image: url('{{ asset("assets/media/auth/bg4-dark.jpg") }}'); }</style>
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<div class="d-flex flex-center flex-lg-start flex-column">
						<a href="#" class="mb-7">
							<img alt="Logo Koperasi" src="{{ asset('assets/media/logos/logo-koperasi.png') }}" style="height: 50vh; max-height: 400px; width: auto; object-fit: contain;" />
						</a>
					</div>
				</div>
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
					<div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
						<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
							<form class="form w-100" method="POST" action="{{ route('login.post') }}">
								@csrf
								<div class="text-center mb-11">
									<h1 class="text-gray-900 fw-bolder mb-3">Masuk</h1>
									<div class="text-gray-500 fw-semibold fs-6">Panel Admin Koperasi Merah Putih</div>
								</div>

								@if ($errors->any())
								<div class="alert alert-danger d-flex align-items-center p-4 mb-6">
									<i class="ki-outline ki-shield-cross fs-2hx text-danger me-3 flex-shrink-0"></i>
									<div>
										@foreach ($errors->all() as $error)
											<div class="fw-semibold">{{ $error }}</div>
										@endforeach
									</div>
								</div>
								@endif

								<div class="fv-row mb-8">
									<input type="email" placeholder="Alamat Email" name="email"
										value="{{ old('email') }}"
										autocomplete="email"
										class="form-control bg-transparent @error('email') is-invalid @enderror" />
								</div>
								<div class="fv-row mb-8">
									<input type="password" placeholder="Password" name="password"
										autocomplete="current-password"
										class="form-control bg-transparent @error('password') is-invalid @enderror" />
								</div>
								<div class="d-grid mb-10">
									<button type="submit" class="btn btn-primary">
										Masuk
									</button>
								</div>
							</form>
						</div>
						<div class="text-center text-muted fs-7 pt-4">
							&copy; {{ date('Y') }} Koperasi. All rights reserved.
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>var hostUrl = "{{ asset('assets') }}/";</script>
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		</body>
</html>
