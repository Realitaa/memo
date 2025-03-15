<?php include "header.php"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="container">

    <div class="row">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Data Memo Tahun
                    <select name="tahun" id="tahun" style="color: black;">
                        <option value="Semua">Semua</option>
                        <?php
                        $currentYear = date('Y'); // Ambil tahun saat ini
                        $sql = mysqli_query($konek, "SELECT DISTINCT YEAR(tanggal) AS tahun FROM dmemo ORDER BY tahun DESC");
                        while ($d = mysqli_fetch_array($sql)) {
                            $selected = ($d['tahun'] == $currentYear) ? "selected" : "";
                            echo "<option value='$d[tahun]' $selected>$d[tahun]</option>";
                        }
                        ?>
                    </select>
                </h3>
            </div>
            <div class="panel-body">
                <!-- <div style="margin-bottom: 15px;">
                    <input type="text" id="search-input" class="form-control" placeholder="Search..." style="width: auto; display: inline-block;">
                </div> -->
                

                <table class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Nama Instansi</th>
                            <th>Target Donor</th>
                            <th>Bus</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Telepon</th>
                            <th>Piagam</th>
                            <th>Keteragan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data-table">
                        <!-- Data akan dimuat melalui AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    $(document).ready(function() {
        // Fungsi untuk memfilter dan memuat data
        function loadData(tahun) {
            $.ajax({
                url: 'get_memo_data.php', // Buat file PHP terpisah untuk mengambil data
                type: 'GET',
                data: {
                    tahun: tahun,
                },
                success: function(response) {
                    $('#data-table').html(response); // Menampilkan data dalam tabel
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }

        // Menangani perubahan tahun
        $('#tahun').change(function() {
            const selectedYear = $(this).val();
            loadData(selectedYear); // Memuat data berdasarkan tahun
        });

        // Memuat data pertama kali dengan tahun default
        let selectedYear = $('#tahun').val();
        // let searchValue = $('#search-input').val().toLowerCase();
        loadData(selectedYear);
    });
</script>