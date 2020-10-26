<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Laporan
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Laporan extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    check_login();
  }

  public function index()
  {
    $data = [
      'breadcumbs' => 'Laporan'
    ];
    $this->template->display('admin/laporan/index',$data);
  }

  public function print()
  {
    $startDate = $this->input->post("periodeAwal");
    $endDate = $this->input->post("periodeAkhir");
    $jenis_laporan = $this->input->post("jenis_laporan");
    if ($jenis_laporan == "produksi") {
      $produksi = $this->m_Produksi->getAllBy(array(
        'tanggal >=' => $startDate,
        'tanggal <=' => $endDate,
      ));
      // echo json_encode($produksi);
      $data = [
        'title' => "Laporan Produksi",
        'periode' => $startDate." - ".$endDate,
        'produksi' => $produksi
      ];
      $this->load->view('admin/laporan/print',$data);
    }else if($jenis_laporan == "pembelian"){
      $pembelian = $this->M_Pembelian->getAllBy(array(
        'tanggal >=' => $startDate,
        'tanggal <=' => $endDate,
      ));
      // echo json_encode($pembelian);
      $data = [
        'title' => "Laporan Pembelian",
        'periode' => $startDate." - ".$endDate,
        'pembelian' => $pembelian
      ];
      $this->load->view('admin/laporan/laporan_pembelian',$data);
    }else {
      $permintaan = $this->M_Permintaan->getAllBy(array(
        'tanggal >=' => $startDate,
        'tanggal <=' => $endDate,
      ));
      // echo json_encode($Permintaan);
      $data = [
        'title' => "Laporan Material Keluar",
        'periode' => $startDate." - ".$endDate,
        'permintaan' => $permintaan
      ];
      $this->load->view('admin/laporan/laporan_permintaan',$data);
    }
  }

}


/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */