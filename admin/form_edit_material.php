<?php
// Memanggil file koneksi.php untuk membuat koneksi
include 'koneksi.php';

// Ambil ID dari parameter GET atau POST
$id = isset($_GET['id']) ? intval($_GET['id']) : (isset($_POST['id_material']) ? intval($_POST['id_material']) : 0);

// Validasi ID jika tidak kosong
if ($id > 0) {
    // Query untuk mengambil data materi berdasarkan ID
    $query = "SELECT * FROM Materials WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $view = $stmt->get_result()->fetch_assoc();

    // Cek apakah data ditemukan
    if (!$view) {
        die("Materi tidak ditemukan.");
    }
} else {
    $view = [
        'id' => '',
        'course_id' => '',
        'title' => '',
        'description' => '',
        'embed_link' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Materi</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Preloader start -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!-- Preloader end -->

    <!-- Main wrapper start -->
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

        <!-- Header start -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="../halamanlogin/dist/login.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header end -->

        <!-- Sidebar start -->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Database</li>
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                                class="icon icon-layout-25"></i><span class="nav-text">Kelola Data</span></a>
                        <ul aria-expanded="false">
                            <li><a href="pengguna.php">Admin</a></li>
                            <li><a href="film.php">Film</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span class="ml-1">Datatable</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Materi</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="crud_material.php">
                                    <div class="form-group">
                                        <label for="id_material">ID Materi</label>
                                        <input type="text" class="form-control" id="id_material" name="id_material"
                                            value="<?php echo htmlspecialchars($view['id']); ?>"
                                            placeholder="Masukkan ID materi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_id">ID Kursus</label>
                                        <input type="text" class="form-control" id="course_id" name="course_id"
                                            value="<?php echo htmlspecialchars($view['course_id']); ?>"
                                            placeholder="Masukkan ID kursus" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Judul Materi</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="<?php echo htmlspecialchars($view['title']); ?>"
                                            placeholder="Masukkan judul materi" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description"
                                            placeholder="Masukkan deskripsi materi"
                                            required><?php echo htmlspecialchars($view['description']); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="embed_link">Link Embed</label>
                                        <input type="text" class="form-control" id="embed_link" name="embed_link"
                                            value="<?php echo htmlspecialchars($view['embed_link']); ?>"
                                            placeholder="Masukkan link embed" required>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content body end -->

        <!-- Footer start -->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            </div>
        </div>
        <!-- Footer end -->

    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>