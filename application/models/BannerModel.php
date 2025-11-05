<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BannerModel extends CI_Model {

    protected $table = 'banners';

    public function getAll(){
        return $this->db->get($this->table)->result_array();
    }

    public function getById($id){
        return $this->db->get_where($this->table, array('id'=>$id))->row_array();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function likeJudul($keyword){
        $this->db->like('judul', $keyword);
        return $this->db->get($this->table)->result_array();
    }

    public function getActiveBanners(){
        $this->db->where('status','aktif');
        return $this->db->get($this->table)->result_array();
    }

    public function getAktifCount()
    {
        $this->db->where('status', 'aktif');
        return $this->db->count_all_results($this->table);
    }
}
