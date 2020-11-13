<?php
include 'header/header.php';
?>

<!-- Questionnaire Form -->
<section>
    <h3 class="mb-3">Perbandingan Berpasangan antar Kriteria</h3>
    <form action="proses_hitung_kriteria.php" method="POST">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="baris">Baris</label>
                    <select class="form-control" name="baris" id="baris">

                        <?php
                        include 'koneksi/koneksi.php';

                        $query = mysqli_query($koneksi, "SELECT * FROM kriteria");
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

                        $query = mysqli_query($koneksi, "SELECT * FROM kriteria");
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
            <th>Kriteria</th>
            <?php
            include 'koneksi/koneksi.php';

            $query = mysqli_query($koneksi, "SELECT * FROM kriteria");
            while ($res = mysqli_fetch_assoc($query)) :  ?>
                <th class="bg-primary text-white"><?= $res['nama'] ?></th>
            <?php endwhile; ?>
        </thead>

        <tbody>

            <?php
            include 'koneksi/koneksi.php';

            $query = mysqli_query($koneksi, "SELECT * FROM kriteria");

            while ($baris = mysqli_fetch_assoc($query)) :  ?>
                <tr>
                    <th class="bg-primary text-white"><?= $baris['nama'] ?></th>
                    <?php
                    $query2 = mysqli_query($koneksi, "SELECT * FROM kriteria");
                    while ($kolom = mysqli_fetch_assoc($query2)) :  ?>
                        <td>
                            <?php
                            if ($baris['id'] == $kolom['id']) {
                                echo 1;
                            } else {
                                $queryNilai = mysqli_query($koneksi, "SELECT * FROM analisa_kriteria WHERE kriteria1 = '$baris[id]' AND kriteria2 = '$kolom[id]'");
                                $nilai = mysqli_fetch_assoc($queryNilai);
                                echo $nilai['indeks'];
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
                $cr1 = mysqli_query($koneksi, "SELECT * FROM kriteria");
                while ($kriteria = mysqli_fetch_assoc($cr1)) :
                ?>
                    <td>
                        <?php
                        $queryJml = mysqli_query($koneksi, "SELECT SUM(indeks) AS jumlah FROM analisa_kriteria WHERE kriteria2 = '$kriteria[id]'");
                        $resultQuery = mysqli_fetch_assoc($queryJml);
                        echo number_format($resultQuery['jumlah'], 2, ',', ',');

                        $updateJml = mysqli_query($koneksi, "UPDATE kriteria SET jumlah_kriteria = '$resultQuery[jumlah]' WHERE id = '$kriteria[id]'");

                        ?>
                    </td>
                <?php endwhile; ?>
            </tr>
        </tfoot>
    </table>
</section>
<!-- End of Table -->

<!-- Eigenvector Table -->
<section>
    <h3 class="mt-5">Nilai Eigen</h3>

    <table class="table table-striped table-bordered">
        <thead>
            <th>Kriteria</th>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM kriteria");
            while ($res = mysqli_fetch_assoc($query)) : ?>
                <th class="bg-primary text-white"><?= $res['nama']; ?></th>
            <?php endwhile; ?>
            <th>Jumlah</th>
            <th>Rata-Rata</th>
        </thead>

        <tbody>
            <?php
            $queryC1 = mysqli_query($koneksi, "SELECT * FROM kriteria");
            while ($kriteria1 = mysqli_fetch_assoc($queryC1)) : ?>
                <tr>
                    <th class="bg-primary text-white"><?= $kriteria1['nama'] ?></th>
                    <?php
                    $queryC2 = mysqli_query($koneksi, "SELECT * FROM kriteria");
                    while ($kriteria2 = mysqli_fetch_assoc($queryC2)) : ?>
                        <td>
                            <?php
                            if ($kriteria1['id'] == $kriteria2['id']) {
                                $c = 1 / $kriteria2['jumlah_kriteria'];
                                $insertEigen = mysqli_query($koneksi, "UPDATE analisa_kriteria SET hasil_analisa_kriteria = '$c' 
                                WHERE kriteria1 = '$kriteria1[id]' AND kriteria2 = '$kriteria2[id]' ");
                                echo number_format($c, 4, ',', ',');
                            } else {
                                $queryEigen = mysqli_query($koneksi, "SELECT * FROM analisa_kriteria 
                                WHERE kriteria1 = '$kriteria1[id]' AND kriteria2 = '$kriteria2[id]'");
                                $resultEigen = mysqli_fetch_assoc($queryEigen);

                                $c = $resultEigen['indeks'] / $kriteria2['jumlah_kriteria'];
                                $insertEigen = mysqli_query($koneksi, "UPDATE analisa_kriteria SET hasil_analisa_kriteria = '$c'
                                WHERE kriteria1 = '$kriteria1[id]' AND kriteria2 = '$kriteria2[id]' ");
                                echo number_format($c, 4, ',', '.');
                            }
                            ?>
                        </td>
                    <?php endwhile; ?>
                    <th>
                        <?php
                        $queryTotalEigen = mysqli_query($koneksi, "SELECT SUM(hasil_analisa_kriteria) as jumlah
                        FROM analisa_kriteria
                        WHERE kriteria1 = '$kriteria1[id]'");

                        $resultTotalEigen = mysqli_fetch_assoc($queryTotalEigen);
                        echo number_format($resultTotalEigen['jumlah'], 4, ',', '.');
                        ?>
                    </th>
                    <th>
                        <?php
                        $queryAvgEigen = mysqli_query($koneksi, "SELECT AVG(hasil_analisa_kriteria) as rata
                        FROM analisa_kriteria WHERE kriteria1 = '$kriteria1[id]'");
                        $resultAvgEigen = mysqli_fetch_assoc($queryAvgEigen);

                        $avgEigen = mysqli_query($koneksi, "UPDATE kriteria SET bobot_kriteria='$resultAvgEigen[rata]' WHERE id = '$kriteria1[id]'");
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
                <th class="bg-info text-white">Kriteria</th>
                <td>
                    <?php
                    $rowCount = mysqli_query($koneksi, "SELECT COUNT(*) as rowCount FROM kriteria");
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
                    $query = mysqli_query($koneksi, "SELECT * FROM kriteria");
                    while ($result = mysqli_fetch_assoc($query)) {
                        $lambdaMax += $result['jumlah_kriteria'] * $result['bobot_kriteria'];
                    }
                    echo number_format($lambdaMax, 5, ',', '.');
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
include 'footer/footer.php'
?>