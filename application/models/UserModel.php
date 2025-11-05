<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    protected $table = 'users';

    // Ambil semua user dengan filter + keyword + role + status aktif + limit pagination
    public function getUsers($keyword = null, $role = null, $limit = null, $start = null, $aktif = null)
    {
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('username', $keyword);
            $this->db->or_like('nama', $keyword);
            $this->db->group_end();
        }

        if ($role && $role != 'all') {
            $this->db->where('role', $role);
        }

        if ($aktif !== null && $aktif !== 'all') {
            $this->db->where('aktif', $aktif);
        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }

        return $this->db->get($this->table)->result_array();
    }

    public function countUsers($keyword = null, $role = null, $aktif = null)
    {
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('username', $keyword);
            $this->db->or_like('nama', $keyword);
            $this->db->group_end();
        }

        if ($role && $role != 'all') {
            $this->db->where('role', $role);
        }

        if ($aktif !== null && $aktif !== 'all') {
            $this->db->where('aktif', $aktif);
        }

        return $this->db->count_all_results($this->table);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insertUser($data)
    {
        // Pastikan ada default aktif jika belum diset
        if (!isset($data['aktif'])) {
            $data['aktif'] = 1;
        }
        return $this->db->insert($this->table, $data);
    }

    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // ==========================
    // Tambahan untuk login CI3 agar mirip CI4
    // ==========================
    public function getUserBy($field, $value)
    {
        return $this->db->get_where($this->table, [$field => $value])->row_array();
    }

    // Update password
    public function updatePassword($id, $newPassword)
    {
        return $this->db->where('id', $id)
                        ->update($this->table, ['password' => $newPassword]);
    }

    // ==========================
    // Tambahan kecil opsional (cek user aktif)
    // ==========================
    public function getActiveUsers()
    {
        return $this->db->where('aktif', 1)->get($this->table)->result_array();
    }

    public function getInactiveUsers()
    {
        return $this->db->where('aktif', 0)->get($this->table)->result_array();
    }
    public function upsertUser($data)
{
    // Cek apakah username sudah ada
    $existing = $this->db->get_where('users', ['username' => $data['username']])->row_array();

    if ($existing) {
        // Kalau sudah ada → update data user
        $this->db->where('username', $data['username']);
        $this->db->update('users', $data);
    } else {
        // Kalau belum ada → insert baru
        $this->db->insert('users', $data);
    }
}

}
