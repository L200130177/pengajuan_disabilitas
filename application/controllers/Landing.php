<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index($data = NULL)
	{
        $this->load->view('landing');
	}

}
