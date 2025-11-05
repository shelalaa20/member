<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FaqModel extends CI_Model {

    protected $table = 'faq';

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function getActiveFaqs()
    {
        $this->db->where('status', 'aktif');
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insertFaq($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function updateFaq($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function deleteFaq($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
