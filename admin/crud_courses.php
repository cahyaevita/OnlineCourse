<?php
include 'koneksi.php';
$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];
$duration = $_POST["duration"];

if (isset($_POST['tambah'])) {
    //jalankan query INSERT untuk menambah data
    $query = "CALL AddCourse('$title', '$description', '$duration')";
    $hasil_query = mysqli_query($koneksi, $query);

    //periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menambah data: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil ditambah.');window.location='kursus.php';</script>";
    }
} elseif (isset($_POST['ubah'])) {
    //jalankan query UPDATE untuk mengubah data
    $query = "CALL UpdateCourse('$id', '$title', '$description', '$duration')";
    $hasil_query = mysqli_query($koneksi, $query);

    //periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal mengubah data: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil diubah.');window.location='kursus.php';</script>";
    }
}
?>