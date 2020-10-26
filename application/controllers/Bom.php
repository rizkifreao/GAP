<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
/**
 * Class Bom
 * Digunakan untuk menyimpan data material untuk membuat aturan suatu produk
 * @property M_Bom|M_Bom_detail
 * ----------------------------------
 * ----------------------------------
 * @author Rizkifreao
 * email : Rizkipebrianto96@gmail.com
 */

class Bom extends CI_Controller { 

    function __construct(){	
        parent::__construct();
        check_login();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data['breadcumbs'] = "Bill Of Material";
        $data['boms'] = $this->M_Bom->getAll();
        $data['produks'] = $this->M_Produk->getAll();
        $data['satuans'] = $this->M_Satuan->getAll();
        $this->template->display('admin/bom/index',$data);
    }

    public function add()
    {
        $id = $this->input->post('id',TRUE);
        
        $data['label'] = $this->input->post('label',TRUE);
        $data['keterangan'] = $this->input->post('keterangan',TRUE);
        $data['satuanid'] = $this->input->post('satuanid',TRUE);
        
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->M_Bom->update($id,$data);
            $this->session->set_flashdata('alert',success('Data berhasil diperbaharui'));
            
        }else{
            $data['produkid'] = $this->input->post('produkid',TRUE);
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->M_Bom->insert($data);
            $this->session->set_flashdata('alert',success('Data berhasil ditambahkan'));
        }

        redirect('bom');
    }

    public function detailJson($id)
    {
        header('Content-Type: application/json');
        $bom = $this->M_Bom->getDetail($id);
        $data = [
            'id' => $bom->id,   
            'produkid' => $bom->produkid,   
            'produk_label' => $this->M_Produk->getDetail($bom->produkid)->label,   
            'label' => $bom->label,   
            'keterangan' => $bom->keterangan,   
            'satuanid' => $bom->satuanid,   
        ];
        echo json_encode($data);
    }

    public function bomDetailJson($id)
    {
        header('Content-Type: application/json');
        $det_bom = $this->M_Bom_detail->getDetail($id);
        $data = [
            'id' => $det_bom->id,
            'bomid' => $det_bom->bomid,
            'materialid' => $det_bom->materialid,
            'satuanid' => $det_bom->satuanid,
            'qty' => $det_bom->qty,
            'material' => $this->M_Material->getDetail($det_bom->materialid)->label,
        ];
        echo json_encode($data);
    }

    public function addDetail()
    {
        $id = $this->input->post('id',TRUE);
        $data['bomid'] = $bomid = $this->input->post('bomid',TRUE);
        $data['qty'] = $this->input->post('jumlah',TRUE);
        $data['satuanid'] = $this->input->post('satuanid',TRUE);
        $data['produkid'] = $this->input->post('produkid',TRUE);
        
        if ($id) { // jika id terisi maka proses yang dilakukan yaitu Update
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->M_Bom_detail->update($id,$data);
            if ($this->db->error()) {
                $this->session->set_flashdata('alert',success('Data sudah ada'));
                echo $this->db->error();
            }
            $this->session->set_flashdata('alert',success('Data berhasil diperbaharui'));
        }else {
            $data['materialid'] = $this->input->post('materialid',TRUE);
            $data['created_at'] = date('Y-m-d H:i:s');
            if ($this->M_Bom_detail->insert($data)) {
                $this->session->set_flashdata('alert',error('Gagal, Data sudah ada !!'));
                redirect('bom/detail/'.$bomid);
            }
            $this->session->set_flashdata('alert',success('Data berhasil ditambahkan'));
        }

        redirect('bom/detail/'.$bomid);
    }

    public function detail($id)
    {
        $bom = $this->M_Bom->getDetail($id);
        if (!$bom) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan !!'));
            redirect('bom');
        }

        $data = [
            'breadcumbs' => "Detail Bill of Material",
            'bom' => $bom,
            'det_bom' => $this->M_Bom_detail->getAllBy('bomid ='.$bom->id),
            'materials' => $this->M_Material->getAll(),
            'satuans' => $this->M_Satuan->getAll(),
        ];
        $this->template->display('admin/bom/detail',$data);
    }

    public function deleteDetail($id)
    {
        $det_bom = $this->M_Bom_detail->getDetail($id);
        $this->M_Bom_detail->delete($id);
        $this->session->flashdata('alert',success('Data berhasil dihapus'));
        redirect('bom/detail/'.$det_bom->bomid,'refresh');
    }
    
    public function delete($id)
    {
        $bom = $this->M_Bom->getDetail($id);
        if ($$bom) {
            $this->session->flashdata('alert',error('Data tidak ditemukan !!'));
            redirect('bom','refresh');
        }
        $this->M_Bom->delete($id);
        $this->session->flashdata('alert',success('Data Berhasil dihapus'));
        
        redirect('bom','refresh');
        
    }
}