<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Jenis Pembayaran
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="card border-primary">
            <div class="card-header bg-primary">
                <a href="#" data-jenisbayar="" class="btn btn-outline-info" data-target="#modalJenisbayar" data-toggle="modal"><i fas fa-fw fa-solid fa-user-plus></i>Tambah Data</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Jenis Bayar</th>
                        <th>Nominal</th>
                        <th>Tahun ajaran</th>
                    </tr>
                    <?php
                    $no = 0;
                    foreach ($jenisbayar as $row) {
                        $data = $row['nama_jenis_pembayaran'] . "," . $row['nominal'] . "," . $row['tahun_ajaran'] . "," . base_url('jenisbayar/edit/' . $row['id_jenis_pembayaran']);
                        $no++;
                    ?>
                        <tr>
                            <td><?= $row['nama_jenis_pembayaran'] ?></td>
                            <td><?= $row['nominal'] ?></td>
                            <td><?= $row['tahun_ajaran'] ?></td>
                            <td>
                                <a href="" data-jenisbayar="<?= $data ?>" data-target="#modalJenisbayar" data-toggle="modal" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('jenisbayar/delete/' . $row['id_jenis_pembayaran']) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php if (!empty(session()->getFlashdata("message"))) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata("message") ?>
                </div>
            <?php endif ?>

            <div class="modal fade" id="modalJenisbayar" tabindex="-1" aria-labelledby="modaljenisbayarLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input data jenis bayar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="frmJenisbayar" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_jenis_pembayaran" class="form-label">Jenis bayar</label>
                                    <input type="text" name="nama_jenis_pembayaran" id="nama_jenis_pembayaran" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nominal" class="form-label">Nominal</label>
                                    <input type="number" name="nominal" id="nominal" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $("#modalJenisbayar").on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var data = button.data('jenisbayar');
            if (data != "") {
                const barisdata = data.split(",");
                $('#nama_jenis_pembayaran').val(barisdata[0]);
                $('#nominal').val(barisdata[1]);
                $('#tahun_ajaran').val(barisdata[2]);
                $('#frmJenisBayar').attr('action', barisdata[3]);
            } else {
                $('#nama_jenis_pembayaran').val('');
                $('#nominal').val('');
                $('#tahun_ajaran').val('');
                $('#frmJenisbayar').attr('action', '/sjenisbayar');
            }
        });
    });
</script>
<?= $this->endSection() ?>