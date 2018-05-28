<?php

Class Model_app extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('encryption');
    }

    public function login($data) {
        $json = $this->readJson(FILE_USER);
        if($data['user'] == $json['user'] && $data['hash'] == $json['hash']){
            return $json;
        }else{
            return false;
        }
    }

    public function readJson($file,$assoc=true){
        $data = file_get_contents($file);
        $dataDecrypt = $this->encryption->decrypt($data);
        return json_decode($dataDecrypt,$assoc);
    }

    public function writeJson($file,$data){
        $dataEncrypt = $this->encryption->encrypt(json_encode($data));
        $fp = fopen($file, 'w');
            fwrite($fp, $dataEncrypt);
        fclose($fp);
        return true;
    }

}
?>