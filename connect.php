<?php 

// $host ="mysql.hostinger.co.id"; 
// $user ="u733702819_danAm"; 
// $pass ="SasmitaBlitar"; 
// $database ="u733702819_danAm";

$host ="localhost"; 
$user ="root";
$pass =""; 
$database ="blitar";

$connect=mysqli_connect($host,$user,$pass,$database) or die ("gagal");

$URL="http://localhost/pariwisata";
// $URL="https://common-id.com/dandi/SasmitaBlitar";
session_start();

if (isset($_SESSION['pesan'])) {
    $msg=$_SESSION['pesan'];
    
    unset($_SESSION['pesan']);
    echo "
    <script>alert('" .$msg. "');</script>
  ";
}


include 'function/wisataFunction.php';
include 'function/adminFunction.php';
include 'function/artikelFunction.php';
include 'function/kulinerFunction.php';
include 'function/eventFunction.php';
include 'function/akomodasiFunction.php';
include 'function/commentFunction.php';

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>