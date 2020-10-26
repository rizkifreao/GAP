<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Model Satuan
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

class Satuan extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    check_login();
    date_default_timezone_set("Asia/Jakarta");
  }

  public function index()
    {
        $data['breadcumbs'] = "Satuan";
        $data['satuans'] = $this->M_Satuan->getAll();
        $this->template->display('admin/satuan/index',$data);
    }

    public function add()
    {
        $id = $this->input->post('id_satuan',TRUE);
        
        $data['nama_satuan'] = $this->input->post('nama_satuan',TRUE);
        
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->M_Satuan->update($id,$data);
            $this->session->set_flashdata('alert',success('Data berhasil diperbaharui'));
            
        }else{
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->M_Satuan->insert($data);
            $this->session->set_flashdata('alert',success('Data berhasil ditambahkan'));
        }

        redirect('satuan');
    }

    public function detailJson($id)
    {
        header('Content-Type: application/json');
        $data = $this->M_Satuan->getDetail($id);
        echo json_encode($data);
    }
    
    public function delete($id)
    {
        $satuan = $this->M_Satuan->getDetail($id);
        if ($satuan) {
            $this->session->flashdata('alert',error('Data tidak ditemukan !!'));
            redirect('satuan','refresh');
        }
        $this->M_Satuan->delete($id);
        $this->session->flashdata('alert',success('Data Berhasil dihapus'));
        
        redirect('satuan','refresh');
        
    }

}


/* End of file Satuan.php */
/* Location: ./application/controllers/Satuan.php */