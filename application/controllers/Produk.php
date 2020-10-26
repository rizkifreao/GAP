<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Produk
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

class Produk extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        check_login();
    }
	
	public function index()
	{
        $data['breadcumbs'] = "Produk";
        $data['produks'] = $this->M_Produk->getAll();
		$this->template->display('admin/produk/index',$data);
    }

    public function detailJson($id)
    {
        header('Content-Type: application/json');
        echo json_encode($this->M_Produk->getDetail($id));
    }
    
    public function add()
    {
        $id = $this->input->post("id_produk");;
        $data["label"] = $this->input->post("nama_produk");
        // $data["stok"] = $this->input->post("stok");
        
        if ($id) {
            $this->M_Produk->update($id,$data);
            $this->session->set_flashdata('alert', success("Data berhasil diperbaharui"));
        }else{
            $this->M_Produk->insert($data);
            $this->session->set_flashdata('alert', success("Berhasil menambahkan data baru"));
        }
        redirect('produk');
    }

    public function delete($id)
    {
        $this->M_Produk->delete($id);
        $this->session->set_flashdata('alert', success("Data berhasil dihapus"));
        redirect('produk');
    }

    public function test()
    {
        $dataLogin = array('status' => true,'token'=> '1234' );

        echo $dataLogin['token'];
    }


}