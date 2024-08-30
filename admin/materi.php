<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("location:index.php");
//     exit;
// }
include('koneksi.php'); // Menghubungkan dengan database

// Memeriksa apakah ID kursus tersedia
if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']); // Pastikan ID adalah integer

    // Query untuk mendapatkan kursus
    $course_query = "SELECT * FROM Courses WHERE id = ?";
    $stmt = $koneksi->prepare($course_query);
    $stmt->bind_param('i', $course_id);
    $stmt->execute();
    $course_result = $stmt->get_result();

    // Query untuk mendapatkan daftar materi berdasarkan course_id
    $materials_query = "SELECT * FROM Materials WHERE course_id = ?";
    $stmt = $koneksi->prepare($materials_query);
    $stmt->bind_param('i', $course_id);
    $stmt->execute();
    $materials_result = $stmt->get_result();
} else {
    echo "ID kursus tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Daftar Materi Kursus</title>
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>

    <div id="main-wrapper">
        <!-- Nav header start -->
        <div class="nav-header">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!-- Nav header end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Materi untuk Kursus:
                                <?php
                                if ($course_result && $course_result->num_rows > 0) {
                                    $course = $course_result->fetch_assoc();
                                    echo htmlspecialchars($course['title']);
                                } else {
                                    echo "Kursus tidak ditemukan";
                                }
                                ?>
                            </h4>
                            <span class="ml-1">Daftar Materi</span>
                        </div>
                    </div>
                </div>

                <!-- Tabel untuk daftar materi -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Admin</h4>
                                <a class="btn btn-warning text-light ml-auto" href="form_tambah_material.php?id=<?php echo htmlspecialchars($course_id); ?>"
                                    style="float: right;">+ &nbsp; Tambah Materi</a>
                            </div>
                            <div class="card-header">
                                <h4 class="card-title">Daftar Materi</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID Materi</th>
                                                <th>Judul Materi</th>
                                                <th>Deskripsi</th>
                                                <th>Link Embed</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($materials_result && $materials_result->num_rows > 0) {
                                                while ($material = $materials_result->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($material['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($material['title']); ?></td>
                                                        <td><?php echo htmlspecialchars($material['description']); ?></td>
                                                        <td><a href="<?php echo htmlspecialchars($material['embed_link']); ?>"
                                                                target="_blank">Link Materi</a></td>
                                                        <td>
                                                            <a class="btn btn-warning text-light"
                                                                href="form_edit_material.php?id=<?php echo htmlspecialchars($material['id']); ?>">Edit</a>
                                                            <a class="btn btn-danger text-light"
                                                                href="hapus_material.php?id=<?php echo htmlspecialchars($material['id']); ?>"
                                                                onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>Tidak ada materi yang ditemukan.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Content body end -->

    </div>

    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>
</html>
