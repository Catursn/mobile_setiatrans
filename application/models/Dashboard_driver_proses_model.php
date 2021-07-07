<?php
class Dashboard_driver_proses_model extends CI_model
{
    public function getDashboard_driver_proses($id = null)
    {
        if ($id === null) {
            return $this->db->get('v_mobile_driver_proses')->result_array();
        } else {
            return $this->db->get_where('v_mobile_driver_proses', ['id_driver' => $id])->result_array();
        }
    }

    public function deleteDashboard_driver_proses($id)
    {
        $this->db->delete('v_mobile_driver_proses', ['id_driver' => $id]);
        return $this->db->affected_rows();
    }

    public function createDashboard_driver_proses($data)
    {
        $this->db->insert('v_mobile_driver_proses', $data);
        return $this->db->affected_rows();
    }

    public function updateDashboard_driver_proses($data, $id)
    {
        $this->db->update('v_mobile_driver_proses', $data, ['id_driver' => $id]);
        return $this->db->affected_rows();
    }
}
