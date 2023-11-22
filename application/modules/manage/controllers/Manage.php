<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent:: __construct();
		check_not_login();
		$this->load->model(['Maintenance_m', 'manage/Manage_m', 'Kecdesa_m']);
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
            $data = [
                'title'         => 'Manage',
                'description'   => 'Data',
                'content'       => 'manage/manage_data', //user adalah nama module, user_data nama file di view yang akan di load
				'kecdesa'		=> $kecamatan
            ];
			$this->load->module('template');
            $this->template->index($data);
        }else{
            $this->load->view('maintenance');
        }
	}

	public function get_data()
    {
		$nik = $this->input->post('nik_manage');
		$data = $this->Manage_m->get_data($nik);
		echo json_encode($data);	
    }

	public function Update_data()
	{
		$nik = $this->input->post('nik');
		$desa_id = $this->Manage_m->get_desa_id($nik);
		$newDesa = implode($desa_id);
		$desa = $this->input->post('desa_id');
		if(!empty($desa)){
			$edit_desa = $desa;
		}else{
			$edit_desa = $newDesa;
		}
		$data = array(
			"id_laporan"                => $this->input->post('id_laporan'),
			"jenis_laporan"             => $this->input->post('jenis_laporan'),
            "nomor_kk"                  => $this->input->post('no_kk'),
            "nik"                       => $this->input->post('nik'),
            "nama_lengkap"              => $this->input->post('nama'),
            "hubkel"                    => $this->input->post('hubkel'),
            "tmpt_lahir"                => $this->input->post('tmpt_lahir'),
            "tgl_lahir"                 => $this->input->post('tgl_lahir'),
            "jenis_kelamin"             => $this->input->post('jenis_kelamin'),
            "status_kawin"              => $this->input->post('status_kawin'),
            "alamat"                    => $this->input->post('alamat'),
            "rt"                        => $this->input->post('rt'),
            "rw"                        => $this->input->post('rw'),
            "kecamatan_id"              => $this->input->post('kecamatan_id'),
            "desa_id"                   => $edit_desa,
            "skor"                      => $this->input->post('nilai'),
            "edited_at"                 => date("Y-m-d H:i:s"),
			"edited_by"                 => $this->session->userdata('name'),
		);
		$this->db->where('nik', $nik);
        $this->db->update('laporan', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Update data berhasil</div>');
		echo json_encode(array("status" => TRUE));
	}

	public function delete_data() {
        $nik = $this->input->post('nik');
        $this->db->where('nik', $nik);
        $this->db->delete('laporan');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil dihapus</div>');
        echo json_encode(array("status" => TRUE));
    }

	function get_desa(){
        $id_kecamatan = $this->input->post('kecamatan_id',TRUE);
        $data = $this->Kecdesa_m->get_desa($id_kecamatan)->result();
        echo json_encode($data);
    }

}