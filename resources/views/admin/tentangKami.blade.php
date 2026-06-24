@extends('admin.layouts.app')

@section('styles')
<style>
.ck.ck-editor__editable {
    background-color: #ffffff !important;
    color: #181C32 !important;
    min-height: 130px;
}
.ck.ck-editor__editable * {
    color: #181C32 !important;
}
.ck.ck-toolbar {
    background-color: #f5f8fa !important;
    border-color: #dee2e6 !important;
}
.ck.ck-toolbar .ck-button {
    color: #3F4254 !important;
}
</style>
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar d-flex flex-stack py-4 py-lg-8">
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Tentang Kami</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-500 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-gray-900">Tentang Kami</li>
		</ul>
	</div>
	@if(!$tentangKami)
	<div class="d-flex align-items-center gap-2 gap-lg-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_tentang">
			<i class="ki-outline ki-plus fs-2"></i> Tambah Data
		</button>
	</div>
	@endif
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

		@if($tentangKami)
		<div class="card mb-6">
			<div class="card-header border-0 pt-6">
				<div class="card-title">
					<h3 class="card-label fw-bold text-gray-900">Data Tentang Kami</h3>
				</div>
				<div class="card-toolbar gap-2">
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_tentang">
						<i class="ki-outline ki-pencil fs-2"></i> Edit
					</button>
					<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_tentang">
						<i class="ki-outline ki-trash fs-2"></i> Hapus
					</button>
				</div>
			</div>
			<div class="card-body py-6">
				<div class="row g-8">
					<div class="col-md-6">
						<div class="mb-6">
							<span class="fw-bold text-gray-500 fs-7 text-uppercase d-block mb-2">Sejarah</span>
							<div class="text-gray-800 fs-6 ck-content">{!! $tentangKami->sejarah !!}</div>
						</div>
						<div class="mb-6">
							<span class="fw-bold text-gray-500 fs-7 text-uppercase d-block mb-2">Latar Belakang</span>
							<div class="text-gray-800 fs-6 ck-content">{!! $tentangKami->latarBelakang !!}</div>
						</div>
						<div class="mb-6">
							<span class="fw-bold text-gray-500 fs-7 text-uppercase d-block mb-2">Nilai</span>
							<div class="text-gray-800 fs-6 ck-content">{!! $tentangKami->nilai !!}</div>
						</div>
						<div class="mb-6">
							<span class="fw-bold text-gray-500 fs-7 text-uppercase d-block mb-2">Dasar Hukum</span>
							<div class="text-gray-800 fs-6 ck-content">{!! $tentangKami->dasarHukum !!}</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-6">
							<span class="fw-bold text-gray-500 fs-7 text-uppercase d-block mb-2">Visi</span>
							<div class="text-gray-800 fs-6 ck-content">{!! $tentangKami->Visi !!}</div>
						</div>
						<div class="mb-6">
							<span class="fw-bold text-gray-500 fs-7 text-uppercase d-block mb-2">Misi</span>
							<div class="text-gray-800 fs-6 ck-content">{!! $tentangKami->Misi !!}</div>
						</div>
						<div class="mb-6">
							<span class="fw-bold text-gray-500 fs-7 text-uppercase d-block mb-2">Tujuan Utama</span>
							<div class="text-gray-800 fs-6 ck-content">{!! $tentangKami->tujuanUtama !!}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="card">
			<div class="card-body py-20 text-center">
				<i class="ki-outline ki-information-5 fs-5tx text-muted mb-5 d-block"></i>
				<p class="text-gray-600 fs-5 mb-5">Belum ada data Tentang Kami.</p>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_tentang">
					<i class="ki-outline ki-plus fs-2"></i> Tambah Data Sekarang
				</button>
			</div>
		</div>
		@endif

	</div>
</div>

