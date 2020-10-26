<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
/**
 *
 * Model Permintaan
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

class Permintaan extends CI_Controller { 

    function __construct(){	
        parent::__construct();
        check_login();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data['breadcumbs'] = "Permintaan Material";
        $data['permintaan'] = $this->M_Permintaan->getAllBy('produkid != "null"');
        $this->template->display('admin/permintaan/index',$data);
    }

    public function getProduk($id)
    {
        header('Content-Type: application/json');
        $produk = $this->M_Produk->getDetail($id);
        $bom = $this->M_Bom->getDetailWhere("produkid =".$produk->id_produk);
        if (!$bom) {
            $callback = [
                'detBOM' => "",
                'satuan' => "",
                'html' => "",
                'status' => "FAILED"
            ];
            echo json_encode($callback);
            exit;
        }
        $datatable['detBOM'] = $detBOM = $this->M_Bom_detail->getAllBy('bomid ='.$bom->id);
        $datatable['jumlah'] = 1;
        $html = $this->load->view("admin/permintaan/table",$datatable,TRUE);

        $callback = [
            'detBOM' => $detBOM,
            'satuan' => $this->M_Satuan->getDetail($produk->satuanid)->nama_satuan,
            'html' => $html,
        ];
        
        echo json_encode($callback);
    }

    public function getDataTable($produkid,$jumlah=""){
        header('Content-Type: application/json');
        $bom = $this->M_Bom->getDetailWhere("produkid =".$produkid);
        $detBOM = $this->M_Bom_detail->getAllBy('bomid ='.$bom->id);
        $datatable = [
            'detBOM' => $detBOM,
            'jumlah' => $jumlah
        ];
        $html = $this->load->view("admin/permintaan/table",$datatable,TRUE);

        $callback = [
            'detBOM' => $detBOM,
            'html' => $html,
        ];
        echo json_encode($callback);
    }

    public function create($id="")
    {
        if (empty($id)) {
            $data['id_permintaan'] = '';
            $this->M_Permintaan->insert($data);
            $lastID = $this->db->insert_id();
            redirect('permintaan/create/'.$lastID);
        }

        $permintaan = $this->M_Permintaan->getDetail($id);
        $detPermintaan = $this->m_Permintaan_detail->getAllBy("permintaanid =".$permintaan->id_permintaan);
        if (!$permintaan) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan !'));
            redirect('permintaan');
        }
        if ($detPermintaan) {
            $this->session->set_flashdata('alert',error('Data sudah di proses'));
            redirect('permintaan');
        }
        if ($permintaan->status == "SELESAI" ) {
            $this->session->set_flashdata('alert',error('Produksi sudah selesai !'));
            redirect('permintaan');
        }
        // if ($permintaan->status === "SELESAI") {
        //     $this->session->set_flashdata('alert',error('Maaf tidak dapat diproses !'));
        //     redirect('permintaan');
        // }
        $data['breadcumbs'] = "Permintaan Material";
        $data['permintaan'] = $permintaan;
        $data['produks'] = $this->M_Produk->getAll();
        $this->template->display('admin/permintaan/create',$data);
    }

    public function save()
    {
        $permintaanid = $this->input->post('permintaanid');
        $produkid = $this->input->post('produkid');
        $jumlah = $this->input->post('kuantiti');

        $permintaan = array(
            'produkid' => $produkid , 
            'tanggal' => date('Y-m-d'),
            'qty_permintaan' => $jumlah,
            'status' => "PROSES",
            'keterangan' => $this->input->post('keterangan')
        );

        $bom = $this->M_Bom->getDetailWhere("produkid =".$produkid);
        $detBOM = $this->M_Bom_detail->getAllBy("bomid =".$bom->id);
        // cek jumlah yang lebih kecil dari stok

        foreach ($detBOM as $key) {
            $material = $this->M_Material->getDetail($key->materialid);
            $JumTotal = $key->qty*$jumlah;
            if ($JumTotal > $material->stok) { //jika jumlah total lebih besar dari stok
                $this->session->set_flashdata('alert',error("Jumlah stok ".$material->label." kurang !!"));
                redirect('permintaan/create/'.$permintaanid,'refresh');
                break;
            }
        }

        // echo json_encode($listStok);
        $this->M_Permintaan->update($permintaanid,$permintaan);

        foreach ($detBOM as $key) {
            $material = $this->M_Material->getDetail($key->materialid);
            $JumTotal = $key->qty*$jumlah;
            // masukan data kedalam tabel detail
            $detPermintaan = [
                'permintaanid' => $permintaanid,
                'materialid' => $key->materialid,
                'satuanid' => $key->satuanid,
                'jumlah' => $JumTotal,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->m_Permintaan_detail->insert($detPermintaan);

            // update stok pada material
            $stokAkhir = $material->stok - $JumTotal;
            $dataMaterial = [
                'qty_keluar' => $stokAkhir,
                'stok' => $stokAkhir
            ];
            $this->M_Material->update($key->materialid,$dataMaterial);
        }

        $this->session->flashdata('alert',success("Data berhasil disimpan"));
        redirect('permintaan','refresh');
        
    }

    public function detail($id)
    {
        $permintaan = $this->M_Permintaan->getDetail($id);
        if (!$permintaan) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan'));
            redirect("permintaan");
        }

        $data['breadcumbs'] = "Detail Permintaan Material";
        $data['permintaan'] = $permintaan;
        $data['det_permintaan'] = $this->m_Permintaan_detail->getAllBy('permintaanid ='.$permintaan->id_permintaan);
        $this->template->display('admin/permintaan/detail',$data);
    }

    public function permintaanBatal($id)
    {
        $permintaan = $this->M_Permintaan->getDetail($id);
        if (!$permintaan) {
            $this->session->set_flashdata('alert',error('Data tidak ditemukan'));
            redirect("permintaan");
        }
        if ($permintaan->produkid != null){
            $this->session->set_flashdata('alert',error('Tidak dapat dilakukan !!'));
            redirect("permintaan");
        }
        $this->M_Permintaan->delete($id);
        redirect("permintaan");
    }

    public function print($id)
    {
        $permintaan = $this->M_Permintaan->getDetail($id);
        if (!$permintaan) {
            echo "<script>window.alert('Error, Data tidak ditemukan !!'); close() </script>";
        }
        $data = [
            'title' => "Faktur Permintaan Material",
            'permintaan' => $permintaan,
            'det_permintaan' => $this->m_Permintaan_detail->getAllBy("permintaanid =".$id)
        ];
        $this->load->view('admin/permintaan/print',$data);
    }
    
}