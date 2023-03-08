<?=$this->extend('layouts/admin')?>
<?=$this->section('title')?>
Siswa
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="row">
    <div class="col">
        <div class="card-border-primary">
            <div class="card-header bg-primary">
                <a href="" data-toggle="modal" data-target="#fsiswa" data-siswa="" class="btn btn-outline-info">Siswa Baru</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nis</th>
                        <th>Kelas</th>
                        <th>Tahun Masuk</th>
                        <th>No rek</th>
                        <th>jk</th>
                        <th>opsi</th>
                    </tr>
                    <?php
                        $no=0;
                        foreach($siswa as $row){
                            $no++;
                            $data = $row['nama_siswa'].",".$row['nis'].",".$row['kelas'].",".$row['tahun_masuk'].",".$row['no_rek'].",".$row['jk'].",".base_url('siswa/edit/'.$row['id_siswa']);
                            ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$row['nama_siswa']?></td>
                                <td><?=$row['nis']?></td>
                                <td><?=$row['kelas']?></td>
                                <td><?=$row['tahun_masuk']?></td>
                                <td><?=$row['no_rek']?></td>
                                <td><?=$row['jk']?></td>
                                <td>
                                    <a href="" data-siswa="<?=$data?>" data-target="#fsiswa" data-toggle="modal" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="/siswa" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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

<div class="modal fade" id="fsiswa" tabindex="-1" aria-labelledby="modalSiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="frmsiswa" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" id="nama_siswa">
                    </div>
                    <div class="form-group">
                        <label for="nis">Nis</label>
                        <input type="text" name="nis" class="form-control" id="nis">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" name="kelas" id="kelas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tahun_masuk">Tahun Masuk</label>
                        <input type="text" name="tahun_masuk" id="tahun_masuk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="no_rek">No rek</label>
                        <input type="number" name="no_rek" id="no_rek" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
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
        $("#fsiswa").on('show.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var data = button.data('siswa');
            if(data != ""){
                const barisdata = data.split(",");
                $('#nama_siswa').val(barisdata[0]);
                $('#nis').val(barisdata[1]);
                $('#kelas').val(barisdata[2]);
                $('#tahun_masuk').val(barisdata[3]);
                $('#no_rek').val(barisdata[4]);
                $('#jk').val(barisdata[5]).change();
                $('#frmsiswa').attr('action',barisdata[6]);
            }else{
                $('#nama_siswa').val('');
                $('#nis').val('');
                $('#kelas').val('');
                $('#tahun_masuk').val('');
                $('#no_rek').val('');
                $('#jk').val('').change();
                $('#frmsiswa').attr('action','/ssiswa');
            }
        });
    });
</script>
<?=$this->endSection()?>