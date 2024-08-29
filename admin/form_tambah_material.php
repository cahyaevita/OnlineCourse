<?php
session_start();
// if (!isset($_SESSION["login"])) {
//     header("location:index.php");
//     exit;
// }
include('koneksi.php'); // Menghubungkan dengan database

// Ambil daftar kursus untuk dropdown
$course_query = "SELECT id, title FROM Courses";
$course_result = mysqli_query($koneksi, $course_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tambah Materi</title>
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <div id="main-wrapper">
        <!-- Nav header start -->
        <div class="nav-header">
            <!-- <a href="index.html" class="brand-logo"> -->
            <!-- <img class="logo-abbr" src="./images/logo.png" alt=""> -->
            <!-- <img class="logo-compact" src="./images/logo-text.png" alt=""> -->
            <!-- <img class="brand-title" src="./images/logo-text.png" alt=""> -->
            <!-- </a> -->

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
                            <h4>Tambah Data Materi</h4>
                            <span class="ml-1">Materi</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Data Materi</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="crud_material.php" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="course_id">ID Kursus</label>
                                        <!-- Dropdown untuk memilih kursus -->
                                        <select class="form-control" id="course_id" name="course_id" required>
                                            <option value="">Pilih Kursus</option>
                                            <?php while ($course = mysqli_fetch_assoc($course_result)) { ?>
                                                <option value="<?php echo htmlspecialchars($course['id']); ?>">
                                                    <?php echo htmlspecialchars($course['title']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Judul Materi</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Judul Materi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description"
                                            placeholder="Deskripsi" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="embed_link">Link Embed</label>
                                        <input type="text" class="form-control" id="embed_link" name="embed_link"
                                            placeholder="Link Embed" required>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
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
