<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Petugas
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="card-border-primary">
            <div class="card-header bg-primary">
                <a href="" data-toggle="modal" data-target="#fpetugas" data-petugas="" class="btn btn-outline-info">Petugas Baru</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="petugas">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Jabatan</th>
                        <th>Opsi</th>
                    </tr>
                    <?php
                        $no=0;
                        foreach($petugas as $row){
                            $no++;
                            $data = $row['nama_petugas'].",".$row['username'].",".$row['password'].",".$row['no_hp'].",".$row['jabatan'].",".$row['hak_akses'].",".base_url('petugas/edit/'.$row['id_petugas']);
                            ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$row['nama_petugas']?></td>
                                <td><?=$row['username']?></td>
                                <td><?=$row['jabatan']?></td>
                                <td>
                                    <a href="" data-petugas="<?=$data?>" data-target="#fpetugas" data-toggle="modal" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="/petugas" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
        </div>
    </div>
</div>

<div class="modal fade" id="fpetugas" tabindex="-1" aria-labelledby="modalPetugasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input data Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="frmpetugas" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_petugas">Nama Petugas</label>
                        <input type="text" name="nama_petugas" class="form-control" id="nama_petugas">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Hp</label>
                        <input type="text" name="no_hp" class="form-control" id="no_hp">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control" required>
                            <option value="">== pilih jabatan ==</option>
                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                            <option value="Wali Kelas">Wali Kelas</option>
                            <option value="Teller">Teller</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hak_akses">Hak Akses</label>
                        <select name="hak_akses" id="hak_akses" class="form-control" required>
                            <option value="">Pilih Hak akses</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection()?>
<?=$this->section("script")?>
<script>
    $(document).ready(function(){
        $("#fpetugas").on('show.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var data = button.data('petugas');
            if(data != ""){
                const barisdata = data.split(",");
                $('#nama_petugas').val(barisdata[0]);
                $('#username').val(barisdata[1]);
                $('#password').val(barisdata[2]);
                $('#no_hp').val(barisdata[3]);
                $('#jabatan').val(barisdata[4]).change();
                $('#hak_akses').val(barisdata[5]).change();
                $('#frmpetugas').attr('action',barisdata[6]);
            }else{
                $('#nama_petugas').val('');
                $('#username').val('');
                $('#password').val('');
                $('#no_hp').val('');
                $('#jabatan').val('').change();
                $('#hak_akses').val('').change();
                $('#frmpetugas').attr('action','/spetugas');
            }
        });
    });
</script>
<?=$this->endSection()?>