<?php

namespace App\Controllers;

class Auth extends BaseController
{

    public function index()
    {
        if (session()->has('username')) {
            return redirect()->to(base_url('home'));
        }
        $data['title'] = 'Login WIS|>>EDP';
        $data['validation'] = \Config\Services::validation();
        return view('login/index', $data);
    }
    public function login()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'username' => 'required|trim|min_length[10]',
            'password' => 'required|trim'
        ])) {
            return  redirect()->to(base_url('auth'))->withInput()->with('validation', $validation);
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $db      = db_connect();

        $user = $db->query("SELECT * FROM tb_user where username='$username'")->getRowArray();
        // dd($user);
        if ($user) {
            if (md5($password) == $user['password']) {
                if ($user['is_active'] == 'Y') {
                    $this->session->set('username', $user['username']);
                    $this->session->set('fullname', $user['fullname']);
                    if ($user['admin_menu'] == 'Y') {
                        $this->session->set('admin_menu', $user['admin_menu']);
                    }
                    $this->session->set('role_id', $user['role_id']);
                    return  redirect()->to(base_url('home'));
                } else {
                    $this->session->setFlashdata('message', '<div class="alert alert-warning" role="alert">
                WARNING!! User Anda tidak aktif
              </div>');
                    return  redirect()->to(base_url('auth'))->withInput();
                }
            } else {
                $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert">
                ERROR!! Password salah
              </div>');
                return redirect()->to(base_url('auth'))->withInput();
            }
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert">
            ERROR!! Username ' . $username . ' tidak terdaftar
          </div>');
            return redirect()->to(base_url('auth'))->withInput();
        }
    }
    public function logout()
    {
        $array_items = ['username', 'role_id', 'admin_menu', 'fullname'];
        $this->session->remove($array_items);
        $this->session->setFlashdata('message', '<div class="alert alert-info" role="alert">
        INFO!! You have been logged out
      </div>');
        return redirect()->to(base_url('auth'));
    }
    public function blocked()
    {
        $data['title'] = "Blocked - WIS EDP";
        $data['title_page'] = "Blocked";
        return view('login/blocked', $data);
    }
}
