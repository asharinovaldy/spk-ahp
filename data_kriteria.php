<?php
include 'header/header.php';
?>

<div class="row">
    <div class="col-lg-4">
        <h3 class="mb-3">Masukkan Data Kriteria</h1>
            <form action="input_kriteria.php" method="POST">
                <div class="form-group">
                    <label for="idKriteria">ID Kriteria</label>
                    <input type="text" class="form-control" name="idKriteria" id="idKriteria" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="namaKriteria">Nama Kriteria</label>
                    <input type="text" class="form-control" name="namaKriteria" id="namaKriteria" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

    <div class="col-lg-8">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <th>ID Kriteria</th>
                <th>Nama Kriteria</th>
            </thead>

            <tbody>
                <?php
                include 'koneksi/koneksi.php';
                $query = mysqli_query($koneksi, "SELECT * FROM kriteria");

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