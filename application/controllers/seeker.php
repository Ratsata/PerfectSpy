<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeker extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->model('model_app');
    }
    
    public function index()
    {
        $config = $this->model_app->readJson(FILE_DATA);
        $data = [];
        
        foreach ($config as $key=>$value) {
            $onlineCamara = "nok";
            $onlinePantalla = "nok";
            $onlineCitofono = "nok";
            
            $id = $value['id'];
            $nombre = $value['nombre'];
            $ipCamara = $value['camara']['ip'];
            if ($ipCamara == ""){
                $onlineCamara = "none";
            }else if($this->pingAddress($ipCamara)){
                $onlineCamara = "ok";
            }
            
            $ipPantalla = $value['pantalla']['ip'];
            if ($ipPantalla == ""){
                $onlinePantalla = "none";
            }else if($this->pingAddress($ipPantalla)){
                $onlinePantalla = "ok";
            }
            
            $ipCitofono = $value['citofono']['ip'];
            if ($ipCitofono == ""){
                $onlineCitofono = "none";
            }else if($this->pingAddress($ipCitofono)){
                $onlineCitofono = "ok";
            }
            
            if ($onlineCamara=="none" && $onlineCamara=="none" && $onlineCamara=="none"){
                $onlineTotem = 0; 
            }else if (($onlineCamara=="ok" || $onlineCamara=="none") && ($onlinePantalla=="ok" || $onlinePantalla=="none") && ($onlineCitofono=="ok" || $onlineCitofono=="none")){
                $onlineTotem = 2; 
            }else if($onlineCamara=="ok" || $onlinePantalla=="ok" || $onlineCitofono=="ok"){
                $onlineTotem = 1;
            }else{
                $onlineTotem = 0;
            }
            
            array_push($data,array("id"=>$id,"nombre"=>$nombre,"onlineCamara"=>$onlineCamara,"ipCamara"=>$ipCamara,"onlinePantalla"=>$onlinePantalla,"ipPantalla"=>$ipPantalla,"onlineCitofono"=>$onlineCitofono,"ipCitofono"=>$ipCitofono,"onlineTotem"=>$onlineTotem));
        }
        echo json_encode($data);
    }

    public function ping($host, $port, $timeout)
    {
        $tB = microtime(true);
        $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
        if (!$fP) { return -1; } 
        $tA = microtime(true); 
        return round((($tA - $tB) * 1000), 0); 
    }

    public function pingAddress($ip){
        $pingresult = shell_exec("start /b ping $ip -n 1");
        $data   = 'inaccesible.';
        $inaccesible = strpos($pingresult, $data);
        if ($inaccesible != false){
            return false;
        } else {
            return true;
        }
    }
}