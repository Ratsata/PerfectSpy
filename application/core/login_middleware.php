<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

Class Login_middleware extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
        $cookie_login = get_cookie("cookie_login");
        if($cookie_login!=null){
            delete_cookie('cookie_login');
            set_cookie("cookie_login",$cookie_login,3600*24*365,"localhost","/");
        }else{
            if(!$this->session->has_userdata('logged_in')){
                redirect('index.php');
            }
        }
    }

}

?>