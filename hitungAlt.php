<?php
include 'header/header.php';
include 'koneksi/koneksi.php';

$id = $_GET['id'];

$queryCr = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id = '$id'");
$data = mysqli_fetch_assoc($queryCr);
?>

<!-- Questionnaire Form -->
<section>
    <h3>Kriteria : <?= $data['nama'] ?> (<?= $data['id'] ?>) </h3>

    <form action="proses_hitung_alternatif.php" method="POST">
        <input type="hidden" name="idKriteria" id="idKriteria" value="<?= $data['id'] ?>">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="baris">Baris</label>
                    <select class="form-control" name="baris" id="baris">

                        <?php
                        include 'koneksi/koneksi.php';

                        $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
                        while ($res = mysqli_fetch_assoc($query)) : ?>

                            <option value="<?= $res['id'] ?>"> <?= $res['nama'] ?> </option>

                        <?php endwhile; ?>

                    </select>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="form-group">
                    <label for="indeks">Nilai Indeks 1 - 9 </label>
                    <select class="form-control" name="indeks" id="indeks">

                        <?php
                        include 'koneksi/koneksi.php';

                        $query = mysqli_query($koneksi, "SELECT * FROM indeks");
                        while ($res = mysqli_fetch_assoc($query)) : ?>

                            <option value="<?= $res['id'] ?>"> <?= $res['angka'] ?> - <?= $res['keterangan'] ?> </option>

                        <?php endwhile; ?>

                    </select>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="kolom">Kolom</label>
                    <select class="form-control" name="kolom" id="kolom">

                        <?php
                        include 'koneksi/koneksi.php';

                        $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
                        while ($res = mysqli_fetch_assoc($query)) : ?>

                            <option value="<?= $res['id'] ?>"> <?= $res['nama'] ?> </option>

                        <?php endwhile; ?>

                    </select>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="Calculate"></input>
    </form>

</section>
<!-- End of Questionnaire Form -->

<!-- Pairwise Comparation Table -->
<section>
    <table class="table table-striped table-bordered mt-5">
        <thead>
            <th>Alternatif</th>
            <?php
            include 'koneksi/koneksi.php';

            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
            while ($res = mysqli_fetch_assoc($query)) :  ?>
                <th class="bg-primary text-white"><?= $res['nama'] ?></th>
            <?php endwhile; ?>
        </thead>

        <tbody>

            <?php
            include 'koneksi/koneksi.php';

            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");

            while ($baris = mysqli_fetch_assoc($query)) :  ?>
                <tr>
                    <th class="bg-primary text-white"><?= $baris['nama'] ?></th>
                    <?php
                    $query2 = mysqli_query($koneksi, "SELECT * FROM alternatif");
                    while ($kolom = mysqli_fetch_assoc($query2)) :  ?>
                        <td>
                            <?php
                            if ($baris['id'] == $kolom['id']) {
                                echo 1;
                            } else {
                                $queryNilai = mysqli_query($koneksi, "SELECT * FROM analisa_alternatif WHERE alternatif1 = '$baris[id]' AND alternatif2 = '$kolom[id]' AND idKriteria = '$data[id]'");
                                $nilai = mysqli_fetch_assoc($queryNilai);
                                echo number_format($nilai['indeks'], 4, ',', '.');
                            }
                            ?>
                        </td>
                    <?php endwhile; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr class="bg-info text-white">
                <th>Jumlah</th>
                <?php
                include 'koneksi/koneksi.php';
                $alt = mysqli_query($koneksi, "SELECT * FROM alternatif");
                $cr = mysqli_query($koneksi, "SELECT * FROM kriteria");

                $crRes = mysqli_fetch_assoc($cr);
                while ($hasil = mysqli_fetch_assoc($alt)) :
                ?>
                    <td>
                        <?php
                        $qjml = mysqli_query($koneksi, "SELECT SUM(indeks) AS jumlah FROM analisa_alternatif WHERE alternatif2 = '$hasil[id]' AND idKriteria = '$data[id]'");
                        $hjml = mysqli_fetch_assoc($qjml);
                        echo number_format($hjml['jumlah'], 4, ',', ',');

                        $idAlt = $hasil['id'];
                        $idCr = $data['id'];

                        $insert = mysqli_query($koneksi, "INSERT INTO juml_alt_kri VALUES('$hasil[id]','$data[id]',1,null,null)");

                        if (!$insert) {
                            $updateJml = mysqli_query($koneksi, "UPDATE juml_alt_kri SET jumlah = '$hjml[jumlah]' WHERE id_alternatif='$idAlt' AND id_kriteria = '$idCr'");
                        }

                        ?>
                    </td>
                <?php endwhile; ?>
            </tr>
        </tfoot>
    </table>
</section>
<!-- End of Pairwise Comparation Table -->

