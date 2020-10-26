<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Produksi
 *
 * This Controller for ...
 * 
 * @package		CodeIgniter
 * @category	Controller
 * @author    rizkipebrianto <rizkipebrianto96@gmail.com>
 * @link      https://github.com/rizkifreao
 * @param     ...
 * @return    ...
 *
 */

class Produksi extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    check_login();
    date_default_timezone_set("Asia/Jakarta");
  }

  public function HitungRetur($id, $jum_retur = "")
  {
    header('Content-Type: application/json');
    $permintaan = $this->M_Permintaan->getDetail($id);
    $detPermintaan = $this->m_Permintaan_detail->getAllBy('permintaanid ='.$id);
    $datatable = array(
      'produkid' => $permintaan->produkid ,
      'retur' => $jum_retur,
      'det_permintaan' => $detPermintaan
    );

    $html = $this->load->view('admin/produksi/tabel',$datatable,TRUE);

    $callback = [
      'html' => $html
    ];

    echo json_encode($callback);

  }

  public function index()
  {
    $data['breadcumbs'] = "Produk Masuk";
    $data['produksi'] = $this->m_Produksi->getAll();
    $this->template->display('admin/produksi/index',$data);
  }

  public function create($permintaanid)
  {
    $permintaan = $this->M_Permintaan->getDetail($permintaanid);
    $det_permintaan = $this->m_Permintaan_detail->getAllBy('permintaanid ='.$permintaanid);
    if (!$permintaan) {
      $this->session->set_flashdata('alert', error("Data permintaan tidak ditemukan !!"));
      redirect('produksi','refresh');
    }

    if ($permintaan->status != "PROSES") {
      $this->session->set_flashdata('alert', error("Maaf tidak dapat dilakukan, data sudah diproses !!"));
      redirect('produksi','refresh');
    }

    if (!$det_permintaan) {
      $this->session->set_flashdata('alert', error("Silahkan isi detail permintaan dengan id perminttan no ".$permintaanid));
      redirect('produksi','refresh');
    }

    $data = array(
      'permintaan' => $permintaan,
      'breadcumbs' => "Detail Produksi",
      'det_permintaan' => $det_permintaan
     );
    
     $this->template->display('admin/produksi/create',$data);
  }

  public function save()
  {
    $sisa = $this->input->post('sisa');
    $retur = $this->input->post('retur');
    $permintaanid = $this->input->post('permintaanid');
    $permintaan = $this->M_Permintaan->getDetail($permintaanid);
    $detPermintaan = $this->m_Permintaan_detail->getAllBy('permintaanid ='.$permintaanid);
    $dataProduksi = [
      'permintaanid' => $permintaanid,
      'retur' => $retur,
      'keterangan' => $this->input->post('keterangan'),
      'tanggal' => date('Y-m-d')
    ];

    if ($retur) {
      //update master produk
      $produk = $this->M_Produk->getDetail($permintaan->produkid);
      $total_permintaan = $permintaan->qty_permintaan - $retur;
      $stokAkhir = $produk->stok + $total_permintaan;
      $this->M_Produk->update($permintaan->produkid,array('stok'=>$stokAkhir));
      
      $this->m_Produksi->insert($dataProduksi);

      $this->M_Permintaan->update($permintaanid,array('status'=>'SELESAI'));
      $lastID = $this->db->insert_id();
      foreach ($detPermintaan as $key) {
        $i = 0;
        $jumlah = $sisa[$i];

        // update stok material
        $material = $this->M_Material->getDetail($key->materialid);
        $total_sisa = $material->stok + $jumlah;
        $this->M_Material->update($material->id_material,array('stok'=>$total_sisa));

        // insert ke tabel det_produksi
        $detProduksi =[
          'produksiid' => $lastID,
          'materialid' => $key->materialid,
          'satuanid' => $key->satuanid,
          'jumlah_sisa' => $jumlah
        ];
        $this->m_Produksi_detail->insert($detProduksi);
        $i++;
      }
      $this->session->set_flashdata('alert', success("Berhasil disimpan"));
      redirect('produksi','refresh');
    }else{
      //update master produk
      $produk = $this->M_Produk->getDetail($permintaan->produkid);
      $total_permintaan = $permintaan->qty_permintaan;
      $stokAkhir = $produk->stok + $total_permintaan;
      $this->M_Produk->update($permintaan->produkid,array('stok'=>$stokAkhir));

      $this->M_Permintaan->update($permintaanid,array('status'=>'SELESAI'));

      // insert tabel produksi
      $this->m_Produksi->insert($dataProduksi);
      $lastID = $this->db->insert_id();
      foreach ($detPermintaan as $key) {

        // insert ke tabel det_produksi
        $detProduksi =[
          'produksiid' => $lastID,
          'materialid' => $key->materialid,
          'satuanid' => $key->satuanid,
          'jumlah_sisa' => "0"
        ];
        $this->m_Produksi_detail->insert($detProduksi);
      }
        $this->session->set_flashdata('alert', success("Berhasil disimpan"));
        redirect('produksi','refresh');
    }
  }

  public function detail($id)
  {
    $produksi = $this->m_Produksi->getDetail($id);
    if (!$produksi) {
      $this->session->set_flashdata('alert', error("Data tidak ditemukan !"));
      redirect('produksi','refresh');
    }

    $permintaan = $this->M_Permintaan->getDetail($produksi->permintaanid);

    $data = [
      'breadcumbs' => "Detail Produksi",
      'produksi' => $produksi,
      'det_produksi' => $this->m_Produksi_detail->getAllBy('produksiid ='.$produksi->id_produksi),
      'permintaan'=>$permintaan
    ];
    $this->template->display('admin/produksi/detail',$data);
  }

  public function print($id)
    {
      $produksi = $this->m_Produksi->getDetail($id);
      if (!$produksi) {
          echo "<script>window.alert('Error, Data tidak ditemukan !!'); close() </script>";
      }
      $data = [
          'title' => "Faktur Hasil Produksi",
          'produksi' => $produksi,
          'det_produksi' => $this->m_Produksi_detail->getAllBy("produksiid =".$id)
      ];
      $this->load->view('admin/produksi/print',$data);
    }

}


/* End of file Produksi.php */
/* Location: ./application/controllers/Satuan.php */