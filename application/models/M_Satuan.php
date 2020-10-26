<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_Satuan
 *
 * This Model for data satuan
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    rizkipebrianto <rizkipebrianto96@gmail.com>
 * @link      https://github.com/rizkifreao
 * @param     ...
 * @return    ...
 *
 */

class M_Satuan extends CI_Model {

  var $table_name = "satuans";
  var $pk = "id_satuan";
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
  
  function getDetail($id) {
    $this->db->where($this->pk, $id);
    $query = $this->db->get($this->table_name);
    return $query->row();
  }

  function insert($data) {
    $this->db->insert($this->table_name, $data);
  }
  
  function update($id, $data) {
    $this->db->where($this->pk, $id);
    $this->db->update($this->table_name, $data);
  }
  
  function delete($id) {
    $this->db->where($this->pk, $id);
    $this->db->delete($this->table_name);
  }
}

/* End of file M_Boml.php */
/* Location: ./application/models/M_Bom.php */