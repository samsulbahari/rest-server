<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_model extends CI_Model
{
    public function get($id = null)
    {
        if($id === null)
        {
        $get = $this->db->get('telepon')->result_array();
        return $get;
        }else{
            $get = $this->db->get_where('telepon',['id'=>$id])->result_array();
        return $get;
        }

    }
    public function hapus($id){
        $this->db->delete('telepon',['id' => $id]);
        return $this->db->affected_rows();
    }
    public function tambah($data)
    {
        $this->db->insert('telepon',$data);
        return $this->db->affected_rows();
    }
    public function ubah($data,$id)
    {
        $this->db->update('telepon',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
}