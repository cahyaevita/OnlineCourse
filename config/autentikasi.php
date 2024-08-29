<?php
session_start(); // Start session before any output

include ('configurasi.php');

$username = $_POST['Username'];
$password = $_POST['password'];

// Protect against SQL injection by using prepared statement
$stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE Username = ? AND Password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1) {
    $user = mysqli_fetch_array($result);
    header('Location:../admin/index.php'); 
    exit(); // Exit after redirection
    // Check if the user is a kasir or manager
    echo("Koneksi Berhasil");
   
}
else if(empty($username) || empty($password)){
    header('Location:../index.php?error=2'); 
    exit(); // Exit after redirection
}
else{
    header('Location:../index.php?error=1'); 
    exit(); // Exit after redirection
}
?>