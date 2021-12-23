<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {

        $db      = db_connect();
        $username = session()->username;
        $user = $db->query("SELECT * FROM tb_user where username='$username'")->getRowArray();

        $data['title'] = "Profile User";
        $data['profile'] = $user;
        return view('profile/index', $data);
    }
    public function changePassword()
    {
        $data['title'] = "Change Password";
        return view('profile/changepassword', $data);
    }
}
