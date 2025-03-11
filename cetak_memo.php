<?php
    ob_start();
    session_start();
    include "koneksi.php";
    if (!isset($_SESSION['login'])) {
        header('location:login.php');
        exit(); // Pastikan script berhenti setelah redirect
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

            .container {
                width: 210mm;
                height: 297mm;
                margin: 0 auto;
                background: white;
                padding: 20mm;
                box-sizing: border-box;
                border: 1px solid #ddd;
                position: relative;
                overflow: hidden;
                z-index: 0;
            }

            .container > * {
                position: relative;
                z-index: 1; /* Pastikan konten tetap di atas watermark */
            }

            .top-border {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: auto;
                max-height: 50px;
            }

            .header {
                text-align: center;
                margin-top: 50px;
                margin-bottom: 20px;
            }

            .header img {
                max-width: 250px;
            }

            .header h1 {
                font-size: 24px;
                font-weight: bold;
                margin: 50px;
            }

            .content {
                text-align: center;
                margin-top: 50px;
            }

            .content p {
                font-size: 18px;
                margin: 10px 0;
            }

            .footer {
                text-align: center;
                margin-top: 80px;
            }

            .footer p {
                margin: 5px 0;
            }

            .signature {
                margin-top: 40px;
                text-align: center;
            }

            .signature img {
                max-height: 60px;
                margin: 10px 0;
            }

            .barcode {
                text-align: center; 
                position: absolute; 
                right: 40px; 
                padding: 40px;
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

            @media print {
                .print-btn {
                    display: none;
                }

                body {
                    margin: 0;
                }


                .container {
                    border: none;
                    padding: 0;
                    width: 210mm;
                    height: 297mm;
                    overflow: hidden;
                    page-break-inside: avoid;
                }

                .top-border {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 210mm;
                    height: auto;
                    max-height: 50px;
                }

                .header img {
                    margin-top: 50px;
                    margin-bottom: 20px;
                    
    }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <?php
            $sql = mysqli_query($konek, 
            "SELECT nomor, tanggal, nama_instansi, alamat, target_donor, bus, DATE_FORMAT(mulai, '%H:%i') AS mulai, DATE_FORMAT(selesai, '%H:%i') AS selesai, telepon, piagam, keterangan FROM dmemo WHERE id='$_GET[id]'");
            $d = mysqli_fetch_array($sql);
            $localMemo = LocalMemo($d['nomor'], $d['tanggal']);
            ?>
            <div class="header">
                <img src="assets/img/logo.png" alt="Logo PMI">
            </div>

            <div class="content">
                <?php
                    echo $localMemo . "<br>";
                    // Dari: Koordinator P2D2S
                    // Kepada: Koordinator Mobil Unit
                    // Perihal: Kegiatan Donor Darah   
                    // Tanggal: 
                    echo LocalDate(date('Y-m-d'))  . "<br>"; // Tanggal hari ini

                    // Hari/Tanggal: 
                    echo LocalDate($d['tanggal'])  . "<br>";
                    echo $d['nama_instansi'] . "<br>";
                    echo $d['alamat'] . "<br>";
                    echo $d['target_donor'] . "<br>";
                    echo $d['bus'] . "<br>";
                    echo $d['mulai'] . "<br>";
                    echo $d['selesai'] . "<br>";
                    echo $d['telepon'] . "<br>";
                    echo $d['piagam'] . "<br>";
                    echo $d['keterangan'] . "<br>";
                ?>
            </div>

            <div class="footer">
                
            </div>
            
            
        </div>

        <button class="print-btn" onclick="window.print()">Print</button>
        ?>
    </body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.onbeforeprint = function() {
            let watermark = document.createElement("img");
            watermark.src = "assets/img/valid-stemp.png";
            watermark.style.position = "absolute";
            watermark.style.top = "50%";
            watermark.style.left = "50%";
            watermark.style.transform = "translate(-50%, -50%) rotate(-15deg)";
            watermark.style.width = "678px";
            watermark.style.height = "255px";
            watermark.style.opacity = "0.5";
            watermark.style.zIndex = "-1";
            
            document.body.appendChild(watermark);
        };

        window.onafterprint = function() {
            let watermarks = document.querySelectorAll("img[src='assets/img/valid-stemp.png']");
            watermarks.forEach(wm => wm.remove());
        };

        window.addEventListener("afterprint", function() {
            $.ajax({
                url: 'aksi_memo.php?act=afterprint', 
                type: 'POST',
                data: {
                    id : <?php echo $_GET['id']; ?>
                },
                success: function(response) {
                    // console.log('banyak copy sudah diperbarui');
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        });
    </script>
    </html>

<?php
?>