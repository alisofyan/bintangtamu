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
        $this->load->model('Metode');

        // jika belum login
        if (!$this->session->userdata('oauth_uid')) {
            redirect("Auth");
        }
    }

    public function index()
    {
        //update W kriteria
        $data['gsJenis'] = $this->GS_model->getJenispertunjukan();
        $data['gsHarga'] = $this->GS_model->getHarga();
        $data['gsLokasi'] = $this->GS_model->getLokasi();

        $data['full_gs'] = $this->GS_model->getFullGs();
        $data['kriteria'] = $this->Metode->getKriteria();
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

            // pertama hapus dulu datanya
            $this->_deleteAll();
            //input filter kriteria
            $this->_kriteriafilter();
            // bobot
            $dataCreteria = $this->input->post('gsi', true);
            //masukan guest star bobot
            $this->_bobotInput($dataCreteria);
            //update W kriteria
            $this->_metodeTahap2();
            // menghitung S
            $this->_metodeTahap3();
            //masukan nilai V atau hasilnya
            $this->_metodeTahap4();
            // hasil guest star yg terpilih
            redirect('home/result');
        }
    }

    private function _bobotInput(array $dataCreteria)
    {
        $getGS = $this->GS_model->getFullGs();
        $getKrit = $this->Metode->getKriteria();
        $hasilW = $this->Metode->wKriteria();
        $idbob = bobotId;
        $idbot = "ID" . $idbob;
        $data = [];
        foreach ($dataCreteria as $creteriaName => $dataGuestStar) {
            $idCreteria = $this->Metode->getIdCreteriaByName($creteriaName);
            $idCreteria = (int) $idCreteria[0]["id"];
            foreach ($dataGuestStar as $bobot => $genreGs) {
                $data[$genreGs][$idCreteria] = $bobot;
            }
        }

        $systemHitung = [];
        foreach ($getGS as $gs) {

            $idGs = $gs["id_gs"];

            $hargaGs = $gs["harga_gs"];
            $genreGs = $gs["genre_gs"];
            $lokasiGs = $gs["lokasi_gs"];
            foreach ($getKrit as $cr) {


                $idCr = $cr["id"];
                $nmCr = $cr["nama_kriteria"];
                $jenisCr = $gs[$nmCr];
                $inputan = [
                    "id_bobot" => $idbot,
                    "id_gs" => $idGs,
                    "id_kriteria" => $idCr,
                    "bobot" => isset($data[$jenisCr][$idCr]) ? $data[$jenisCr][$idCr] : 0
                ];
                //var_dump($idbot);
                $this->db->insert('metode_bobot', $inputan);
                //var_dump($inputan["bobot"]);

                $systemHitung[] = $inputan;
            }
        }


        //var_dump($systemHitung);
        //var_dump($this->jawab());
        // $jawab = $this->jawab($systemHitung[0]["id_bobot"]);

        // foreach (range(0, 8) as $index) {
        //     $beda = array_diff_assoc(
        //         $systemHitung[$index],
        //         $jawab[$index]
        //     );
        //     if (!empty($beda)) {
        //         var_dump("data beda ke " . ($index + 1));
        //         var_dump($beda);
        //     }
        // }


        // die();
    }

    private function _metodeTahap2()
    {
        $hasilW = $this->Metode->wKriteria();
        $allKriteria = $this->Metode->getKriteria();
        foreach ($hasilW as $w => $value) {
            $d = (int) $value["bobot"];
            foreach ($allKriteria as $ak => $valAk) {
                $idK = $valAk["id"];
                $nilaiX = (int) $valAk["bobot"];
                $WperKriteria = $nilaiX / $d;
                $bobotW = [
                    "id" => $idK,
                    "nilaiW" => $WperKriteria
                ];
                //var_dump($bobotW);
                // $this->db->where('id', $idK);
                // $this->db->update('metode_kriteria', $bobotW);
            }
        }
    }

    private function _metodeTahap3()
    {
        $idbob = bobotId;
        $idbot = "ID" . $idbob;
        //$idbot = "ID8HEmHoNU";
        $getGS = $this->GS_model->getFullGs();
        $allKriteria = $this->Metode->getKriteria();
        $getAllBobot = $this->Metode->getAllBobotById($idbot);
        $getBobot = $this->Metode->getBobotById($idbot);
        $groupIDCre = $this->Metode->getBobot($idbot);
        //$idCreteria = (int)$idCreteria[0]["id"];
        $totalS = array();
        $totalS2 = array();
        $tempAllkriteria = array();
        foreach ($allKriteria as $kr) {
            $tempAllkriteria[$kr["id"]] = $kr;
        }

        foreach ($getAllBobot as $bb) {
            $bbt = $bb["bobot"];
            $idbbt = $bb["id_bobot"];
            $idkrb = $bb["id_kriteria"];
            $idgs = $bb["id_gs"];
            //echo $tempAllkriteria[$idkrb]["nilaiW"] . "*" . $bbt . "<br>";
            $nilaiW = $tempAllkriteria[$idkrb]["nilaiW"];
            $nilaiWfloat = floatval($nilaiW);
            $bbtInt = (int) $bbt;
            $hasilstep3 = pow($bbtInt, $nilaiWfloat);
            // echo $nilaiWfloat . "<br>";
            // echo $idgs . "-" . $idkrb . "-" . $hasilstep3 . "<br>";
            $totalS = [
                "id_bobot" => $idbbt,
                "id_gs" => $idgs,
                "id_kriteria" => $idkrb,
                "hasilS" => $hasilstep3
            ];
            var_dump($totalS);
            //echo $totalS['id_gs']['hasilS'] . "<br />";
            $this->db->insert('metode_nilais', $totalS);
        }
    }


    private function _metodeTahap4()
    {
        $idbob = bobotId;
        $idbot = "ID" . $idbob;
        // $idbot = "IDO4Ge30Et";
        $getNilaisAll = $this->Metode->nilaiSAll($idbot);
        $getNilaisById = $this->Metode->getnilaiSById($idbot);
        $dataV = array();
        foreach ($getNilaisAll as $sa) {
            $lamS = $sa["total_S"];
            $lamSfloat = floatval($lamS);
            foreach ($getNilaisById as $s) {
                $si = $s["total_S"];
                $idgs = $s["id_gs"];
                $sifloat = floatval($si);
                $hasilV = $sifloat / $lamSfloat;
                $dataV = [
                    "id_bobot" => $idbot,
                    "id_gs" => $idgs,
                    "hasilV" => $hasilV
                ];
                // var_dump($dataV);
                $this->db->insert('metode_hasil', $dataV);
                //$sesi1 = $this->session->set_userdata($data);
            }
        }
    }

    private function _deleteAll()
    {
        $this->db->empty_table('metode_hasil');
        $this->db->empty_table('metode_nilais');
        $this->db->empty_table('metode_bobot');
        $this->db->empty_table('filter_kriteria1');
        $this->db->empty_table('filter_kriteria3');
    }

    private function _kriteriafilter()
    {
        $filter_kategori1 = $this->input->post('gsi[genre_gs]');
        $filter_kategori2 = $this->GS_model->getKriteria2();
        $filter_kategori3 = $this->input->post('gsi[lokasi_gs]');
        foreach ($filter_kategori1 as $genre) {
            $datagenre = [
                "nama" => $genre
            ];
            //var_dump($datagenre);
            $this->db->insert('filter_kriteria1', $datagenre);
        }
        foreach ($filter_kategori3 as $lokasi) {
            $datalokasi = [
                "nama" => $lokasi
            ];
            //var_dump($datalokasi);
            $this->db->insert('filter_kriteria3', $datalokasi);
        }
    }
    public function result()
    {
        $idbob = bobotId;
        // $idbot = "ID" . $idbob;
        $idbot = "IDYV3aCgol";
        //$data['hasilgs'] = $this->db->get_where('v_hasilgs', ['id_bobot' => $this->session->userdata('id_bobot')])->row_array();
        $data['logoutURL'] = $this->facebook->logout_url();
        $data['judul'] = 'Daftar Mahasiswa';
        $data['hasilgs'] = $this->GS_model->getHasilmetodegs();
        $data['filter_jenis'] = $this->GS_model->getKriteria1();
        $data['filter_harga'] = $this->GS_model->getKriteria2();
        $data['filter_lokasi'] = $this->GS_model->getKriteria3();

        $this->load->view('templates/header', $data);
        $this->load->view('home/result', $data);
        $this->load->view('templates/footer');
        $sesidetail = $this->session->set_userdata($data);
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
