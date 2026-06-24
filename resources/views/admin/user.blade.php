@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar d-flex flex-stack py-4 py-lg-8">
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manajemen User</h1>
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-muted">
				<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
			</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-500 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-gray-900">Manajemen User</li>
		</ul>
	</div>
	<div class="d-flex align-items-center gap-2 gap-lg-3">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_user">
			<i class="ki-outline ki-plus fs-2"></i> Tambah User
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
					<h3 class="card-label fw-bold text-gray-900">Daftar User</h3>
				</div>
			</div>
			<div class="card-body py-4">
				<div class="table-responsive">
					<table class="table align-middle table-row-dashed fs-6 gy-5">
						<thead>
							<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
								<th class="w-50px">No</th>
								<th>Username</th>
								<th>Email</th>
								<th class="w-150px">Status</th>
								<th class="text-end min-w-150px">Aksi</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-semibold">
							@forelse($users as $i => $user)
							<tr>
								<td>{{ $users->firstItem() + $i }}</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
											<div class="symbol-label fs-3 bg-light-primary text-primary">
												{{ strtoupper(substr($user->username, 0, 1)) }}
											</div>
										</div>
										<span class="text-gray-800 fw-bold">{{ $user->username }}</span>
									</div>
								</td>
								<td>
									<span class="text-gray-800">{{ $user->email }}</span>
								</td>
								<td>
									@if($user->status)
										<span class="badge badge-light-success fs-7 fw-bold">Aktif</span>
									@else
										<span class="badge badge-light-danger fs-7 fw-bold">Tidak Aktif</span>
									@endif
								</td>
								<td class="text-end">
									<button type="button"
										class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
										title="Edit"
										data-bs-toggle="modal"
										data-bs-target="#modal_edit_user"
										onclick="editUser({{ $user->id }}, '{{ addslashes($user->username) }}', '{{ addslashes($user->email) }}', {{ $user->status ? 1 : 0 }})">
										<i class="ki-outline ki-pencil fs-2"></i>
									</button>

									<form method="POST" action="{{ route('admin.user.activate', $user) }}" class="d-inline">
										@csrf
										@method('PATCH')
										<button type="submit"
											class="btn btn-icon btn-sm btn-bg-light me-1 {{ $user->status ? 'btn-active-color-warning' : 'btn-active-color-success' }}"
											title="{{ $user->status ? 'Nonaktifkan' : 'Aktifkan' }}">
											<i class="ki-outline {{ $user->status ? 'ki-lock-2' : 'ki-check-circle' }} fs-2"></i>
										</button>
									</form>

									<button type="button"
										class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
										title="Hapus"
										data-bs-toggle="modal"
										data-bs-target="#modal_hapus_user"
										onclick="hapusUser({{ $user->id }}, '{{ addslashes($user->username) }}')">
										<i class="ki-outline ki-trash fs-2"></i>
									</button>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="4" class="text-center text-muted py-10">
									<i class="ki-outline ki-user fs-3x text-muted mb-3 d-block"></i>
									Belum ada data user.
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<div class="d-flex justify-content-end mt-5">
					{{ $users->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Modal Tambah User --}}
<div class="modal fade" id="modal_tambah_user" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-600px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Tambah User</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" action="{{ route('admin.user.store') }}">
				@csrf
				<div class="modal-body px-5 py-10">
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Username</label>
						<input type="text" name="username" class="form-control form-control-solid"
							placeholder="Masukkan username" value="{{ old('username') }}" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Email</label>
						<input type="email" name="email" class="form-control form-control-solid"
							placeholder="Masukkan email" value="{{ old('email') }}" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Password</label>
						<input type="password" name="password" class="form-control form-control-solid"
							placeholder="Minimal 6 karakter" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Status</label>
						<select name="status" class="form-select form-select-solid">
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
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

{{-- Modal Edit User --}}
<div class="modal fade" id="modal_edit_user" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-600px">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="fw-bold">Edit User</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
					<i class="ki-outline ki-cross fs-1"></i>
				</div>
			</div>
			<form method="POST" id="form_edit_user" action="">
				@csrf
				@method('PUT')
				<div class="modal-body px-5 py-10">
					<div class="alert alert-light-primary d-flex align-items-center p-4 mb-6">
						<i class="ki-outline ki-information-5 fs-2x text-primary me-4 flex-shrink-0"></i>
						<div>
							<span class="fw-semibold text-gray-700">Mengedit user: </span>
							<span class="fw-bold text-primary" id="edit_user_info_nama"></span>
							<span class="ms-3 text-muted fs-7">Status saat ini: </span>
							<span class="fw-semibold fs-7" id="edit_user_info_status"></span>
						</div>
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Username</label>
						<input type="text" name="username" id="edit_username"
							class="form-control form-control-solid" required />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Email</label>
						<input type="email" name="email" id="edit_email"
							class="form-control form-control-solid" required />
					</div>
					<div class="fv-row mb-7">
						<label class="fw-semibold fs-6 mb-2">
							Password
							<span class="text-muted fs-7 fw-normal">(kosongkan jika tidak diubah)</span>
						</label>
						<input type="password" name="password" class="form-control form-control-solid"
							placeholder="Password baru" />
					</div>
					<div class="fv-row mb-7">
						<label class="required fw-semibold fs-6 mb-2">Status</label>
						<select name="status" id="edit_status" class="form-select form-select-solid">
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
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

{{-- Modal Hapus User --}}
<div class="modal fade" id="modal_hapus_user" tabindex="-1" aria-hidden="true">
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
				<p class="fs-5 text-gray-700 mb-1">Yakin ingin menghapus user</p>
				<p class="fs-4 fw-bold text-gray-900 mb-5" id="hapus_username_label">-</p>
				<p class="text-muted fs-6">Data yang dihapus tidak dapat dikembalikan.</p>
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
				<form method="POST" id="form_hapus_user" action="">
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
function editUser(id, username, email, status) {
	document.getElementById('form_edit_user').action = '{{ url("admin/user") }}/' + id;
	document.getElementById('edit_username').value = username;
	document.getElementById('edit_email').value = email;
	document.getElementById('edit_status').value = status;
	document.getElementById('edit_user_info_nama').textContent   = username;
	document.getElementById('edit_user_info_status').textContent = status ? 'Aktif' : 'Tidak Aktif';
	document.getElementById('edit_user_info_status').className   = status ? 'fw-semibold fs-7 text-success' : 'fw-semibold fs-7 text-danger';
}

function hapusUser(id, username) {
	document.getElementById('form_hapus_user').action = '{{ url("admin/user") }}/' + id;
	document.getElementById('hapus_username_label').textContent = username;
}
</script>
@endsection
