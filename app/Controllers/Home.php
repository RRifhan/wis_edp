<?php

namespace App\Controllers;

class Home extends BaseController
{


    public function index()
    {

        $data['title'] = 'Dashboard';
        return view('dashboard', $data);
    }

    public function getToko()
    {
        $kdtk = $this->request->getVar('kdtk');
        $query = "SELECT KodeToko,NamaToko,NoTelpToko,get_user_name(pic_office) AS personil,aspv,amgr,TypeToko24,TokoApka,isIkiosk,AlamatToko,tipe_koneksi_primary,tipe_koneksi_secondary,TOK_KELURAHAN,TOK_KECAMATAN,KotaToko, jenis,ipaddress, lat_decimal,long_decimal,station FROM tb_toko LEFT  JOIN rekap_ip ON tb_toko.`KodeToko`=rekap_ip.`kdtk` WHERE tb_toko.Kodetoko='$kdtk'";
        $hasil = $this->db->query($query)->getResultArray();
        echo json_encode($hasil);
    }
    public function getArea()
    {
        $initial = $this->input->post('initial');
        $query = "SELECT * FROM tb_area WHERE initial='$initial'";
        $hasil = $this->db->query($query)->getRowArray();
        echo json_encode($hasil);
    }
}
