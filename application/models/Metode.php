<?php

class Metode extends CI_model
{
    public function getKriteria()
    {
        return $this->db->get('metode_kriteria')->result_array();
    }

    public function simpanKriteria($data)
    {
        return $this->db->insert_batch('metode_bobot', $data);
    }

    public function getIdCreteriaByName($creteriaName)
    {
        $this->db->select('id');
        $queryku = $this->db->get_where('metode_kriteria', array('nama_kriteria' => $creteriaName));
        return $queryku->result_array();
        // var_dump($queryku);
        // die;
    }

    public function getIdGuestarByName($guestarName)
    {

        $this->db->select('id_gs');
        $queryw = $this->db->get_where('vfull_detailgs', $guestarName);
        return $queryw->result_array();
    }

    public function wKriteria()
    {
        $this->db->select_sum('bobot');
        $query1 = $this->db->get('metode_kriteria');
        return $query1->result_array();
    }

    public function getBobotById($idbot)
    {
        $this->db->select('bobot');
        $queryku = $this->db->get_where('metode_bobot', array('id_bobot' => $idbot));
        return $queryku->result_array();
    }
    public function getAllBobotById($idbot)
    {
        return $this->db->get_where('metode_bobot', ['id_bobot' => $idbot])->result_array();
    }

    public function getBobot($idbot)
    {
        $this->db->select('bobot');
        $this->db->group_by("id_gs");
        $queryku = $this->db->get_where('metode_bobot', array('id_bobot' => $idbot));
        return $queryku->result_array();
    }

    public function nilaiSAll($idbot)
    {
        $this->db->select_sum('total_S');
        $queryku = $this->db->get_where('nilaisbyid', array('id_bobot' => $idbot));
        return $queryku->result_array();
    }

    public function getnilaiSById($idbot)
    {
        $this->db->select('*');
        $queryku = $this->db->get_where('nilaisbyid', array('id_bobot' => $idbot));
        return $queryku->result_array();
    }

    public function nilaiSById($idbot)
    {
        $query = $this->db->query("call view_nilaiSById('" . $idbot . "')");
        return $query->result();
    }
}
