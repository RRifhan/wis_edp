<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        helper('auth');


        if ($request->uri->getSegment(1) != "auth") {
            if (!session()->has('username')) {
                return redirect()->to(base_url('auth'));
            } else {
                if ($request->uri->getSegment(1) == "profile") {

                    return;
                }
                $request = \Config\Services::request();
                $role_id = session()->get('role_id');
                $menu = $request->uri->getSegment(1);
                $alowed = ['', 'profile'];
                if (in_array($menu, $alowed)) {
                    $menu = 'dashboard';
                }

                $querymenu = "SELECT tb_menu_role.*,link FROM tb_menu_role JOIN tb_menu 
            ON tb_menu_role.`id_menu`=tb_menu.id WHERE id_level_user='$role_id' AND link ='$menu'";
                $db      = \Config\Database::connect();

                $cekMenuAkses = $db->query($querymenu)->getNumRows();

                if ($cekMenuAkses < 1) {
                    return redirect()->to(base_url('auth/blocked'));
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
