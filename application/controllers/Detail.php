<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Load facebook library
        $this->load->library('facebook');

        // load form validate
        $this->load->library('form_validation');

        //Load user model
        $this->load->model('GS_model');

        // jika belum login
        if (!$this->session->userdata('oauth_uid')) {
            redirect("Auth");
        }
    }

    public function index($id)
    {
        $data['logoutURL'] = $this->facebook->logout_url();
        // get byID
        $data['gs'] = $this->GS_model->getGsById($id);
        // form verify
        $this->form_validation->set_rules('namaevent', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tglevent', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('tempatevent', 'Tempat', 'required|trim');
        $this->form_validation->set_rules('emailuser', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('telpuser', 'HP', 'required|trim');
        $this->form_validation->set_rules('deskripsievent', 'Deskripsi', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('detail/header', $data);
            $this->load->view('detail/index', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('emailuser', true);
            $gs_id = $this->input->post('idgs', true);
            $data = [
                'id_user' => htmlspecialchars($this->input->post('iduser', true)),
                'namauser' => htmlspecialchars($this->input->post('namauser', true)),
                'id_gs' => htmlspecialchars($gs_id),
                'oauth_provider' => htmlspecialchars($this->input->post('authuser', true)),
                'nama_event' => htmlspecialchars($this->input->post('namaevent', true)),
                'tgl_event' => htmlspecialchars($this->input->post('tglevent', true)),
                'tempat_event' => htmlspecialchars($this->input->post('tempatevent', true)),
                'email_user' => htmlspecialchars($email),
                'hp_user' => htmlspecialchars($this->input->post('telpuser', true)),
                'deskripsi_event' => htmlspecialchars($this->input->post('deskripsievent', true)),
                'status_trx' => 'menunggu',
                'tgl_trx' => htmlspecialchars($this->input->post('tgltrx', true))
            ];
            $this->db->insert('transaksi', $data);
            $this->_emailTawaran();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tawaran berhasil dikirim, silakan tunggu konfirmasi melalui email anda!</div>');
            redirect('detail/index/' . $gs_id);
        }
    }


    private function _emailTawaran()
    {
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
        $this->email->to($this->input->post('emailgs'));
        $this->email->subject('Tawaran Baru!');
        $this->email->message('<div style="text-align: center"><h1>Hai!</h1><br>Anda mendapat tawaran baru dari <h4>' . $this->input->post('namauser') . '</h4><br>Silakan cek<br><a href="' . base_url('dashboard/request/' . $this->input->post('idgs') . '') . '" class="btn btn-primary btn-block">CEK DISINI!</a</div>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
