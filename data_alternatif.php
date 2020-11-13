<?php
include 'header/header.php';
?>

<div class="row">
    <div class="col-lg-4">
        <h3 class="mb-3">Masukkan Data Alternatif</h1>
            <form action="input_alternatif.php" method="POST">
                <div class="form-group">
                    <label for="idAlternatif">ID Alternatif</label>
                    <input type="text" class="form-control" name="idAlternatif" id="idAlternatif" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="namaAlternatif">Nama Alternatif</label>
                    <input type="text" class="form-control" name="namaAlternatif" id="namaAlternatif" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

    <div class="col-lg-8">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <th>ID Alternatif</th>
                <th>Nama Alternatif</th>
            </thead>

            <tbody>
                <?php
                include 'koneksi/koneksi.php';
                $query = mysqli_query($koneksi, "SELECT * FROM alternatif");

                while ($res = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td><?= $res['id'] ?></td>
                        <td><?= $res['nama'] ?></td>
                    </tr>
                <?php
                endwhile;
                ?>
            </tbody>

        </table>
    </div>
</div>


<?php
include 'footer/footer.php';
?>