<?php 
namespace App\Models;

use CodeIgniter\Model;

class Detailtransaksi extends Model{
    protected $table      = 'tbdetail_transaksi';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_detail_transaksi';
    protected $allowedfields = ['id_transaksi','bulan_dibayar','id_jenis_pembayaran'];
}