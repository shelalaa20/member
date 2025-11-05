<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;

class Pelanggan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MemberModel');
        $this->load->library('pagination');
    }

// List pelanggan
public function index()
{
    $this->load->library('pagination');

    $keyword = $this->input->get('keyword');

    // Pagination setup
    $config['base_url']    = site_url('admin/pelanggan/index');
    $config['total_rows']  = $this->MemberModel->countAll($keyword);
    $config['per_page']    = 25;
    $config['uri_segment'] = 4;

    // Styling Bootstrap
    $config['full_tag_open']   = '<ul class="pagination">';
    $config['full_tag_close']  = '</ul>';
    $config['first_link']      = 'First';
    $config['last_link']       = 'Last';
    $config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
    $config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close']  = '</span></li>';
    $config['next_link']       = '&raquo;';
    $config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close']  = '</span></li>';
    $config['prev_link']       = '&laquo;';
    $config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close']  = '</span></li>';
    $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']   = '</span></li>';
    $config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']   = '</span></li>';

    $this->pagination->initialize($config);

    // Pastikan segment angka, kalau null fallback ke 0
    $page = $this->uri->segment(4);
    $page = (ctype_digit((string) $page)) ? (int)$page : 0;
    
    $data['members']     = $this->MemberModel->getPaginated($config['per_page'], $page, $keyword);
    $data['pagination']  = $this->pagination->create_links();
    $data['keyword']     = $keyword;

    // Tampilkan dengan layout_admin
    $data['content'] = $this->load->view('admin/pelanggan/index', $data, TRUE);
    $this->load->view('layout_admin', $data);
}


    // Form tambah
    public function create()
    {
        $data['content'] = $this->load->view('admin/pelanggan/create', [], TRUE);
        $this->load->view('layout_admin', $data);
    }

    // Simpan pelanggan baru
    public function store()
    {
        $data = $this->input->post();

        // Validasi wajib
        $requiredFields = ['id_member','nama','kontak','nama_paket','kecepatan','jatuh_tempo','tanggal_daftar','va'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $this->session->set_flashdata('error', "Field wajib belum diisi: $field");
                redirect('admin/pelanggan/create');
            }
        }

        // Cek duplikat ID member
        if ($this->MemberModel->findBy('id_member', $data['id_member'])) {
            $this->session->set_flashdata('error', "ID member '{$data['id_member']}' sudah terdaftar. Gunakan ID lain.");
            redirect('admin/pelanggan/create');
        }

        // Cek duplikat VA
        if ($this->MemberModel->findBy('va', $data['va'])) {
            $this->session->set_flashdata('error', "VA '{$data['va']}' sudah terdaftar. Gunakan VA lain.");
            redirect('admin/pelanggan/create');
        }

        // Insert data
        $this->MemberModel->insertData($data);
        $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan!');
        redirect('admin/pelanggan');
    }

    // Form edit
    public function edit($id_member)
    {
        $data['member'] = $this->MemberModel->find($id_member);
        $data['content'] = $this->load->view('admin/pelanggan/edit', $data, TRUE);
        $this->load->view('layout_admin', $data);
    }

    // Update data
    public function update($id_member)
    {
        $updateData = $this->input->post();
        $this->MemberModel->updateData($id_member, $updateData);
        $this->session->set_flashdata('success', 'Pelanggan berhasil diperbarui!');
        redirect('admin/pelanggan');
    }

    // Hapus data
    public function delete($id_member)
    {
        $this->MemberModel->deleteData($id_member);
        $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus!');
        redirect('admin/pelanggan');
    }

    public function import_excel()
    {
        $data['title'] = 'Import Pelanggan';
        $data['content'] = $this->load->view('admin/pelanggan/import_excel', $data, TRUE);
        $this->load->view('layout_admin', $data);
    }
    private function cleanCell($value)
{
    if ($value === null) return '';
    // Hapus spasi, titik, strip panjang, tab, dsb
    $value = preg_replace('/[.\-]+/', '', $value);
    return trim($value);
}
// Untuk format MM/DD/YYYY (Tanggal Daftar)
private function convertDateMDY($value)
{
    if (empty($value)) return null;

    // Kalau Excel kasih angka serial
    if (is_numeric($value)) {
        return date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value));
    }

    $date = \DateTime::createFromFormat('m/d/Y', $value);
    return $date ? $date->format('Y-m-d') : null;
}

