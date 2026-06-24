@extends('admin.layouts.app')

@section('styles')
<style>
.ck.ck-editor__editable {
    background-color: #ffffff !important;
    color: #181C32 !important;
    min-height: 150px;
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
.foto-preview {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
.foto-preview-modal {
    width: 100%;
    max-height: 200px;
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
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Unit Usaha</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-500 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-gray-900">Unit Usaha</li>
		</ul>
	</div>
	<div class="d-flex align-items-center gap-2 gap-lg-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_usaha">
			<i class="ki-outline ki-plus fs-2"></i> Tambah Unit Usaha
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
					<span class="text-muted fw-semibold fs-7">Total: {{ $unitUsahas->total() }} unit usaha</span>
				</div>
			</div>
			<div class="card-body py-4">
				<div class="table-responsive">
					<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
						<thead>
							<tr class="fw-bold text-muted bg-light">
								<th class="ps-4 w-40px rounded-start">#</th>
								<th class="w-80px">Foto</th>
								<th>Nama Usaha</th>
								<th>Keterangan</th>
								<th class="pe-4 text-end rounded-end">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse($unitUsahas as $item)
							<tr>
								<td class="ps-4">
									<span class="text-muted fw-semibold">{{ ($unitUsahas->currentPage() - 1) * $unitUsahas->perPage() + $loop->iteration }}</span>
								</td>
								<td>
									@if($item->foto)
									<img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->namaUsaha }}" class="foto-preview">
									@else
									<div class="foto-preview d-flex align-items-center justify-content-center bg-light text-muted">
										<i class="ki-outline ki-picture fs-3"></i>
									</div>
									@endif
								</td>
								<td>
									<span class="text-gray-900 fw-bold fs-6">{{ $item->namaUsaha }}</span>
								</td>
								<td>
									<div class="text-muted fs-7" style="max-width: 360px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
										{{ strip_tags($item->keterangan) }}
									</div>
								</td>
								<td class="text-end pe-4">
									<button type="button"
										class="btn btn-icon btn-light-primary btn-sm me-1"
										data-bs-toggle="modal"
										data-bs-target="#modal_edit_usaha"
										data-id="{{ $item->id }}"
										data-nama="{{ $item->namaUsaha }}"
										data-foto="{{ $item->foto ? asset('storage/' . $item->foto) : '' }}"
										data-keterangan="{{ htmlspecialchars($item->keterangan, ENT_QUOTES) }}"
										onclick="setEditData(this)">
										<i class="ki-outline ki-pencil fs-4"></i>
									</button>
									<button type="button"
										class="btn btn-icon btn-light-danger btn-sm"
										data-bs-toggle="modal"
										data-bs-target="#modal_hapus_usaha"
										data-id="{{ $item->id }}"
										data-nama="{{ $item->namaUsaha }}"
										onclick="setHapusData(this)">
										<i class="ki-outline ki-trash fs-4"></i>
									</button>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="5" class="text-center py-15">
									<i class="ki-outline ki-briefcase fs-5tx text-muted mb-5 d-block"></i>
									<p class="text-gray-600 fs-5 mb-0">Belum ada data unit usaha.</p>
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<div class="d-flex justify-content-end mt-4">
					{{ $unitUsahas->links() }}
				</div>
			</div>
		</div>

	</div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modal_tambah_usaha" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-700px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Tambah Unit Usaha</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_tambah_usaha" action="{{ route('admin.unitUsaha.store') }}" enctype="multipart/form-data">
				@csrf
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Nama Usaha</label>
						<input type="text" name="namaUsaha" class="form-control form-control-solid" placeholder="Masukkan nama unit usaha" maxlength="200" required>
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Foto Unit Usaha</label>
						<input type="file" name="foto" id="tambah_foto" class="form-control form-control-solid" accept="image/*" onchange="previewFoto(this, 'tambah_foto_preview')">
						<img id="tambah_foto_preview" class="foto-preview-modal" alt="Preview Foto">
						<div class="form-text text-muted">Format: JPG, PNG, WEBP. Maks. 2MB. (Opsional)</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Keterangan</label>
						<div class="border rounded overflow-hidden">
							<textarea id="tambah_keterangan" name="keterangan"></textarea>
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

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit_usaha" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-700px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Edit Unit Usaha</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_edit_usaha" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">
					<div class="alert alert-light-primary d-flex align-items-center p-4 mb-6">
						<i class="ki-outline ki-information-5 fs-2x text-primary me-4 flex-shrink-0"></i>
						<div>
							<span class="fw-semibold text-gray-700">Mengedit unit usaha: </span>
							<span class="fw-bold text-primary" id="edit_usaha_info_nama"></span>
							<div class="text-muted fs-7 mt-1">Data saat ini sudah terisi di form — ubah hanya bagian yang perlu diperbarui.</div>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Nama Usaha</label>
						<input type="text" id="edit_namaUsaha" name="namaUsaha" class="form-control form-control-solid" maxlength="200" required>
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Foto Unit Usaha</label>
						<div id="edit_foto_current" class="mb-3" style="display:none;">
							<p class="text-muted fs-7 mb-2">Foto saat ini:</p>
							<img id="edit_foto_current_img" src="" alt="Foto Saat Ini" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
						</div>
						<input type="file" name="foto" id="edit_foto" class="form-control form-control-solid" accept="image/*" onchange="previewFoto(this, 'edit_foto_preview')">
						<img id="edit_foto_preview" class="foto-preview-modal" alt="Preview Foto Baru">
						<div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP. Maks. 2MB.</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Keterangan</label>
						<div class="border rounded overflow-hidden">
							<textarea id="edit_keterangan" name="keterangan"></textarea>
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

{{-- Modal Hapus --}}
<div class="modal fade" id="modal_hapus_usaha" tabindex="-1" aria-hidden="true">
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
				<p class="fs-5 text-gray-700 mb-1">Yakin ingin menghapus unit usaha:</p>
				<p class="fw-bold fs-4 text-gray-900 mb-3" id="hapus_namaUsaha"></p>
				<p class="text-muted fs-6">Data yang dihapus tidak dapat dikembalikan.</p>
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
				<form id="form_hapus_usaha" method="POST">
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
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script>
(function () {
    var editorTambah = null;
    var editorEdit   = null;
    var pendingEditKeterangan = null;

    // --- Preview foto sebelum upload ---
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

    // --- Modal Tambah ---
    document.getElementById('modal_tambah_usaha').addEventListener('shown.bs.modal', function () {
        if (editorTambah) return;
        ClassicEditor.create(document.getElementById('tambah_keterangan'))
            .then(function (editor) { editorTambah = editor; })
            .catch(console.error);
    });

    document.getElementById('modal_tambah_usaha').addEventListener('hidden.bs.modal', function () {
        if (editorTambah) {
            editorTambah.destroy().then(function () { editorTambah = null; });
        }
        document.getElementById('tambah_foto').value = '';
        document.getElementById('tambah_foto_preview').src = '';
        document.getElementById('tambah_foto_preview').style.display = 'none';
    });

    document.getElementById('form_tambah_usaha').addEventListener('submit', function () {
        if (editorTambah) {
            document.getElementById('tambah_keterangan').value = editorTambah.getData();
        }
    });

    // --- Modal Edit ---
    document.getElementById('modal_edit_usaha').addEventListener('shown.bs.modal', function () {
        if (editorEdit) {
            if (pendingEditKeterangan !== null) {
                editorEdit.setData(pendingEditKeterangan);
                pendingEditKeterangan = null;
            }
            return;
        }
        ClassicEditor.create(document.getElementById('edit_keterangan'))
            .then(function (editor) {
                editorEdit = editor;
                if (pendingEditKeterangan !== null) {
                    editor.setData(pendingEditKeterangan);
                    pendingEditKeterangan = null;
                }
            })
            .catch(console.error);
    });

    document.getElementById('modal_edit_usaha').addEventListener('hidden.bs.modal', function () {
        if (editorEdit) {
            editorEdit.destroy().then(function () { editorEdit = null; });
        }
        document.getElementById('edit_foto').value = '';
        document.getElementById('edit_foto_preview').src = '';
        document.getElementById('edit_foto_preview').style.display = 'none';
    });

    document.getElementById('form_edit_usaha').addEventListener('submit', function () {
        if (editorEdit) {
            document.getElementById('edit_keterangan').value = editorEdit.getData();
        }
    });

    // --- Set data untuk modal Edit ---
    window.setEditData = function (btn) {
        var id         = btn.getAttribute('data-id');
        var nama       = btn.getAttribute('data-nama');
        var foto       = btn.getAttribute('data-foto');
        var keterangan = btn.getAttribute('data-keterangan');

        document.getElementById('edit_namaUsaha').value = nama;
        document.getElementById('form_edit_usaha').action = '{{ url("admin/unitUsaha") }}/' + id;
        document.getElementById('edit_usaha_info_nama').textContent = nama;

        // Tampilkan foto saat ini jika ada
        var currentDiv = document.getElementById('edit_foto_current');
        var currentImg = document.getElementById('edit_foto_current_img');
        if (foto) {
            currentImg.src = foto;
            currentDiv.style.display = 'block';
        } else {
            currentDiv.style.display = 'none';
            currentImg.src = '';
        }

        pendingEditKeterangan = keterangan;
        if (editorEdit) {
            editorEdit.setData(keterangan);
            pendingEditKeterangan = null;
        }
    };

    // --- Set data untuk modal Hapus ---
    window.setHapusData = function (btn) {
        var id   = btn.getAttribute('data-id');
        var nama = btn.getAttribute('data-nama');
        document.getElementById('hapus_namaUsaha').textContent = nama;
        document.getElementById('form_hapus_usaha').action = '{{ url("admin/unitUsaha") }}/' + id;
    };
})();
</script>
@endsection
