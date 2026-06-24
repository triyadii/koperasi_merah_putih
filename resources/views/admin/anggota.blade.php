@extends('admin.layouts.app')

@section('styles')
<style>
.foto-anggota {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
.foto-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    border: 1px dashed #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f8fa;
    color: #a1a5b7;
}
.foto-preview-modal {
    width: 100%;
    max-height: 180px;
    object-fit: contain;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    display: none;
    margin-top: 8px;
}
</style>
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar d-flex flex-stack py-4 py-lg-8">
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manajemen Anggota</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
			<li class="breadcrumb-item text-gray-900">Anggota</li>
		</ul>
	</div>
	<div class="d-flex align-items-center gap-2 gap-lg-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_anggota">
			<i class="ki-outline ki-plus fs-2"></i> Tambah Anggota
		</button>
	</div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
	<div class="app-container container-xxl">

		@if(session('success'))
		<div class="alert alert-success d-flex align-items-center p-5 mb-6">
			<i class="ki-outline ki-shield-tick fs-2hx text-success me-4"></i>
			<div class="d-flex flex-column flex-grow-1"><span>{{ session('success') }}</span></div>
			<button type="button" class="btn btn-icon ms-auto" data-bs-dismiss="alert">
				<i class="ki-outline ki-cross fs-1 text-success"></i>
			</button>
		</div>
		@endif

		@if($errors->any())
		<div class="alert alert-danger d-flex align-items-center p-5 mb-6">
			<i class="ki-outline ki-information-5 fs-2hx text-danger me-4"></i>
			<div class="d-flex flex-column flex-grow-1">
				@foreach($errors->all() as $error)<span>{{ $error }}</span>@endforeach
			</div>
			<button type="button" class="btn btn-icon ms-auto" data-bs-dismiss="alert">
				<i class="ki-outline ki-cross fs-1 text-danger"></i>
			</button>
		</div>
		@endif

		<div class="card">
			<div class="card-header border-0 pt-6">
				<div class="card-title">
					<span class="text-muted fw-semibold fs-7">Total: {{ $anggotas->total() }} anggota</span>
				</div>
			</div>
			<div class="card-body py-4">
				<div class="table-responsive">
					<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
						<thead>
							<tr class="fw-bold text-muted bg-light">
								<th class="ps-4 w-40px rounded-start">#</th>
								<th class="w-60px">Foto</th>
								<th class="w-60px">Foto Usaha</th>
								<th>Nama Lengkap</th>
								<th>NIK</th>
								<th>No. HP</th>
								<th>Status</th>
								<th class="pe-4 text-end rounded-end">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse($anggotas as $item)
							<tr>
								<td class="ps-4">
									<span class="text-muted fw-semibold">{{ ($anggotas->currentPage() - 1) * $anggotas->perPage() + $loop->iteration }}</span>
								</td>
								<td>
									@if($item->foto)
									<img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->namaLengkap }}" class="foto-anggota">
									@else
									<div class="foto-placeholder"><i class="ki-outline ki-user fs-4"></i></div>
									@endif
								</td>
								<td>
									@if($item->fotoUsaha)
									<img src="{{ asset('storage/' . $item->fotoUsaha) }}" alt="{{ $item->namaUsaha }}" class="foto-anggota">
									@else
									<div class="foto-placeholder"><i class="ki-outline ki-shop fs-4"></i></div>
									@endif
								</td>
								<td>
									<div class="d-flex flex-column">
										<span class="text-gray-900 fw-bold fs-6">{{ $item->namaLengkap }}</span>
										<span class="text-muted fs-7">{{ $item->tempatLahir }}, {{ $item->tanggalLahir->format('d/m/Y') }}</span>
									</div>
								</td>
								<td><span class="text-gray-700 fs-6">{{ $item->nomorKTP }}</span></td>
								<td><span class="text-gray-700 fs-6">{{ $item->nomorHP }}</span></td>
								<td>
									@if($item->statusAnggota === 'aktif')
										<span class="badge badge-light-success fs-7">Aktif</span>
									@elseif($item->statusAnggota === 'nonaktif')
										<span class="badge badge-light-danger fs-7">Nonaktif</span>
									@else
										<span class="badge badge-light-warning fs-7">Pending</span>
									@endif
								</td>
								<td class="text-end pe-4">
									{{-- Detail --}}
									<button type="button"
										class="btn btn-icon btn-light-info btn-sm me-1"
										data-bs-toggle="modal"
										data-bs-target="#modal_detail_anggota"
										data-item="{{ json_encode($item->toArray()) }}"
										data-foto="{{ $item->foto ? asset('storage/' . $item->foto) : '' }}"
										onclick="setDetailData(this)">
										<i class="ki-outline ki-eye fs-4"></i>
									</button>

									{{-- Download KTP --}}
									@if($item->fileKtp)
									<a href="{{ asset('storage/' . $item->fileKtp) }}"
										download="KTP_{{ $item->nomorKTP }}"
										class="btn btn-icon btn-light-success btn-sm me-1"
										title="Download KTP">
										<i class="ki-outline ki-cloud-download fs-4"></i>
									</a>
									@endif

									{{-- Edit --}}
									<button type="button"
										class="btn btn-icon btn-light-primary btn-sm me-1"
										data-bs-toggle="modal"
										data-bs-target="#modal_edit_anggota"
										data-item="{{ json_encode($item->toArray()) }}"
										data-foto="{{ $item->foto ? asset('storage/' . $item->foto) : '' }}"
										onclick="setEditData(this)">
										<i class="ki-outline ki-pencil fs-4"></i>
									</button>

									{{-- Hapus --}}
									<button type="button"
										class="btn btn-icon btn-light-danger btn-sm me-1"
										data-bs-toggle="modal"
										data-bs-target="#modal_hapus_anggota"
										data-id="{{ $item->id }}"
										data-nama="{{ $item->namaLengkap }}"
										onclick="setHapusData(this)">
										<i class="ki-outline ki-trash fs-4"></i>
									</button>

									{{-- Aktivasi --}}
									<form method="POST" action="{{ route('admin.anggota.activate', $item) }}" class="d-inline">
										@csrf
										@method('PATCH')
										@if($item->statusAnggota === 'aktif')
										<button type="submit" class="btn btn-sm btn-light-warning">
											<i class="ki-outline ki-cross-circle fs-5 me-1"></i>Nonaktifkan
										</button>
										@else
										<button type="submit" class="btn btn-sm btn-light-success">
											<i class="ki-outline ki-check-circle fs-5 me-1"></i>Aktifkan
										</button>
										@endif
									</form>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="8" class="text-center py-15">
									<i class="ki-outline ki-people fs-5tx text-muted mb-5 d-block"></i>
									<p class="text-gray-600 fs-5 mb-0">Belum ada data anggota.</p>
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				@if ($anggotas->hasPages())
				<div class="d-flex justify-content-between align-items-center mt-4">
					<div class="text-muted fs-7">
						Menampilkan {{ $anggotas->firstItem() }} – {{ $anggotas->lastItem() }} dari {{ $anggotas->total() }} anggota
					</div>
					<ul class="pagination">
						<li class="page-item previous {{ $anggotas->onFirstPage() ? 'disabled' : '' }}">
							<a href="{{ $anggotas->previousPageUrl() ?? '#' }}" class="page-link"><i class="previous"></i></a>
						</li>
						@foreach ($anggotas->getUrlRange(1, $anggotas->lastPage()) as $page => $url)
						<li class="page-item {{ $page == $anggotas->currentPage() ? 'active' : '' }}">
							<a href="{{ $url }}" class="page-link">{{ $page }}</a>
						</li>
						@endforeach
						<li class="page-item next {{ !$anggotas->hasMorePages() ? 'disabled' : '' }}">
							<a href="{{ $anggotas->nextPageUrl() ?? '#' }}" class="page-link"><i class="next"></i></a>
						</li>
					</ul>
				</div>
				@endif
			</div>
		</div>

	</div>
