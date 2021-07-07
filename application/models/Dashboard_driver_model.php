<?php
class Dashboard_driver_model extends CI_model
{
    public function getDashboard_driver($id = null)
    {
        if ($id === null) {
            return $this->db->get('v_dashboard_mobile_driver')->result_array();
        } else {
            return $this->db->get_where('v_dashboard_mobile_driver', ['id_driver' => $id])->result_array();
        }
    }

    public function deleteDashboard_driver($id)
    {
        $this->db->delete('v_dashboard_mobile_driver', ['id_driver' => $id]);
        return $this->db->affected_rows();
    }

    public function createDashboard_driver($data)
    {
        $this->db->insert('v_dashboard_mobile_driver', $data);
        return $this->db->affected_rows();
    }

    public function updateDashboard_driver($data, $id)
    {
        $this->db->update('v_dashboard_mobile_driver', $data, ['id_driver' => $id]);
        return $this->db->affected_rows();
    }
}
