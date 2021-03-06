<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
require_once APPPATH . 'core/login_middleware.php';

class Dashboard extends Login_middleware
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    /*public function __construct() {
        parent::__construct();
        $this->load->library('session');
        echo json_encode($this->session->userdata['logged_in']);
        if(!isset($this->session->userdata['logged_in'])){
            $this->load->view('login');
        }
    }*/
    public function __construct() {
        parent::__construct();
        $this->load->model('model_app');
    }

    public function index($id="x")
    {
        if ($id != "x"){
            $data['id'] = $id;
        }
        $this->load->helper('file');
        $led_icons = get_filenames(FCPATH . TX_LED_DATA_PATH.'/icons');

        $data['led'] = [];
        $led_data = array(
            'current' => TX_LED_DATA_PATH . '/current/current.jpg',
            'width' => 214,
            'height' => 134,
            'path' => TX_LED_DATA_PATH . '/icons',
            'icons' => $led_icons
        );

        $data['led'] = $led_data;
        $json = $this->model_app->readJson(FILE_DATA);
        $data['activoIndex'] = 1;

        $data['json'] = $json;
        $this->load->view('header');
        $this->load->view('dashboard/headerScript', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('main-menu', $data);
        $this->load->view('dashboard/modals', $data);
        $this->load->view('dashboard/footer');
    }
}