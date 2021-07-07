<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';

    class Spb extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Spb_model', 'mhs');
        }

        // Get Data
        public function index_get() {
            $id = $this->get('jenis');
            // jika id tidak ada (tidak panggil) 
            if($id === null) {
                // maka panggil semua data
                $Spb = $this->mhs->getSpb();
                // tapi jika id di panggil maka hanya id tersebut yang akan muncul pada data tersebut
            } else {
                $Spb = $this->mhs->getSpb($id);

            }

            if($Spb) {
                 //$this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                $this->response(
                    $Spb
                , REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
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
                if($this->mhs->deleteSpb($id) > 0) {
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
                'nrp' => $this->post('nrp'),
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'jurusan' => $this->post('jurusan')
            ];

            if ($this->mhs->createSpb($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'new Spb has been created'
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


            if ($this->mhs->updateSpb($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'update Spb has been updated'
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
