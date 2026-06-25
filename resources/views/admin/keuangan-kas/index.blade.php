@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar d-flex flex-stack py-4 py-lg-8">
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manajemen Keuangan Kas</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-500 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-gray-900">Keuangan Kas</li>
		</ul>
	</div>
	<div class="d-flex align-items-center gap-2 gap-lg-3">
		<a href="{{ route('admin.keuangan-kas.export') }}" class="btn btn-success" title="Export ke Excel">
			<i class="ki-outline ki-file-down fs-2"></i> Export Excel
		</a>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_kas">
			<i class="ki-outline ki-plus fs-2"></i> Tambah Data
		</button>
	</div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
	<div class="app-container container-xxl">

		@if(session('success'))
		<div class="alert alert-success d-flex align-items-center p-5 mb-6">
			<i class="ki-outline ki-shield-tick fs-2hx text-success me-4"></i>
			<div class="d-flex flex-column flex-grow-1">
				<span>{{ session('success') }}</span>
			</div>
			<button type="button" class="btn btn-icon ms-auto" data-bs-dismiss="alert">
				<i class="ki-outline ki-cross fs-1 text-success"></i>
			</button>
		</div>
		@endif

		@if($errors->any())
		<div class="alert alert-danger d-flex align-items-center p-5 mb-6">
			<i class="ki-outline ki-information-5 fs-2hx text-danger me-4"></i>
			<div class="d-flex flex-column flex-grow-1">
				@foreach($errors->all() as $error)
				<span>{{ $error }}</span>
				@endforeach
			</div>
			<button type="button" class="btn btn-icon ms-auto" data-bs-dismiss="alert">
				<i class="ki-outline ki-cross fs-1 text-danger"></i>
			</button>
		</div>
		@endif

		<div class="card">
			<div class="card-header border-0 pt-6">
				<div class="card-title">
					<h3 class="card-label fw-bold text-gray-900">Daftar Keuangan Kas</h3>
				</div>
			</div>

			<!-- Filter Section -->
			<div class="card-body border-top py-6">
				<form method="GET" action="{{ route('admin.keuangan-kas.index') }}" class="mb-6">
					<div class="row g-4">
						<div class="col-md-3">
							<label class="form-label fw-semibold fs-6 mb-2">Tanggal Mulai</label>
							<input type="date" name="tanggal_mulai" class="form-control form-control-solid" value="{{ request('tanggal_mulai') }}" />
						</div>
						<div class="col-md-3">
							<label class="form-label fw-semibold fs-6 mb-2">Tanggal Akhir</label>
							<input type="date" name="tanggal_akhir" class="form-control form-control-solid" value="{{ request('tanggal_akhir') }}" />
						</div>
						<div class="col-md-4">
							<label class="form-label fw-semibold fs-6 mb-2">Nomor Anggota</label>
							<input type="text" name="nomorAnggota" class="form-control form-control-solid" placeholder="Cari nomor anggota" value="{{ request('nomorAnggota') }}" />
						</div>
						<div class="col-md-2 d-flex align-items-end gap-2">
							<button type="submit" class="btn btn-primary w-100" title="Cari">
								<i class="ki-outline ki-magnifier fs-5"></i>
							</button>
							<a href="{{ route('admin.keuangan-kas.index') }}" class="btn btn-light w-100" title="Reset">
								<i class="ki-outline ki-cross fs-5"></i>
							</a>
						</div>
					</div>
				</form>
			</div>

			<div class="card-body py-4">
				<div class="table-responsive">
					<table class="table align-middle table-row-dashed fs-6 gy-5">
						<thead>
							<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
								<th class="w-50px">No</th>
								<th>Nomor Anggota</th>
								<th>Nama Anggota</th>
								<th>Simpanan Pokok</th>
								<th>Simpanan Wajib</th>
								<th>Tanggal Bayar</th>
								<th class="text-end min-w-150px">Aksi</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-semibold">
							@forelse($keuanganKas as $i => $kas)
							<tr>
								<td>{{ $keuanganKas->firstItem() + $i }}</td>
								<td>
									<span class="text-gray-800 fw-bold">{{ $kas->nomorAnggota }}</span>
								</td>
								<td>
									<span class="text-gray-800">{{ $kas->namaAnggota }}</span>
								</td>
								<td>
									<span class="text-gray-800">Rp {{ number_format($kas->simpananPokok, 0, ',', '.') }}</span>
								</td>
								<td>
									<span class="text-gray-800">Rp {{ number_format($kas->simpananWajib, 0, ',', '.') }}</span>
								</td>
								<td>
									<span class="text-gray-800">{{ $kas->tanggalBayar->format('d/m/Y') }}</span>
								</td>
								<td class="text-end">
									<a href="{{ route('admin.keuangan-kas.edit', $kas) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit">
										<i class="ki-outline ki-pencil fs-2"></i>
									</a>
									<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" title="Hapus" data-bs-toggle="modal" data-bs-target="#modal_hapus_kas" onclick="setHapusData({{ $kas->id }}, '{{ $kas->namaAnggota }}')">
										<i class="ki-outline ki-trash fs-2"></i>
									</button>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="7" class="text-center text-muted py-10">
									<i class="ki-outline ki-folder fs-3x text-muted mb-3 d-block"></i>
									Belum ada data keuangan kas.
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<div class="d-flex justify-content-end mt-5">
					{{ $keuanganKas->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah Kas -->
<div class="modal fade" id="modal_tambah_kas" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-600px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Tambah Data Keuangan Kas</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" action="{{ route('admin.keuangan-kas.store') }}" class="form" id="form_tambah_kas">
				@csrf
				<div class="modal-body px-5 py-10">
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Nama Anggota</label>
						<select name="nama_anggota" id="nama_anggota" class="form-select form-select-solid @error('nomorAnggota') is-invalid @enderror" required onchange="updateNomorAnggota()">
							<option value="">-- Pilih Nama Anggota --</option>
							@foreach($anggotas as $anggota)
							<option value="{{ $anggota->nomorKTP }}" data-nama="{{ $anggota->namaLengkap }}">{{ $anggota->namaLengkap }}</option>
							@endforeach
						</select>
					</div>

					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Nomor Anggota (NIK)</label>
						<input type="text" name="nomorAnggota" id="nomorAnggota" class="form-control form-control-solid @error('nomorAnggota') is-invalid @enderror" readonly />
						@error('nomorAnggota')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>

					<input type="hidden" name="namaAnggota" id="namaAnggota" />

					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Simpanan Pokok (Rp)</label>
						<input type="number" name="simpananPokok" class="form-control form-control-solid @error('simpananPokok') is-invalid @enderror" placeholder="0" value="{{ old('simpananPokok') }}" min="0" />
						@error('simpananPokok')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>

					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Simpanan Wajib (Rp)</label>
						<input type="number" name="simpananWajib" class="form-control form-control-solid @error('simpananWajib') is-invalid @enderror" placeholder="0" value="{{ old('simpananWajib') }}" min="0" />
						@error('simpananWajib')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>

					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Tanggal Bayar</label>
						<input type="date" name="tanggalBayar" class="form-control form-control-solid @error('tanggalBayar') is-invalid @enderror" value="{{ old('tanggalBayar') }}" required />
						@error('tanggalBayar')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>

					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Keterangan</label>
						<textarea name="keterangan" class="form-control form-control-solid @error('keterangan') is-invalid @enderror" placeholder="Keterangan (opsional)" rows="2">{{ old('keterangan') }}</textarea>
						@error('keterangan')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<div class="modal-footer flex-center">
					<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Hapus Kas -->
<div class="modal fade" id="modal_hapus_kas" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-500px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Konfirmasi Hapus</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<div class="modal-body text-center py-10">
				<i class="ki-outline ki-trash fs-5tx text-danger mb-5 d-block"></i>
				<p class="fs-5 text-gray-700 mb-1">Yakin ingin menghapus data keuangan kas</p>
				<p class="fs-4 fw-bold text-gray-900 mb-5" id="hapus_nama_label">-</p>
				<p class="text-muted fs-6">Data yang dihapus tidak dapat dikembalikan.</p>
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
				<form method="POST" id="form_hapus_kas" action="">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Hapus</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
function setHapusData(id, nama) {
	document.getElementById('hapus_nama_label').textContent = nama;
	document.getElementById('form_hapus_kas').action = '{{ url("admin/keuangan-kas") }}/' + id;
}

function updateNomorAnggota() {
	const selectElement = document.getElementById('nama_anggota');
	const selectedOption = selectElement.options[selectElement.selectedIndex];
	const nomorAnggota = selectedOption.value;
	const namaAnggota = selectedOption.getAttribute('data-nama');

	document.getElementById('nomorAnggota').value = nomorAnggota;
	document.getElementById('namaAnggota').value = namaAnggota;
}

// Reset form saat modal ditutup
document.getElementById('modal_tambah_kas').addEventListener('hidden.bs.modal', function () {
	document.getElementById('form_tambah_kas').reset();
	document.getElementById('nomorAnggota').value = '';
	document.getElementById('namaAnggota').value = '';
});
</script>
@endsection