// Untuk format DD/MM/YYYY (Tanggal Non Aktif)
private function convertDateDMY($value)
{
    if (empty($value)) return null;

    $value = trim((string)$value);

    // Jika ada waktu, pisahkan hanya tanggal
    if (strpos($value, ' ') !== false) {
        $value = explode(' ', $value)[0];
    }

    // Coba format d/m/Y (karena Excel kamu pakai garis miring)
    $date = \DateTime::createFromFormat('d/m/Y', $value);
    if ($date) return $date->format('Y-m-d');

    // Coba format d-m-Y kalau nanti ada variasi pakai tanda "-"
    $date = \DateTime::createFromFormat('d-m-Y', $value);
    if ($date) return $date->format('Y-m-d');

    // Coba fallback strtotime untuk jaga-jaga
    $timestamp = strtotime($value);
    return $timestamp ? date('Y-m-d', $timestamp) : null;
}



public function do_import()
{
    ini_set('max_execution_time', 0); // biar gak timeout
    ini_set('memory_limit', '1024M'); // jaga-jaga

    $file = $_FILES['file_excel']['tmp_name'];
    $filename = $_FILES['file_excel']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (empty($file)) {
        $this->session->set_flashdata('error', 'File tidak ditemukan.');
        redirect('admin/pelanggan/import_excel');
        return;
    }

    $allowed_ext = ['xls', 'xlsx', 'csv'];
    if (!in_array(strtolower($ext), $allowed_ext)) {
        $this->session->set_flashdata('error', 'Format file tidak valid.');
        redirect('admin/pelanggan/import_excel');
        return;
    }

    try {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        $this->session->set_flashdata('error', 'Gagal membaca file Excel.');
        redirect('admin/pelanggan/import_excel');
        return;
    }

    $sheet = $spreadsheet->getActiveSheet()->toArray();
    if (empty($sheet) || empty($sheet[0])) {
        $this->session->set_flashdata('error', 'File Excel kosong atau format salah.');
        redirect('admin/pelanggan/import_excel');
        return;
    }

    $header = array_map(function($value) {
        return is_string($value) ? strtolower(trim($value)) : '';
    }, $sheet[0]);

    // Kolom wajib
    $requiredColumns = [
        'id' => 'id_member',
        'va' => 'va',
        'nama' => 'nama',
        'kontak' => 'kontak',
        'nama paket' => 'nama_paket',
        'kecepatan' => 'kecepatan',
        'jatuh tempo' => 'jatuh_tempo',
        'tanggal daftar' => 'tanggal_daftar'
    ];

    $col = [];
    foreach ($requiredColumns as $headerName => $field) {
        $index = array_search($headerName, $header);
        if ($index === false) {
            $this->session->set_flashdata('error', "Kolom '$headerName' tidak ditemukan di file Excel.");
            redirect('admin/pelanggan/import_excel');
            return;
        }
        $col[$field] = $index;
    }

    // Kolom opsional
    $col['tanggal_non_aktif'] = array_search('tanggal non aktif', $header);
    $col['aktif'] = array_search('aktif', $header);

    $membersData = [];
    $usersData = [];
    $errors = [];

    for ($i = 1; $i < count($sheet); $i++) {
        $row = $sheet[$i];
        if (empty($row[$col['id_member']])) continue;

        $namaAsli   = $row[$col['nama']];
        $namaBersih = explode(',', $namaAsli)[0];

        $aktifVal = (isset($col['aktif']) && $row[$col['aktif']] !== null && $row[$col['aktif']] !== '')
                        ? (int)$row[$col['aktif']]
                        : 0;

        $data = [
            'id_member'        => trim((string)$row[$col['id_member']]),
            'va'               => trim((string)$row[$col['va']]),
            'nama'             => $this->cleanCell($namaBersih),
            'kontak'           => $this->cleanCell($row[$col['kontak']]),
            'nama_paket'       => $this->cleanCell($row[$col['nama_paket']]),
            'kecepatan'        => $this->cleanCell($row[$col['kecepatan']]),
            'jatuh_tempo'      => $this->cleanCell($row[$col['jatuh_tempo']]),
            'tanggal_daftar'   => $this->convertDateMDY($row[$col['tanggal_daftar']]),
            'tanggal_non_aktif'=> (isset($col['tanggal_non_aktif']) && isset($row[$col['tanggal_non_aktif']]))
                                    ? $this->convertDateDMY($row[$col['tanggal_non_aktif']])
                                    : null,
            'aktif'            => $aktifVal
        ];

        // Validasi data wajib
        $required = ['id_member','va','nama','kontak','nama_paket','kecepatan','jatuh_tempo','tanggal_daftar'];
        $missing = [];
        foreach ($required as $field) {
            if (!isset($data[$field]) || trim($data[$field]) === '') {
                $missing[] = $field;
            }
        }
        if (!empty($missing)) {
            $errors[] = "Data pelanggan <b>{$data['nama']}</b> tidak lengkap (kolom kosong: ".implode(', ', $missing).")";
            continue;
        }

        // Data members
        $membersData[] = $data;

        // Data users
// Ambil bagian setelah tanda "-" dari VA
$va_parts = explode('-', $data['va']);
$username = end($va_parts); // ambil bagian terakhir setelah "-"

$usersData[] = [
    'username' => $username,
    'password' => $username, // password sama seperti username
    'nama'     => $data['nama'],
    'role'     => 'pelanggan',
    'aktif'    => $aktifVal
];

    }

    $this->load->database();
    $this->db->trans_start();

    // === Simpan ke tabel members ===
    if (!empty($membersData)) {
        $chunks = array_chunk($membersData, 500);
        foreach ($chunks as $batch) {
            foreach ($batch as $m) {
                $this->db->query("
                    INSERT INTO members (id_member, va, nama, kontak, nama_paket, kecepatan, jatuh_tempo, tanggal_daftar, tanggal_non_aktif, aktif)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE 
                        va = VALUES(va),
                        nama = VALUES(nama),
                        kontak = VALUES(kontak),
                        nama_paket = VALUES(nama_paket),
                        kecepatan = VALUES(kecepatan),
                        jatuh_tempo = VALUES(jatuh_tempo),
                        tanggal_daftar = VALUES(tanggal_daftar),
                        tanggal_non_aktif = VALUES(tanggal_non_aktif),
                        aktif = VALUES(aktif)
                ", [
                    $m['id_member'],
                    $m['va'],
                    $m['nama'],
                    $m['kontak'],
                    $m['nama_paket'],
                    $m['kecepatan'],
                    $m['jatuh_tempo'],
                    $m['tanggal_daftar'],
                    $m['tanggal_non_aktif'],
                    $m['aktif']
                ]);
            }
        }
    }

    // === Simpan ke tabel users ===
    if (!empty($usersData)) {
        $chunks = array_chunk($usersData, 500);
        foreach ($chunks as $batch) {
            foreach ($batch as $u) {
                $this->db->query("
                    INSERT INTO users (username, password, nama, role, aktif)
                    VALUES (?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE 
                        nama = VALUES(nama),
                        aktif = VALUES(aktif)
                ", [
                    $u['username'],
                    $u['password'],
                    $u['nama'],
                    $u['role'],
                    $u['aktif']
                ]);
            }
        }
    }

    $this->db->trans_complete();

    $successCount = count($membersData);

    if (!empty($errors)) {
        $msg = "Import selesai. <b>$successCount</b> data berhasil disimpan.<br><br>";
        $msg .= "Namun ada beberapa baris bermasalah:<br>" . implode("<br>", $errors);
        $this->session->set_flashdata('error', $msg);
    } else {
        $this->session->set_flashdata('success', "Import berhasil. $successCount data disimpan & akun user dibuat otomatis.");
    }

    redirect('admin/pelanggan');
}


