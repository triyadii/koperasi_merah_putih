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
.gambar-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
.gambar-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    border: 1px dashed #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f8fa;
    color: #a1a5b7;
}
.gambar-preview-modal {
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
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manajemen Pengumuman</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
			<li class="breadcrumb-item text-gray-900">Pengumuman</li>
		</ul>
	</div>
	<div class="d-flex align-items-center gap-2 gap-lg-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_pengumuman">
			<i class="ki-outline ki-plus fs-2"></i> Tambah Pengumuman
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
					<span class="text-muted fw-semibold fs-7">Total: {{ $pengumumans->total() }} pengumuman</span>
				</div>
			</div>
			<div class="card-body py-4">
				<div class="table-responsive">
					<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
						<thead>
							<tr class="fw-bold text-muted bg-light">
								<th class="ps-4 w-40px rounded-start">#</th>
								<th class="w-70px">Gambar</th>
								<th>Judul</th>
								<th class="w-120px">Status</th>
								<th class="pe-4 text-end rounded-end">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse($pengumumans as $item)
							<tr>
								<td class="ps-4">
									<span class="text-muted fw-semibold">{{ ($pengumumans->currentPage() - 1) * $pengumumans->perPage() + $loop->iteration }}</span>
								</td>
								<td>
									@if($item->gambar)
									<img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="gambar-thumb">
									@else
									<div class="gambar-placeholder"><i class="ki-outline ki-picture fs-4"></i></div>
									@endif
								</td>
								<td>
									<span class="text-gray-900 fw-bold fs-6">{{ $item->judul }}</span>
								</td>
								<td>
									@if($item->status === 'published')
									<span class="badge badge-light-success fs-7">Published</span>
									@else
									<span class="badge badge-light-warning fs-7">Draft</span>
									@endif
								</td>
								<td class="text-end pe-4">
									{{-- Edit --}}
									<button type="button"
										class="btn btn-icon btn-light-primary btn-sm me-1"
										data-bs-toggle="modal"
										data-bs-target="#modal_edit_pengumuman"
										data-item="{{ json_encode($item->toArray()) }}"
										data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
										onclick="setEditData(this)">
										<i class="ki-outline ki-pencil fs-4"></i>
									</button>

									{{-- Hapus --}}
									<button type="button"
										class="btn btn-icon btn-light-danger btn-sm me-1"
										data-bs-toggle="modal"
										data-bs-target="#modal_hapus_pengumuman"
										data-id="{{ $item->id }}"
										data-judul="{{ $item->judul }}"
										onclick="setHapusData(this)">
										<i class="ki-outline ki-trash fs-4"></i>
									</button>

									{{-- Publish --}}
									<form method="POST" action="{{ route('admin.pengumuman.publish', $item) }}" class="d-inline">
										@csrf
										@method('PATCH')
										@if($item->status === 'published')
										<button type="submit" class="btn btn-sm btn-light-warning">
											<i class="ki-outline ki-archive fs-5 me-1"></i>Arsipkan
										</button>
										@else
										<button type="submit" class="btn btn-sm btn-light-success">
											<i class="ki-outline ki-send fs-5 me-1"></i>Publish
										</button>
										@endif
									</form>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="5" class="text-center py-15">
									<i class="ki-outline ki-notification fs-5tx text-muted mb-5 d-block"></i>
									<p class="text-gray-600 fs-5 mb-0">Belum ada data pengumuman.</p>
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				@if ($pengumumans->hasPages())
				<div class="d-flex justify-content-between align-items-center mt-4">
					<div class="text-muted fs-7">
						Menampilkan {{ $pengumumans->firstItem() }} – {{ $pengumumans->lastItem() }} dari {{ $pengumumans->total() }} pengumuman
					</div>
					<ul class="pagination">
						<li class="page-item previous {{ $pengumumans->onFirstPage() ? 'disabled' : '' }}">
							<a href="{{ $pengumumans->previousPageUrl() ?? '#' }}" class="page-link"><i class="previous"></i></a>
						</li>
						@foreach ($pengumumans->getUrlRange(1, $pengumumans->lastPage()) as $page => $url)
						<li class="page-item {{ $page == $pengumumans->currentPage() ? 'active' : '' }}">
							<a href="{{ $url }}" class="page-link">{{ $page }}</a>
						</li>
						@endforeach
						<li class="page-item next {{ !$pengumumans->hasMorePages() ? 'disabled' : '' }}">
							<a href="{{ $pengumumans->nextPageUrl() ?? '#' }}" class="page-link"><i class="next"></i></a>
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
<div class="modal fade" id="modal_tambah_pengumuman" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-800px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Tambah Pengumuman</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_tambah_pengumuman" action="{{ route('admin.pengumuman.store') }}" enctype="multipart/form-data">
				@csrf
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Judul Pengumuman</label>
						<input type="text" name="judul" class="form-control form-control-solid" placeholder="Judul pengumuman" required>
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Gambar <span class="text-muted fs-7 fw-normal">(opsional)</span></label>
						<input type="file" name="gambar" id="tambah_gambar" class="form-control form-control-solid" accept="image/*" onchange="previewGambar(this, 'tambah_gambar_preview')">
						<img id="tambah_gambar_preview" class="gambar-preview-modal" alt="Preview">
						<div class="form-text text-muted">Format: JPG, PNG, WEBP. Maks. 2MB.</div>
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

{{-- ============================================================ --}}
{{-- Modal Edit --}}
{{-- ============================================================ --}}
<div class="modal fade" id="modal_edit_pengumuman" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-800px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Edit Pengumuman</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_edit_pengumuman" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="modal-body px-5 py-8" style="max-height: 65vh; overflow-y: auto;">
					<div class="alert alert-light-primary d-flex align-items-center p-4 mb-6">
						<i class="ki-outline ki-information-5 fs-2x text-primary me-4 flex-shrink-0"></i>
						<div>
							<span class="fw-semibold text-gray-700">Mengedit pengumuman: </span>
							<span class="fw-bold text-primary" id="edit_info_judul"></span>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Judul Pengumuman</label>
						<input type="text" id="edit_judul" name="judul" class="form-control form-control-solid" required>
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">Gambar <span class="text-muted fs-7 fw-normal">(kosongkan jika tidak diubah)</span></label>
						<div id="edit_gambar_current" class="mb-3" style="display:none;">
							<p class="text-muted fs-7 mb-2">Gambar saat ini:</p>
							<img id="edit_gambar_current_img" src="" alt="Gambar" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
						</div>
						<input type="file" name="gambar" id="edit_gambar" class="form-control form-control-solid" accept="image/*" onchange="previewGambar(this, 'edit_gambar_preview')">
						<img id="edit_gambar_preview" class="gambar-preview-modal" alt="Preview Baru">
						<div class="form-text text-muted">Format: JPG, PNG, WEBP. Maks. 2MB.</div>
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

{{-- ============================================================ --}}
{{-- Modal Hapus --}}
{{-- ============================================================ --}}
<div class="modal fade" id="modal_hapus_pengumuman" tabindex="-1" aria-hidden="true">
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
				<p class="fs-5 text-gray-700 mb-1">Yakin ingin menghapus pengumuman:</p>
				<p class="fw-bold fs-4 text-gray-900 mb-3" id="hapus_judul_pengumuman"></p>
				<p class="text-muted fs-6">Data yang dihapus tidak dapat dikembalikan.</p>
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
				<form id="form_hapus_pengumuman" method="POST">
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

    window.previewGambar = function (input, previewId) {
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

    // ---- Tambah ----
    var tambahPengumumanEditor = null;

    document.getElementById('modal_tambah_pengumuman').addEventListener('shown.bs.modal', function () {
        if (!tambahPengumumanEditor) {
            ClassicEditor.create(document.getElementById('tambah_keterangan')).then(function (editor) {
                tambahPengumumanEditor = editor;
            });
        }
    });

    document.getElementById('form_tambah_pengumuman').addEventListener('submit', function () {
        if (tambahPengumumanEditor) {
            document.getElementById('tambah_keterangan').value = tambahPengumumanEditor.getData();
        }
    });

    document.getElementById('modal_tambah_pengumuman').addEventListener('hidden.bs.modal', function () {
        document.getElementById('form_tambah_pengumuman').reset();
        if (tambahPengumumanEditor) { tambahPengumumanEditor.setData(''); }
        var prev = document.getElementById('tambah_gambar_preview');
        prev.src = ''; prev.style.display = 'none';
    });

    // ---- Edit ----
    var editPengumumanEditor = null;
    var pendingEditKet       = null;

    window.setEditData = function (btn) {
        var item      = JSON.parse(btn.getAttribute('data-item'));
        var gambarUrl = btn.getAttribute('data-gambar');

        document.getElementById('form_edit_pengumuman').action    = '{{ url("admin/pengumuman") }}/' + item.id;
        document.getElementById('edit_info_judul').textContent    = item.judul || '-';
        document.getElementById('edit_judul').value               = item.judul || '';

        pendingEditKet = item.keterangan || '';

        var currentDiv = document.getElementById('edit_gambar_current');
        var currentImg = document.getElementById('edit_gambar_current_img');
        if (gambarUrl) {
            currentImg.src = gambarUrl;
            currentDiv.style.display = 'block';
        } else {
            currentDiv.style.display = 'none';
            currentImg.src = '';
        }
    };

    document.getElementById('modal_edit_pengumuman').addEventListener('shown.bs.modal', function () {
        if (!editPengumumanEditor) {
            ClassicEditor.create(document.getElementById('edit_keterangan')).then(function (editor) {
                editPengumumanEditor = editor;
                if (pendingEditKet !== null) {
                    editor.setData(pendingEditKet);
                    pendingEditKet = null;
                }
            });
        } else if (pendingEditKet !== null) {
            editPengumumanEditor.setData(pendingEditKet);
            pendingEditKet = null;
        }
    });

    document.getElementById('form_edit_pengumuman').addEventListener('submit', function () {
        if (editPengumumanEditor) {
            document.getElementById('edit_keterangan').value = editPengumumanEditor.getData();
        }
    });

    document.getElementById('modal_edit_pengumuman').addEventListener('hidden.bs.modal', function () {
        document.getElementById('edit_gambar').value = '';
        var prev = document.getElementById('edit_gambar_preview');
        prev.src = ''; prev.style.display = 'none';
    });

    // ---- Hapus ----
    window.setHapusData = function (btn) {
        document.getElementById('hapus_judul_pengumuman').textContent = btn.getAttribute('data-judul');
        document.getElementById('form_hapus_pengumuman').action       = '{{ url("admin/pengumuman") }}/' + btn.getAttribute('data-id');
    };

})();
</script>
@endsection
