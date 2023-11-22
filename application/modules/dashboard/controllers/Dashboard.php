<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_validate();
        check_not_login();
        $this->load->model(['Maintenance_m']);
        $name = $this->session->userdata('name');
        $this->db->set('activity', date("Y-m-d H:i:s"));
        $this->db->where('name', $name);
        $this->db->update('user');
    }

	public function index()
	{
        $this->load->model('Maintenance_m');
        $maintenance = $this->Maintenance_m->maintenance();
        if($maintenance != true){
            $data = [
                'title'         => 'Dashboard',
                'description'   => '',
                'content'       => 'dashboard/dashboard' //user adalah nama module, user_data nama file di view yang akan di load
            ];
            $this->load->module('template');
            $this->template->index($data);
        }else{
            $this->load->view('maintenance');
        }
	}

    public function cek_nik_pbi()
    {
        $get_nik_laporan = $this->db->get_where('laporan', array('nik' => $this->input->post('nik_pbi')))->row_array();
        $get_nik_apbn = $this->db->get_where('apbn', array('nik' => $this->input->post('nik_pbi')))->row_array();
        if(isset($get_nik_apbn['nik']) != $this->input->post('nik_pbi')){
            if(isset($get_nik_laporan['nik']) != $this->input->post('nik_pbi')){
                $nik ['cek_nik'] = $this->input->post('nik_pbi');
                $this->session->set_userdata($nik);
                redirect('kuesioner');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>NIK ANDA SUDAH DIUSULKAN DI DINAS SOSIAL</div>');
            redirect('dashboard');
        }
    }

    public function cek_nik_ppks()
    {
    }
}
