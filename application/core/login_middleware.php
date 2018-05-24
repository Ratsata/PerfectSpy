<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

Class Login_middleware extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if(!$this->session->has_userdata('logged_in')){
            redirect('index.php');
        }
    }

}

?>