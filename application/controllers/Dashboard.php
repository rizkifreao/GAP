<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Dashboard
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

class Dashboard extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->database();
        check_login();
    }
	
	public function index()
	{
        $data['breadcumbs'] = "Dashboard";
		$this->template->display('admin/dashboard/index',$data);
	}
}
