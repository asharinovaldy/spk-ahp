<?php
include 'header/header.php';
?>

<section class="mt-5">
    <h3 class="mb-3">Perbandingan Alternatif berdasarkan Kriteria</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <th>ID</th>
            <th>Kriteria</th>
        </thead>

        <tbody>
            <?php
            include 'koneksi/koneksi.php';
            $query = mysqli_query($koneksi, "SELECT * FROM kriteria");
            while ($res = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $res['id']; ?></td>
                    <td><?= $res['nama']; ?>
                        <span class="badge badge-primary float-right ml-2">
                            <a href="hitungAlt.php?id=<?= $res['id']; ?>" class="text-white">Bandingkan</a>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

<?php
include 'footer/footer.php';
?>