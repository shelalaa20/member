<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FaqModel');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    // Menampilkan semua FAQ
    public function index()
    {
        $data = [
            'faqs' => $this->FaqModel->getAll()
        ];
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/faq/index', $data, TRUE)]);
    }

    // Form tambah FAQ
    public function create()
    {
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/faq/create', [], TRUE)]);
    }

    // Simpan FAQ baru
    public function store()
    {
        $jawaban = $this->autoLink($this->input->post('jawaban'));
        $this->FaqModel->insertFaq([
            'pertanyaan' => $this->input->post('pertanyaan'),
            'jawaban'    => $jawaban,
            'urutan'     => $this->input->post('urutan'),
            'status'     => $this->input->post('status')
        ]);
        $this->session->set_flashdata('success', 'FAQ berhasil ditambahkan.');
        redirect('admin/faq');
    }

    // Form edit FAQ
    public function edit($id)
    {
        $faq = $this->FaqModel->getById($id);
        if (!$faq) {
            show_404("FAQ dengan ID $id tidak ditemukan");
        }
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/faq/edit', ['faq' => $faq], TRUE)]);
    }

    // Update FAQ
    public function update($id)
    {
        $jawaban = $this->autoLink($this->input->post('jawaban'));
        $this->FaqModel->updateFaq($id, [
            'pertanyaan' => $this->input->post('pertanyaan'),
            'jawaban'    => $jawaban,
            'urutan'     => $this->input->post('urutan'),
            'status'     => $this->input->post('status')
        ]);
        $this->session->set_flashdata('success', 'FAQ berhasil diperbarui.');
        redirect('admin/faq');
    }

    // Hapus FAQ
    public function delete($id)
    {
        $this->FaqModel->deleteFaq($id);
        $this->session->set_flashdata('success', 'FAQ berhasil dihapus.');
        redirect('admin/faq');
    }

    private function autoLink($text)
    {
        return preg_replace(
            '/(https?:\/\/[^\s]+)/',
            '<a href="$1" target="_blank">$1</a>',
            $text
        );
    }
}
