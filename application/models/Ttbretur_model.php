<?php
class Ttbretur_model extends CI_model
{
    public function getAmplop($id = null)
    {
        if ($id === null) {
            return $this->db->get('transaksi_ttb')->result_array();
        } else {
            return $this->db->get_where('transaksi_ttb', ['id_amplop' => $id])->result_array();
        }
    }

    public function deleteAmplop($id)
    {
        $this->db->delete('transaksi_ttb', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createAmplop($data)
    {
        $this->db->insert('transaksi_ttb', $data);
        return $this->db->affected_rows();
    }

    public function updateAmplop($data, $id)
    {
        $this->db->update('transaksi_ttb', $data, ['id_amplop' => $id]);
        return $this->db->affected_rows();
    }
}
