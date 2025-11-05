<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('MemberModel');
        $this->load->library('session');
        $this->load->helper('url');
    }

    // ------------------------------
    // PRIVATE FUNCTIONS (Filter)
    // ------------------------------
    private function requireLogin()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    private function requireAdmin()
    {
        $this->requireLogin();
        if ($this->session->userdata('role') !== 'admin') {
            redirect('login');
        }
    }

    private function requirePelanggan()
    {
        $this->requireLogin();
        if ($this->session->userdata('role') !== 'pelanggan') {
            redirect('login');
        }
    }

    // ------------------------------
    // FORM LOGIN
    // ------------------------------
    public function index()
    {
        if ($this->session->userdata('isLoggedIn')) {
            if ($this->session->userdata('role') === 'admin') {
                redirect('admin/dashboard');
            } elseif ($this->session->userdata('role') === 'pelanggan') {
                redirect('pelanggan/dashboard');
            }
        }

        $this->load->view('auth/login', [
            'hideSidebar' => true,
            'hideNavbar'  => true
        ]);
    }

    // ------------------------------
    // PROSES LOGIN
    // ------------------------------
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->UserModel->getUserBy('username', $username);
    
        if ($user && $password === $user['password']) {
    
            // 🟢 Tambahkan cek status aktif dari tabel members (kalau role pelanggan)
            if ($user['role'] === 'pelanggan') {
                $member = $this->MemberModel->getMemberByLikeVa($user['username']);
               
                if ($member) {
                    if (isset($member['aktif']) && $member['aktif'] == 0) {
                        $this->session->set_flashdata('error', 'Akun kamu nonaktif, hubungi admin.');
                        redirect('login');
                        return; // berhenti di sini biar gak lanjut login
                    }
                }
            }
    
            // 🟢 Kalau aktif, baru lanjut login seperti biasa
            $sessionData = [
                'isLoggedIn' => true,
                'userId'     => $user['id'],
                'nama'       => $user['nama'],
                'role'       => $user['role'],
            ];
    
            if ($user['role'] === 'pelanggan' && isset($member)) {
                $sessionData['id_member'] = $member['id_member'];
            }
    
            $this->session->set_userdata($sessionData);
    
            if ($user['role'] === 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('pelanggan/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah');
            redirect('login');
        }
    }
    
    // ------------------------------
    // FORM REGISTRASI
    // ------------------------------
    public function registerForm()
    {
        $this->load->view('auth/register', [
            'hideSidebar' => true,
            'hideNavbar'  => true
        ]);
    }

    // ------------------------------
    // PROSES REGISTRASI
    // ------------------------------
    public function register()
    {
        $va       = $this->input->post('username');
        $password = $this->input->post('password');

        $member = $this->MemberModel->getMemberBy('va', $va);
        if (!$member) {
            $this->session->set_flashdata('error', 'VA tidak ditemukan, silakan hubungi admin.');
            redirect('register');
        }

        $existingUser = $this->UserModel->getUserBy('username', $va);
        if ($existingUser) {
            $this->session->set_flashdata('error', 'User sudah terdaftar.');
            redirect('register');
        }

        $this->UserModel->insertUser([
            'username' => $va,
            'password' => $password, // plaintext sesuai permintaan
            'nama'     => $member['nama'],
            'role'     => 'pelanggan'
        ]);

        $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
        redirect('login');
    }

    // ------------------------------
    // LOGOUT
    // ------------------------------
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    // ------------------------------
    // CONTOH METHOD DENGAN FILTER
    // ------------------------------
    public function adminDashboard()
    {
        $this->requireAdmin(); // Filter admin
        $this->load->view('admin/dashboard');
    }

    public function pelangganDashboard()
    {
        $this->requirePelanggan(); // Filter pelanggan
        $this->load->view('pelanggan/dashboard');
    }
}
