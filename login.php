<!DOCTIPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="assets/img/icon.png">

        <title>Aplikasi Piagam</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Custom styles for this template -->

        <link rel="stylesheet" href="assets/login.css">

    </head>

    <body>

        <div class="container">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                LOGIN PETUGAS</h3>
                        </center>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> <?php echo $error; ?>
                            </div>
                            <?php
                        }
                        ?>

                        <form method="post" action="validation.php" role="form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" autocomplete="off"
                                    placeholder="Username" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Masuk" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="text-muted"><a href="https://bikinbagoes.my.id" target="_blank">bikinbagoes.my.id</a> Tahun
                    2024</p>
            </div>
        </footer>

        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
    </body>

    </html>