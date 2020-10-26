<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Login
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

class Backup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_login();

	}

	public function index()
  {
      
    $data = array(
      'tables' => $this->db->list_tables(),
      'database' => $this->db,
      'breadcumbs' => 'Backup & Restore'
    );

    $this->template->display('admin/backup/index', $data);
      
  }

  public function backupTable()
  {

    $tabel = $this->input->post('tabel_name');
    $this->load->dbutil();
    $prefs = array(     
            'tables'      => array($tabel),
                  'format'      => 'zip',             
                  'filename'    => 'table_'.$tabel.date("d-m-Y_H:i:s").'_backup.sql'
                );
    $backup =& $this->dbutil->backup($prefs); 
    $db_name = 'backup-table-'. $tabel . '_' . date("d-m-Y_H:i:s") .'.zip'; //NAMAFILENYA
    $save = 'backup_db/db/'.$db_name;
    $this->load->helper('file');
    write_file($save, $backup); 
    $this->load->helper('download');
    force_download($db_name, $backup);
  }

  public function backupDB()
  {
      $this->load->dbutil();
      $dbname = $this->db->database;
      $prefs = array(
        'format' => 'zip',
        'filename' => $dbname.'.sql'
      );
    
      $backup =& $this->dbutil->backup($prefs);
    
      $db_name = $dbname.'_' . date("d-m-Y_H:i:s") . '.zip'; // file name
      $save  = 'backup_db/db/' . $db_name; // dir name backup output destination
    
      $this->load->helper('file');
      write_file($save, $backup);
    
      $this->load->helper('download');
      force_download($db_name, $backup);
  }

  public function backupSistem()
  {
      ini_set('max_execution_time', 300);
      $opt = array(
          'src' => '../maibro', // dir name to backup
          'dst' => 'backup/files' // dir name backup output destination
        );
        
        // Codeigniter v3x
        $this->load->library('recurseZip_lib', $opt);
        $download = $this->recursezip_lib->compress();
        
        /* Codeigniter v2x
        $zip    = $this->load->library('recurseZip_lib', $opt);     
        $download = $zip->compress();
        */
        
        redirect(base_url($download));
  }

    public function restore()    
    {
        ini_set('max_execution_time', 300);
        $this->load->helper('file');
        // $this->load->model('sismas_m');
        $config['upload_path']="./backup/db/";
        $config['allowed_types']="sql|x-sql";
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload("datafile")){
         $error = array('error' => $this->upload->display_errors());
        //  echo "GAGAL UPLOAD";
         $this->session->set_flashdata('failed', 'Restore Gagal !!');
         var_dump($error);
         exit();
        }

        $file = $this->upload->data();  //DIUPLOAD DULU KE DIREKTORI assets/database/
        $fotoupload=$file['file_name'];
                    
        $isi_file = file_get_contents('./backup/db/' . $fotoupload); //PANGGIL FILE YANG TERUPLOAD
        $string_query = rtrim( $isi_file, "\n;" );
        $array_query = explode(";", $string_query);   //JALANKAN QUERY MERESTORE KEDATABASE
        foreach($array_query as $query)
        {
              $this->db->query($query);
        }
        $path_to_file = './backup/db/' . $fotoupload;
        if(unlink($path_to_file)) {   // HAPUS FILE YANG TERUPLOAD
              redirect('utilitas');
        }
        else {
            //  echo 'errors occured';
            $this->session->set_flashdata('failed', 'Errors Occured');
        }
    }

  public function test()
  {
    echo json_encode($this->db->list_tables());
  }
	
}
