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
        $this->load->model('Model_app');
        
        if(!file_exists(FILE_DATA)){
            $data = [];
            $this->Model_app->writeJson(FILE_DATA,$data);
        }
        if(!file_exists(FILE_USER)){
            $data = array("nombre"=>"Administrador","email"=>"","user"=>DEFAULT_USER,"hash"=>DEFAULT_HASH);
            $this->Model_app->writeJson(FILE_USER,$data);
        }
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
            $result = $this->Model_app->login($data);
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
        
        /* $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sebastian.vega.saavedra@gmail.com', // change it to yours
            'smtp_pass' => '123sebaa',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        ); */
        /* $this->load->library('email');
        $this->email->from('PerfectSpy@CleanVoltage.com', 'Perfect Spy');
        $this->email->to('sebastian.vega.saavedra@gmail.com');
        $this->email->subject('PerfectSpy Restablecer contraseña');
        $this->email->message('Se ha solicitado restablecer');
        $r = $this->email->send();
        if(!$r)echo $this->email->print_debugger(); */

		/* $mensaje = "Mensaje";
		$asunto = "Perfect Spy";
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: PerfectSpy <perfectspy@cleanvoltage.com>' . "\r\n";
		$bool = mail("sebastian.vega.saavedra@gmail.com", $asunto, $mensaje,$cabeceras);
		echo $bool; */
        
        
        /* $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sebastian.vega.saavedra@gmail.com',
            'smtp_pass' => '123sebaa',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE  
     
          );
          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");   */
        /* $this->load->library('email');
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_user'] = 'sebastian.vega.saavedra@gmail.com';
        $config['smtp_pass'] = '123sebaa';
        $config['smtp_port'] = 465;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n"); */

       /*  $this->email->from('PerfectSpy@CleanVoltage.com', 'Perfect Spy');
        $this->email->to('sebastian.vega.saavedra@gmail.com');
        $this->email->subject('PerfectSpy Restablecer contraseña');
        $this->email->message('Se ha solicitado restablecer');
        $r = $this->email->send();
        if(!$r)echo $this->email->print_debugger(); */
        /* $from_email = "sebastian.vega.saavedra@gmail.com";
        $to_email = "sebastian.vega.saavedra@gmail.com";
        $this->load->library('email');
        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');
        //Send mail
        if($this->email->send()){
            echo "ok";
        }else{
            echo $this->email->print_debugger();
        } */
        /* if($this->Model_app->writeJson(FILE_DATA,$config)){
            echo json_encode($config);
        }else{
            echo "NOK";
        } */
        $correo = $this->Model_app->readJson(FILE_USER,false);
        $correo = json_encode($correo);
        print_r ($correo);
        print ($correo);
        printf($correo);
        echo($correo);
    }

}

?>