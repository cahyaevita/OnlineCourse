<?php 
    session_start();
     $_SESSION = [];
    // menghapus semua session
    session_unset();
    session_destroy();
    
    // mengalihkan halaman dan mengirim pesan logout
    echo "<script>alert('BERHASIL LOG OUT.');window.location='../halamanlogin/dist/login.php';</script>";
    exit;
