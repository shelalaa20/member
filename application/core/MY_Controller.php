<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Load library yang dibutuhkan
        $this->load->library('session');
        $this->load->helper('url');

        // Proteksi global
        $currentClass = $this->router->fetch_class();
        $allowedPages = ['auth']; // hanya Auth controller yang bebas diakses

        if (!in_array(strtolower($currentClass), $allowedPages)) {
            if (!$this->session->userdata('isLoggedIn')) {
                $this->session->set_flashdata('error', 'Akses gagal, silakan login dulu.');
                redirect('login');
            }
        }
    }
}
