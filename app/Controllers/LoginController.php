<?php 
namespace App\Controllers;

use App\Models\Petugas;
use CodeIgniter\Controller;

class LoginController extends BaseController{
    public function index()
    {
        return view('login_view');
    }
    public function login()
    {
        $petugass = new Petugas();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $dataPetugas = $petugass->where(['username'=>$username])->first();
        if($dataPetugas){
            $password = $password . "";
            if(password_verify($password,$dataPetugas['password'])){
                session()->set([
                    'id_petugas'=>$dataPetugas['id_petugas'],
                    'nama_petugas'=>$dataPetugas['nama_petugas'],
                    'hak_akses'=>$dataPetugas['hak_akses'],
                    'logged_in'=>true,
                ]);
                return redirect('home');
            }else{
                session()->setFlashdata('error','username password salah awowaokwok');
                return $this->response->redirect('/login');
            }
        }else{
            session()->setFlashdata('error','username tidak ditemukan aowkowkwoa');
            return $this->response->redirect('/login');
        }
    }
    function logout()
    {
        session()->destroy();
        return $this->response->redirect('/login');
    }
}