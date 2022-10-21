<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// panggil libraries Server
require APPPATH."libraries/Server.php";

class Mahasiswa extends Server {

	// service get
    function service_get ()
    {
        
        //panggiilan fungsi/method "get_data"
        $hasil = $this->mdl->get_data();

        // tampilkan hasil dalam format "JSON"
        $this->response(array("mahasiswa" => $hasil),200);
    }


    // service delete
    function service_delete ()
    {
        // ambil parameter "npm" sebagai dasar penghapusn data
        $token = $this->delete("npm");

        // panggil method "hapus_data
        $hasil = $this->mdl->hapus_data(base64_encode($token));
    
        // jika data mahasiswa berhasil di hapus
        if($hasil == 1)
    
        {
        // tampilkan hasil dalam format "JSON"
        $this->response(array("status" => "Data Berhasil Dihapus"),200);
        }
        
        // jika data mahasiswa gagal dihapus
        else
        
        {
        // tampilkan status dalam format "JSON"
        $this->response(array("status" => "Data Gagal Dihapus ! "),200);
        }
    }


    // service post
    function service_post ()
    {
        // panggil model "Mmahaiswa"
        $this->load->model ("Mmahasiswa","mdl",TRUE);
        // ambil data dari parameter2
        $data = array(
            "npm" => $this->post("npm"),
            "nama" => $this->post("nama"),
            "telepon" => $this->post("telepon"),
            "jurusan" => $this->post("jurusan"),
        );

        // panggil method "simpan_data"
        $hasil = $this->mdl->simpan_data($data["npm"],$data["nama"],$data["telepon"],$data["jurusan"], base64_encode($data{"npm"}));
        // jika mahasiswa tidak ditemukan
        if($hasil == 0)
        {
            // tampilkan hasil dalam format "JSON"
        $this->response(array("status" => "Data Berhasil Disimpan..."),200);
        }
        // jika mahasiswa ditemukan
        else
        {
        // tampilkan hasil dalam format "JSON"
        $this->response(array("status" => "Data Gagal Disimpan"),200);
        }
    }

    // service put
    function service_put ()
    {
        
    }


}
