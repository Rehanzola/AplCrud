<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServerApi extends CI_Controller {
    //fungsi untuk CREATE
    public function addStaff() {
        //deklarasi variabel
        $name = $this->input->post('name');
        $hp = $this->input->post('hp');
        $alamat = $this->input->post ('alamat');

        //mengisikan variabel dengan nama file
        $data['staff name'] = $name;
        $data['staff_hp']  = $hp;
        $data['staff alamat'] = $alamat;
        $q = $this->db->insert('tb_staff', $data);

        //cek apakah insert berhasil
        if ($q) {
            $response['pesan']='insert berhasil';
            $response['status']=200;
        } else {
            $response['pesan']='insert gagal';
            $response['status']=404;
        }
        echo json_encode ($response);
    }

    //fungsi untuk READ
    public function getDataStaff() {
        //deklarasi variabel
        $q = $this->db->get('tb_staff');

        //cek apakah read berhasil
        if ($q->num_rows() > 0) {
            $response['pesan']='data ada';
            $response['status']=200;

             //1 row
            $response['staff'] = $q->row(); 
            $response['staff'] = $q->result();
         } else {
            $response['pesan']='data tidak ada';
            $response['status']=404;
         }
        echo json_encode ($response);
    }

    //fungsi untuk UPDATE
    public function updateStaff() {
        //deklarasi variabel 
        $id = $this->input->post('id');
        $name = $this->input->post('name'); 
        $hp = $this->input->post('hp');
        $alamat = $this->input->post ('alamat'); 
        $this->db->where('staff id', $id);
    
        //mengisikan variabel dengan nama file
        $data['staff_name'] = $name; 
        $data['staff_hp'] = $hp;
        $data['staff_alamat'] = $alamat; 
        $q = $this->db->update ('tb_staff', $data);
    
    //cek apakah update berhasil
    if ($q) { 
        $response['pesan']='update berhasil';   
        $response['status']=200;
    } else {
        $response['pesan']='update gagal';
        $response['status']=404;
    }
    echo json_encode ($response);
}

    //fungsi untuk DELETE 
    public function deleteStaff() {
    //deklarasi variabel 
        $id = $this->input->post('id'); 
        $this->db->where('staff id', $id); 
        $status = $this->db->delete ('tb_staff');

    //cek apakah berhasil terhapus
    if ($status== true) { 
        $response['pesan']='hapus berhasil'; 
        $response['status']=200;
    } else {
        $response['pesan']='hapus gagal'; 
        $response['status']=404;
    }
    echo json_encode ($response);
    }  
} 
