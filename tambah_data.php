<?php include "header.php"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="assets/tambah_data.css">

<div class="content-wrapper">
<div class="container">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Tambah Data Memo Donor</h3>
			</div>
			<div class="panel-body">
				
				<form method="post" action="aksi_memo.php?act=insert">
					<table class="table">
						<?php
							// Ambil nilai nomor terbaru dari tabel dmemo
							$sql = mysqli_query($konek, "SELECT nomor, MONTH(tanggal) AS bulan FROM dmemo ORDER BY id DESC LIMIT 1");
							$row = mysqli_fetch_assoc($sql); // Ambil hasil sebagai array asosiatif
							$bulan = $row['bulan'] ?? null;
							$last_memo = $row['nomor'] ?? null + 1;

							if ($bulan == date('m')) {
								// Tambahkan format empat digit
								$formatted_memo = sprintf('%04d', $last_memo + 1);
							} else {
								// Reset menjadi 0001
								$formatted_memo = "0001";
							}
							
						?>
						<tr>
							<td width="160px">Nomor Memo</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="nomor" value="<?= $formatted_memo . '/' . date('m') ?>" required /></div></td>
						</tr>
						<tr>
							<td width="160px">Tanggal Donor</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="tanggal" id="tanggal"/></div></td>
						</tr>
						<tr>
							<td width="160px">Nama Instansi</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="nama" autofocus required /></div></td>
						</tr>
						<tr>
							<td width="160px">Alamat</td>
							<td><div class="col-md-6"><textarea class="form-control" name="alamat" required ></textarea></div></td>
						</tr>
						<tr>
							<td width="160px">Target Donor</td>
							<td><div class="col-md-6"><input class="form-control" type="number" name="target" required /></div></td>
						</tr>
						<tr>
							<td width="160px">Bus</td>
							<td><div class="col-md-6"><input class="form-control" type="number" name="bus" required /></div></td>
						</tr>
						<tr>
							<td width="160px">Mulai</td>
							<td><div class="col-md-6"><input class="form-control time" type="text" name="mulai" required /></div></td>
						</tr>
						<tr>
							<td width="160px">Selesai</td>
							<td><div class="col-md-6"><input class="form-control time" type="text" name="selesai" required /></div></td>
						</tr>
						<tr>
							<td width="160px">Telepon</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="telepon" required /></div></td>
						</tr>
						<tr>
							<td width="160px">Piagam</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="piagam" /></div></td>
						</tr>
						<tr>
							<td width="160px">Keterangan</td>
							<td><div class="col-md-6"><textarea class="form-control" name="keterangan" ></textarea></div></td>
						</tr>
						<tr>
							<td></td>
							<td>
							<div class="col-md-6">
								<input class="btn btn-primary" type="submit" value="Simpan" />
								<a class="btn btn-danger" href="data_piagam.php">Kembali</a>
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
	flatpickr("#tanggal", {
		dateFormat: "Y-m-d",
		defaultDate: new Date(),
		minDate: new Date()
	});
	flatpickr(".time", {
		enableTime: true,
		noCalendar: true,
		dateFormat: "H:i",
		time_24hr: true
	});
</script>

<?php include "footer.php"; ?>
