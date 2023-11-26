<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // check_not_validate();
        // check_not_login();
        $this->load->model(['Maintenance_m', 'dashboard/Dashboard_m']);
        $name = $this->session->userdata('name');
        $this->db->set('activity', date("Y-m-d H:i:s"));
        $this->db->where('name', $name);
        $this->db->update('user');
    }

	public function index()
	{
        // $data_dummy = $this->Dashboard_m->get()->result();
        // $minio_date = date( "F-Y", strtotime($data_dummy[0]->created_at));
        // var_dump($minio_date);
        // die();
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

    public function list_data() 
    {
        $list = $this->Dashboard_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $usr) {
            $no++;
            $nik = base64_encode($this->encryption->encrypt($usr->nik));
            $ref_file = "http://103.169.233.45:9000/dinsos/". date( "F-Y", strtotime($usr->created_at)) . "/" . $usr->nama . "_" . $usr->nik . "/";
            $row = array();
            $row[] = $no.".";
            $row[] = $usr->nama;
            $row[] = $usr->nik;
            $row[] = '<img src="'.$ref_file.$usr->ref_file.'" class="user-image" alt="User Image" style="width: 200px;height:100px;">';
            $row[] = '<a href="'.$ref_file.$usr->ref_file.'" target="_blank" class="btn btn-success btn-xs">Download Dokumen</a>';
            // $row[] = $usr->level  == 1 ? "Admin" : "User";  
            // $row[] = '<button type="button" title="edit user" class="btn btn-primary btn-xs" onclick="byid(' . "'" . $id . "', 'edit'" . ')">
            //             <i class="fa fa-pencil"></i> Update
            //             </button>
            //             <button type="button" title="delete user" class="btn btn-danger btn-xs" onclick="byid(' . "'" . $id . "', 'delete'" . ')">
            //             <i class="fa fa-trash"></i>  Delete
            //             </button>
            //             <button type="button" title="reset session" class="btn btn-warning btn-xs" onclick="byid(' . "'" . $id . "', 'session'" . ')">
            //             <i class="fa fa-trash"></i>  Session
            //             </button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Dashboard_m->count_all(),
                    "recordsFiltered" => $this->Dashboard_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function submit_rekomendasi()
    {
        $post = $this->input->post(null, TRUE);
        $insert = $this->db->insert('pengajuan_disabilitas',$post);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil ditambahkan</div>');
            redirect('pengajuan');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>NIK sudah terdaftar</div>');
            redirect('pengajuan');
        }
    }
}
