<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/login_middleware.php';

class Config extends Login_middleware
{
    
    public function index()
    {
        $config = file_get_contents('assets/data.json');
        $config = json_decode($config);
        $data = [];
        $data['config'] = $config;

        $data['activoIndex'] = 2;

        $this->load->view('header');
        $this->load->view('config/headerScript');
        $this->load->view('config/index', $data);
        $this->load->view('main-menu');
        $this->load->view('config/totem_new');
        $this->load->view('config/footer');
        $config = array(
            'id' => "",
            'nombre' => "",
            'camara' => array(
                'ip' => "",
                'estado' => 0
            ),
            'pantalla' => array(
                'ip' => "",
                'estado' => 0
            ),
            'citofono' => array(
                'ip' => "",
                'estado' => 0
            )
        );
        $this->load->view('config/totem_update',$config);
    }

    public function listar(){
        $id = $this->input->post('id');
        $x = null;

        $config = file_get_contents('assets/data.json');
        $config = json_decode($config, true);
        
        foreach ($config as $key=>$value) {
            if ($value['id'] == $id){
                $x = $key;
                break;
            }
        }
        
        echo json_encode($config[$x]);
        
    }

    public function nuevo() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre', 'Username', 'required|max_length[20]');
        if ($this->form_validation->run() == FALSE){
            echo json_encode("NOK");
        }else{
            $ip_camara = $this->input->post('ip-camara');
            $ip_pantalla = $this->input->post('ip-pantalla');
            $ip_citofono = $this->input->post('ip-citofono');

            $estado_camara = ($ip_camara != '' ? 1 : 0);
            $estado_pantalla = ($ip_pantalla != '' ? 1 : 0);
            $estado_citofono = ($ip_citofono != '' ? 1 : 0);
            
            $data = file_get_contents('assets/data.json');
            $config = json_decode($data, true);
            $id = 0;
            foreach ($config as $key) {
                $id = ($key['id'] > $id ? $key['id'] : $id);
            }
            $data = array(
                'id' => $id+1,
                'nombre' => $this->input->post('nombre'),
                'camara' => array(
                    'ip' => $ip_camara,
                    'estado' => $estado_camara
                ),
                'pantalla' => array(
                    'ip' => $ip_pantalla,
                    'estado' => $estado_pantalla
                ),
                'citofono' => array(
                    'ip' => $ip_citofono,
                    'estado' => $estado_citofono
                )
            );
            
            array_push($config, $data);
            $fp = fopen('assets/data.json', 'w');
                fwrite($fp, json_encode($config));
            fclose($fp);

            echo json_encode($config);
        }
    }

    public function modificar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('nombre', 'Username', 'required|max_length[20]');
        if ($this->form_validation->run() == FALSE){
            echo json_encode("NOK");
        }else{
            $id = $this->input->post('id');
            $ip_camara = $this->input->post('Uip-camara');
            $ip_pantalla = $this->input->post('Uip-pantalla');
            $ip_citofono = $this->input->post('Uip-citofono');

            $estado_camara = ($ip_camara != '' ? 1 : 0);
            $estado_pantalla = ($ip_pantalla != '' ? 1 : 0);
            $estado_citofono = ($ip_citofono != '' ? 1 : 0);

            $upd = array(
                'id' => $id,
                'nombre' => $this->input->post('nombre'),
                'camara' => array(
                    'ip' => $ip_camara,
                    'estado' => $estado_camara
                ),
                'pantalla' => array(
                    'ip' => $ip_pantalla,
                    'estado' => $estado_pantalla
                ),
                'citofono' => array(
                    'ip' => $ip_citofono,
                    'estado' => $estado_citofono
                )
            );
            
            $data = file_get_contents('assets/data.json');
            $config = json_decode($data, true);
            
            foreach ($config as $key => $value) {
                if ($value['id'] == $id) {
                    $config[$key] = $upd;
                    break;
                }
            }

            $fp = fopen('assets/data.json', 'w');
                fwrite($fp, json_encode($config));
            fclose($fp);

            echo json_encode($config);
        }
    }

    public function eliminar() {
        $id = $this->input->post('id');
        
        $data = file_get_contents('assets/data.json');
        $config = json_decode($data, true);

        foreach ($config as $key=>$value) {
            if ($value['id'] == $id){
                unset($config[$key]);
                break;
            }
        }
        
        $fp = fopen('assets/data.json', 'w');
            fwrite($fp, json_encode($config));
        fclose($fp);

        echo json_encode($config);
    }
}