</div>

{{-- ============================================================ --}}
{{-- Modal Tambah --}}
{{-- ============================================================ --}}
<div class="modal fade" id="modal_tambah_anggota" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-900px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Tambah Anggota</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_tambah_anggota" action="{{ route('admin.anggota.store') }}" enctype="multipart/form-data">
				@csrf
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">

					{{-- Seksi 1: Data Pribadi --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-user fs-6 me-1"></i> Data Pribadi
						</h6>
						<div class="row g-5">
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nama Lengkap</label>
									<input type="text" name="namaLengkap" class="form-control form-control-solid" placeholder="Nama lengkap sesuai KTP" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Tempat Lahir</label>
									<input type="text" name="tempatLahir" class="form-control form-control-solid" placeholder="Kota tempat lahir" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Tanggal Lahir</label>
									<input type="date" name="tanggalLahir" class="form-control form-control-solid" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Jenis Kelamin</label>
									<select name="jenisKelamin" class="form-select form-select-solid" required>
										<option value="">-- Pilih --</option>
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Agama</label>
									<select name="agama" class="form-select form-select-solid" required>
										<option value="">-- Pilih --</option>
										<option value="Islam">Islam</option>
										<option value="Kristen Protestan">Kristen Protestan</option>
										<option value="Kristen Katolik">Kristen Katolik</option>
										<option value="Hindu">Hindu</option>
										<option value="Buddha">Buddha</option>
										<option value="Konghucu">Konghucu</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Status Perkawinan</label>
									<select name="statusPerkawinan" class="form-select form-select-solid" required>
										<option value="">-- Pilih --</option>
										<option value="Belum Menikah">Belum Menikah</option>
										<option value="Menikah">Menikah</option>
										<option value="Cerai Hidup">Cerai Hidup</option>
										<option value="Cerai Mati">Cerai Mati</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Kewarganegaraan</label>
									<input type="text" name="kewarganegaraan" class="form-control form-control-solid" value="WNI" required>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 2: Identitas & Kontak --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-card fs-6 me-1"></i> Identitas & Kontak
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nomor KTP / NIK</label>
									<input type="text" name="nomorKTP" class="form-control form-control-solid" placeholder="16 digit NIK" maxlength="20" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nomor Kartu Keluarga</label>
									<input type="text" name="nomorKK" class="form-control form-control-solid" placeholder="Nomor KK" maxlength="20" required>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Alamat Lengkap (sesuai KTP)</label>
									<textarea name="alamatKTP" class="form-control form-control-solid" rows="2" placeholder="Alamat sesuai KTP" required></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Alamat Domisili <span class="text-muted fs-7">(jika berbeda)</span></label>
									<textarea name="alamatDomisili" class="form-control form-control-solid" rows="2" placeholder="Kosongkan jika sama dengan KTP"></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nomor HP / Telepon</label>
									<input type="text" name="nomorHP" class="form-control form-control-solid" placeholder="08xxxxxxxxxx" maxlength="20" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Email</label>
									<input type="email" name="email" class="form-control form-control-solid" placeholder="email@contoh.com">
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 3: Data Pekerjaan --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-briefcase fs-6 me-1"></i> Data Pekerjaan
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Pekerjaan / Profesi</label>
									<input type="text" name="pekerjaan" class="form-control form-control-solid" placeholder="Wiraswasta, PNS, dll.">
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Jabatan / Posisi</label>
									<input type="text" name="jabatan" class="form-control form-control-solid" placeholder="Jabatan di tempat kerja">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Nama Tempat Kerja</label>
									<input type="text" name="namaTempatKerja" class="form-control form-control-solid" placeholder="Nama perusahaan / instansi">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Alamat Tempat Kerja</label>
									<textarea name="alamatTempatKerja" class="form-control form-control-solid" rows="2" placeholder="Alamat lengkap tempat kerja"></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Penghasilan per Bulan (Rp)</label>
									<input type="number" name="penghasilan" class="form-control form-control-solid" placeholder="0" min="0">
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 4: Data Usaha --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-shop fs-6 me-1"></i> Data Usaha
						</h6>
						<div class="row g-5">
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Nama Usaha</label>
									<input type="text" name="namaUsaha" class="form-control form-control-solid" placeholder="Nama usaha">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Foto Usaha</label>
									<input type="file" name="fotoUsaha" id="tambah_fotoUsaha" class="form-control form-control-solid" accept="image/*" onchange="previewFoto(this, 'tambah_fotoUsaha_preview')">
									<img id="tambah_fotoUsaha_preview" class="foto-preview-modal" alt="Preview">
									<div class="form-text text-muted">Format: JPG, PNG, WEBP. Maks. 2MB. (Opsional)</div>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">File KTP</label>
									<input type="file" name="fileKtp" id="tambah_fileKtp" class="form-control form-control-solid" accept="application/pdf,image/*">
									<div class="form-text text-muted">Format: PDF, JPG, PNG. Maks. 2MB. (Opsional)</div>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 5: Data Koperasi --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-bank fs-6 me-1"></i> Data Koperasi
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Simpanan Wajib per Bulan (Rp)</label>
									<input type="number" name="simpananWajib" class="form-control form-control-solid" placeholder="0" min="0" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Nomor Rekening Bank</label>
									<input type="text" name="nomorRekening" class="form-control form-control-solid" placeholder="Nomor rekening">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Foto Anggota</label>
									<input type="file" name="foto" id="tambah_foto" class="form-control form-control-solid" accept="image/*" onchange="previewFoto(this, 'tambah_foto_preview')">
									<img id="tambah_foto_preview" class="foto-preview-modal" alt="Preview">
									<div class="form-text text-muted">Format: JPG, PNG, WEBP. Maks. 2MB. (Opsional)</div>
								</div>
							</div>
						</div>
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

{{-- ============================================================ --}}
{{-- Modal Edit --}}
{{-- ============================================================ --}}
<div class="modal fade" id="modal_edit_anggota" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-900px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Edit Anggota</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_edit_anggota" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">

					{{-- Info: data yang sedang diedit --}}
					<div class="alert alert-light-primary d-flex align-items-center p-4 mb-6">
						<i class="ki-outline ki-information-5 fs-2x text-primary me-4 flex-shrink-0"></i>
						<div class="flex-grow-1">
							<span class="fw-semibold text-gray-700">Mengedit anggota: </span>
							<span class="fw-bold text-primary" id="edit_info_nama"></span>
							<span class="text-muted fs-7 ms-2">NIK: </span>
							<span class="fw-semibold text-gray-700 fs-7" id="edit_info_nik"></span>
						</div>
					</div>

					{{-- Seksi 1: Data Pribadi --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-user fs-6 me-1"></i> Data Pribadi
						</h6>
						<div class="row g-5">
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nama Lengkap</label>
									<input type="text" id="edit_namaLengkap" name="namaLengkap" class="form-control form-control-solid" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Tempat Lahir</label>
									<input type="text" id="edit_tempatLahir" name="tempatLahir" class="form-control form-control-solid" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Tanggal Lahir</label>
									<input type="date" id="edit_tanggalLahir" name="tanggalLahir" class="form-control form-control-solid" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Jenis Kelamin</label>
									<select id="edit_jenisKelamin" name="jenisKelamin" class="form-select form-select-solid" required>
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Agama</label>
									<select id="edit_agama" name="agama" class="form-select form-select-solid" required>
										<option value="Islam">Islam</option>
										<option value="Kristen Protestan">Kristen Protestan</option>
										<option value="Kristen Katolik">Kristen Katolik</option>
										<option value="Hindu">Hindu</option>
										<option value="Buddha">Buddha</option>
										<option value="Konghucu">Konghucu</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Status Perkawinan</label>
									<select id="edit_statusPerkawinan" name="statusPerkawinan" class="form-select form-select-solid" required>
										<option value="Belum Menikah">Belum Menikah</option>
										<option value="Menikah">Menikah</option>
										<option value="Cerai Hidup">Cerai Hidup</option>
										<option value="Cerai Mati">Cerai Mati</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Kewarganegaraan</label>
									<input type="text" id="edit_kewarganegaraan" name="kewarganegaraan" class="form-control form-control-solid" required>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 2: Identitas & Kontak --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-card fs-6 me-1"></i> Identitas & Kontak
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nomor KTP / NIK</label>
									<input type="text" id="edit_nomorKTP" name="nomorKTP" class="form-control form-control-solid" maxlength="20" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nomor Kartu Keluarga</label>
									<input type="text" id="edit_nomorKK" name="nomorKK" class="form-control form-control-solid" maxlength="20" required>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Alamat Lengkap (sesuai KTP)</label>
									<textarea id="edit_alamatKTP" name="alamatKTP" class="form-control form-control-solid" rows="2" required></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Alamat Domisili <span class="text-muted fs-7">(jika berbeda)</span></label>
									<textarea id="edit_alamatDomisili" name="alamatDomisili" class="form-control form-control-solid" rows="2"></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nomor HP / Telepon</label>
									<input type="text" id="edit_nomorHP" name="nomorHP" class="form-control form-control-solid" maxlength="20" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Email</label>
									<input type="email" id="edit_email" name="email" class="form-control form-control-solid">
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 3: Data Pekerjaan --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-briefcase fs-6 me-1"></i> Data Pekerjaan
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Pekerjaan / Profesi</label>
									<input type="text" id="edit_pekerjaan" name="pekerjaan" class="form-control form-control-solid">
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Jabatan / Posisi</label>
									<input type="text" id="edit_jabatan" name="jabatan" class="form-control form-control-solid">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Nama Tempat Kerja</label>
									<input type="text" id="edit_namaTempatKerja" name="namaTempatKerja" class="form-control form-control-solid">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Alamat Tempat Kerja</label>
									<textarea id="edit_alamatTempatKerja" name="alamatTempatKerja" class="form-control form-control-solid" rows="2"></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Penghasilan per Bulan (Rp)</label>
									<input type="number" id="edit_penghasilan" name="penghasilan" class="form-control form-control-solid" min="0">
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 4: Data Usaha --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-shop fs-6 me-1"></i> Data Usaha
						</h6>
						<div class="row g-5">
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Nama Usaha</label>
									<input type="text" id="edit_namaUsaha" name="namaUsaha" class="form-control form-control-solid">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Foto Usaha</label>
									<div id="edit_fotoUsaha_current" class="mb-3" style="display:none;">
										<p class="text-muted fs-7 mb-2">Foto usaha saat ini:</p>
										<img id="edit_fotoUsaha_current_img" src="" alt="Foto Usaha" style="width:70px;height:70px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
									</div>
									<input type="file" name="fotoUsaha" id="edit_fotoUsaha" class="form-control form-control-solid" accept="image/*" onchange="previewFoto(this, 'edit_fotoUsaha_preview')">
									<img id="edit_fotoUsaha_preview" class="foto-preview-modal" alt="Preview Baru">
									<div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP. Maks. 2MB.</div>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">File KTP</label>
									<div id="edit_fileKtp_current" class="mb-3" style="display:none;">
										<p class="text-muted fs-7 mb-2">File KTP saat ini:</p>
										<div class="d-flex gap-2">
											<a id="edit_fileKtp_current_view" href="#" target="_blank" class="btn btn-sm btn-light-primary">
												<i class="ki-outline ki-eye fs-6 me-1"></i>Lihat
											</a>
											<a id="edit_fileKtp_current_download" href="#" download class="btn btn-sm btn-light-success">
												<i class="ki-outline ki-cloud-download fs-6 me-1"></i>Download
											</a>
										</div>
									</div>
									<input type="file" name="fileKtp" id="edit_fileKtp" class="form-control form-control-solid" accept="application/pdf,image/*">
									<div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah file. Format: PDF, JPG, PNG. Maks. 2MB.</div>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 5: Data Koperasi --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-bank fs-6 me-1"></i> Data Koperasi
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Simpanan Wajib per Bulan (Rp)</label>
									<input type="number" id="edit_simpananWajib" name="simpananWajib" class="form-control form-control-solid" min="0" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Nomor Rekening Bank</label>
									<input type="text" id="edit_nomorRekening" name="nomorRekening" class="form-control form-control-solid">
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="fw-semibold fs-6 mb-2">Foto Anggota</label>
									<div id="edit_foto_current" class="mb-3" style="display:none;">
										<p class="text-muted fs-7 mb-2">Foto saat ini:</p>
										<img id="edit_foto_current_img" src="" alt="Foto" style="width:70px;height:70px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
									</div>
									<input type="file" name="foto" id="edit_foto" class="form-control form-control-solid" accept="image/*" onchange="previewFoto(this, 'edit_foto_preview')">
									<img id="edit_foto_preview" class="foto-preview-modal" alt="Preview Baru">
									<div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP. Maks. 2MB.</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer flex-center">
					<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Perbarui</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- ============================================================ --}}
{{-- Modal Detail --}}
{{-- ============================================================ --}}
<div class="modal fade" id="modal_detail_anggota" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-900px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Detail Anggota</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<div class="modal-body px-5 py-6" style="max-height: 75vh; overflow-y: auto;">

				{{-- Header: foto + nama + status --}}
				<div class="d-flex align-items-center gap-5 mb-7 p-5 bg-light rounded">
					<div id="detail_foto_wrap">
						<img id="detail_foto_img" src="" alt="Foto" style="width:80px;height:80px;object-fit:cover;border-radius:12px;border:2px solid #dee2e6;display:none;">
						<div id="detail_foto_placeholder" class="foto-placeholder" style="width:80px;height:80px;border-radius:12px;">
							<i class="ki-outline ki-user fs-2x"></i>
						</div>
					</div>
					<div class="flex-grow-1">
						<div class="fw-bold text-gray-900 fs-4 mb-1" id="detail_namaLengkap">-</div>
						<div class="text-muted fs-6 mb-2" id="detail_ttl">-</div>
						<span id="detail_statusBadge" class="badge fs-7">-</span>
					</div>
				</div>

				{{-- Seksi 1: Data Pribadi --}}
				<div class="mb-5">
					<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
						<i class="ki-outline ki-user fs-6 me-1"></i> Data Pribadi
					</h6>
					<div class="row g-4">
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Jenis Kelamin</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_jenisKelamin">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Agama</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_agama">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Status Perkawinan</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_statusPerkawinan">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Kewarganegaraan</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_kewarganegaraan">-</span>
						</div>
					</div>
				</div>

				<div class="separator separator-dashed my-5"></div>

				{{-- Seksi 2: Identitas & Kontak --}}
				<div class="mb-5">
					<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
						<i class="ki-outline ki-card fs-6 me-1"></i> Identitas & Kontak
					</h6>
					<div class="row g-4">
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Nomor KTP / NIK</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_nomorKTP">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Nomor Kartu Keluarga</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_nomorKK">-</span>
						</div>
						<div class="col-12">
							<span class="text-gray-500 fs-7 d-block">Alamat KTP</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_alamatKTP">-</span>
						</div>
						<div class="col-12">
							<span class="text-gray-500 fs-7 d-block">Alamat Domisili</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_alamatDomisili">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Nomor HP</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_nomorHP">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Email</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_email">-</span>
						</div>
					</div>
				</div>

				<div class="separator separator-dashed my-5"></div>

				{{-- Seksi 3: Data Pekerjaan --}}
				<div class="mb-5">
					<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
						<i class="ki-outline ki-briefcase fs-6 me-1"></i> Data Pekerjaan
					</h6>
					<div class="row g-4">
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Pekerjaan / Profesi</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_pekerjaan">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Jabatan / Posisi</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_jabatan">-</span>
						</div>
						<div class="col-12">
							<span class="text-gray-500 fs-7 d-block">Nama Tempat Kerja</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_namaTempatKerja">-</span>
						</div>
						<div class="col-12">
							<span class="text-gray-500 fs-7 d-block">Alamat Tempat Kerja</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_alamatTempatKerja">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Penghasilan per Bulan</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_penghasilan">-</span>
						</div>
					</div>
				</div>

				<div class="separator separator-dashed my-5"></div>

				{{-- Seksi 4: Data Usaha --}}
				<div class="mb-5">
					<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
						<i class="ki-outline ki-shop fs-6 me-1"></i> Data Usaha
					</h6>
					<div class="row g-4">
						<div class="col-12">
							<span class="text-gray-500 fs-7 d-block">Nama Usaha</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_namaUsaha">-</span>
						</div>
						<div class="col-12">
							<span class="text-gray-500 fs-7 d-block">Foto Usaha</span>
							<div id="detail_fotoUsaha_wrap" style="margin-top: 8px;">
								<img id="detail_fotoUsaha_img" src="" alt="Foto Usaha" style="width:100px;height:100px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;display:none;">
								<span id="detail_fotoUsaha_none" class="text-muted fs-7">-</span>
							</div>
						</div>
						<div class="col-12">
							<span class="text-gray-500 fs-7 d-block mb-2">File KTP</span>
							<div id="detail_fileKtp_buttons" style="display:none;">
								<a id="detail_fileKtp_view" href="#" target="_blank" class="btn btn-sm btn-light-primary me-2">
									<i class="ki-outline ki-eye fs-6 me-1"></i>Lihat
								</a>
								<a id="detail_fileKtp_download" href="#" download class="btn btn-sm btn-light-success">
									<i class="ki-outline ki-cloud-download fs-6 me-1"></i>Download
								</a>
							</div>
							<span id="detail_fileKtp_none" class="text-muted fs-7">-</span>
						</div>
					</div>
				</div>

				<div class="separator separator-dashed my-5"></div>

				{{-- Seksi 5: Data Koperasi --}}
				<div class="mb-3">
					<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
						<i class="ki-outline ki-bank fs-6 me-1"></i> Data Koperasi
					</h6>
					<div class="row g-4">
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Simpanan Wajib per Bulan</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_simpananWajib">-</span>
						</div>
						<div class="col-md-6">
							<span class="text-gray-500 fs-7 d-block">Nomor Rekening Bank</span>
							<span class="fw-semibold text-gray-800 fs-6" id="detail_nomorRekening">-</span>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

{{-- ============================================================ --}}
{{-- Modal Hapus --}}
{{-- ============================================================ --}}
<div class="modal fade" id="modal_hapus_anggota" tabindex="-1" aria-hidden="true">
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
				<p class="fs-5 text-gray-700 mb-1">Yakin ingin menghapus anggota:</p>
				<p class="fw-bold fs-4 text-gray-900 mb-3" id="hapus_namaAnggota"></p>
				<p class="text-muted fs-6">Data yang dihapus tidak dapat dikembalikan.</p>
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
				<form id="form_hapus_anggota" method="POST">
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
(function () {

    window.previewFoto = function (input, previewId) {
        var preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    };

    document.getElementById('modal_tambah_anggota').addEventListener('hidden.bs.modal', function () {
        document.getElementById('form_tambah_anggota').reset();
        var prev = document.getElementById('tambah_foto_preview');
        prev.src = ''; prev.style.display = 'none';
        var prevFotoUsaha = document.getElementById('tambah_fotoUsaha_preview');
        prevFotoUsaha.src = ''; prevFotoUsaha.style.display = 'none';
    });

    document.getElementById('modal_edit_anggota').addEventListener('hidden.bs.modal', function () {
        document.getElementById('edit_foto').value = '';
        document.getElementById('edit_fotoUsaha').value = '';
        document.getElementById('edit_fileKtp').value = '';
        var prev = document.getElementById('edit_foto_preview');
        prev.src = ''; prev.style.display = 'none';
        var prevFotoUsaha = document.getElementById('edit_fotoUsaha_preview');
        prevFotoUsaha.src = ''; prevFotoUsaha.style.display = 'none';
    });

    window.setEditData = function (btn) {
        var item    = JSON.parse(btn.getAttribute('data-item'));
        var fotoUrl = btn.getAttribute('data-foto');

        document.getElementById('form_edit_anggota').action = '{{ url("admin/anggota") }}/' + item.id;

        // Info bar
        document.getElementById('edit_info_nama').textContent = item.namaLengkap || '-';
        document.getElementById('edit_info_nik').textContent  = item.nomorKTP || '-';

        document.getElementById('edit_namaLengkap').value          = item.namaLengkap || '';
        document.getElementById('edit_tempatLahir').value          = item.tempatLahir || '';
        document.getElementById('edit_tanggalLahir').value         = item.tanggalLahir || '';
        document.getElementById('edit_jenisKelamin').value         = item.jenisKelamin || '';
        document.getElementById('edit_agama').value                = item.agama || '';
        document.getElementById('edit_statusPerkawinan').value     = item.statusPerkawinan || '';
        document.getElementById('edit_kewarganegaraan').value      = item.kewarganegaraan || '';
        document.getElementById('edit_nomorKTP').value             = item.nomorKTP || '';
        document.getElementById('edit_nomorKK').value              = item.nomorKK || '';
        document.getElementById('edit_alamatKTP').value            = item.alamatKTP || '';
        document.getElementById('edit_alamatDomisili').value       = item.alamatDomisili || '';
        document.getElementById('edit_nomorHP').value              = item.nomorHP || '';
        document.getElementById('edit_email').value                = item.email || '';
        document.getElementById('edit_namaUsaha').value            = item.namaUsaha || '';
        document.getElementById('edit_pekerjaan').value            = item.pekerjaan || '';
        document.getElementById('edit_jabatan').value              = item.jabatan || '';
        document.getElementById('edit_namaTempatKerja').value      = item.namaTempatKerja || '';
        document.getElementById('edit_alamatTempatKerja').value    = item.alamatTempatKerja || '';
        document.getElementById('edit_penghasilan').value          = item.penghasilan || '';
        document.getElementById('edit_simpananWajib').value        = item.simpananWajib || '';
        document.getElementById('edit_nomorRekening').value        = item.nomorRekening || '';

        // Foto
        var currentDiv = document.getElementById('edit_foto_current');
        var currentImg = document.getElementById('edit_foto_current_img');
        if (fotoUrl) {
            currentImg.src = fotoUrl;
            currentDiv.style.display = 'block';
        } else {
            currentDiv.style.display = 'none';
            currentImg.src = '';
        }

        // Foto Usaha
        var currentFotoUsahaDiv = document.getElementById('edit_fotoUsaha_current');
        var currentFotoUsahaImg = document.getElementById('edit_fotoUsaha_current_img');
        var fotoUsahaUrl = item.fotoUsaha ? '{{ url("storage") }}/' + item.fotoUsaha : '';
        if (fotoUsahaUrl) {
            currentFotoUsahaImg.src = fotoUsahaUrl;
            currentFotoUsahaDiv.style.display = 'block';
        } else {
            currentFotoUsahaDiv.style.display = 'none';
            currentFotoUsahaImg.src = '';
        }

        // File KTP
        var currentFileKtpDiv = document.getElementById('edit_fileKtp_current');
        var currentFileKtpView = document.getElementById('edit_fileKtp_current_view');
        var currentFileKtpDownload = document.getElementById('edit_fileKtp_current_download');
        var fileKtpUrl = item.fileKtp ? '{{ url("storage") }}/' + item.fileKtp : '';
        if (fileKtpUrl) {
            currentFileKtpView.href = fileKtpUrl;
            currentFileKtpDownload.href = fileKtpUrl;
            currentFileKtpDownload.setAttribute('download', 'KTP_' + item.nomorKTP + (fileKtpUrl.endsWith('.pdf') ? '.pdf' : ''));
            currentFileKtpDiv.style.display = 'block';
        } else {
            currentFileKtpDiv.style.display = 'none';
            currentFileKtpView.href = '#';
            currentFileKtpDownload.href = '#';
        }
    };

    window.setHapusData = function (btn) {
        document.getElementById('hapus_namaAnggota').textContent   = btn.getAttribute('data-nama');
        document.getElementById('form_hapus_anggota').action       = '{{ url("admin/anggota") }}/' + btn.getAttribute('data-id');
    };

    window.setDetailData = function (btn) {
        var item    = JSON.parse(btn.getAttribute('data-item'));
        var fotoUrl = btn.getAttribute('data-foto');

        var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        function formatTgl(str) {
            if (!str) return '-';
            var parts = str.substring(0, 10).split('-');
            return parseInt(parts[2]) + ' ' + bulan[parseInt(parts[1]) - 1] + ' ' + parts[0];
        }
        function formatRp(val) {
            if (!val && val !== 0) return '-';
            return 'Rp ' + parseInt(val).toLocaleString('id-ID');
        }

        // Header
        document.getElementById('detail_namaLengkap').textContent  = item.namaLengkap || '-';
        document.getElementById('detail_ttl').textContent          = (item.tempatLahir || '-') + ', ' + formatTgl(item.tanggalLahir);

        var badge = document.getElementById('detail_statusBadge');
        if (item.statusAnggota === 'aktif') {
            badge.className = 'badge badge-light-success fs-7';
            badge.textContent = 'Aktif';
        } else if (item.statusAnggota === 'nonaktif') {
            badge.className = 'badge badge-light-danger fs-7';
            badge.textContent = 'Nonaktif';
        } else {
            badge.className = 'badge badge-light-warning fs-7';
            badge.textContent = 'Pending';
        }

        // Foto
        var fotoImg = document.getElementById('detail_foto_img');
        var fotoPh  = document.getElementById('detail_foto_placeholder');
        if (fotoUrl) {
            fotoImg.src = fotoUrl;
            fotoImg.style.display = 'block';
            fotoPh.style.display  = 'none';
        } else {
            fotoImg.style.display = 'none';
            fotoPh.style.display  = 'flex';
        }

        // Data Pribadi
        document.getElementById('detail_jenisKelamin').textContent     = item.jenisKelamin || '-';
        document.getElementById('detail_agama').textContent            = item.agama || '-';
        document.getElementById('detail_statusPerkawinan').textContent = item.statusPerkawinan || '-';
        document.getElementById('detail_kewarganegaraan').textContent  = item.kewarganegaraan || '-';

        // Identitas & Kontak
        document.getElementById('detail_nomorKTP').textContent         = item.nomorKTP || '-';
        document.getElementById('detail_nomorKK').textContent          = item.nomorKK || '-';
        document.getElementById('detail_alamatKTP').textContent        = item.alamatKTP || '-';
        document.getElementById('detail_alamatDomisili').textContent   = item.alamatDomisili || '(sama dengan KTP)';
        document.getElementById('detail_nomorHP').textContent          = item.nomorHP || '-';
        document.getElementById('detail_email').textContent            = item.email || '-';

        // Pekerjaan
        document.getElementById('detail_pekerjaan').textContent        = item.pekerjaan || '-';
        document.getElementById('detail_jabatan').textContent          = item.jabatan || '-';
        document.getElementById('detail_namaTempatKerja').textContent  = item.namaTempatKerja || '-';
        document.getElementById('detail_alamatTempatKerja').textContent = item.alamatTempatKerja || '-';
        document.getElementById('detail_penghasilan').textContent      = formatRp(item.penghasilan);

        // Usaha
        document.getElementById('detail_namaUsaha').textContent = item.namaUsaha || '-';

        var detailFotoUsahaImg = document.getElementById('detail_fotoUsaha_img');
        var detailFotoUsahaNone = document.getElementById('detail_fotoUsaha_none');
        if (item.fotoUsaha) {
            detailFotoUsahaImg.src = '{{ url("storage") }}/' + item.fotoUsaha;
            detailFotoUsahaImg.style.display = 'block';
            detailFotoUsahaNone.style.display = 'none';
        } else {
            detailFotoUsahaImg.style.display = 'none';
            detailFotoUsahaNone.style.display = 'block';
        }

        var detailFileKtpButtons = document.getElementById('detail_fileKtp_buttons');
        var detailFileKtpView = document.getElementById('detail_fileKtp_view');
        var detailFileKtpDownload = document.getElementById('detail_fileKtp_download');
        var detailFileKtpNone = document.getElementById('detail_fileKtp_none');
        if (item.fileKtp) {
            var ktpUrl = '{{ url("storage") }}/' + item.fileKtp;
            detailFileKtpView.href = ktpUrl;
            detailFileKtpDownload.href = ktpUrl;
            detailFileKtpDownload.setAttribute('download', 'KTP_' + item.nomorKTP + (ktpUrl.endsWith('.pdf') ? '.pdf' : ''));
            detailFileKtpButtons.style.display = 'block';
            detailFileKtpNone.style.display = 'none';
        } else {
            detailFileKtpButtons.style.display = 'none';
            detailFileKtpNone.style.display = 'block';
        }

        // Koperasi
        document.getElementById('detail_simpananWajib').textContent    = formatRp(item.simpananWajib);
        document.getElementById('detail_nomorRekening').textContent    = item.nomorRekening || '-';
    };

})();
</script>
@endsection
