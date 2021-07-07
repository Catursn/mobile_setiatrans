<?php
class Login_driver_model extends CI_model
{
  public function __construct() {
        parent::__construct();

        // Load the database library
        $this->load->database();

        $this->userTbl = 'v_driver';
    }
    public function getLogin_driver($id = null)
    {
        if ($id === null) {
            return $this->db->get('v_driver')->result_array();
        } else {
            return $this->db->get_where('v_driver', ['id_driver' => $id])->result_array();
        }
    }

    public function deleteLogin_driver($id)
    {
        $this->db->delete('v_driver', ['id_driver' => $id]);
        return $this->db->affected_rows();
    }

    public function createLogin_driver($data)
    {
        $this->db->insert('v_driver', $data);
        return $this->db->affected_rows();
    }

    public function updateLogin_driver($data, $id)
    {
        $this->db->update('v_driver', $data, ['id_driver' => $id]);
        return $this->db->affected_rows();
    }
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->userTbl);

        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }

        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }

            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }

        //return fetched data
        return $result;
    }
}
