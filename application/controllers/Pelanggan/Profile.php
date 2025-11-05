<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MemberModel');
        $this->load->model('UserModel');
        $this->load->library('session');
        $this->load->helper('url'); // buat redirect & base_url
    }

    // Halaman profil
    public function index()
    {
        $id = $this->session->userdata('id_member');
        if (!$id) {
            $this->session->set_flashdata('error', 'Session habis, silakan login ulang.');
            redirect('login');
            return;
        }

        // Ambil data member
        $member = $this->MemberModel->find($id);
        if (!$member) {
            $this->session->set_flashdata('error', 'Data member tidak ditemukan.');
            redirect('pelanggan/dashboard');
            return;
        }

        // Ambil data user berdasarkan username = va
        // Ambil bagian setelah tanda "-" dari VA
$va_parts = explode('-', $member['va']);
$username = end($va_parts);

// Ambil user berdasarkan username yang benar
$user = $this->UserModel->getUserBy('username', $username);


        $data = [
            'title'  => 'Detail Profil',
            'member' => $member,
            'user'   => $user,
            'activePage'  => 'profile',
            'content'=> $this->load->view('pelanggan/profile', [
                'member' => $member,
                'user'   => $user
            ], true) // hasilnya string HTML
        ];
        

        // Load via layout
        $this->load->view('layout_pelanggan', $data);
    }

    // Proses update password
    public function updatePassword()
    {
        $id = $this->session->userdata('id_member');
        if (!$id) {
            $this->session->set_flashdata('error', 'Session habis, silakan login ulang.');
            redirect('login');
            return;
        }

        $member = $this->MemberModel->find($id);
        if (!$member) {
            $this->session->set_flashdata('error', 'Data member tidak ditemukan.');
            redirect('pelanggan/profile');
            return;
        }

        // Cari user berdasarkan username = va
        // Ambil bagian setelah tanda "-" dari VA
$va_parts = explode('-', $member['va']);
$username = end($va_parts);

// Ambil user berdasarkan username yang benar
$user = $this->UserModel->getUserBy('username', $username);

        if (!$user) {
            $this->session->set_flashdata('error', 'Akun user tidak ditemukan.');
            redirect('pelanggan/profile');
            return;
        }

        $oldPassword     = $this->input->post('old_password');
        $newPassword     = $this->input->post('new_password');
        $confirmPassword = $this->input->post('confirm_password');

        // Cek password lama (masih plaintext sesuai login controller kamu)
        if ($oldPassword !== $user['password']) {
            $this->session->set_flashdata('error', 'Password lama salah.');
            redirect('pelanggan/profile');
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok.');
            redirect('pelanggan/profile');
            return;
        }

        if (strlen($newPassword) < 6) {
            $this->session->set_flashdata('error', 'Password baru minimal 6 karakter.');
            redirect('pelanggan/profile');
            return;
        }

        // Update password (plaintext sesuai sistem sekarang)
        $this->UserModel->updatePassword($user['id'], $newPassword);

        $this->session->set_flashdata('success', 'Password berhasil diubah.');
        redirect('pelanggan/profile');
    }
}
