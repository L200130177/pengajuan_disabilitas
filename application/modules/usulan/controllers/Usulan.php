<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usulan extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_validate();
        check_not_login();
        $this->load->model(['Maintenance_m','Kecdesa_m','kuesioner/Kuesioner_m']);
        $name = $this->session->userdata('name');
        $this->db->set('activity', date("Y-m-d H:i:s"));
        $this->db->where('name', $name);
        $this->db->update('user');
    }

	public function index()
	{
        $maintenance = $this->Maintenance_m->maintenance();
        $kecamatan = $this->Kecdesa_m->get_kecamatan()->result();
        if($maintenance != true){
            $nik = $this->session->userdata('cek_nik');
            if($nik != null){
                $total['total'] = $this->Kuesioner_m->tampil_kuesioner($nik)->result();
                foreach ($total['total'] as $key) :
                endforeach;
                $nilai = $key->kuesioner_subtotal;
                switch ($nilai) {
                    case $nilai < 40:
                        $jenis = 'sangat_miskin';
                        break;
                    case $nilai < 60:
                        $jenis = 'miskin';
                        break;
                    case $nilai < 75:
                        $jenis = 'hampir_miskin';
                        break;
                    default:
                        $jenis = 'mampu';
                }
                $data = [
                    'title'         => 'Data Usulan',
                    'description'   => 'Simpan Usulan',
                    'content'       => 'usulan/usulan',
                    'kecamatan'     => $kecamatan,
                    'nilai'         => $nilai,
                    'jenis'         => $jenis
                ];
                $this->load->module('template');
                $this->template->index($data);
            }else{
                redirect('dashboard');
            }
        }else{
            $this->load->view('maintenance');
        }
	}

    function get_desa(){
        $id_kecamatan = $this->input->post('id',TRUE);
        $data = $this->Kecdesa_m->get_desa($id_kecamatan)->result();
        echo json_encode($data);
    }
}
