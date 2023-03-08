<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Petugas;
class PetugasController extends BaseController{

    protected $petugass;
    function __construct()
    {
        $this->petugass = new Petugas();
    }
    function index()
    {
        $data['petugas']=$this->petugass->findAll();
        return view('petugas_view',$data);
    }
    public function save()
    {
        $this->petugass->insert([
            'nama_petugas'=>$this->request->getPost('nama_petugas'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            'no_hp'=>$this->request->getPost('no_hp'),
            'jabatan'=>$this->request->getPost('jabatan'),
            'hak_akses'=>$this->request->getPost('hak_akses'),
        ]);
        return redirect('petugas');
    }
    public function edit($id)
    {
        $data= array(
            'nama_petugas'=>$this->request->getPost('nama_petugas'),
            'username'=>$this->request->getPost('nominal'),
            'password'=>$this->request->getPost('password'),
            'no_hp'=>$this->request->getPost('no_hp'),
            'jabatan'=>$this->request->getPost('jabtan'),
            'hak_akses'=>$this->request->getPost('hak_akses'),
        );
        $this->petugass->update($id, $data);
        session()->getFlashdata("message","data berhasil di update awokaowkwoak");
        return redirect('petugas');
    }
    public function delete($id)
    {
        $this->petugass->delete($id);
        session()->setFlashdata("message","Data berhasil di hapus");
        return redirect('petugas');
    }
}