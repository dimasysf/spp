<?php

namespace App\Controllers;

use App\Models\DetailTransaksi;
use CodeIgniter\Controller;
use App\Models\Transaksi;
use App\Models\Siswa;
use App\Models\Jenisbayar;
use Config\Database;

class TransaksiController extends BaseController
{
    function __construct()
    {
        $this->transaksi = new Transaksi();
        $this->detail_transaksi = new Detailtransaksi();
        $this->siswa = new Siswa();
        $this->jenisbayar = new Jenisbayar();
        $this->db = \config\Database::connect();
    }
    public function index()
    {
        return view('pembayaran_view');
    }
    public function cari()
    {
        $bulan = array();
        $trans = array();
        if ($this->request->getVar('no_rek') != null) {
            $no_rek = $this->request->getVar('no_rek');
            $data_siswa = $this->siswa->where('no_rek', $no_rek)->first();
            $sel = $this->db->table('tbsiswa a,tbjenis_pembayaran b');
            if($data_siswa != null){
                $where = "a.tahun_masuk = b.tahun_ajaran AND a,id_siswa =". $data_siswa['id_siswa'];
                $sel->where($where);
                $query = $sel->get();
                foreach ($query->getResult() as $row) {
                    $seltrans = $this->db->table('tbtransaksi a, detail_transaksi b');
                    $wheretrans = "a.id_transaksi = b.id_transaksi AND a.id_siswa=".$row->id_siswa." and b.id_jenis_pembayaran".$row->id_jenis_pembayaran;
                    $seltrans->where($wheretrans);
                    $hasil = $seltrans->countAllResult();
                    if($hasil > 0) {
                        $seltrans = $this->db->table('tbtransaksi a, detail_transaksi b');
                        $wheretrans = "a.id_transaksi = b.id_transaksi AND a,id_siswa".$row->id_siswa." and b.id_jenis_pembayaran=".$row->id_jenis_pembayaran;
                        $seltrans->where($wheretrans);
                        $hTrans = $seltrans->get();
                        foreach($hTrans->getResult() as $row1) {
                            if ($row->id_jenis_pembayaran == $row1->id_jenis_pembayaran) {
                                $trans[$row->nama_transaksi] = $row1->id_transaksi;
                            }
                        }
                        $bulan[$row->nama_transaksi] = 0;
                    }else{
                        $bulan[$row->nama_transaksi] = $row->id_jenis_pembayaran;
                    }
                }
            }
            $data["trans"] = $trans;
            $data["spp"]= $bulan;
            $data["siswa"]=$data_siswa;
            return view('cari_view', $data);
        }else{
            return view("tampil_transaksi");
        }
    }
    public function bayar($bulan, $id, $idjenis_pembayaran)
    {
        $tanggal = Date("Y-m-d");
        $idtrans = $this->transaksi->insert([
            "id_siswa" => $id,
            "id_petugas" => '2'

        ]);
        $siswas = $this->siswa->find($id);
        $this->detail_transaksi->insert([]);
    }
    public function bill($id)
    {
        $seltrans = $this->db->table('transaksi a, detail_transaksi b, tbsiswa c, tbpetugas d');
        $wheretrans = "a.id_transaksi = b.id_transaksi and a.id_siswa = c.id_siswa and d.id_petugas = a.id_petugas and a.id_transaksi='$id'";
        $seltrans->where($wheretrans);
        $q = $seltrans->get();
        foreach ($q->getResult() as $row) {
            $kelas = $row->kelas;
            $nama_siswa = $row->nama_siswa;
            $petugas = $row->nama_petugas;
        }
        $data['kelas'] = $kelas;
        $data['nama_siswa'] = $nama_siswa;
        $data['petugas'] = $petugas;
        return view('bill', $data);
    }
}
