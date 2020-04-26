<?php

class Dashboard_model extends CI_model
{

    public function getAllTawaran()
    {

        return $this->db->get('gs_info')->result_array();
    }

    public function getTawaranById($id)
    {
        return $this->db->get_where('transaksi', ['id_gs' => $id])->result_array();
    }

    public function getRequest($id_req)
    {
        return $this->db->get_where('transaksi', ['id_trx' => $id_req])->row_array();
    }
}
