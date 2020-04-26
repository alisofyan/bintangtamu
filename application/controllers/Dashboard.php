<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // load form validate
        $this->load->library('form_validation');

        //Load dashboard model
        $this->load->model('Dashboard_model');

        // jika belum login
        if (!$this->session->userdata('username_gs')) {
            redirect("Auth/backoffice");
        }
    }


    public function index()
    {
        // $data['gs_login'] = $this->db->get_where('gs_login', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        // echo 'selamat datang' . $data['gs_login']['username_gs'];
        $data['breadcrumb'] = 'Home';
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/sidebar', $data);
        $this->load->view('dashboard/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('dashboard/footer');
    }

    public function profile()
    {
        $data['title'] = 'Dashboard / Profil';
        $data['breadcrumb'] = 'Home / Profile';
        $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        // rules
        $this->form_validation->set_rules('namags', 'Nama', 'required|trim');
        $this->form_validation->set_rules('telpgs', 'HP', 'required|trim');
        $this->form_validation->set_rules('genregs', 'Genre', 'required');
        $this->form_validation->set_rules('lokasigs', 'Lokasi', 'required');
        $this->form_validation->set_rules('hargags', 'Harga', 'required|trim');
        $this->form_validation->set_rules('deskripsigs', 'Deskripsi', 'required|trim');
        // kondisi
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/sidebar', $data);
            $this->load->view('dashboard/topbar', $data);
            $this->load->view('dashboard/profile', $data);
            $this->load->view('dashboard/footer');
        } else {
            $id_gs = $this->input->post('idgs');
            $data1 = [
                'link_fb' => $this->input->post('facebookgs'),
                'link_ig' => $this->input->post('instagramgs'),
                'link_yt' => $this->input->post('youtubegs'),
                'link_tw' => $this->input->post('twittergs')
            ];
            $data3 = [
                'nama_gs' => $this->input->post('namags'),
                'genre_gs' => $this->input->post('genregs'),
                'lokasi_gs' => $this->input->post('lokasigs'),
                'harga_gs' => $this->input->post('hargags'),
                // 'foto_gs' => $this->input->post('fotogs'),
                'deskripsi_gs' => $this->input->post('deskripsigs'),
                'telp_gs' => $this->input->post('telpgs')
            ];

            $this->db->where('id_gs', $id_gs);
            $this->db->update('gs_sosmed', $data1);

            // cek jika ada gambar
            $upload_image = $_FILES['fotogs'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('fotogs')) {
                    $old_image = $data['user']['foto_gs'];
                    if ($old_image != 'image.jpg') {
                        unlink(FCPATH . '/assets/img/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto_gs', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->where('id_gs', $id_gs);
            $this->db->update('gs_info', $data3);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data sudah ter update!</div>');
            redirect('Dashboard');
        }
    }

    public function akun()
    {
        $data['title'] = 'Dashboard / Akun';
        $data['breadcrumb'] = 'Home / Akun';
        $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        // rules
        $this->form_validation->set_rules('passwordlama', 'Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('passwordgs', 'Password', 'required|trim|min_length[5]|matches[passwordgs2]');
        $this->form_validation->set_rules('passwordgs2', 'Password', 'required|trim|min_length[5]|matches[passwordgs]');

        // kondisi
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/sidebar', $data);
            $this->load->view('dashboard/topbar', $data);
            $this->load->view('dashboard/akun', $data);
            $this->load->view('dashboard/footer');
        } else {
            $password_lama = $this->input->post('passwordlama');
            $password_baru = $this->input->post('passwordgs');
            if (!password_verify($password_lama, $data['user']['password_gs'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                redirect('Dashboard/akun');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak boleh sama!</div>');
                    redirect('Dashboard/akun');
                } else {
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $username = $this->session->userdata('username_gs');

                    $this->db->set('password_gs', $password_hash);
                    $this->db->where('username_gs', $username);
                    $this->db->update('gs_login');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
                    redirect('Dashboard');
                }
            }
        }
    }

    public function request($id)
    {
        $data['breadcrumb'] = 'Home / Tawaran';
        $data['title'] = 'Dashboard / Tawaran';
        $data['tawaran'] = $this->Dashboard_model->getTawaranById($id);
        $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        //$data['tawaran'] = $this->db->get_where('transaksi', ['id_gs' => $this->session->userdata('id_gs')])->row_array();
        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/sidebar', $data);
        $this->load->view('dashboard/topbar', $data);
        $this->load->view('dashboard/request', $data);
        $this->load->view('dashboard/footer');
    }

    public function detailrequest($id_req)
    {
        $data['breadcrumb'] = 'Home / Tawaran / Detail Tawaran';
        $data['title'] = 'Dashboard / Detail';
        $data['req'] = $this->Dashboard_model->getRequest($id_req);
        $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        //$data['tawaran'] = $this->db->get_where('transaksi', ['id_gs' => $this->session->userdata('id_gs')])->row_array();
        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/sidebar', $data);
        $this->load->view('dashboard/topbar', $data);
        $this->load->view('dashboard/detailrequest', $data);
        $this->load->view('dashboard/footer');
    }

    public function terimaTawaran($idtrx)
    {
        $penerima = $this->db->get_where('transaksi', ['id_trx' => $idtrx])->row_array();
        $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        $terima = 'diterima';
        $this->db->set('status_trx', $terima);
        $this->db->where('id_trx', $idtrx);
        $this->db->update('transaksi');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'carigsmarketplace@gmail.com',
            'smtp_pass' => 'jebraw24',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('carigsmarketplace@gmail.com', 'Cari Guest Star Marketplace');
        $this->email->to($penerima['email_user']);
        $this->email->subject('Konfirmasi Tawaran');
        $this->email->message('<div style="text-align: center"><h1>Selamat, ' . $penerima['namauser'] . ' !</h1><br>Tawaran yang anda ajukan kepada ' . $data['user']['nama_gs'] . ' <h4 style="color: green;">Diterima !!</h4><br>Untuk transaksi lebih lanjut silakan hubungi contact dibawah ini<br>Nomer Hp : ' .  $data['user']['telp_gs'] . '<br>Email : ' .  $data['user']['email_gs'] . '</div>');

        if ($this->email->send()) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tawaran berhasil diterima!</div>');
            redirect('Dashboard/request/' . $data['user']['id_gs'] . '');
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function tolakTawaran($idtrx)
    {
        $penerima = $this->db->get_where('transaksi', ['id_trx' => $idtrx])->row_array();
        $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        $terima = 'ditolak';
        $this->db->set('status_trx', $terima);
        $this->db->where('id_trx', $idtrx);
        $this->db->update('transaksi');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'carigsmarketplace@gmail.com',
            'smtp_pass' => 'jebraw24',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('carigsmarketplace@gmail.com', 'Cari Guest Star Marketplace');
        $this->email->to($penerima['email_user']);
        $this->email->subject('Konfirmasi Tawaran');
        $this->email->message('<div style="text-align: center"><h1>Hai, ' . $penerima['namauser'] . ' !</h1><br>Tawaran yang anda ajukan kepada ' . $data['user']['nama_gs'] . ' <h4 style="color: red;">Belum Diterima</h4><br>Silakan ajukan tawaran yang lain<br><a href="' . base_url() . '" class="btn btn-primary btn-block">Cari Guest Star mu disini!</a></div>');

        if ($this->email->send()) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tawaran berhasil ditolak!</div>');
            redirect('Dashboard/request/' . $data['user']['id_gs'] . '');
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
