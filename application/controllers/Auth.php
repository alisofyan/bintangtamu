<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Load facebook library
        $this->load->library('facebook');

        //Load user model
        $this->load->model('user');

        // load form validate
        $this->load->library('form_validation');
    }

    public function login()
    {
        $this->load->view('auth/header');
        $this->load->view('auth/login');
        $this->load->view('auth/footer');
    }

    public function backoffice()
    {
        $this->form_validation->set_rules('usernamegs', 'Username', 'trim|required');
        $this->form_validation->set_rules('passwordgs', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['titlebtn'] = 'Penyelenggara';
            $data['redir'] = '';
            $data['title'] = 'Login Dashboard';
            $this->load->view('auth/header', $data);
            $this->load->view('auth/backoffice');
            $this->load->view('auth/footer');
        } else {
            $this->_ceklogin();
        }
    }

    private function _ceklogin()
    {
        $cekuser = $this->input->post('usernamegs');
        $cekpass = $this->input->post('passwordgs');

        $user = $this->db->get_where('gs_login', ['username_gs' => $cekuser])->row_array();

        //jika user aktif
        if ($user) {
            // jika aktif
            if ($user['active'] == 1) {
                // cek password
                if (password_verify($cekpass, $user['password_gs'])) {
                    $data = [
                        'username_gs' => $user['username_gs']
                    ];
                    $this->session->set_userdata($data);
                    redirect('Dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('Auth/backoffice');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum aktif! silakan verifikasi email anda</div>');
                redirect('Auth/backoffice');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username belum terdaftar!</div>');
            redirect('Auth/backoffice');
        }
    }


    public function backofficesignup()
    {
        $this->form_validation->set_rules('namags', 'Nama', 'required|trim');
        $this->form_validation->set_rules('emailgs', 'Email', 'required|trim|valid_email|is_unique[gs_info.email_gs]');
        $this->form_validation->set_rules('telpgs', 'HP', 'required|trim|is_unique[gs_info.telp_gs]');
        $this->form_validation->set_rules('genregs', 'Genre', 'required');
        $this->form_validation->set_rules('lokasigs', 'Lokasi', 'required');
        $this->form_validation->set_rules('hargags', 'Harga', 'required|trim');
        $this->form_validation->set_rules('deskripsigs', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['titlebtn'] = 'Penyelenggara';
            $data['redir'] = '';
            $data['title'] = 'Step 1';
            $this->load->view('auth/header', $data);
            $this->load->view('auth/backoffice-signup');
            $this->load->view('auth/footer');
        } else {
            $data = [
                'nama_gs' => htmlspecialchars($this->input->post('namags', true)),
                'email_gs' => htmlspecialchars($this->input->post('emailgs', true)),
                'genre_gs' => htmlspecialchars($this->input->post('genregs', true)),
                'lokasi_gs' => htmlspecialchars($this->input->post('lokasigs', true)),
                'harga_gs' => htmlspecialchars($this->input->post('hargags', true)),
                'foto_gs' => 'image.jpg',
                'deskripsi_gs' => htmlspecialchars($this->input->post('deskripsigs', true)),
                'telp_gs' => htmlspecialchars($this->input->post('telpgs', true))
            ];
            $this->db->insert('gs_info', $data);
            $sesi1 = $this->session->set_userdata($data);
            redirect('Auth/backofficesignupstep2');
        }
    }
    public function backofficesignupstep2()
    {
        $this->form_validation->set_rules('usernamegs', 'Username', 'required|trim|is_unique[gs_login.username_gs]');
        $this->form_validation->set_rules('passwordgs', 'Password', 'required|trim|min_length[5]|matches[passwordgs2]');
        $this->form_validation->set_rules('passwordgs2', 'Password', 'required|trim|min_length[5]|matches[passwordgs]');

        if ($this->form_validation->run() == false) {
            $data['gs_info'] = $this->db->get_where('gs_info', ['email_gs' => $this->session->userdata('email_gs')])->row_array();
            $data['titlebtn'] = 'Guest star';
            $data['redir'] = 'Backoffice';
            $data['title'] = 'Step 2';
            $data['idgs'] = $data['gs_info']['id_gs'];
            $data['emailgs'] = $data['gs_info']['email_gs'];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/backoffice-signupstep2', $data);
            $this->load->view('auth/footer');
        } else {
            $email = $this->input->post('emailgs', true);
            $data = [
                'username_gs' => htmlspecialchars($this->input->post('usernamegs', true)),
                'password_gs' => password_hash($this->input->post('passwordgs'), PASSWORD_DEFAULT),
                'id_gs' => $this->input->post('idgs'),
                'active' => 0
            ];
            // token

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email_gs' => $email,
                'token' => $token,
                'date_created' => time()
            ];
            // sosmed
            $sosmed = [
                'id_gs' => $this->input->post('idgs'),
                'link_fb' => '',
                'link_ig' => '',
                'link_tw' => '',
                'link_yt' => ''
            ];

            $this->db->insert('gs_login', $data);
            $this->db->insert('gs_token', $user_token);
            $this->db->insert('gs_sosmed', $sosmed);

            $this->_sendEmail($token, 'verify');
            $sesi2 = $this->session->set_userdata($data);
            redirect('Auth/backofficesignupstep3');
        }
    }
    public function backofficesignupstep3()
    {
        $data['title'] = 'Complete';
        $data['titlebtn'] = 'Guest star';
        $data['redir'] = 'Backoffice';
        $this->load->view('Auth/header', $data);
        $this->load->view('Auth/completesignup');
        $this->load->view('Auth/footer');
    }

    private function _sendEmail($token, $type)
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

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Silakan klik tombol ini untuk verifikasi akun anda : <br><a href="' . base_url() . 'Auth/verify?email=' . $this->input->post('emailgs') . '&token=' . $token . '">Active</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = rawurldecode(urlencode($this->input->get('token')));
        //$token = $this->input->get('token');
        $user = $this->db->get_where('gs_info', ['email_gs' => $email])->row_array();
        $idgs = $this->db->get_where('gs_info', ['email_gs' => $email])->row('id_gs');
        // var_dump($token);
        // die;

        if ($user) {
            $user_token = $this->db->get_where('gs_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->db->set('active', 1);
                $this->db->where('id_gs', $idgs);
                $this->db->update('gs_login');

                $this->db->delete('gs_token', ['email_gs' => $email]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun anda telah aktif, silakan login</div>');
                redirect('Auth/backoffice');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token tidak valid!</div>');
                redirect('Auth/backoffice');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun gagal di aktifkan!</div>');
            redirect('Auth/backoffice');
        }
    }

    public function index()
    {
        // ===================================== EMAIL ============================================
        $this->form_validation->set_rules('emailuser', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('passworduser', 'Password', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->_cekloginuser();
        } else {

            // ======================================= FACEBOOK ======================================
            $userData = array();

            // Check if user is logged in
            if ($this->facebook->is_authenticated()) {
                // Get user facebook profile details
                $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

                // Preparing data for database insertion
                $userData['oauth_provider'] = 'facebook';
                $userData['oauth_uid']    = !empty($fbUser['id']) ? $fbUser['id'] : '';;
                $userData['first_name']    = !empty($fbUser['first_name']) ? $fbUser['first_name'] : '';
                $userData['last_name']    = !empty($fbUser['last_name']) ? $fbUser['last_name'] : '';
                $userData['email']        = !empty($fbUser['email']) ? $fbUser['email'] : '';
                $userData['gender']        = !empty($fbUser['gender']) ? $fbUser['gender'] : '';
                $userData['picture']    = !empty($fbUser['picture']['data']['url']) ? $fbUser['picture']['data']['url'] : '';
                $userData['link']        = !empty($fbUser['link']) ? $fbUser['link'] : '';

                // Insert or update user data
                $userID = $this->user->checkUser($userData);

                // Check user data insert or update status
                if (!empty($userID)) {
                    $data['userData'] = $userData;
                    $this->session->set_userdata('userData', $userData);
                    $this->session->set_userdata($userData);
                } else {
                    $data['userData'] = array();
                }

                // Get logout URL
                $data['logoutURL'] = $this->facebook->logout_url();
            } else {
                // Get login URL
                $data['authURL'] =  $this->facebook->login_url();
            }

            // Load login & profile view
            $data['title'] = 'Login';
            $data['titlebtn'] = 'Guest star';
            $data['redir'] = 'Backoffice';
            $this->load->view('auth/header', $data);
            //$this->load->view('auth/login');
            $this->load->view('Auth/index', $data);
            $this->load->view('auth/footer');
        }
    }
    public function _cekloginuser()
    {
        $cekemail = $this->input->post('emailuser');
        $cekpass = $this->input->post('passworduser');

        $user = $this->db->get_where('user_email', ['email' => $cekemail])->row_array();

        //jika user aktif
        if ($user) {
            // cek password
            if (password_verify($cekpass, $user['password'])) {
                $data = [
                    'oauth_uid' => $user['id'],
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'oauth_provider' => $user['oauth_provider']
                ];
                $this->session->set_userdata($data);
                redirect('');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
            redirect('Auth');
        }
    }


    public function userregister()
    {
        $this->form_validation->set_rules('namauser', 'Nama', 'required|trim');
        $this->form_validation->set_rules('emailuser', 'Email', 'required|trim|valid_email|is_unique[user_email.email]');
        $this->form_validation->set_rules('passworduser', 'Password', 'required|trim|min_length[5]|matches[passworduser2]');
        $this->form_validation->set_rules('passworduser2', 'Password', 'required|trim|min_length[5]|matches[passworduser]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar';
            $data['titlebtn'] = 'Penyelenggara';
            $data['redir'] = '';
            $this->load->view('Auth/header', $data);
            $this->load->view('Auth/userregister');
            $this->load->view('Auth/footer');
        } else {
            // mulai input
            $data = [
                'first_name' => htmlspecialchars($this->input->post('namauser', true)),
                'email' => htmlspecialchars($this->input->post('emailuser', true)),
                'password' => password_hash($this->input->post('passworduser'), PASSWORD_DEFAULT),
                'oauth_provider' => 'email',
                'gambar' => 'image.jpg'
            ];
            $this->db->insert('user_email', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendafataran berhasil, silakan login</div>');
            redirect('Auth');
            // selse
        }
    }

    public function logout()
    {
        // Remove local Facebook session
        $this->facebook->destroy_session();
        // Remove user data from session
        $this->session->unset_userdata('userData');
        // Redirect to login page
        redirect('Auth');
    }

    public function logoutdashboard()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username_gs');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah logout</div>');
        redirect('Auth/backoffice');
    }

    public function logoutuser()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('oauth_provider');
        $this->facebook->logout_url();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah logout</div>');
        redirect('Auth');
    }
}
