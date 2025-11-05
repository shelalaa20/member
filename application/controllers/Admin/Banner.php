<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('BannerModel');
        $this->load->helper(array('url','form'));
        $this->load->library('session');
    }

    // List semua banner dengan pencarian
    public function index()
    {
        $keyword = $this->input->get('keyword');
        
        if ($keyword) {
            $banners = $this->BannerModel->likeJudul($keyword);
        } else {
            $banners = $this->BannerModel->getAll();
        }

        $data = array(
            'banners' => $banners,
            'keyword' => $keyword
        );
        
        $this->load->view('layout_admin', array('content' => $this->load->view('admin/banner/index', $data, TRUE)));
    }

    // Form tambah
    public function create()
    {
        $this->load->view('layout_admin', array('content' => $this->load->view('admin/banner/create', NULL, TRUE)));
    }

    // Simpan banner baru
    public function store()
    {
        if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0){
            $info = getimagesize($_FILES['gambar']['tmp_name']);
            $width = $info[0]; 
            $height = $info[1];
            $ratio = $width / $height;
            $targetRatio = 0.8; // 4:5
            $tolerance = 0.05; // toleransi tetap 5%

            if($ratio < $targetRatio - $tolerance || $ratio > $targetRatio + $tolerance){
                $this->session->set_flashdata('error', 'Ukuran gambar harus dengan rasio 4:5 atau mendekati.');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $namaFile = time().'_'.$_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], 'assets/uploads/banner/'.$namaFile);

$this->BannerModel->insert(array(
    'judul'  => $this->input->post('judul'),
    'gambar' => $namaFile,
    'status' => $this->input->post('status') // ambil dari form
));


            $this->session->set_flashdata('success', 'Banner berhasil ditambahkan');
            redirect('admin/banner');
        } else {
            $this->session->set_flashdata('error', 'Gagal upload gambar.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Form edit
    public function edit($id)
    {
        $data['banner'] = $this->BannerModel->getById($id);
        $this->load->view('layout_admin', array('content' => $this->load->view('admin/banner/edit', $data, TRUE)));
    }

    // Update banner
    public function update($id)
    {
        $banner = $this->BannerModel->getById($id);
        $namaFile = $banner['gambar'];

        if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0){
            $info = getimagesize($_FILES['gambar']['tmp_name']);
            $ratio = $info[0] / $info[1];
            $targetRatio = 0.8; // 4:5
            $tolerance = 0.05; // toleransi tetap 5%

            if($ratio < $targetRatio - $tolerance || $ratio > $targetRatio + $tolerance){
                $this->session->set_flashdata('error', 'Ukuran gambar harus dengan rasio 4:5 atau mendekati.');
                redirect($_SERVER['HTTP_REFERER']);
            }

            if(!empty($banner['gambar']) && file_exists('assets/uploads/banner/'.$banner['gambar'])){
                unlink('assets/uploads/banner/'.$banner['gambar']);
            }

            $namaFile = time().'_'.$_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], 'assets/uploads/banner/'.$namaFile);
        }

        $this->BannerModel->update($id, array(
            'judul' => $this->input->post('judul'),
            'gambar' => $namaFile,
            'status' => $this->input->post('status')
        ));

        $this->session->set_flashdata('success', 'Banner berhasil diperbarui');
        redirect('admin/banner');
    }

    // Toggle status
    public function toggle($id)
    {
        $banner = $this->BannerModel->getById($id);
        $newStatus = $banner['status'] === 'aktif' ? 'nonaktif' : 'aktif';
        $this->BannerModel->update($id, array('status'=>$newStatus));

        $this->session->set_flashdata('success', 'Status banner diperbarui');
        redirect('admin/banner');
    }

    // Hapus banner
    public function delete($id)
    {
        $banner = $this->BannerModel->getById($id);
        if(!$banner){
            $this->session->set_flashdata('error', 'Banner tidak ditemukan.');
            redirect('admin/banner');
        }

        if(!empty($banner['gambar']) && file_exists('assets/uploads/banner/'.$banner['gambar'])){
            unlink('assets/uploads/banner/'.$banner['gambar']);
        }

        $this->BannerModel->delete($id);
        $this->session->set_flashdata('success', 'Banner berhasil dihapus.');
        redirect('admin/banner');
    }
}
