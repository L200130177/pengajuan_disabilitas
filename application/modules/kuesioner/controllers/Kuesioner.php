<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_validate();
        check_not_login();
        $this->load->model(['Maintenance_m','kuesioner/Kuesioner_m']);
        $name = $this->session->userdata('name');
        $this->db->set('activity', date("Y-m-d H:i:s"));
        $this->db->where('name', $name);
        $this->db->update('user');
    }

	public function index()
	{
        $maintenance = $this->Maintenance_m->maintenance();
        $nik = $this->session->userdata('cek_nik');
        if($maintenance != true){
            $get_nik = $this->db->get_where('kuesioner', array('nik' => $nik))->row_array();
            switch ($nik) {
                case (isset($get_nik['nik']) == $nik):
                    redirect('usulan');
                    break;
                case 0:
                    redirect('dashboard');
                    break;
                default:
                    $data = [
                    'title'         => 'Kuesioner',
                    'description'   => 'Formulir Kuesioner',
                    'nik'           => $nik,
                    'content'       => 'kuesioner/kuesioner'
                    ];
                    $this->load->module('template');
                    $this->template->index($data);
            }
        }else{
            $this->load->view('maintenance');
        }
	}

    public function submit()
    {
        $post = $this->input->post(null, TRUE);
        $this->Kuesioner_m->add($post);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil disimpan</div>');
            redirect('usulan');
        }
    }

    public function cek_nik_ppks()
    {

    }
}
