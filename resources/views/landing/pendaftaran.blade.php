@extends('landing.layouts.app')

@section('title', 'Pendaftaran Anggota Koperasi')

@section('content')

<section class="kop-page-header py-14">
	<div class="container">
		<nav class="kop-breadcrumb fs-7 mb-3">
			<a href="{{ route('landing') }}">Beranda</a>
			<span class="mx-2 opacity-50">/</span>
			<span class="opacity-75">Pendaftaran Anggota</span>
		</nav>
		<h1 class="text-white fw-bolder mb-0" style="font-size: 2.4rem;">Formulir Pendaftaran Anggota</h1>
	</div>
</section>

<section class="py-16">
	<div class="container">
		
		@if(session('success'))
			<div class="alert alert-success d-flex align-items-center p-5 mb-10" style="background-color: rgba(122, 193, 67, 0.1); border: 1px solid var(--kop-green); border-radius: .75rem;">
				<i class="ki-outline ki-check-circle fs-2x me-4" style="color: var(--kop-green-dark);"></i>
				<div class="d-flex flex-column">
					<h4 class="mb-1" style="color: var(--kop-green-dark);">Pendaftaran Berhasil!</h4>
					<span style="color: var(--kop-green-dark);">{{ session('success') }}</span>
				</div>
			</div>
		@endif

		@if ($errors->any())
			<div class="alert alert-danger d-flex align-items-center p-5 mb-10" style="background-color: rgba(241, 65, 108, 0.1); border: 1px solid #f1416c; border-radius: .75rem;">
				<i class="ki-outline ki-information-5 fs-2x me-4 text-danger"></i>
				<div class="d-flex flex-column text-danger">
					<h4 class="mb-1 text-danger">Terjadi Kesalahan!</h4>
					<ul class="mb-0 ps-5">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		<div class="kop-card p-10 h-auto">
			<form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				
				<h3 class="fw-bolder mb-6" style="color: var(--kop-navy);">Data Diri Pribadi</h3>
				
				<div class="row g-6 mb-8">
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Nama Lengkap <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="namaLengkap" value="{{ old('namaLengkap') }}" required placeholder="Masukkan nama lengkap sesuai KTP" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Jenis Kelamin <span class="text-danger">*</span></label>
						<select class="form-select" name="jenisKelamin" required style="padding: .75rem; border-radius: .5rem;">
							<option value="">Pilih Jenis Kelamin</option>
							<option value="Laki-laki" {{ old('jenisKelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
							<option value="Perempuan" {{ old('jenisKelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
						</select>
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Tempat Lahir <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="tempatLahir" value="{{ old('tempatLahir') }}" required placeholder="Tempat lahir" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Tanggal Lahir <span class="text-danger">*</span></label>
						<input type="date" class="form-control" name="tanggalLahir" value="{{ old('tanggalLahir') }}" required style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Agama <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="agama" value="{{ old('agama') }}" required placeholder="Agama" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Status Perkawinan <span class="text-danger">*</span></label>
						<select class="form-select" name="statusPerkawinan" required style="padding: .75rem; border-radius: .5rem;">
							<option value="">Pilih Status</option>
							<option value="Belum Menikah" {{ old('statusPerkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
							<option value="Menikah" {{ old('statusPerkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
							<option value="Cerai Hidup" {{ old('statusPerkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
							<option value="Cerai Mati" {{ old('statusPerkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
						</select>
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Kewarganegaraan <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="kewarganegaraan" value="{{ old('kewarganegaraan', 'WNI') }}" required placeholder="Kewarganegaraan" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Pas Foto (Opsional)</label>
						<input type="file" class="form-control" name="foto" accept="image/*" style="padding: .75rem; border-radius: .5rem;" />
						<div class="form-text mt-2">Format: JPG/PNG/JPEG. Maks: 2MB.</div>
					</div>
				</div>

				<hr class="mb-8" style="border-color: #e7eef5; border-width: 2px;" />

				<h3 class="fw-bolder mb-6" style="color: var(--kop-navy);">Informasi Identitas & Kontak</h3>

				<div class="row g-6 mb-8">
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Nomor KTP (NIK) <span class="text-danger">*</span></label>
						<input type="number" class="form-control" name="nomorKTP" value="{{ old('nomorKTP') }}" required placeholder="Masukkan 16 digit NIK" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
						<input type="number" class="form-control" name="nomorKK" value="{{ old('nomorKK') }}" required placeholder="Masukkan 16 digit No. KK" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-12">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Alamat Sesuai KTP <span class="text-danger">*</span></label>
						<textarea class="form-control" name="alamatKTP" rows="3" required placeholder="Alamat lengkap sesuai KTP" style="padding: .75rem; border-radius: .5rem;">{{ old('alamatKTP') }}</textarea>
					</div>
					<div class="col-md-12">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Alamat Domisili Sekarang</label>
						<textarea class="form-control" name="alamatDomisili" rows="3" placeholder="Isi jika berbeda dengan KTP" style="padding: .75rem; border-radius: .5rem;">{{ old('alamatDomisili') }}</textarea>
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="nomorHP" value="{{ old('nomorHP') }}" required placeholder="Contoh: 08123456789" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Alamat Email</label>
						<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Contoh: nama@email.com" style="padding: .75rem; border-radius: .5rem;" />
					</div>
				</div>

				<hr class="mb-8" style="border-color: #e7eef5; border-width: 2px;" />

				<h3 class="fw-bolder mb-6" style="color: var(--kop-navy);">Informasi Usaha</h3>

				<div class="row g-6 mb-8">
					<div class="col-md-12">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Nama Usaha</label>
						<input type="text" class="form-control" name="namaUsaha" value="{{ old('namaUsaha') }}" placeholder="Nama usaha atau bisnis Anda" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Foto Usaha</label>
						<input type="file" class="form-control" name="fotoUsaha" accept="image/*" style="padding: .75rem; border-radius: .5rem;" />
						<div class="form-text mt-2">Format: JPG/PNG/JPEG. Maks: 2MB. (Opsional)</div>
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">File KTP</label>
						<input type="file" class="form-control" name="fileKtp" accept="application/pdf,image/*" style="padding: .75rem; border-radius: .5rem;" />
						<div class="form-text mt-2">Format: PDF/JPG/PNG. Maks: 2MB. (Opsional)</div>
					</div>
				</div>

				<hr class="mb-8" style="border-color: #e7eef5; border-width: 2px;" />

				<h3 class="fw-bolder mb-6" style="color: var(--kop-navy);">Informasi Pekerjaan & Koperasi</h3>

				<div class="row g-6 mb-8">
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Pekerjaan</label>
						<input type="text" class="form-control" name="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Pekerjaan saat ini" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Nama Instansi / Tempat Kerja</label>
						<input type="text" class="form-control" name="namaTempatKerja" value="{{ old('namaTempatKerja') }}" placeholder="Nama perusahaan atau instansi" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-12">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Alamat Tempat Kerja</label>
						<textarea class="form-control" name="alamatTempatKerja" rows="2" placeholder="Alamat lengkap instansi/perusahaan" style="padding: .75rem; border-radius: .5rem;">{{ old('alamatTempatKerja') }}</textarea>
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Jabatan</label>
						<input type="text" class="form-control" name="jabatan" value="{{ old('jabatan') }}" placeholder="Jabatan atau posisi" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Penghasilan Per Bulan (Rp)</label>
						<input type="number" class="form-control" name="penghasilan" value="{{ old('penghasilan') }}" placeholder="Misal: 5000000" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Rencana Simpanan Wajib / Bulan (Rp) <span class="text-danger">*</span></label>
						<input type="number" class="form-control" name="simpananWajib" value="{{ old('simpananWajib') }}" required placeholder="Nominal simpanan wajib bulanan" style="padding: .75rem; border-radius: .5rem;" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold" style="color: var(--kop-navy);">Nomor Rekening Bank Pribadi</label>
						<input type="text" class="form-control" name="nomorRekening" value="{{ old('nomorRekening') }}" placeholder="Nama Bank - Nomor Rekening" style="padding: .75rem; border-radius: .5rem;" />
					</div>
				</div>

				<div class="d-flex align-items-start gap-3 mt-10 mb-8 p-6" style="background-color: #f4f8fb; border-radius: .75rem;">
					<input type="checkbox" class="form-check-input mt-1" required id="persetujuan" style="width: 1.5rem; height: 1.5rem;" />
					<label for="persetujuan" class="form-check-label fs-6" style="color: var(--kop-navy);">
						Dengan ini saya menyatakan bahwa data yang saya isi adalah benar dan saya bersedia mematuhi Anggaran Dasar (AD), Anggaran Rumah Tangga (ART), serta ketentuan lain yang berlaku di koperasi.
					</label>
				</div>

				<div class="text-end">
					<button type="submit" class="kop-btn-blue fs-5 px-10 py-4">
						Kirim Pendaftaran <i class="ki-outline ki-send fs-4 ms-2"></i>
					</button>
				</div>
			</form>
		</div>

	</div>
</section>

@endsection
