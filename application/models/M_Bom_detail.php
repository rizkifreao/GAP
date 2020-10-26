<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_Bom
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

class M_Bom_detail extends CI_Model {

  var $table_name = "bom_detail";
  var $pk = "id";
  var $order = "DESC";

  function getAll() {
    $this->db->order_by($this->pk,$this->order);
    $query = $this->db->get($this->table_name);
    return $query->result();
  }
  
  function getAllBy($kondisi) {
    $this->db->order_by($this->pk,$this->order);
    $query = $this->db->get_where($this->table_name, $kondisi);
    return $query->result();
  }

  function getDetailWhere($kondisi) {
    $this->db->where($kondisi);
    $query = $this->db->get($this->table_name);
    return $query->row();
  }
  
  function getDetail($id) {
    $this->db->where($this->pk, $id);
    $query = $this->db->get($this->table_name);
    return $query->row();
  }

  function insert($data) {
    if (!$this->db->insert($this->table_name, $data)) { //jika data duplikat maka tampilkan pesan eror
        return $this->db->error();
    }
  }
  
  function update($id, $data) {
    $this->db->where($this->pk, $id);
    $this->db->update($this-> table_name, $data);
  }
  
  function delete($id) {
    $this->db->where($this->pk, $id);
    $this->db->delete($this->table_name);
  }

}

/* End of file M_Bom_detail_model.php */
/* Location: ./application/models/M_Bom_detail_model.php */