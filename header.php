<?php
ob_start();
session_start();

if (!isset($_SESSION['login'])) {
  header('location:login.php');
  exit(); // Pastikan script berhenti setelah redirect
}


include "koneksi.php";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./assets/img/logo.png">

  <title>Aplikasi Memo</title>

  <!-- Bootstrap core CSS -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <link href="./assets/style.css" rel="stylesheet">

</head>

<body>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar navbar-brand" href="./">Aplikasi Memo</a>
        <a class="navbar navbar-brand" href="tambah_data.php">Tambah Memo</a>
        <a class="navbar navbar-brand" href="data_memo.php">Memo</a>
        <a class="navbar navbar-brand" href="logout.php">Keluar</a>
      </div>
    </div>
  </nav>