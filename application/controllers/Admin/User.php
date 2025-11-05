<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'pagination']);
    }

    // List pengguna dengan pencarian dan filter role
    public function index()
    {
        $keyword = $this->input->get('keyword');
        $role = $this->input->get('role');

        // Pagination config
        $config['base_url'] = base_url('admin/user/index');
        $config['total_rows'] = $this->UserModel->countUsers($keyword, $role);
        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'per_page';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['attributes'] = ['class' => 'page-link'];

        $this->pagination->initialize($config);

        $page = $this->input->get('per_page') ?? 0;

        $users = $this->UserModel->getUsers($keyword, $role, $config['per_page'], $page);

        $data = [
            'users' => $users,
            'keyword' => $keyword,
            'role' => $role,
            'title' => 'Data Pengguna',
            'pagination' => $this->pagination->create_links()
        ];

        $this->load->view('layout_admin', ['content' => $this->load->view('admin/user/index', $data, TRUE)]);
    }

    // Form tambah user
    public function create()
    {
        $data['title'] = 'Tambah User';
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/user/create', $data, TRUE)]);
    }

    // Simpan user baru
    public function store()
    {
        $post = $this->input->post();
// store()
$this->UserModel->insertUser([
    'username' => $post['username'],
    'password' => $post['password'], // plain text
    'nama'     => $post['nama'],
    'role'     => $post['role'],
    'aktif'    => $post['aktif'] // ambil langsung 1 atau 0
]);
      
        $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
        redirect('admin/user');
    }
    

    // Form edit user
    public function edit($id)
    {
        $user = $this->UserModel->getById($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user');
        }
        $data = [
            'user' => $user,
            'title' => 'Edit User'
        ];
        $this->load->view('layout_admin', ['content' => $this->load->view('admin/user/edit', $data, TRUE)]);
    }

    // Update user
    public function update($id)
    {
        $post = $this->input->post();
// update()
$updateData = [
    'username' => $post['username'],
    'nama'     => $post['nama'],
    'role'     => $post['role'],
    'aktif'    => $post['aktif'] // ambil langsung 1 atau 0
];
if (!empty($post['password'])) {
    $updateData['password'] = $post['password'];
}
$this->UserModel->updateUser($id, $updateData);

        $this->session->set_flashdata('success', 'User berhasil diupdate.');
        redirect('admin/user');
    }
    public function reset_password($id)
{
    $user = $this->UserModel->getById($id);

    if (!$user) {
        $this->session->set_flashdata('error', 'User tidak ditemukan.');
        redirect('admin/user');
        return;
    }

    // Password = username
    $newPassword = $user['username'];

    $this->UserModel->updateUser($id, [
        'password' => $newPassword
    ]);

    $this->session->set_flashdata('success', 'Password berhasil direset ke default (sama dengan username).');
    redirect('admin/user/edit/' . $id);
}

    

    // Hapus user
    public function delete($id)
    {
        $this->UserModel->deleteUser($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus.');
        redirect('admin/user');
    }
}
