<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

/**
 *
 * Model Material
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    rizkipebrianto <rizkipebrianto96@gmail.com>
 * @link      https://github.com/rizkifreao
 * @param     ...
 * @return    ...
 *
 */

class Material extends CI_Controller { 

    function __construct(){	
        parent::__construct();
        check_login();
    }

    public function index()
    {
        $data['breadcumbs'] = "Material";
        $data['materials'] = $this->M_Material->getAll();
        $this->template->display('admin/material/index',$data);
    }

        public function detailJson($id)
    {
        header('Content-Type: application/json');
        echo json_encode($this->M_Material->getDetail($id));
    }

    public function add()
    {
        $id = $this->input->post("id_material");;
        $data["label"] = $this->input->post("nama_material");
        // $data["stok"] = $this->input->post("stok");
        
        if ($id) {
            $this->M_Material->update($id,$data);
            $this->session->set_flashdata('alert', success("Data berhasil diperbaharui"));
        }else{
            $this->M_Material->insert($data);
            $this->session->set_flashdata('alert', success("Berhasil menambahkan data baru"));
        }
        redirect('material');
    }

    public function delete($id)
    {
        $this->M_Material->delete($id);
        $this->session->set_flashdata('alert', success("Data berhasil dihapus"));
        redirect('material');
    }
}