<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ttbsukses extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ttbretur_model', 'mhs');
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
        $data = [
            'tanggal' => $this->post('tanggal'),
            'id_pelanggan' => $this->post('id_pelanggan'),
            'id_pool' => $this->post('id_pool'),
            'berat_amplop' => $this->post('berat_amplop'),
            'jenis_kirim' => $this->post('jenis_kirim'),
            'jenis_bayar' => $this->post('jenis_bayar'),
            'id_tarif' => $this->post('id_tarif'),
            'ongkos_kirim' => $this->post('ongkos_kirim'),
            'ongkos_bongkar' => $this->post('ongkos_bongkar'),
            'diskon' => $this->post('diskon'),
            'ongkos_bersih' => $this->post('ongkos_bersih'),
            'bayar_amplop' => $this->post('bayar_amplop'),
            'kembalian_amplop' => $this->post('kembalian_amplop'),
            'keterangan' => $this->post('keterangan'),
            'photo' => $this->post('photo'),
            'satuan' => $this->post('satuan'),
            'nama_pengirim' => $this->post('nama_pengirim'),
            'alamat_pengirim' => $this->post('alamat_pengirim'),
            'hp_pengirim' => $this->post('hp_pengirim'),
            'nama_penerima' => $this->post('nama_penerima'),
            'alamat_penerima' => $this->post('alamat_penerima'),
            'status' => $this->post('status'),
            'tarif' => $this->post('tarif'),
            'provinsi' => $this->post('provinsi'),
            'kota' => $this->post('kota'),
            'kecamatan' => $this->post('kecamatan')

        ];

        if ($this->mhs->createAmplop($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new Amplop has been created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed create data'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // update data
    public function index_put()
    {
      $id = $this->put('id_amplop');
      $data = [
          'mobile_driver_diterima_nama' => $this->put('mobile_driver_diterima_nama'),
          'mobile_driver_diterima_jenis_penerima' => $this->put('mobile_driver_diterima_jenis_penerima'),
          'mobile_driver_pengantar' => $this->put('mobile_driver_pengantar'),
          'status' => 3
      ];
      $data_history['id_amplop'] = $id;
      $data_history['tanggal'] = date("Y-m-d");
      $data_history['waktu'] = date("H:i:s");
      $data_history['location'] = 'Diterima Oleh Penerima';
      $data_history['status'] = '3';


        if ($this->mhs->updateAmplop($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'update status amplop'
            ], REST_Controller::HTTP_OK);
            $this->mhs->save_detail($data_history);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
