<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model
{
    protected $table = 'members';

    public function countAll($keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('id_member', $keyword);
            $this->db->or_like('va', $keyword);
            $this->db->or_like('kontak', $keyword);
            $this->db->or_like('nama_paket', $keyword);
        }
        return $this->db->count_all_results($this->table);
    }

    public function getPaginated($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('id_member', $keyword);
            $this->db->or_like('va', $keyword);
            $this->db->or_like('kontak', $keyword);
            $this->db->or_like('nama_paket', $keyword);
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result_array();
    }

    public function find($id)
    {
        return $this->db->get_where($this->table, ['id_member' => $id])->row_array();
    }

    public function findBy($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get($this->table)->row_array();
    }

    public function insertData($data)
    {
        // pastikan semua kolom baru bisa di-handle
        $allowedFields = [
            'id_member', 'nama', 'kontak', 'nama_paket', 'kecepatan',
            'jatuh_tempo', 'tanggal_daftar', 'tanggal_non_aktif',
            'va', 'aktif', 'status_bayar'
        ];
        $filteredData = array_intersect_key($data, array_flip($allowedFields));

        return $this->db->insert($this->table, $filteredData);
    }

    public function updateData($id, $data)
    {
        $allowedFields = [
            'nama', 'kontak', 'nama_paket', 'kecepatan',
            'jatuh_tempo', 'tanggal_daftar', 'tanggal_non_aktif',
            'va', 'aktif', 'status_bayar'
        ];
        $filteredData = array_intersect_key($data, array_flip($allowedFields));

        $this->db->where('id_member', $id);
        return $this->db->update($this->table, $filteredData);
    }

    public function deleteData($id)
    {
        $this->db->where('id_member', $id);
        return $this->db->delete($this->table);
    }

    public function getTotal()
    {
        return $this->db->count_all($this->table);
    }

    public function getAktifCount()
    {
        $this->db->where('aktif', 1);
        return $this->db->count_all_results($this->table);
    }
    

    // ==========================
    // Tambahan untuk login CI3 agar mirip CI4
    // ==========================
    public function getMemberBy($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get($this->table)->row_array();
    }
    public function getMemberByLikeVa($username)
{
    $this->db->like('va', '-' . $username, 'before'); // cari yang diakhiri dengan -username
    return $this->db->get($this->table)->row_array();
}

}
