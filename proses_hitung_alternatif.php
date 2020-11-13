<?php
include 'koneksi/koneksi.php';

$a1 = $_POST['baris'];
$a2 = $_POST['kolom'];
$indeks = intval($_POST['indeks']);
$idKriteria = $_POST['idKriteria'];

$i1 = $indeks / 1;
$i2 = 1 / $indeks;

$insert = "INSERT INTO analisa_alternatif VALUES('$a1','$i1',null,'$a2','$idKriteria');";
$insert .= "INSERT INTO analisa_alternatif VALUES('$a2','$i2',null,'$a1','$idKriteria');";

if (mysqli_multi_query($koneksi, $insert)) {
    echo "<script language='Javascript'>
				  (window.alert('Data telah Disimpan')) </script>";
    echo "<script language='Javascript'>
				  location.href='hitungAlt.php?id=$idKriteria'</script>";
} else {
    echo "<script language='Javascript'>
				  (window.alert('Data tidak dapat disimpan')) </script>";
    echo "<script language='Javascript'>
				  location.href='hitungAlt.php?id=$idKriteria'</script>";
}

mysqli_close($koneksi);
