<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index($data = NULL)
	{
        $this->load->view('template', $data);
	}

}
