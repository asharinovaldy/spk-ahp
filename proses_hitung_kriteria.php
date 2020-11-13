<?php
include 'koneksi/koneksi.php';

$cr1 = $_POST['baris'];
$cr2 = $_POST['kolom'];
$indeks = intval($_POST['indeks']);

$i1 = $indeks / 1;
$i2 = 1 / $indeks;

$insert = "INSERT INTO analisa_kriteria VALUES('$cr1','$i1',null,'$cr2');";
$insert .= "INSERT INTO analisa_kriteria VALUES('$cr2','$i2',null,'$cr1')";

if (mysqli_multi_query($koneksi, $insert)) {
    echo "<script language='Javascript'>
				  (window.alert('Data telah Disimpan')) </script>";
    echo "<script language='Javascript'>
				  location.href='hitung_kriteria.php'</script>";
} else {
    echo "<script language='Javascript'>
				  (window.alert('Data tidak dapat disimpan')) </script>";
    echo "<script language='Javascript'>
				  location.href='hitung_kriteria.php'</script>";
}

mysqli_close($koneksi);
