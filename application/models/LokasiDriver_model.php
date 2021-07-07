<?php
    class LokasiDriver_model extends CI_model {
        public function getLokasiDriver($id = null) {
            if($id === null) {
                return $this->db->get('v_lokasi')->result_array();
            } else {
                return $this->db->get_where('v_lokasi', ['id' => $id])->result_array();

            }
        }

        public function deleteLokasiDriver($id) {
            $this->db->delete('lokasi_driver', ['id' => $id]);
            return $this->db->affected_rows();
        }

        public function createLokasiDriver($data) {
            $this->db->insert('lokasi_driver', $data);
            return $this->db->affected_rows();
        }

        public function updateLokasiDriver($data, $id) {
            $this->db->update('lokasi_driver', $data, ['id' => $id]);
            return $this->db->affected_rows();
        }
    }
?>