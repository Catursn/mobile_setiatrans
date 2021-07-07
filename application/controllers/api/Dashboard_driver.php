<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';

    class Dashboard_driver extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Dashboard_driver_model', 'mhs');

        }

        // Get Data
        public function index_get() {
            $id = $this->get('id_driver');
            // jika id tidak ada (tidak panggil)
            if($id === null) {
                // maka panggil semua data
                $Spb = $this->mhs->getDashboard_driver();
                // tapi jika id di panggil maka hanya id tersebut yang akan muncul pada data tersebut
            } else {
                $Spb = $this->mhs->getDashboard_driver($id);

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






    }

?>
