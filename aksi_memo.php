<?php
session_start();
if(!isset($_SESSION['login'])){
	header('location:login.php');
}
include "koneksi.php";

// jika ada get act
if(isset($_GET['act'])){
	if($_GET['act']=='insert'){
		//proses simpan data
		$nomor = $_POST['nomor'];
		$tanggal = $_POST['tanggal'];
		$nama_instansi = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$target = $_POST['target'];
		$bus = $_POST['bus'];
		$mulai = $_POST['mulai'];
		$selesai = $_POST['selesai'];
		$telepon = $_POST['telepon'];
		$piagam = $_POST['piagam'];
		$keterangan = $_POST['keterangan'];
		
		if($nomor=='' || $tanggal=='' || $nama_instansi=='' || $alamat=='' || $target=='' || $bus=='' || $mulai=='' || $selesai=='' || $telepon==''){
			header('location:tambah_data.php');
		}else{		
			//proses simpan data oleh admin
			$simpan = mysqli_query($konek, "INSERT INTO dmemo (nomor, tanggal, nama_instansi, alamat, target_donor, bus, mulai, selesai, telepon, piagam, keterangan) 
				VALUES ('$nomor', '$tanggal', '$nama_instansi', '$alamat', '$target', '$bus', '$mulai', '$selesai', '$telepon', '$piagam', '$keterangan')");

			if ($simpan) {
				header('location:data_memo.php');
			}
		}
	} else if ($_GET['act']=='delete'){
	    $id = $_GET['id'];
	        
	    if ($id) {
	        $hapus = mysqli_query($konek, "DELETE FROM dmemo WHERE id = $id");
	        if ($hapus) {
	            header('location:data_memo.php');
	        }
	    } else {
	        header('location:data_memo.php');
	    }
	} 
	// else if ($_GET['act'] == 'afterprint') {
	//     $id = $_POST['id'];

	// 	if ($id) {
	// 		$id = intval($id);

	// 		$update = mysqli_query($konek, "UPDATE dmemo SET banyak_copy = banyak_copy + 1 WHERE id = $id");
	// 	} else {
	// 		header('Content-Type: application/json');
	// 		echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan jumlah cetak']);		
	// 	}
	// }

	else{
		header('location:data_memo.php');
	}

} // akhir get act

else{
	header('location:data_memo.php');
}
?>