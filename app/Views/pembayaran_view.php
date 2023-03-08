<?=$this->extend('layouts/admin')?>
<?=$this->section('title')?>
Pembayaran
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="row">
    <div class="col">
        <div class="card border-primary">
            <div class="card-header bg-primary">

            </div>
            <div class="card-body">
                <form action="/caritagihan" method="post">
                    <div class="form-group">
                        <label for="">No rekening</label>
                        <input type="text" name="no_rek" id="no_rek" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"</i></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>