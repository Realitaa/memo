<?php include "header.php"; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="container">

    <div class="row">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Data Memo</h3>
            </div>
            <div class="panel-body">
                <div style="margin-bottom: 15px;">
                    <div style="position: relative; display: inline-block; width: 250px;">
                        <input type="text" id="date-input" class="form-control" placeholder="Cari berdasarkan tanggal..." style="width: 100%;">
                        <button type="button" id="clear-date" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: none; border: none; font-size: 16px; cursor: pointer;">&times;</button>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#clear-date').click(function() {
                                $('#date-input').val('').trigger('change'); // Kosongkan input dan trigger event change
                            });
                        });
                    </script>
                </div>
                

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
    flatpickr("#date-input", {
		dateFormat: "Y-m-d",
	});

    $(document).ready(function() {
        // Fungsi untuk memfilter dan memuat data
        function loadData(date) {
            $.ajax({
                url: 'get_memo_data.php', // Buat file PHP terpisah untuk mengambil data
                type: 'GET',
                data: {
                    date: date,
                },
                success: function(response) {
                    $('#data-table').html(response); // Menampilkan data dalam tabel
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }

        //Mereset tanggal
        $('#clear-date').click(function() {
            $('#date-input').val('').trigger('change'); // Kosongkan input dan trigger event change
        });

        // Menangani perubahan tanggal
        $('#date-input').change(function() {
            const date = $(this).val();
            if (date) {
            loadData(date); // Memuat data berdasarkan tanggal jika ada
            } else {
            loadData(); // Memuat data tanpa parameter tanggal jika kosong
            }
        });

        // Memuat data pertama kali dengan tahun default
        let selectedYear = $('#tahun').val();
        // let searchValue = $('#search-input').val().toLowerCase();
        loadData(selectedYear);
    });
</script>