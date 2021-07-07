<?php
class Spb_model extends CI_model
{
    public function getSpb($id = null)
    {
        if ($id === null) {
            //return $this->db->get('v_spb')->result_array();
            return $this->db->get_where('v_spb', ['status' => 2])->result_array();
        } else {
            return $this->db->get_where('v_spb', ['jenis' => $id])->result_array();
        }
    }

    public function deleteKota($id)
    {
        $this->db->delete('ref_kota', ['id_kota' => $id]);
        return $this->db->affected_rows();
    }

    public function createKota($data)
    {
        $this->db->insert('ref_kota', $data);
        return $this->db->affected_rows();
    }

    public function updateKota($data, $id)
    {
        $this->db->update('ref_kota', $data, ['id_kota' => $id]);
        return $this->db->affected_rows();
    }
}
