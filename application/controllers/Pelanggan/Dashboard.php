<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    protected $infoLayanan;
    protected $waLink;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MemberModel');
        $this->load->model('BannerModel');
        $this->load->model('LayananModel');
        $this->load->model('UserModel');
        $this->load->model('FaqModel');
        $this->load->library('session');
        $this->load->helper('url');

        // inisialisasi variabel global
        $this->infoLayanan = $this->LayananModel->getFirst();
        $this->waLink = $this->infoLayanan['wa_cs'] ?? '#';
    }

    public function index()
    {
        $id = $this->session->userdata('id_member');
        $member = $id ? $this->MemberModel->find($id) : null;
    
        if (!$member) {
            $member = [
                'nama'        => 'Guest',
                'nama_paket'  => '-',
                'jatuh_tempo' => '-'
            ];
        }
    
        $banners     = $this->BannerModel->getActiveBanners();
        $infoLayanan = $this->LayananModel->getFirst();
        $faqs        = $this->FaqModel->getActiveFaqs();
    
        $data = [
            'title'       => 'Dashboard Pelanggan',
            'member'      => $member,
            'banners'     => $banners,
            'infoLayanan' => $this->infoLayanan,
            'waLink'      => $this->waLink,
            'activePage'  => 'dashboard',
            'faqs'        => $faqs,
            'content'     => $this->load->view('pelanggan/dashboard', compact('member','banners','infoLayanan','faqs'), true)
        ];
    
        $this->load->view('layout_pelanggan', $data);
    }
    
    public function speedtest()
    {
        $viewData = []; // kalau ada data tambahan buat view
    
        $data = [
            'title'   => 'Speedtest',
            'infoLayanan' => $this->infoLayanan,
            'waLink'      => $this->waLink,
            'activePage'  => 'speedtest',
            'content' => $this->load->view('pelanggan/speedtest', $viewData, true)
        ];
    
        $this->load->view('layout_pelanggan', $data);
    }
    



    public function promo()
    {
        $banners = $this->BannerModel->getActiveBanners();
    
        $data = [
            'title'   => 'Promo Spesial',
            'infoLayanan' => $this->infoLayanan,
            'waLink'      => $this->waLink,
            'activePage'  => 'promo',
            'content' => $this->load->view('pelanggan/promo', [
                'banners' => $banners
            ], true)
        ];
    
        $this->load->view('layout_pelanggan', $data);
    }
    

    public function profile()
    {
        // Ambil id member dari session
        $id = $this->session->userdata('id_member');

        // Ambil data member
        $member = $this->MemberModel->find($id);

        if (!$member) {
            $this->session->set_flashdata('error', 'Data member tidak ditemukan.');
            redirect('pelanggan/dashboard');
            return;
        }

        // Ambil data user, username = va (bukan id_member lagi)
        $user = $this->UserModel->getUserBy('username', $member['va']);

        $data = [
            'title'  => 'Detail Profil',
            'infoLayanan' => $this->infoLayanan,
            'waLink'      => $this->waLink,
            'member' => $member,
            'user'   => $user,
            
        ];

        $this->load->view('pelanggan/profile', $data);
    }
}
