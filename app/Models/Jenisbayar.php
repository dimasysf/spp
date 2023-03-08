<?php 
namespace App\Models;

use CodeIgniter\Model;

class JenisBayar extends Model{
    protected $table      = 'tbjenis_pembayaran';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $primaryKey = 'id_jenis_pembayaran';
    protected $allowedFields = ['nama_jenis_pembayaran','nominal','tahun_ajaran'];
}