<?php
ob_start();
session_start();
include "koneksi.php";
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit();
}

if (!($_GET['id'])) {
    header('location:data_memo.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cetak Memo</title>
    <link rel="icon" href="./assets/img/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .page {
            width: 210mm;
            /* Ukuran A4 */
            min-height: 297mm;
            margin: 0 auto;
            background: #fff;
            padding: 20mm;
            box-sizing: border-box;
            border: 1px solid #ddd;
            position: relative;
            overflow: visible;
        }

        .memo-section {
            position: relative;
            margin-bottom: 30px;
            /* Jarak antar memo */
        }

        .memo-section>* {
            position: relative;
            z-index: 1;
        }

        /* Header (logo PMI di kiri, MEMO di kanan) */
        .header-memo {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-left img {
            width: 60px;
            margin-right: 10px;
        }

        .header-left .text h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header-left .text p {
            margin: 0;
        }

        .memo-title {
            font-size: 28px;
            font-weight: bold;
        }

        hr {
            border: none;
            border-top: 1px solid #000;
            margin: 15px 0;
        }

        /* Tabel untuk No, Perihal, Dari, Tanggal, Kepada */
        .memo-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .memo-info td {
            padding: 4px 5px;
            vertical-align: top;
        }

        /* Tabel detail Rencana Kegiatan Donor Darah */
        .rencana-title {
            font-weight: bold;
            margin: 10px 0 8px 0;
        }

        .rencana-table {
            width: 100%;
            border-collapse: collapse;
        }

        .rencana-table td {
            padding: 4px 5px;
            vertical-align: top;
        }

        .catatan {
            margin-top: 15px;
        }

        .print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Watermark DUPLICATED */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-20deg);
            font-size: 100px;
            font-weight: bold;
            color: rgba(200, 0, 0, 0.3);
            z-index: 0;
            white-space: nowrap;
        }

        @media print {
            .print-btn {
                display: none;
            }

            .page {
                border: none;
                width: 210mm;
                min-height: 297mm;
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <?php
    $sql = mysqli_query(
        $konek,
        "SELECT nomor, tanggal, nama_instansi, alamat, target_donor, bus, 
                DATE_FORMAT(mulai, '%H:%i') AS mulai, 
                DATE_FORMAT(selesai, '%H:%i') AS selesai, 
                telepon, piagam, keterangan 
         FROM dmemo 
         WHERE id='$_GET[id]'"
    );
    $d = mysqli_fetch_array($sql);
    $localMemo = LocalMemo($d['nomor'], $d['tanggal']);
    ?>

    <div class="page">
        <!-- MEMO PERTAMA -->
        <div class="memo-section">
            <div class="header-memo">
                <div class="header-left">
                    <img src="assets/img/logo.png" alt="Logo PMI">
                    <div class="text">
                        <h2>Palang Merah Indonesia</h2>
                        <p>UDD PMI KOTA MEDAN</p>
                    </div>
                </div>
                <div class="memo-title">MEMO</div>
            </div>
            <hr>
            <table class="memo-info">
                <tr>
                    <td>No</td>
                    <td>: <?php echo $localMemo; ?></td>
                    <td>Perihal</td>
                    <td>: Kegiatan Donor Darah</td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td>: Koordinator P2D2S</td>
                    <td>Tanggal</td>
                    <td>: <?php echo LocalDate(date('Y-m-d')); ?></td>
                </tr>
                <tr>
                    <td>Kepada</td>
                    <td>: Koordinator Mobil Unit</td>
                </tr>
            </table>
            <hr>
            <div class="rencana-title">Rencana Kegiatan Donor Darah</div>
            <table class="rencana-table">
                <tr>
                    <td>Hari/Tanggal</td>
                    <td>: <?php echo LocalDate($d['tanggal']); ?></td>
                    <td>Jam Mulai</td>
                    <td>: <?php echo $d['mulai']; ?> WIB</td>
                </tr>
                <tr>
                    <td>Nama Instansi</td>
                    <td>: <?php echo $d['nama_instansi']; ?></td>
                    <td>Jam Selesai</td>
                    <td>: <?php echo $d['selesai']; ?> WIB</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?php echo $d['alamat']; ?></td>
                    <td>PIC Instansi</td>
                    <td>: <?php echo $d['telepon']; ?></td>
                </tr>
                <tr>
                    <td>Target Donor</td>
                    <td>: ±<?php echo $d['target_donor']; ?></td>
                    <td>Piagam Instansi</td>
                    <td>: <?php echo $d['piagam']; ?></td>
                </tr>
                <tr>
                    <td>Bus/Velbed</td>
                    <td>: <?php echo $d['bus']; ?></td>
                    <td>Keterangan</td>
                    <td>: <?php echo $d['keterangan']; ?></td>
                </tr>
            </table>
            <div class="catatan">
                <p>Mohon agar ditindaklanjuti. Atas perhatian dan kerjasamanya diucapkan terima kasih.</p>
                <p><strong>Kasi P2D2S</strong></p>
            </div>
        </div>
        <hr>
        <br>
        <br>
        <!-- MEMO KEDUA (DUPLICATE) -->
        <div class="memo-section">
            <div class="watermark">DUPLICATED</div>
            <div class="header-memo">
                <div class="header-left">
                    <img src="assets/img/logo.png" alt="Logo PMI">
                    <div class="text">
                        <h2>Palang Merah Indonesia</h2>
                        <p>UDD PMI KOTA MEDAN</p>
                    </div>
                </div>
                <div class="memo-title">MEMO</div>
            </div>
            <hr>
            <table class="memo-info">
                <tr>
                    <td>No</td>
                    <td>: <?php echo $localMemo; ?></td>
                    <td>Perihal</td>
                    <td>: Kegiatan Donor Darah</td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td>: Koordinator P2D2S</td>
                    <td>Tanggal</td>
                    <td>: <?php echo LocalDate(date('Y-m-d')); ?></td>
                </tr>
                <tr>
                    <td>Kepada</td>
                    <td>: Koordinator Mobil Unit</td>
                </tr>
            </table>
            <hr>
            <div class="rencana-title">Rencana Kegiatan Donor Darah</div>
            <table class="rencana-table">
                <tr>
                    <td>Hari/Tanggal</td>
                    <td>: <?php echo LocalDate($d['tanggal']); ?></td>
                    <td>Jam Mulai</td>
                    <td>: <?php echo $d['mulai']; ?> WIB</td>
                </tr>
                <tr>
                    <td>Nama Instansi</td>
                    <td>: <?php echo $d['nama_instansi']; ?></td>
                    <td>Jam Selesai</td>
                    <td>: <?php echo $d['selesai']; ?> WIB</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?php echo $d['alamat']; ?></td>
                    <td>PIC Instansi</td>
                    <td>: <?php echo $d['telepon']; ?></td>
                </tr>
                <tr>
                    <td>Target Donor</td>
                    <td>: ±<?php echo $d['target_donor']; ?></td>
                    <td>Piagam Instansi</td>
                    <td>: <?php echo $d['piagam']; ?></td>
                </tr>
                <tr>
                    <td>Bus/Velbed</td>
                    <td>: <?php echo $d['bus']; ?></td>
                    <td>Keterangan</td>
                    <td>: <?php echo $d['keterangan']; ?></td>
                </tr>
            </table>
            <div class="catatan">
                <p>Mohon agar ditindaklanjuti. Atas perhatian dan kerjasamanya diucapkan terima kasih.</p>
                <p><strong>Kasi P2D2S</strong></p>
            </div>
        </div>
    </div>

    <button class="print-btn" onclick="window.print()">Print</button>
</body>

</html>