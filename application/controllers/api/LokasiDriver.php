<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';

    class LokasiDriver extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('LokasiDriver_model', 'mhs');
        }

        // Get Data
        public function index_get() {
            $id = $this->get('id');
            // jika id tidak ada (tidak panggil)
            if($id === null) {
                // maka panggil semua data
                $mahasiswa = $this->mhs->getLokasiDriver();

                // tapi jika id di panggil maka hanya id tersebut yang akan muncul pada data tersebut
            } else {
                $mahasiswa = $this->mhs->getLokasiDriver($id);

            }

            if($mahasiswa) {
                $this->response([
                    'placeName' => 'JAGAD Creative',
                    'label' => 'JAGAD Creative',
                    'keterangan' => 'JAGAD Creative',
                    'LatLng' => $mahasiswa,
                    'type' => 'truck',
                    'status' => true,
                    'data' => $mahasiswa
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

            }

        }

        // delete data
        public function index_delete() {
            $id = $this->delete('id');
            if($id === null) {
                $this->response([
                    'status' => false,
                    'message' => 'provide an id'
                ], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                if($this->mhs->deleteLokasiDriver($id) > 0) {
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
        public function index_post() {
            $data = [
                'lat' => $this->post('lat'),
                'long' => $this->post('long'),
                'keterangan' => $this->post('keterangan'),
                'driver_id' => $this->post('driver_id'),
                'timestemp' => $this->post('timestemp')
            ];

            if ($this->mhs->createLokasiDriver($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'new mahasiswa has been created'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed create data'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        // update data
        public function index_put() {
            $id = $this->put('id');
            $data = [
                'nrp' => $this->put('nrp'),
                'nama' => $this->put('nama'),
                'email' => $this->put('email'),
                'jurusan' => $this->put('jurusan')
            ];


            if ($this->mhs->updateLokasiDriver($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'update mahasiswa has been updated'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed to update data'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

?>
