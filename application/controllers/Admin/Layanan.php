<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LayananModel');
        $this->load->model('FaqModel');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    // Halaman utama kelola layanan + FAQ
    public function index()
    {
        $data = [
            'layanan' => $this->LayananModel->getFirst(),
            'faqs' => $this->FaqModel->getAll()
        ];
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/layanan/index', $data, TRUE)]);
    }

    // Update layanan
    public function update()
    {
        $this->LayananModel->updateLayanan(1, [
            'wa_cs' => $this->input->post('wa_cs'),
            'youtube' => $this->input->post('youtube')
        ]);
        $this->session->set_flashdata('success', 'Info layanan berhasil diperbarui.');
        redirect('admin/layanan');
    }

    // CRUD FAQ
    public function createFaq()
    {
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/layanan/faq/create', [], TRUE)]);
    }

    public function storeFaq()
    {
        $this->FaqModel->insertFaq([
            'pertanyaan' => $this->input->post('pertanyaan'),
            'jawaban' => $this->input->post('jawaban'),
            'urutan' => $this->input->post('urutan'),
            'status' => $this->input->post('status')
        ]);
        $this->session->set_flashdata('success', 'FAQ berhasil ditambahkan.');
        redirect('admin/layanan');
    }

    public function editFaq($id)
    {
        $faq = $this->FaqModel->getById($id);
        if (!$faq) {
            show_404('FAQ tidak ditemukan');
        }
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/layanan/faq/edit', ['faq' => $faq], TRUE)]);
    }

    public function updateFaq($id)
    {
        $this->FaqModel->updateFaq($id, [
            'pertanyaan' => $this->input->post('pertanyaan'),
            'jawaban' => $this->input->post('jawaban'),
            'urutan' => $this->input->post('urutan'),
            'status' => $this->input->post('status')
        ]);
        $this->session->set_flashdata('success', 'FAQ berhasil diperbarui.');
        redirect('admin/layanan');
    }

    public function deleteFaq($id)
    {
        $this->FaqModel->deleteFaq($id);
        $this->session->set_flashdata('success', 'FAQ berhasil dihapus.');
        redirect('admin/layanan');
    }
}
