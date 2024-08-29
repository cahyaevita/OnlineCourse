<?php
include 'koneksi.php';

// Ambil data dari form
$course_id = isset($_POST["course_id"]) ? intval($_POST["course_id"]) : null;
$title = isset($_POST["title"]) ? $_POST["title"] : '';
$description = isset($_POST["description"]) ? $_POST["description"] : '';
$embed_link = isset($_POST["embed_link"]) ? $_POST["embed_link"] : '';
$id = isset($_POST["id_material"]) ? intval($_POST["id_material"]) : null; // Jika id_material digunakan untuk update

// Periksa apakah tombol tambah atau ubah ditekan
if (isset($_POST['tambah'])) {
    // Jalankan query INSERT untuk menambah data
    $query = "CALL AddCourse(?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('sssss', $course_id, $title, $description, $embed_link); // 5 parameter
    $hasil_query = $stmt->execute();

    // Periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menambah data: " . $stmt->errno . " - " . $stmt->error);
    } else {
        echo "<script>alert('Data berhasil ditambah.');window.location='materi.php';</script>";
    }
} elseif (isset($_POST['ubah'])) {
    // Jalankan query UPDATE untuk mengubah data
    $query = "CALL UpdateMaterial(?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('isss', $id, $title, $description, $embed_link); // 4 parameter
    $hasil_query = $stmt->execute();

    // Periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal mengubah data: " . $stmt->errno . " - " . $stmt->error);
    } else {
        echo "<script>alert('Data berhasil diubah.');window.location='materi.php';</script>";
    }
}
?>