{{-- Modal Tambah --}}
@if(!$tentangKami)
<div class="modal fade" id="modal_tambah_tentang" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-900px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Tambah Data Tentang Kami</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_tambah_tentang" action="{{ route('admin.tentangKami.store') }}">
				@csrf
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">

					{{-- Seksi 1: Sejarah & Latar Belakang --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-book fs-6 me-1"></i> Sejarah & Latar Belakang
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Sejarah</label>
									<div class="border rounded overflow-hidden">
										<textarea id="tambah_sejarah" name="sejarah">{!! old('sejarah') !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Latar Belakang</label>
									<div class="border rounded overflow-hidden">
										<textarea id="tambah_latarBelakang" name="latarBelakang">{!! old('latarBelakang') !!}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 2: Visi & Misi --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-target fs-6 me-1"></i> Visi & Misi
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Visi</label>
									<div class="border rounded overflow-hidden">
										<textarea id="tambah_Visi" name="Visi">{!! old('Visi') !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Misi</label>
									<div class="border rounded overflow-hidden">
										<textarea id="tambah_Misi" name="Misi">{!! old('Misi') !!}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 3: Nilai, Tujuan & Dasar Hukum --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-shield-tick fs-6 me-1"></i> Nilai, Tujuan & Dasar Hukum
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nilai</label>
									<div class="border rounded overflow-hidden">
										<textarea id="tambah_nilai" name="nilai">{!! old('nilai') !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Tujuan Utama</label>
									<div class="border rounded overflow-hidden">
										<textarea id="tambah_tujuanUtama" name="tujuanUtama">{!! old('tujuanUtama') !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Dasar Hukum</label>
									<div class="border rounded overflow-hidden">
										<textarea id="tambah_dasarHukum" name="dasarHukum">{!! old('dasarHukum') !!}</textarea>
									</div>
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
@endif

{{-- Modal Edit --}}
@if($tentangKami)
<div class="modal fade" id="modal_edit_tentang" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-900px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Edit Data Tentang Kami</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_edit_tentang" action="{{ route('admin.tentangKami.update', $tentangKami) }}">
				@csrf
				@method('PUT')
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">

					<div class="alert alert-light-primary d-flex align-items-center p-4 mb-6">
						<i class="ki-outline ki-information-5 fs-2x text-primary me-4 flex-shrink-0"></i>
						<div>
							<span class="fw-semibold text-gray-700">Edit Data Tentang Kami</span>
							<div class="text-muted fs-7 mt-1">Data saat ini sudah terisi di semua editor — ubah hanya bagian yang perlu diperbarui.</div>
						</div>
					</div>

					{{-- Seksi 1: Sejarah & Latar Belakang --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-book fs-6 me-1"></i> Sejarah & Latar Belakang
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Sejarah</label>
									<div class="border rounded overflow-hidden">
										<textarea id="edit_sejarah" name="sejarah">{!! old('sejarah', $tentangKami->sejarah) !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Latar Belakang</label>
									<div class="border rounded overflow-hidden">
										<textarea id="edit_latarBelakang" name="latarBelakang">{!! old('latarBelakang', $tentangKami->latarBelakang) !!}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 2: Visi & Misi --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-target fs-6 me-1"></i> Visi & Misi
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Visi</label>
									<div class="border rounded overflow-hidden">
										<textarea id="edit_Visi" name="Visi">{!! old('Visi', $tentangKami->Visi) !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Misi</label>
									<div class="border rounded overflow-hidden">
										<textarea id="edit_Misi" name="Misi">{!! old('Misi', $tentangKami->Misi) !!}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="separator separator-dashed my-6"></div>

					{{-- Seksi 3: Nilai, Tujuan & Dasar Hukum --}}
					<div class="mb-5">
						<h6 class="fw-bold text-gray-700 fs-7 text-uppercase mb-4">
							<i class="ki-outline ki-shield-tick fs-6 me-1"></i> Nilai, Tujuan & Dasar Hukum
						</h6>
						<div class="row g-5">
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Nilai</label>
									<div class="border rounded overflow-hidden">
										<textarea id="edit_nilai" name="nilai">{!! old('nilai', $tentangKami->nilai) !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Tujuan Utama</label>
									<div class="border rounded overflow-hidden">
										<textarea id="edit_tujuanUtama" name="tujuanUtama">{!! old('tujuanUtama', $tentangKami->tujuanUtama) !!}</textarea>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="fv-row mb-7">
									<label class="required fw-semibold fs-6 mb-2">Dasar Hukum</label>
									<div class="border rounded overflow-hidden">
										<textarea id="edit_dasarHukum" name="dasarHukum">{!! old('dasarHukum', $tentangKami->dasarHukum) !!}</textarea>
									</div>
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

{{-- Modal Hapus --}}
<div class="modal fade" id="modal_hapus_tentang" tabindex="-1" aria-hidden="true">
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
				<p class="fs-5 text-gray-700 mb-1">Yakin ingin menghapus data Tentang Kami?</p>
				<p class="text-muted fs-6">Data yang dihapus tidak dapat dikembalikan.</p>
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
				<form method="POST" action="{{ route('admin.tentangKami.destroy', $tentangKami) }}">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Hapus</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endif
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script>
(function () {
    @if(!$tentangKami)
    var tambahEditors = {};
    var tambahFields  = [
        'tambah_sejarah', 'tambah_latarBelakang', 'tambah_Visi',
        'tambah_Misi', 'tambah_nilai', 'tambah_tujuanUtama', 'tambah_dasarHukum'
    ];

    document.getElementById('modal_tambah_tentang').addEventListener('shown.bs.modal', function () {
        tambahFields.forEach(function (id) {
            if (!tambahEditors[id]) {
                ClassicEditor.create(document.getElementById(id)).then(function (editor) {
                    tambahEditors[id] = editor;
                });
            }
        });
    });

    document.getElementById('form_tambah_tentang').addEventListener('submit', function () {
        tambahFields.forEach(function (id) {
            if (tambahEditors[id]) {
                document.getElementById(id).value = tambahEditors[id].getData();
            }
        });
    });
    @endif

    @if($tentangKami)
    var editEditors = {};
    var editFields  = [
        'edit_sejarah', 'edit_latarBelakang', 'edit_Visi',
        'edit_Misi', 'edit_nilai', 'edit_tujuanUtama', 'edit_dasarHukum'
    ];

    document.getElementById('modal_edit_tentang').addEventListener('shown.bs.modal', function () {
        editFields.forEach(function (id) {
            if (!editEditors[id]) {
                ClassicEditor.create(document.getElementById(id)).then(function (editor) {
                    editEditors[id] = editor;
                });
            }
        });
    });

    document.getElementById('form_edit_tentang').addEventListener('submit', function () {
        editFields.forEach(function (id) {
            if (editEditors[id]) {
                document.getElementById(id).value = editEditors[id].getData();
            }
        });
    });
    @endif
})();
</script>
@endsection
