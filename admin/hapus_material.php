<?php
include 'koneksi.php';

// Ambil ID dari parameter GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validasi ID
if ($id <= 0) {
    die("ID materi tidak valid.");
}

// Jalankan query DELETE untuk menghapus data
$query = "CALL DeleteMaterial(?)";
$stmt = $koneksi->prepare($query);
$stmt->bind_param('i', $id);
$hasil_query = $stmt->execute();

// Periksa hasil query
if (!$hasil_query) {
    die("Gagal menghapus data: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Data materi berhasil dihapus.');window.location='materi.php?id=" . htmlspecialchars($course_id) . "';</script>";
}
?>
