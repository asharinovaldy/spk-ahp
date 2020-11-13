<?php
error_reporting(0);
include 'koneksi/koneksi.php';


$idAlternatif = $_POST['idAlternatif'];
$namaAlternatif = $_POST['namaAlternatif'];

$query = mysqli_query($koneksi, "INSERT INTO alternatif VALUES ('$idAlternatif', '$namaAlternatif',null)");

if ($query) {
    echo "<script language='Javascript'>
    (window.alert('Data telah Disimpan')) </script>";
    echo "<script language='Javascript'>
    location.href='data_alternatif.php'</script>";
} else {
    echo "<script language='Javascript'>
    (window.alert('Data tidak dapat disimpan!'))</script>";
    echo "<script language='Javascript'>
    location.href='data_alternatif.php'</script>";
}
