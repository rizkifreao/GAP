<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
/**
 *
 * Model Pembelian
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

class Pembelian extends CI_Controller { 

    function __construct(){	
        parent::__construct();
        check_login();
    }
    
    public function index()
    {
        $data['breadcumbs'] = "Pembelian Material";
        $data['pembelians'] = $this->M_Pembelian->getAllBy('nofaktur != ""');
        $this->template->display('admin/pembelian/index',$data);
    }

    public function detail($id)
    {
        $pembelian = $this->M_Pembelian->getDetail($id);
        if (!$pembelian) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan'));
            redirect("pembelian");
        }

        $data['breadcumbs'] = "Pembelian Material";
        $data['pembelian'] = $pembelian;
        $data['det_pembelian'] = $this->M_Pembelian_detail->getAllBy('pembelianid ='.$pembelian->id_pembelian);
        $this->template->display('admin/pembelian/detail',$data);
    }

    public function detailPembelianJson($id)
    {
        header('Content-Type: application/json');
        $det_pembelian = $this->M_Pembelian_detail->getDetail($id);
        $data = array(
            'id' => $det_pembelian->id,
            'materialid' => $det_pembelian->materialid,
            'label'=> $this->M_Material->getDetail($det_pembelian->materialid)->label,
            'jumlah'=> $det_pembelian->jumlah 
        );
        echo json_encode($data);
    }

    public function create($id="")
    {
        if (empty($id)) {
            $data['nofaktur'] = '';
            $this->M_Pembelian->insert($data);
            $lastID = $this->db->insert_id();
            redirect('pembelian/create/'.$lastID);
        }

        $pembelian = $this->M_Pembelian->getDetail($id);
        if (!$pembelian) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan !'));
            redirect('pembelian');
        }
        if ($pembelian->status === "SELESAI") {
            $this->session->set_flashdata('alert',error('Maaf tidak dapat diproses !'));
            redirect('pembelian');
        }
        $data['breadcumbs'] = "Pembelian Material";
        $data['pembelian'] = $pembelian;
        $data['det_material'] = $this->M_Pembelian_detail->getAllBy("pembelianid =".$id);
        $data['material'] = $this->M_Material->getAll();
        $this->template->display('admin/pembelian/create',$data);
    }

    public function addMaterial()
    {
        // Insert to table det_pembelian
        $id = $this->input->post("id");
        $data["pembelianid"] = $pembelianid = $this->input->post("pembelianid");
        $data["materialid"] = $id_material = $this->input->post("materialid");
        $data["jumlah"] = $jumlah = $this->input->post("jumlah");
        $data["stok_awal"] = $this->input->post("stok_awal");

        if ($id) {
            $this->M_Pembelian_detail->update($id,$data);
            $html = $this->load->view('admin/pembelian/tabel', array('det_material'=>$this->M_Pembelian_detail->getAllBy("pembelianid =".$pembelianid)), true);
            $callback = array(
				'status'=>'success',
				'pesan'=>'Data berhasil diperbaharui',
				'html'=>$html
			);
        }else{
            $this->M_Pembelian_detail->insert($data);

            $html = $this->load->view('admin/pembelian/tabel', array('det_material'=>$this->M_Pembelian_detail->getAllBy("pembelianid =".$pembelianid)), true);
            $callback = array(
                'status'=>'success',
				'pesan'=>'Data berhasil ditambahkan',
				'html'=> $html
			);
        }
        
        echo json_encode($callback);
    }

    public function pembelianfinish()
    {
        // update atribut faktur
        $pembelian["id_pembelian"] = $pembelianid = $this->input->post("id_pembelian");
		$pembelian["nofaktur"] = $this->input->post("nofaktur");
		$pembelian["suplier"] = $this->input->post("suplier");
		$pembelian["tanggal"] = $this->input->post("tanggal");
        $pembelian["keterangan"] = $this->input->post("keterangan");
        $pembelian["status"] = "SELESAI";
        // echo json_encode($pembelian);
        $this->M_Pembelian->update($pembelianid,$pembelian);

        // update stok material
        $det_pembelian = $this->M_Pembelian_detail->getAllBy("pembelianid =".$pembelianid);
        foreach ($det_pembelian as $key ) {
            $matrial = $this->M_Material->getDetail($key->materialid);
            $data['stok'] = $matrial->stok + $key->jumlah;
            $this->M_Material->update($key->materialid,$data);
        }

        $this->session->set_flashdata('alert',success('Data berhasil disimpan'));
        redirect("pembelian");
    }

    public function pembelianBatal($id)
    {
        if (!$this->M_Pembelian->getDetail($id)) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan !!'));
            redirect("pembelian");
        }else {
            $this->M_Pembelian->delete($id);
            $this->session->set_flashdata('alert',success('Data berhasil dibatalkan'));
            redirect("pembelian");
        }

    }

    public function hapusDetailPembelian($id)
    {
        $pembelianid = $this->M_Pembelian_detail->getDetail($id)->pembelianid;
        if (!$this->M_Pembelian_detail->getDetail($id)) {
           $html = $this->load->view('admin/pembelian/tabel', array('det_material'=>$this->M_Pembelian_detail->getAllBy("pembelianid =".$pembelianid)), true);
            $callback = array(
                'status'=>'error',
                'pesan'=>'Data tidak ditemukan',
                'html'=> $html
            );
        }else{
            $this->M_Pembelian_detail->delete($id);
            $html = $this->load->view('admin/pembelian/tabel', array('det_material'=>$this->M_Pembelian_detail->getAllBy("pembelianid =".$pembelianid)), true);
            $callback = array(
                'status'=>'success',
                'pesan'=>'Data berhasil dihapus',
                'html'=> $html
            );
        }
        
        echo json_encode($callback);
    }

    public function delete($id)
    {
        if (!$this->M_Pembelian->getDetail($id)) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan'));
        }else{
            $this->M_Pembelian->delete($id);
            $this->session->set_flashdata('alert',success('Data berhasil dihapus'));
        }
        redirect("pembelian");
    }

    public function print($id)
    {
        $pembelian = $this->M_Pembelian->getDetail($id);
        if (!$pembelian) {
            echo "<script>window.alert('Error, Data tidak ditemukan !!'); close() </script>";
        }
        $data = [
            'title' => "Faktur Pembelian",
            'pembelian' => $pembelian,
            'det_pembelian' => $this->M_Pembelian_detail->getAllBy("pembelianid =".$id)
        ];
        $this->load->view('admin/pembelian/print',$data);
    }
}