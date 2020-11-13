<?php
include 'header/header.php';
include 'koneksi/koneksi.php';
?>

<!-- Weighting Section -->
<section class="mt-5">

    <?php
    $countCr = mysqli_query($koneksi, "SELECT COUNT(*) as kolom FROM kriteria");
    $count = mysqli_fetch_assoc($countCr);
    ?>

    <table class="table table-bordered">
        <tbody>
            <tr class="bg-success text-white">
                <td>Alternatif</td>
                <td colspan='<?= $count['kolom']; ?>' class="text-center">Bobot Akhir (Bobot Kriteria * Bobot Alternatif) </td>
            </tr>
            <?php
            $alternatif = mysqli_query($koneksi, "SELECT * FROM alternatif");
            while ($result = mysqli_fetch_assoc($alternatif)) : ?>
                <tr>
                    <th><?= $result['nama']; ?></th>
                    <?php
                    $cr = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id ASC");
                    while ($kriteria = mysqli_fetch_assoc($cr)) : ?>
                        <?php
                        $weight = 0;
                        $alt = mysqli_query($koneksi, "SELECT * FROM juml_alt_kri WHERE id_kriteria='$kriteria[id]' AND id_alternatif='$result[id]'");
                        while ($wAlt = mysqli_fetch_assoc($alt)) : ?>
                            <td>
                                <?php
                                $weight = $kriteria['bobot_kriteria'] * $wAlt['bobot_alternatif'];
                                echo number_format($weight, 4, ',', '.');

                                $updateJml = mysqli_query($koneksi, "UPDATE juml_alt_kri SET bobot_akhir = '$weight' WHERE id_alternatif='$result[id]' AND id_kriteria = '$kriteria[id]'");

                                ?>
                            </td>
                        <?php endwhile; ?>
                    <?php endwhile; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</section>
<!-- End of Weighting Section -->

<!-- Ranking Section -->
<section class="mt-5">
    <h3 class="text-center">HASIL AKHIR</h3>
    <table class="table table-bordered">
        <thead class="bg-success text-white">
            <th>Alternatif</th>
            <th>Hasil Akhir</th>
            <th>Peringkat</th>
        </thead>

        <tbody>
            <?php
            $rank = 1;
            $alt2 = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY hasil_akhir DESC");
            while ($result2 = mysqli_fetch_assoc($alt2)) : ?>
                <tr>
                    <td><?= $result2['nama'] ?></td>
                    <td>
                        <?php
                        $r = mysqli_query($koneksi, "SELECT SUM(bobot_akhir) as hasil FROM juml_alt_kri WHERE id_alternatif='$result2[id]'");
                        while ($hasilAkhir = mysqli_fetch_assoc($r)) {
                            echo number_format($result2['hasil_akhir'], 4, ',', '.');

                            $updateAlt = mysqli_query($koneksi, "UPDATE alternatif SET hasil_akhir = '$hasilAkhir[hasil]' WHERE id='$result2[id]'");
                        }
                        ?>
                    </td>
                    <td><?= $rank++; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</section>
<!-- End of Ranking Section -->

<?php include 'footer/footer.php'; ?>