// === Form upload status bayar ===
public function import_status_bayar()
{
    $data['title'] = 'Import Status Bayar';
    $data['content'] = $this->load->view('admin/pelanggan/import_status_bayar', $data, TRUE);
    $this->load->view('layout_admin', $data);
}

// === Eksekusi import status bayar ===
public function do_import_status_bayar()
{
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '512M');

    $file = $_FILES['file_excel']['tmp_name'];
    $filename = $_FILES['file_excel']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (empty($file)) {
        $this->session->set_flashdata('error', 'File tidak ditemukan.');
        redirect('admin/pelanggan/import_status_bayar');
        return;
    }

    $allowed_ext = ['xls', 'xlsx'];
    if (!in_array(strtolower($ext), $allowed_ext)) {
        $this->session->set_flashdata('error', 'Format file tidak valid.');
        redirect('admin/pelanggan/import_status_bayar');
        return;
    }

    require_once FCPATH . 'vendor/autoload.php';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();

    $count = 0;

    for ($row = 2; $row <= $highestRow; $row++) {
        $nama_value  = $sheet->getCellByColumnAndRow(4, $row)->getValue();  // kolom D (Nama)
        $total_value = $sheet->getCellByColumnAndRow(10, $row)->getValue(); // kolom J (Total)

        $nama  = !empty($nama_value) ? trim($nama_value) : '';
        $total = !empty($total_value) ? trim($total_value) : '';

        $va = null;
        if (strpos($nama, 'ID :') !== false) {
            $parts = explode('ID :', $nama);
            $nama = trim(str_replace(',', '', $parts[0])); // hapus koma di akhir nama
            $va = trim($parts[1]); // jangan hapus tanda "-"
        }

        if ($nama != '' && $va != '') {
            $status = ($total == '' || $total == null) ? 'Lunas' : 'Belum Lunas';

            $this->db->where('nama', $nama);
            $this->db->where('va', $va);
            $this->db->update('members', ['status_bayar' => $status]);

            if ($this->db->affected_rows() > 0) {
                $count++;
            }
        }
    }

    $this->session->set_flashdata('success', "Status bayar berhasil diperbarui untuk $count pelanggan!");
    redirect('admin/pelanggan');
}





}