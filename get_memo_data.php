<?php
include 'koneksi.php'; 

$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : 'Semua';
// $search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk memfilter data berdasarkan tahun, kategori, dan pencarian
$query = "SELECT * FROM dmemo WHERE 1";

// Filter berdasarkan tahun
if ($tahun != 'Semua') {
    $query .= " AND YEAR(tanggal) = '$tahun'";
}

// Filter berdasarkan kategori
// if (!empty($kategori)) {
//     $query .= " AND kategori = '$kategori'";
// }

// // Filter berdasarkan pencarian
// if (!empty($search)) {
//     $query .= " AND (nama_instansi LIKE '%$search%')";
// }

$query .= " ORDER BY id DESC"; // Urutkan berdasarkan ID secara DESC

$sql = mysqli_query($konek, $query);
$no = 1;
while ($d = mysqli_fetch_array($sql)) {

    $localDate = LocalDate($d['tanggal']);
    
    echo "<tr>
        <td width='40px' align='center'>$no</td>
        <td>$d[nomor]</td>
        <td>$localDate</td>
        <td>$d[nama_instansi]</td>
        <td>$d[target_donor]</td>
        <td>$d[bus]</td>
        <td>$d[mulai]</td>
        <td>$d[selesai]</td>
        <td>$d[telepon]</td>
        <td>$d[piagam]</td>
        <td>$d[keterangan]</td>
        <td align='center'>
            <a class='btn btn-success btn-sm' href='cetak_memo.php?id=$d[id]' 
            target='_blank'>Cetak</a>
            <a href='aksi_memo.php?act=delete&id=$d[id]' class='btn btn-danger btn-sm'>Hapus</a>
        </td>
    </tr>";
    $no++;
}
?>
