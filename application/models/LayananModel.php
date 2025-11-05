<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LayananModel extends CI_Model {

    protected $table = 'info_layanan';

    public function getFirst()
    {
        return $this->db->get($this->table)->row_array();
    }

    public function updateLayanan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    public function getTotal()
    {
        return $this->db->count_all($this->table);
    }

}
