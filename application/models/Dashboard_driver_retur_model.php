<?php
class Dashboard_driver_retur_model extends CI_model
{
    public function getDashboard_driver_retur($id = null)
    {
        if ($id === null) {
            return $this->db->get('v_mobile_driver_retur')->result_array();
        } else {
            return $this->db->get_where('v_mobile_driver_retur', ['id_driver' => $id])->result_array();
        }
    }

    public function deleteDashboard_driver_retur($id)
    {
        $this->db->delete('v_mobile_driver_retur', ['id_driver' => $id]);
        return $this->db->affected_rows();
    }

    public function createDashboard_driver_retur($data)
    {
        $this->db->insert('v_mobile_driver_retur', $data);
        return $this->db->affected_rows();
    }

    public function updateDashboard_driver_retur($data, $id)
    {
        $this->db->update('v_mobile_driver_retur', $data, ['id_driver' => $id]);
        return $this->db->affected_rows();
    }
}
