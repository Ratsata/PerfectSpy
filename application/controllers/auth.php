<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

Class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('model_app');
    }

    public function index() {
        $this->load->view('login_form');
    }
    
    public function login() {
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            if($this->session->has_userdata('logged_in')){
                redirect("index.php/welcome");
            }else{
                $this->load->view('login_form');
            }
        } else {
            $data = array(
                'user' => $this->input->post('username'),
                'hash' => $this->input->post('password')
            );
            $result = $this->model_app->login($data);
            if ($result != false) {
                $session_data = array(
                    'username' => $result['user'],
                    'nombre' => $result['nombre'],
                    'email' => $result['email'],
                );
                $this->session->set_userdata('logged_in', $session_data);
                redirect("index.php/welcome");
            } else {
                $data = array(
                    'error_message' => 'Usuario o contraseña incorrecta'
                );
                $this->load->view('login_form', $data);
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect("index.php");
    }

}

?>