<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\JenisBayar;
class JenisbayarController extends BaseController{

    protected $jenisbayars;
    function __construct()
    {
        $this->jenisbayars = new Jenisbayar();
    }
    public function index()
    {
        $data['jenisbayar']=$this->jenisbayars->findAll();
        return view('jenisbayar_view',$data);
    }
    public function save()
    {
        $this->jenisbayars->insert([
            'nama_jenis_pembayaran'=>$this->request->getPost('nama_jenis_pembayaran'),
            'nominal'=>$this->request->getPost('nominal'),
            'tahun_ajaran'=>$this->request->getPost('tahun_ajaran'),
        ]);
        return redirect('jenisbayar');
    }
    public function edit($id)
    {
        $data= array(
            'nama_jenis_pembayaran'=>$this->request->getPost('nama_jenis_pembayaran'),
            'nominal'=>$this->request->getPost('nominal'),
            'tahun_ajaran'=>$this->request->getPost('tahun_ajaran'),
        );
        $this->jenisbayars->update($id, $data);
        session()->getFlashdata("message", "Data berhasi disimpan");
        return redirect('jenisbayar');
    }
    public function delete($id)
    {
        $this->jenisbayars->delete($id);
        session()->setFlashdata("message","data berhasil di hapus");
        return redirect('jenisbayar');
    }
}