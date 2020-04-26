<?php

class GS_model extends CI_model
{

    public function getAllGs()
    {
        return $this->db->get('gs_info')->result_array();
    }

    public function getHasilmetodegs()
    {
        $this->db->order_by('hasilV', 'DESC');
        return $this->db->get('vhasil_gs')->result_array();
    }
    public function getFUllGs()
    {

        return $this->db->get('vfull_detailgs')->result_array();
    }

    public function getGsById($id)
    {
        return $this->db->get_where('gs_info', ['id_gs' => $id])->row_array();
    }

    public function getJenispertunjukan()
    {
        return $this->db->get('jenispertunjukan')->result_array();
    }
    public function getLokasi()
    {
        return $this->db->get('lokasi')->result_array();
    }
    public function getHarga()
    {
        return $this->db->get('harga')->result_array();
    }
    public function getKriteria1()
    {
        return $this->db->get('filter_kriteria1')->result_array();
    }
    public function getKriteria2()
    {
        return $this->db->get('filter_kriteria2')->result_array();
    }
    public function getKriteria3()
    {
        return $this->db->get('filter_kriteria3')->result_array();
    }

    // mengambil Genre semua gs
    public function JenisGs()
    {
        $this->db->select('genre_gs');
        $this->db->from('gs_info');
        $queryku = $this->db->get();
    }
}
