<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Maintenance_m', 'pengajuan/Pengajuan_m']);
    }

	public function index()
	{
        $this->load->view('pengajuan');
	}

    public function submit()
    {
        $data = array(
            'email' 	            => htmlentities($this->input->post('email')),
            'nama' 	                => htmlentities($this->input->post('nama')),
            'nik'                   => hhtmlentities($this->input->post('nik')),
            'umur'                  => htmlentities($this->input->post('umur')),
            'jenis_kelamin' 	    => htmlentities($this->input->post('jenis_kelamin')),
            'alamat_lengkap' 	    => htmlentities($this->input->post('alamat')),
            'agama' 	            => htmlentities($this->input->post('agama')),
            'anak_ke' 	            => htmlentities($this->input->post('username')),
            'pendidikan_terakhir' 	=> htmlentities($this->input->post('username')),
            'status_pernikahan' 	=> htmlentities($this->input->post('username')),
            'pekerjaan' 	        => htmlentities($this->input->post('username')),
            'jaminan_sosial' 	    => htmlentities($this->input->post('username')),
            'jenis_kedisabilitasan' => htmlentities($this->input->post('username')),
            'no_telepon' 	        => htmlentities($this->input->post('username')),
            'program_rehabilitasi' 	=> htmlentities($this->input->post('username')),
            'nama_wali' 	        => htmlentities($this->input->post('username')),
            'alamat_wali' 	        => htmlentities($this->input->post('username')),
            'pekerjaan_wali' 	    => htmlentities($this->input->post('username')),
            'penghasilan_wali' 	    => htmlentities($this->input->post('username')),
            'agama_wali' 	        => htmlentities($this->input->post('username')),
            'keluarga_wali' 	    => htmlentities($this->input->post('username')),
            'no_telepon_wali' 	    => htmlentities($this->input->post('username')),
            'hubungan_ppks' 	    => htmlentities($this->input->post('username')),
            'jenis_layanan' 	    => htmlentities($this->input->post('username')),
            );
        $insert = $this->db->insert('pengajuan_disabilitas',$data);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil ditambahkan</div>');
            redirect('pengajuan');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>NIK sudah terdaftar</div>');
            redirect('pengajuan');
        }
    }

}
