<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

	<div class="container">
		<div class="row mt-5">
        <?php echo validation_errors(); ?>
			<div class="col-md-6">
				<form class="row g-3 needs-validation" method="POST" action="<?= base_url($action); ?>" novalidate>
					<div class="col-md-4">
						<label for="nama" class="form-label">Nama</label>
						<input type="text" class="form-control" id="nama" name="nama" required>
					</div>
					<div class="col-md-4">
						<label for="nik" class="form-label">NIK</label>
						<input type="text" class="form-control" id="nik" name="nik" required>
					</div>
					<div class="col-md-4">
						<label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
						<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
					</div>
					<div class="col-md-4">
						<label for="tempat_lahir" class="form-label">Tempat Lahir</label>
						<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
					</div>
					<div class="col-md-4">
						<label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
						<select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
							<option selected disabled value="">-Pilih--</option>
							<option value="laki-laki">Laki-laki</option>
							<option value="perempuan">Perempuan</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="provinsi" class="form-label">Provinsi</label>
						<select class="form-select" name="provinsi" id="reg_provinces" required>
							<option selected disabled value="">Choose...</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="kabupaten" class="form-label">Kabupaten</label>
						<select class="form-select" name="kabupaten" id="regencies_id" required>
							<option selected disabled value="">Choose...</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="kecamatan" class="form-label">Kecamatan</label>
						<select class="form-select" name="kecamatan" id="regency_id" required>
							<option selected disabled value="">Choose...</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="desa" class="form-label">Desa</label>
						<select class="form-select" name="desa" id="villages_id" required>
							<option selected disabled value="">Choose...</option>
						</select>
					</div>


					<div class="col-md-4">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="col-md-4">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
                    <div class="col-md-4">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
                    </div>


					<div class="col-12">
						<button class="btn btn-primary" type="submit">Submit form</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function () {
			// Ambil data provinsi saat halaman dimuat
			$.getJSON('<?= base_url("wilayah/get_provinsi") ?>', function (data) {
				let options = '<option selected disabled value="">Choose...</option>';
				data.forEach(function (provinsi) {
					options += `<option value="${provinsi.id}">${provinsi.name}</option>`;
				});
				$('#reg_provinces').html(options);
			});

			// Event saat provinsi dipilih
			$('#reg_provinces').change(function () {
				const idProvinsi = $(this).val();
				$.getJSON(`<?= base_url("wilayah/get_kabupaten/") ?>${idProvinsi}`, function (data) {
					let options = '<option selected disabled value="">Choose...</option>';
					data.forEach(function (kabupaten) {
						options +=
							`<option value="${kabupaten.id}">${kabupaten.name}</option>`;
					});
					$('#regencies_id').html(options);
				});
			});

			// Event saat kabupaten dipilih
			$('#regencies_id').change(function () {
				const idKabupaten = $(this).val();
				$.getJSON(`<?= base_url("wilayah/get_kecamatan/") ?>${idKabupaten}`, function (data) {
					let options = '<option selected disabled value="">Choose...</option>';
					data.forEach(function (kecamatan) {
						options +=
							`<option value="${kecamatan.id}">${kecamatan.name}</option>`;
					});
					$('#regency_id').html(options);
				});
			});

			// Event saat kecamatan dipilih
			$('#regency_id').change(function () {
				const idKecamatan = $(this).val();
				$.getJSON(`<?= base_url("wilayah/get_desa/") ?>${idKecamatan}`, function (data) {
					let options = '<option selected disabled value="">Choose...</option>';
					data.forEach(function (desa) {
						options += `<option value="${desa.id}">${desa.name}</option>`;
					});
					$('#villages_id').html(options);
				});
			});
		});
	</script>

</body>

</html>