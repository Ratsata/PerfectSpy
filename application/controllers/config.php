<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller
{
    
    public function index()
    {
        $config = file_get_contents('assets/data.json');
        $config = json_decode($config);
        $data = [];
        $data['config'] = $config;

        $this->load->view('config', $data);
        $this->load->view('totem_new');
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
        $this->load->view('totem_update',$config);
    }

    public function listar(){
        $id = $this->input->post('id');
        $i = 0;
        $x = null;

        $config = file_get_contents('assets/data.json');
        $config = json_decode($config, true);
        
        foreach ($config as $key) {
            if ($key['id'] == $id){
                $x = $i;
            }
            $i++;
        }
        
        echo json_encode($config[$x]);
        
    }

    public function nuevo() {
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

    public function modificar() {
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
            }
        }

        $fp = fopen('assets/data.json', 'w');
            fwrite($fp, json_encode($config));
        fclose($fp);

        echo json_encode($config);
    }

    public function eliminar() {
        $id = $this->input->post('id');
        
        $data = file_get_contents('assets/data.json');
        $config = json_decode($data, true);
        $i = 0;
        foreach ($config as $key) {
            if ($key['id'] == $id){
                unset($config[$i]);
            }
            $i++;
        }
        
        $fp = fopen('assets/data.json', 'w');
            fwrite($fp, json_encode($config));
        fclose($fp);

        echo json_encode($config);
    }
}