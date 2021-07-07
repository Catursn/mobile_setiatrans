<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Upload extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Amplop_model', 'mhs');
    }

    // Get Data
    public function index_get()
    {
        $id = $this->get('id_amplop');
        // jika id tidak ada (tidak panggil)
        if ($id === null) {
            // maka panggil semua data
            $Amplop = $this->mhs->getAmplop();
            // tapi jika id di panggil maka hanya id tersebut yang akan muncul pada data tersebut
        } else {
            $Amplop = $this->mhs->getAmplop($id);
        }

        if ($Amplop) {
            $this->response([
                'status' => true,
                'data' => $Amplop
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

        }
    }

    // delete data
    public function index_delete()
    {
        $id = $this->delete('id_amplop');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mhs->deleteAmplop($id) > 0) {
                // Ok
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted success'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                // id not found
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

            }
        }
    }

    // post data
    public function index_post()
    {
      $response = array();
      $uploaddir = '/var/www/uploads/';
      $uploadfile = $uploaddir . basename($_FILES['mobile_driver_diterima_foto']['name']);
      $uploadfile1 = $uploaddir . basename($_FILES['mobile_driver_diterima_ttd']['name']);

      foreach($_FILES as $key => $file){
      	if(is_array($_FILES[$key]["name"])){
      		foreach($_FILES[$key]["name"] as $_key => $value) {
      			$fileName = time().rand(0,99999).".".pathinfo($_FILES[$key]["name"][$_key], PATHINFO_EXTENSION);
      			if(move_uploaded_file($_FILES[$key]['tmp_name'][$_key], "gambar/".$fileName)){
      				$response['data'][] = $fileName;
      			}
      		}
      	}
      	else {
      		$fileName = time().rand(0,99999).".".pathinfo($_FILES['mobile_driver_diterima_foto']["name"], PATHINFO_EXTENSION);
          $fileName1 = time().rand(0,99999).".".pathinfo($_FILES['mobile_driver_diterima_ttd']["name"], PATHINFO_EXTENSION);

      		if(move_uploaded_file($_FILES['mobile_driver_diterima_foto']['tmp_name'], "gambar/".$fileName) & move_uploaded_file($_FILES['mobile_driver_diterima_ttd']['tmp_name'], "gambar/".$fileName1)){
      			$response['data'][] = $fileName;
            $response['data'][] = $fileName1;

            $id = $this->post('id_amplop');
            $data = [
              'mobile_driver_diterima_nama' => $this->post('mobile_driver_diterima_nama'),
              'mobile_driver_diterima_ttd' => ($fileName1),
              'mobile_driver_diterima_jenis_penerima' => $this->post('mobile_driver_diterima_jenis_penerima'),
              'mobile_driver_pengantar' => $this->post('mobile_driver_pengantar'),
              'mobile_driver_diterima_foto' => ($fileName),
              'status' => 3
            ];
            $this->mhs->updateAmplop($data, $id);

      		}
      	}
      }
      if(!empty($response['data'])){
      	$response['data'] = implode(',',$response['data']);
      }
      if(!empty($response)){
      	$response['status'] = 1;
      	echo json_encode($response);
      	exit();
      }else {
      	$response['data'] = "No Image upload.";
      	$response['status'] = 0;
      	echo json_encode($response);
      	exit();
      }
      exit();

    }

    // update data
    public function index_put()
    {
        $id = $this->put('id_amplop');
        $response = array();
        foreach($_FILES as $key => $file){

        	if(is_array($_FILES[$key]["name"])){
        		foreach($_FILES[$key]["name"] as $_key => $value) {
        			$fileName = time().rand(0,99999).".".pathinfo($_FILES[$key]["name"][$_key], PATHINFO_EXTENSION);
        			if(move_uploaded_file($_FILES[$key]['tmp_name'][$_key], "gambar/".$fileName)){
        				$response['data'][] = $fileName;
        			}
        		}
        	}
        	else {
        		$fileName = time().rand(0,99999).".".pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION);
        		if(move_uploaded_file($_FILES[$key]['tmp_name'], "gambar/".$fileName)){
        			$response['data'][] = $fileName;
        		}
        	}
        }
        if(!empty($response['data'])){
        	$response['data'] = implode(',',$response['data']);
        }
        if(!empty($response)){
        	$response['status'] = 1;
        	echo json_encode($response);
        	exit();
        }else {
        	$response['data'] = "No Image upload.";
        	$response['status'] = 0;
        	echo json_encode($response);
        	exit();
        }
        exit();
        $data = [


            'mobile_driver_diterima_foto' => ($this->put('mobile_driver_diterima_foto'))
        ];


        if ($this->mhs->updateAmplop($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'update Amplop has been updated'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
