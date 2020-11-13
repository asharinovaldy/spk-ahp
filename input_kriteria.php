<?php
error_reporting(0);
include 'koneksi/koneksi.php';


$idKriteria = $_POST['idKriteria'];
$namaKriteria = $_POST['namaKriteria'];

$query = mysqli_query($koneksi, "INSERT INTO kriteria VALUES ('$idKriteria', '$namaKriteria', null, null)");

if ($query) {
    echo "<script language='Javascript'>
    (window.alert('Data telah Disimpan')) </script>";
    echo "<script language='Javascript'>
    location.href='data_kriteria.php'</script>";
} else {
    echo "<script language='Javascript'>
    (window.alert('Data tidak dapat disimpan!'))</script>";
    echo "<script language='Javascript'>
    location.href='data_kriteria.php'</script>";
}
