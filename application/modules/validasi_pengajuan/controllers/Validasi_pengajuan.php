<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi_pengajuan extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        check_already_validate();
    }

	public function index()
	{
        $this->load->view('validasi_pengajuan');
	}

    public function validation_key()
    {
        $key = $this->input->post('validasi_key');
        if($key == getenv('VALIDATION')){
            $this->session->set_userdata('validation', 'active');
            redirect('auth_pengajuan');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>Kode validasi yang anda masukkan salah !</div>');
            redirect('validasi_pengajuan');
        }
    }

}
