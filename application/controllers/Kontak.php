<?php

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';






class Kontak extends RestController {

    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Kontak_model');
        $this->methods['index_get']['limit'] = 10;
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id === null){
            $kontak = $this->Kontak_model->get();
        }else{
            $kontak = $this->Kontak_model->get($id);
        }
        
        if ($kontak)
        {
             $this->response([
                'status' => true,
                'data' => $kontak
            ],200); 
        }else{
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === null){
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        }else
        {
            if($this->Kontak_model->hapus($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted'
                ], 200); 

            }else{
                $this->response([
                    'status' => false,
                    'message' => 'Provide an id'
                ], 400);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'nomor' => $this->post('nomor')
        ];      
        if ($this->Kontak_model->tambah($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'new kontak created'
            ], 201);           
        }else{
            $this->response([
                'status' => false,
                'message' => 'FAIL NEW DATA'
            ], 400);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'nomor' => $this->put('nomor')
        ];   
        if ($this->Kontak_model->ubah($data,$id) > 0){
            $this->response([
                'status' => true,
                'message' => 'new kontak terupdate'
            ],201);           
        }else{
            $this->response([
                'status' => false,
                'message' => 'FAIL update DATA'
            ], 400);
        }
    }

}
?>