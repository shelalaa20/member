<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

public function __construct() {
    parent::__construct();

    // Load library session
    $this->load->library('session');

    // Load model sesuai versi CI3
    $this->load->model('MemberModel');
    $this->load->model('BannerModel');
    $this->load->model('LayananModel');

    // Cek session admin
    // if(!$this->session->userdata('is_admin')){
    //     redirect('login');
    // }
}


    public function index() {
        // Hitung total pelanggan
        $totalPelanggan = $this->MemberModel->getTotal();

        // Hitung pelanggan aktif
        $pelangganAktif = $this->MemberModel->getAktifCount();

        // Hitung banner aktif
        $bannerAktif = $this->BannerModel->getAktifCount();

        // Hitung layanan tersedia
        $layananCount = $this->LayananModel->getTotal();

        // Dummy data aktivitas terbaru
        $activities = [
            [
                'icon' => 'fa-user-plus',
                'text' => 'Pelanggan baru didaftarkan',
                'time' => '2 menit lalu'
            ],
            [
                'icon' => 'fa-image',
                'text' => 'Banner promosi baru dipublikasikan',
                'time' => '1 jam lalu'
            ],
            [
                'icon' => 'fa-question-circle',
                'text' => '3 pertanyaan baru ditambahkan ke FAQ',
                'time' => '3 jam lalu'
            ]
        ];

        // Data untuk view dashboard
        $data = [
            'title'          => 'Dashboard',
            'totalPelanggan' => $totalPelanggan,
            'pelangganAktif' => $pelangganAktif,
            'bannerAktif'    => $bannerAktif,
            'layananCount'   => $layananCount,
            'activities'     => $activities
        ];

        // Render ke layout_admin
        $this->load->view('layout_admin', [
            'title'   => $data['title'],
            'content' => $this->load->view('admin/dashboard', $data, TRUE)
        ]);
    }
}
