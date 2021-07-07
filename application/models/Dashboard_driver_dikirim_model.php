<?php
class Dashboard_driver_dikirim_model extends CI_model
{
    public function getDashboard_driver_dikirim($id = null)
    {
        if ($id === null) {
            return $this->db->get('v_mobile_driver_dikirim')->result_array();
        } else {
            return $this->db->get_where('v_mobile_driver_dikirim', ['id_driver' => $id])->result_array();
        }
    }

    public function deleteDashboard_driver_dikirim($id)
    {
        $this->db->delete('v_mobile_driver_dikirim', ['id_driver' => $id]);
        return $this->db->affected_rows();
    }

    public function createDashboard_driver_dikirim($data)
    {
        $this->db->insert('v_mobile_driver_dikirim', $data);
        return $this->db->affected_rows();
    }

    public function updateDashboard_driver_dikirim($data, $id)
    {
        $this->db->update('v_mobile_driver_dikirim', $data, ['id_driver' => $id]);
        return $this->db->affected_rows();
    }
}
