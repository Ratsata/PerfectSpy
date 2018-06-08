<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function screen_update()
    {
        $data['status'] = false;
        $new_img = $this->input->post('image');
        if ($new_img) {
            $img_path = FCPATH . TX_LED_DATA_PATH . '/current/current.jpg';
            $imgbmp_path = FCPATH . TX_LED_DATA_PATH . '/current/current.bmp';
            $saved = $this->base64_to_jpeg($new_img, $img_path);

            if ($saved) {
                $bmp = imagecreatefromjpeg($img_path);
                $this->imagebmp($bmp, $imgbmp_path);
                $uploaded = $this->transfer_image_to_screen($imgbmp_path);

                if ($uploaded) {
                    $data['status'] = true;
                }
            }
        }

        echo json_encode($data);
    }

    private function imagebmp(&$im, $filename = "")
    {
        if (!$im) return false;
        $w = imagesx($im);
        $h = imagesy($im);
        $result = '';

        if (!imageistruecolor($im)) {
            $tmp = imagecreatetruecolor($w, $h);
            imagecopy($tmp, $im, 0, 0, 0, 0, $w, $h);
            imagedestroy($im);
            $im = & $tmp;
        }

        $biBPLine = $w * 3;
        $biStride = ($biBPLine + 3) & ~3;
        $biSizeImage = $biStride * $h;
        $bfOffBits = 54;
        $bfSize = $bfOffBits + $biSizeImage;

        $result .= substr('BM', 0, 2);
        $result .=  pack ('VvvV', $bfSize, 0, 0, $bfOffBits);
        $result .= pack ('VVVvvVVVVVV', 40, $w, $h, 1, 24, 0, $biSizeImage, 0, 0, 0, 0);

        $numpad = $biStride - $biBPLine;
        for ($y = $h - 1; $y >= 0; --$y) {
            for ($x = 0; $x < $w; ++$x) {
                $col = imagecolorat ($im, $x, $y);
                $result .=  substr(pack ('V', $col), 0, 3);
            }
            for ($i = 0; $i < $numpad; ++$i)
                $result .= pack ('C', 0);
        }

        if($filename==""){
            echo $result;
        }
        else
        {
            $file = fopen($filename, "wb");
            fwrite($file, $result);
            fclose($file);
        }
        return true;
    }

  

    private function transfer_image_to_screen($img_path)
    {
        $this->load->library('ftp');
        $config['hostname'] = TX_SCREEN_FTP_IP;
        $config['username'] = TX_SCREEN_FTP_USERNAME;
        $config['password'] = TX_SCREEN_FTP_PASSWORD;
        
        $this->ftp->connect($config);
            $result = $this->ftp->upload($img_path, TX_UBICACION_PROYECTO, 'auto', 0664);
        $this->ftp->close();

        return $result;
    }

    private function base64_to_jpeg($base64_string, $output_file)
    {

        if (is_writeable($output_file)) {
            $ifp = fopen($output_file, 'wb');

            $data = explode(',', $base64_string);
            fwrite($ifp, base64_decode($data[1]));
            fclose($ifp);

            return true;
        }
        return false;
    }
}
