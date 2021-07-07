<?php
class Dashboard_driver_sukses_model extends CI_model
{
    public function getDashboard_driver_sukses($id = null)
    {
        if ($id === null) {
            return $this->db->get('v_mobile_driver_sukses')->result_array();
        } else {
            return $this->db->get_where('v_mobile_driver_sukses', ['id_driver' => $id])->result_array();
        }
    }

    public function deleteDashboard_driver_sukses($id)
    {
        $this->db->delete('v_mobile_driver_sukses', ['id_driver' => $id]);
        return $this->db->affected_rows();
    }

    public function createDashboard_driver_sukses($data)
    {
        $this->db->insert('v_mobile_driver_sukses', $data);
        return $this->db->affected_rows();
    }

    public function updateDashboard_driver_sukses($data, $id)
    {
        $this->db->update('v_mobile_driver_sukses', $data, ['id_driver' => $id]);
        return $this->db->affected_rows();
    }
}
