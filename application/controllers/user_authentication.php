<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

Class User_Authentication extends CI_Controller {

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

    public function user_registration_show() {
        $this->load->view('registration_form');
    }

    public function new_user_registration() {

        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('registration_form');
        } else {
            $data = array(
                'user_name' => $this->input->post('username'),
                'user_email' => $this->input->post('email_value'),
                'user_password' => $this->input->post('password')
            );
            $result = $this->login_database->registration_insert($data);
            if ($result == TRUE) {
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('login_form', $data);
            } else {
                $data['message_display'] = 'Username already exist!';
                $this->load->view('registration_form', $data);
            }
        }
    }
    
    public function user_login_process() {
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            if(isset($this->session->userdata['logged_in'])){
                $this->load->view('admin_page');
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
                $this->load->view('admin_page');
            } else {
                $data = array(
                    'error_message' => 'Usuario o contraseña incorrecta'
                );
                $this->load->view('login_form', $data);
            }
        }
    }

    public function logout() {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Logout satistactorio';
        $this->load->view('login_form', $data);
    }

}

?>