<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

Class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('model_app');
    }

    public function index() {
        $cookie_login = get_cookie("cookie_login");
        if($cookie_login!=null || $this->session->has_userdata('logged_in')){
            redirect('index.php/dashboard');
        }
        $this->load->view('header');
        $this->load->view('login');
    }
    
    public function login() {
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            if($this->session->has_userdata('logged_in')){
                redirect("index.php/dashboard");
            }else{
                $this->load->view('header');
                $this->load->view('login');
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
                if($this->input->post('remember')!=null){
                    set_cookie("cookie_login",$result['user'],3600*24*365,"localhost","/");
                }
                redirect("index.php/dashboard");
            } else {
                $data = array(
                    'error_message' => 'Error: Usuario o contraseña incorrecta'
                );
                $this->load->view('header');
                $this->load->view('login', $data);
            }
        }
    }

    public function logout() {
        if(get_cookie('cookie_login')!=null){
            delete_cookie('cookie_login');
        }
        $this->session->sess_destroy();
        redirect("index.php");
    }

    public function recover() {
        $this->load->view('header');
        $this->load->view('recover');
    }

    public function correo() {
        $this->load->library('email');

        $this->email->from('PerfectSpy@CleanVoltage.com', 'Perfect Spy');
        $this->email->to('sebastian.vega.saavedra@gmail.com');
        $this->email->subject('[PerfectSpy] Restablecer contraseña');
        $mensaje = "Se ha solicitado restablecer su contraseña\n"+
        "la contraseña por defecto es: 1234";
        $this->email->message($mensaje);
        $this->email->send();
    }

}

?>