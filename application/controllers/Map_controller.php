<?php
   class Map_controller extends CI_Controller {

      function __construct() {
         parent::__construct();
         $this->load->helper('url');
         $this->load->database();
      }

      public function index() {
         $this->load->helper('url');
         $this->load->view('Map_view');
      }
   }
?>
