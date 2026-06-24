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
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manajemen Konten</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-500 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-gray-900">Manajemen Konten</li>
		</ul>
	</div>
	@if(!$konten)
	<div class="d-flex align-items-center gap-2 gap-lg-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_konten">
			<i class="ki-outline ki-plus fs-2"></i> Tambah Konten
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

		@if($konten)
		<div class="card mb-6">
			<div class="card-header border-0 pt-6">
				<div class="card-title">
					<h3 class="card-label fw-bold text-gray-900">Informasi Koperasi</h3>
				</div>
				<div class="card-toolbar gap-2">
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_konten">
						<i class="ki-outline ki-pencil fs-2"></i> Edit Konten
					</button>
					<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_konten">
						<i class="ki-outline ki-trash fs-2"></i> Hapus
					</button>
				</div>
			</div>
			<div class="card-body py-6">
				<div class="row g-6">
					<div class="col-md-4 text-center">
						<span class="fw-bold text-gray-700 fs-6 d-block mb-3">Logo Koperasi</span>
						<img src="{{ asset('storage/' . $konten->logoKoperasi) }}"
							alt="Logo {{ $konten->namaKoperasi }}"
							class="mw-200px mh-150px object-fit-contain border rounded p-2" />
					</div>
					<div class="col-md-8">
						<div class="mb-5">
							<span class="fw-bold text-gray-500 fs-7 d-block mb-1">Nama Koperasi</span>
							<span class="fw-bold text-gray-900 fs-4">{{ $konten->namaKoperasi }}</span>
						</div>
						<div class="mb-5">
							<span class="fw-bold text-gray-500 fs-7 d-block mb-1">Tagline</span>
							<div class="text-gray-700 fs-6 ck-content">{!! $konten->tagline !!}</div>
						</div>
					</div>
					<div class="col-12">
						<span class="fw-bold text-gray-500 fs-7 d-block mb-3">Keterangan Banner Program</span>
						<div class="text-gray-700 fs-6 ck-content">{!! $konten->bannerProgram !!}</div>
					</div>
					<div class="col-md-6">
						<span class="fw-bold text-gray-500 fs-7 d-block mb-1">Kontak / Nomor HP</span>
						@if($konten->kontak)
						<a href="tel:{{ $konten->kontak }}" class="fw-bold text-gray-900 fs-6 text-hover-primary">{{ $konten->kontak }}</a>
						@else
						<span class="text-muted fs-6">-</span>
						@endif
					</div>
					<div class="col-md-6">
						<span class="fw-bold text-gray-500 fs-7 d-block mb-1">Lokasi (Google Maps)</span>
						@if($konten->lokasi)
						<a href="{{ $konten->lokasi }}" target="_blank" rel="noopener" class="btn btn-sm btn-light-primary">
							<i class="ki-outline ki-geolocation fs-5 me-1"></i>Lihat Peta
						</a>
						@else
						<span class="text-muted fs-6">-</span>
						@endif
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="card">
			<div class="card-body py-20 text-center">
				<i class="ki-outline ki-document fs-5tx text-muted mb-5 d-block"></i>
				<p class="text-gray-600 fs-5 mb-5">Belum ada data konten koperasi.</p>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_konten">
					<i class="ki-outline ki-plus fs-2"></i> Tambah Konten Sekarang
				</button>
			</div>
		</div>
		@endif

	</div>
</div>