<!-- Eigenvector Table -->
<section>
    <h3 class="mt-5">Nilai Eigen</h3>

    <table class="table table-striped table-bordered">
        <thead>
            <th>Kriteria</th>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
            while ($res = mysqli_fetch_assoc($query)) : ?>
                <th class="bg-primary text-white"><?= $res['nama']; ?></th>
            <?php endwhile; ?>
            <th>Jumlah</th>
            <th>Rata-Rata</th>
        </thead>

        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM alternatif");
            while ($baris = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <th class="bg-primary text-white"><?= $baris['nama'] ?></th>
                    <?php
                    $query2 = mysqli_query($koneksi, "SELECT * FROM juml_alt_kri WHERE id_kriteria = '$data[id]'");
                    while ($kolom = mysqli_fetch_assoc($query2)) : ?>
                        <td>
                            <?php
                            if ($baris['id'] == $kolom['id_alternatif']) {
                                $c = 1 / $kolom['jumlah'];
                                $insertEigen = mysqli_query($koneksi, "UPDATE analisa_alternatif SET hasil_analisa_alternatif = '$c' WHERE alternatif1 = '$baris[id]' AND alternatif2 = '$kolom[id_alternatif]' AND idKriteria = '$data[id]'");
                                echo number_format($c, 4, ',', ',');
                            } else {
                                $queryEigen = mysqli_query($koneksi, "SELECT * FROM analisa_alternatif WHERE alternatif1 = '$baris[id]' AND alternatif2 = '$kolom[id_alternatif]' AND idKriteria = '$data[id]'");
                                $resultEigen = mysqli_fetch_assoc($queryEigen);

                                $c = $resultEigen['indeks'] / $kolom['jumlah'];
                                $insertEigen = mysqli_query($koneksi, "UPDATE analisa_alternatif SET hasil_analisa_alternatif = '$c' WHERE alternatif1 = '$baris[id]' AND alternatif2 = '$kolom[id_alternatif]' AND idKriteria = '$data[id]'");
                                echo number_format($c, 4, ',', '.');
                            }
                            ?>
                        </td>
                    <?php endwhile; ?>
                    <th>
                        <?php
                        $queryTotalEigen = mysqli_query($koneksi, "SELECT SUM(hasil_analisa_alternatif) as jumlah
                        FROM analisa_alternatif WHERE alternatif1 = '$baris[id]' AND idKriteria = '$data[id]'");
                        $resultTotalEigen = mysqli_fetch_assoc($queryTotalEigen);
                        echo number_format($resultTotalEigen['jumlah'], 4, ',', '.');
                        ?>
                    </th>
                    <th>
                        <?php
                        $queryAvgEigen = mysqli_query($koneksi, "SELECT AVG(hasil_analisa_alternatif) as rata
                        FROM analisa_alternatif WHERE alternatif1 = '$baris[id]' AND idKriteria = '$data[id]'");
                        $resultAvgEigen = mysqli_fetch_assoc($queryAvgEigen);

                        $avgEigen = mysqli_query($koneksi, "UPDATE juml_alt_kri SET bobot_alternatif='$resultAvgEigen[rata]' WHERE id_alternatif = '$baris[id]' AND id_kriteria = '$data[id]'");
                        echo number_format($resultAvgEigen['rata'], 4, ',', '.');
                        ?>
                    </th>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>
<!-- End Of Eigenvector Table -->

<!-- Result -->
<section class="mt-5">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th class="bg-info text-white">Alternatif</th>
                <td>
                    <?php
                    $rowCount = mysqli_query($koneksi, "SELECT COUNT(*) as rowCount FROM alternatif");
                    $count = mysqli_fetch_assoc($rowCount);
                    echo $count['rowCount'];
                    ?>
                </td>
            </tr>
            <tr>
                <th class="bg-info text-white">Lambda Max</th>
                <td>
                    <?php
                    $lambdaMax = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM juml_alt_kri WHERE id_kriteria='$data[id]'");
                    while ($result = mysqli_fetch_assoc($query)) {
                        $lambdaMax += $result['jumlah'] * $result['bobot_alternatif'];
                    }
                    echo number_format($lambdaMax, 4, ',', '.');
                    ?>
                </td>
            </tr>
            <tr>
                <th class="bg-info text-white">Consistency Index</th>
                <td>
                    <?php
                    $ci = ($lambdaMax - $count['rowCount']) / ($count['rowCount'] - 1);

                    echo number_format($ci, 5, ',', '.');
                    ?>
                </td>
            </tr>
            <tr>
                <th class="bg-info text-white">Consistency Ratio</th>
                <td>
                    <?php

                    switch ($count['rowCount']) {
                        case 1:
                            $r = 0;
                            break;
                        case 2:
                            $r = 0;
                            break;
                        case 3:
                            $r = 0.58;
                            break;
                        case 4:
                            $r = 0.90;
                            break;
                        case 5:
                            $r = 1.12;
                            break;
                        case 6:
                            $r = 1.24;
                            break;
                        case 7:
                            $r = 1.32;
                            break;
                        case 8:
                            $r = 1.41;
                            break;
                        case 9:
                            $r = 1.45;
                            break;
                        default:
                            echo 'not found';
                    }

                    $cr = $ci / $r;

                    echo number_format($cr, 5, ',', '.');

                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</section>
<!-- End of Result -->

<?php
include 'footer/footer.php';
?>