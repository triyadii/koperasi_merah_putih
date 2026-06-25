@extends('admin.layouts.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar d-flex flex-stack py-4 py-lg-8">
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Edit Data Keuangan Kas</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-500 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.keuangan-kas.index') }}" class="text-muted text-hover-primary">Keuangan Kas</a>
			</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-500 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-gray-900">Edit Data</li>
		</ul>
	</div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
	<div class="app-container container-xxl">
		<div class="card">
			<div class="card-body p-lg-17">
				<form method="POST" action="{{ route('admin.keuangan-kas.update', $keuanganKa) }}" class="form" id="form_edit_kas">
					@csrf
					@method('PUT')

					<div class="row mb-6">
						<label class="col-lg-4 col-form-label required fw-semibold fs-6">Nomor Anggota</label>
						<div class="col-lg-8 fv-row">
							<input type="text" name="nomorAnggota" class="form-control form-control-lg form-control-solid @error('nomorAnggota') is-invalid @enderror" placeholder="Nomor anggota" value="{{ old('nomorAnggota', $keuanganKa->nomorAnggota) }}" required />
							@error('nomorAnggota')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="row mb-6">
						<label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Anggota</label>
						<div class="col-lg-8 fv-row">
							<input type="text" name="namaAnggota" class="form-control form-control-lg form-control-solid @error('namaAnggota') is-invalid @enderror" placeholder="Nama anggota" value="{{ old('namaAnggota', $keuanganKa->namaAnggota) }}" required />
							@error('namaAnggota')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="row mb-6">
						<label class="col-lg-4 col-form-label fw-semibold fs-6">Simpanan Pokok (Rp)</label>
						<div class="col-lg-8 fv-row">
							<input type="number" name="simpananPokok" class="form-control form-control-lg form-control-solid @error('simpananPokok') is-invalid @enderror" placeholder="0" value="{{ old('simpananPokok', $keuanganKa->simpananPokok) }}" min="0" />
							@error('simpananPokok')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="row mb-6">
						<label class="col-lg-4 col-form-label fw-semibold fs-6">Simpanan Wajib (Rp)</label>
						<div class="col-lg-8 fv-row">
							<input type="number" name="simpananWajib" class="form-control form-control-lg form-control-solid @error('simpananWajib') is-invalid @enderror" placeholder="0" value="{{ old('simpananWajib', $keuanganKa->simpananWajib) }}" min="0" />
							@error('simpananWajib')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="row mb-6">
						<label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal Bayar</label>
						<div class="col-lg-8 fv-row">
							<input type="date" name="tanggalBayar" class="form-control form-control-lg form-control-solid @error('tanggalBayar') is-invalid @enderror" value="{{ old('tanggalBayar', $keuanganKa->tanggalBayar->format('Y-m-d')) }}" required />
							@error('tanggalBayar')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="row mb-6">
						<label class="col-lg-4 col-form-label fw-semibold fs-6">Keterangan</label>
						<div class="col-lg-8 fv-row">
							<textarea name="keterangan" class="form-control form-control-lg form-control-solid @error('keterangan') is-invalid @enderror" placeholder="Keterangan (opsional)" rows="3">{{ old('keterangan', $keuanganKa->keterangan) }}</textarea>
							@error('keterangan')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="row">
						<label class="col-lg-4"></label>
						<div class="col-lg-8">
							<a href="{{ route('admin.keuangan-kas.index') }}" class="btn btn-light me-3">Batal</a>
							<button type="submit" class="btn btn-primary">Perbarui</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