{{-- Modal Tambah --}}
@if(!$konten)
<div class="modal fade" id="modal_tambah_konten" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-700px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Tambah Konten Koperasi</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_tambah_konten" action="{{ route('admin.konten.store') }}" enctype="multipart/form-data">
				@csrf
				<div class="modal-body px-5 py-10" style="max-height: 65vh; overflow-y: auto;">
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Nama Koperasi</label>
						<input type="text" name="namaKoperasi" class="form-control form-control-solid"
							placeholder="Masukkan nama koperasi" value="{{ old('namaKoperasi') }}" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Logo Koperasi</label>
						<input type="file" name="logoKoperasi" class="form-control form-control-solid" accept="image/*" required />
						<span class="text-muted fs-7">Format: JPG, PNG, SVG. Maks. 2MB</span>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Tagline</label>
						<div class="border rounded overflow-hidden">
							<textarea id="tambah_tagline" name="tagline">{!! old('tagline') !!}</textarea>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Keterangan Banner Program</label>
						<div class="border rounded overflow-hidden">
							<textarea id="tambah_bannerProgram" name="bannerProgram">{!! old('bannerProgram') !!}</textarea>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Kontak / Nomor HP <span class="text-muted fs-7 fw-normal">(opsional)</span></label>
						<input type="text" name="kontak" class="form-control form-control-solid" placeholder="08xxxxxxxxxx" maxlength="20" value="{{ old('kontak') }}">
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Lokasi (Link Google Maps) <span class="text-muted fs-7 fw-normal">(opsional)</span></label>
						<input type="text" name="lokasi" class="form-control form-control-solid" placeholder="https://maps.google.com/..." value="{{ old('lokasi') }}">
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
@if($konten)
<div class="modal fade" id="modal_edit_konten" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-700px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Edit Konten Koperasi</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_edit_konten" action="{{ route('admin.konten.update', $konten) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="modal-body px-5 py-10" style="max-height: 65vh; overflow-y: auto;">
					<div class="alert alert-light-primary d-flex align-items-center p-4 mb-6">
						<i class="ki-outline ki-information-5 fs-2x text-primary me-4 flex-shrink-0"></i>
						<div>
							<span class="fw-semibold text-gray-700">Mengedit konten: </span>
							<span class="fw-bold text-primary">{{ $konten->namaKoperasi }}</span>
							<div class="text-muted fs-7 mt-1">Data saat ini sudah terisi di form berikut — ubah hanya bagian yang perlu diperbarui.</div>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Nama Koperasi</label>
						<input type="text" name="namaKoperasi" class="form-control form-control-solid"
							value="{{ old('namaKoperasi', $konten->namaKoperasi) }}" required />
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">
							Logo Koperasi
							<span class="text-muted fs-7 fw-normal">(kosongkan jika tidak diubah)</span>
						</label>
						<input type="file" name="logoKoperasi" class="form-control form-control-solid" accept="image/*" />
						<span class="text-muted fs-7">Format: JPG, PNG, SVG. Maks. 2MB</span>
						<div class="mt-2 d-flex align-items-center gap-3">
							<img src="{{ asset('storage/' . $konten->logoKoperasi) }}" alt="Logo saat ini" class="h-50px rounded border" />
							<span class="text-muted fs-7">Logo saat ini</span>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Tagline</label>
						<div class="border rounded overflow-hidden">
							<textarea id="edit_tagline" name="tagline">{!! old('tagline', $konten->tagline) !!}</textarea>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Keterangan Banner Program</label>
						<div class="border rounded overflow-hidden">
							<textarea id="edit_bannerProgram" name="bannerProgram">{!! old('bannerProgram', $konten->bannerProgram) !!}</textarea>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Kontak / Nomor HP <span class="text-muted fs-7 fw-normal">(opsional)</span></label>
						<input type="text" name="kontak" class="form-control form-control-solid" placeholder="08xxxxxxxxxx" maxlength="20" value="{{ old('kontak', $konten->kontak) }}">
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Lokasi (Link Google Maps) <span class="text-muted fs-7 fw-normal">(opsional)</span></label>
						<input type="text" name="lokasi" class="form-control form-control-solid" placeholder="https://maps.google.com/..." value="{{ old('lokasi', $konten->lokasi) }}">
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
<div class="modal fade" id="modal_hapus_konten" tabindex="-1" aria-hidden="true">
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
				<p class="fs-5 text-gray-700 mb-1">Yakin ingin menghapus data konten koperasi?</p>
				<p class="text-muted fs-6">Data yang dihapus tidak dapat dikembalikan.</p>
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
				<form method="POST" action="{{ route('admin.konten.destroy', $konten) }}">
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
    @if(!$konten)
    var tambahEditors = {};
    var tambahFields  = ['tambah_tagline', 'tambah_bannerProgram'];

    document.getElementById('modal_tambah_konten').addEventListener('shown.bs.modal', function () {
        tambahFields.forEach(function (id) {
            if (!tambahEditors[id]) {
                ClassicEditor.create(document.getElementById(id)).then(function (editor) {
                    tambahEditors[id] = editor;
                });
            }
        });
    });

    document.getElementById('form_tambah_konten').addEventListener('submit', function () {
        tambahFields.forEach(function (id) {
            if (tambahEditors[id]) {
                document.getElementById(id).value = tambahEditors[id].getData();
            }
        });
    });
    @endif

    @if($konten)
    var editEditors = {};
    var editFields  = ['edit_tagline', 'edit_bannerProgram'];

    document.getElementById('modal_edit_konten').addEventListener('shown.bs.modal', function () {
        editFields.forEach(function (id) {
            if (!editEditors[id]) {
                ClassicEditor.create(document.getElementById(id)).then(function (editor) {
                    editEditors[id] = editor;
                });
            }
        });
    });

    document.getElementById('form_edit_konten').addEventListener('submit', function () {
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
