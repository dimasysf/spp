<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Siswa;
class SiswaController extends BaseController{

    protected $siswas;
    function __construct()
    {
        $this->siswas = new Siswa();
    }
    function index()
    {
        $data['siswa']=$this->siswas->findAll();
        return view('siswa_view',$data);
    }
    public function save()
    {
        $this->siswas->insert([
            'nama_siswa'=>$this->request->getPost('nama_siswa'),
            'nis'=>$this->request->getPost('nis'),
            'kelas'=>$this->request->getPost('kelas'),
            'tahun_masuk'=>$this->request->getPost('tahun_masuk'),
            'no_rek'=>$this->request->getPost('no_rek'),
            'jk'=>$this->request->getPost('jk'),
        ]);
        return redirect('siswa');
    }
    public function edit($id)
    {
        $data= array(
            'nama_siswa'=>$this->request->getPost('nama_siswa'),
            'nis'=>$this->request->getPost('nis'),
            'kelas'=>$this->request->getPost('kelas'),
            'tahun_masuk'=>$this->request->getPost('tahun_masuk'),
            'no_rek'=>$this->request->getPost('no_rek'),
            'jk'=>$this->request->getPost('jk'),
        );
        $this->siswas->update($id, $data);
        session()->getFlashdata("message","Data berhasil di edit");
        return redirect('siswa');
    }
    public function delete($id)
    {
        $this->siswas->delete($id);
        session()->getFlashdata("message","Data berhasil di hapus");
        return redirect('siswa');
    }
}