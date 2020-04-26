<?php

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load facebook library
        $this->load->library('facebook');

        $this->load->helper('form');
        // load form validate
        $this->load->library('form_validation');

        //Load user model
        $this->load->model('GS_model');
        $this->load->model('Electre');
    }

    public function index()
    {
        $data['gsJenis'] = $this->GS_model->getJenispertunjukan();
        $data['gsHarga'] = $this->GS_model->getHarga();
        $data['gsLokasi'] = $this->GS_model->getLokasi();

        $data['full_gs'] = $this->GS_model->getFullGs();
        $data['kriteria'] = $this->Electre->getKriteria();

        // var_dump($data['genre_gs']);
        // die;
        $data['logoutURL'] = $this->facebook->logout_url();
        //validasi genre
        $this->form_validation->set_rules('gsi[genre_gs][3]', 'Genre', 'required');
        $this->form_validation->set_rules('gsi[genre_gs][2]', 'Genre', 'required');
        $this->form_validation->set_rules('gsi[genre_gs][1]', 'Genre', 'required');
        //validasi lokasi
        $this->form_validation->set_rules('gsi[lokasi_gs][5]', 'Lokasi', 'required');
        $this->form_validation->set_rules('gsi[lokasi_gs][4]', 'Lokasi', 'required');
        $this->form_validation->set_rules('gsi[lokasi_gs][3]', 'Lokasi', 'required');
        $this->form_validation->set_rules('gsi[lokasi_gs][2]', 'Lokasi', 'required');
        $this->form_validation->set_rules('gsi[lokasi_gs][1]', 'Lokasi', 'required');
        $this->form_validation->set_message(
            'required',
            'Silakan pilih prioritas'
        );

        // $data['user'] = $this->db->get_where('', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('home/index', $data);
            $this->load->view('templates/footer');
        } else {
            // get genre
            $genre1 = $this->input->post('genregs1', true);
            $genre2 = $this->input->post('genregs2', true);
            $genre3 = $this->input->post('genregs3', true);
            // get lokasi
            $lokasi1 = $this->input->post('lokasigs1', true);
            $lokasi2 = $this->input->post('lokasigs2', true);
            $lokasi3 = $this->input->post('lokasigs3', true);
            $lokasi4 = $this->input->post('lokasigs4', true);
            $lokasi5 = $this->input->post('lokasigs5', true);
            $isi = $this->input->post('isi', true);
            $data = [
                'bobot3_genre' => $genre1, $genre2, $genre3,
                'bobot2_genre' => $genre2, $genre1, $genre3,
                'bobot1_genre' => $genre3, $genre1, $genre3,
                'bobot5_lokasi' => $lokasi1, $lokasi1, $genre1,
                'bobot4_lokasi' => $lokasi2, $lokasi1, $genre1,
                'bobot3_lokasi' => $lokasi3, $lokasi1, $genre1,
                'bobot2_lokasi' => $lokasi4, $lokasi1, $genre1,
                'bobot1_lokasi' => $lokasi5, $lokasi1, $genre1,
            ];
            $dataCreteria = $this->input->post('gsi', true);
            $this->_bobotPupupate($dataCreteria);
            //$this->_insertBobot();
            // $this->db->insert('electre_pembobotan', $data);
        }
    }
    private function _insertBobot()
    {
        $getGS = $this->GS_model->getFullGs();
        $getKrit = $this->Electre->getKriteria();
        $idbob = base64_encode(random_bytes(5));
        $idbot = "ID" . $idbob;
        foreach ($getGS as $gs) {
            $idgs = $gs['id_gs'];
            foreach ($getKrit as $kr) {
                $idkrit = $kr['id'];
                $data = array(
                    "id_bobot" => $idbot,
                    "id_gs" =>  $idgs,
                    "id_kriteria" => $idkrit
                );
                // foreach ($getGS as $gsBobot) {
                //     $harg = $gsBobot['harga_gs'];
                //     $data2 = array{}
                // }
                $this->db->insert('electre_bobot', $data);
            }
        }

        // Ambil data yang dikirim dari form
        // $idgs = $_POST['idgs'];
        // $gs = $_POST['gs'];
        // $harga = $_POST['hargags'];
        // $idkriteria = $_POST['idkriteria'];
        // $bobotkriteria = $_POST['bobotkriteria'];
        // $genregs = $_POST['genregs1'];
        // $data = array();

        // $index = 0; // Set index array awal dengan 0
        // foreach ($idgs as $datanis) {
        //     array_push($data, array(
        //         'id_gs' => $datanis,
        //         //'nama' => $gs[$index], 
        //         'id_kriteria' => $idkriteria,
        //         'bobot' => $genregs,
        //     ));

        //     $index++;
        // }
        //batas
        // var_dump($data);
        // die;
        //  $this->db->insert('electre_bobot', $data);
        //$sql = $this->Electre->simpanKriteria($data);
    }

    private function _bobotPupupate(array $dataCreteria)
    {
        $getGS = $this->GS_model->getFullGs();
        $getKrit = $this->Electre->getKriteria();
        $idbob = base64_encode(random_bytes(5));
        $idbot = "ID" . $idbob;
        $data = [];
        foreach ($dataCreteria as $creteriaName => $dataGuestStar) {
            $idCreteria = $this->Electre->getIdCreteriaByName($creteriaName);
            $idCreteria = (int)$idCreteria[0]["id"];
            foreach ($dataGuestStar as $bobot => $genreGs) {
                $data[$genreGs][$idCreteria] = $bobot;
                var_dump($bobot);
            }
        }


        // $allGsData = getAllGsData();
        // $allCretriaData = getAllCretriaData();
        $systemHitung = [];
        foreach ($getGS as $gs) {

            $idGs = $gs["id_gs"];
            $genreGs = $gs["genre_gs"];
            foreach ($getKrit as $cr) {
                $idCr = $cr["id"];
                $inputan = [
                    "id_bobot" => $idbot,
                    "id_gs" => $idGs,
                    "id_creteria" => $idCr,
                    "bobot" => isset($data[$genreGs][$idCr]) ? $data[$genreGs][$idCr] : 0
                ];
                $systemHitung[] = $inputan;
                // var_dump($inputan);
                //$this->db->insert('electre_bobot', $inputan);
            }
        }

        die();

        // var_dump($systemHitung);
        // var_dump($this->jawab());
        $jawab = $this->jawab($systemHitung[0]["id_bobot"]);

        foreach (range(0, 8) as $index) {
            $beda = array_diff_assoc(
                $systemHitung[$index],
                $jawab[$index]
            );
            if (!empty($beda)) {
                var_dump("data beda ke " . ($index + 1));
                var_dump($beda);
            }
        }


        die();
    }

    public function result()
    {
        $data['logoutURL'] = $this->facebook->logout_url();
        // $data['user'] = $this->db->get_where('vfull_detailgs', ['username_gs' => $this->session->userdata('username_gs')])->row_array();
        $data['judul'] = 'Daftar Mahasiswa';
        $data['hasilgs'] = $this->GS_model->getAllGs();
        $this->load->view('templates/header', $data);
        $this->load->view('home/result', $data);
        $this->load->view('templates/footer');
        $sesidetail = $this->session->set_userdata($data);
    }

    public function drag()
    {
        $this->load->view('Home/drag');
    }


    protected function jawab($idBobot)
    {
        return [
            [
                "id_bobot" => $idBobot,
                "id_gs" => "10",
                "id_creteria" => "1",
                "bobot" => 1
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "10",
                "id_creteria" => "2",
                "bobot" => 8000000
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "10",
                "id_creteria" => "3",
                "bobot" => 1
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "7",
                "id_creteria" => "1",
                "bobot" => 2
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "7",
                "id_creteria" => "2",
                "bobot" => 10000000
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "7",
                "id_creteria" => "3",
                "bobot" => 3
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "6",
                "id_creteria" => "1",
                "bobot" => 3
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "6",
                "id_creteria" => "2",
                "bobot" => 6000000
            ],
            [
                "id_bobot" => $idBobot,
                "id_gs" => "6",
                "id_creteria" => "3",
                "bobot" => 5
            ],
        ];
    }
}
