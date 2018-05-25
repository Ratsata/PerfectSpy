<?php

Class Model_app extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('encryption');
    }

    public function registration_insert($data) {
        $condition = "user_name =" . "'" . $data['user_name'] . "'";
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->insert('user_login', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function login($data) {
        $json = file_get_contents('assets/user.json');
        $json = json_decode($json, true);
        if($data['user'] == $json['user'] && $data['hash'] == $json['hash']){
            return $json;
        }else{
            return false;
        }
    }

    public function encrypt(){
        $config = file_get_contents('assets/data.json');
        //$config = json_decode($config, true);
        $ciphertext = $this->encryption->encrypt($config);
        $data = $this->encryption->decrypt($ciphertext);
        echo $data;
        /* $data = $this->encrypt($config,"CleanVoltage");
        $data2 = json_decode($this->decrypt($data,"CleanVoltage"));
        echo json_encode($data2); */
        //echo $data;
    }

}
?>