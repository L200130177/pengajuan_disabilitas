<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // check_not_validate();
        // check_not_login();
        $this->load->model(['Maintenance_m', 'user/User_m']);
        $this->load->library('session');
        $name = $this->session->userdata('name');
        $this->db->set('activity', date("Y-m-d H:i:s"));
        $this->db->where('name', $name);
        $this->db->update('user');
    }

	public function index()
	{
        $maintenance = $this->Maintenance_m->maintenance();
        if($maintenance != true){
            $check = $this->db->get_where('user', array('user_id' =>  $this->encryption->decrypt(base64_decode($this->session->userdata('userid')))))->row_array();
            if($check['level'] != 1){
                redirect('dashboard');
            }
            $data = [
                'title'         => 'User',
                'description'   => 'pengguna',
                'content'       => 'user/user_data' //user adalah nama module, user_data nama file di view yang akan di load
            ];
            $this->load->module('template');
            $this->template->index($data);
        }else{
            $this->load->view('maintenance');
        }
	}

    function list_data() 
    {
        $list = $this->User_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $usr) {
            $no++;
            $id = base64_encode($this->encryption->encrypt($usr->user_id));
            $row = array();
            $row[] = $no.".";
            $row[] = $usr->username;
            $row[] = $usr->name;
            $row[] = $usr->address;
            $row[] = $usr->level  == 1 ? "Admin" : "User";  
            $row[] = '<button type="button" title="edit user" class="btn btn-primary btn-xs" onclick="byid(' . "'" . $id . "', 'edit'" . ')">
                        <i class="fa fa-pencil"></i> Update
                        </button>
                        <button type="button" title="delete user" class="btn btn-danger btn-xs" onclick="byid(' . "'" . $id . "', 'delete'" . ')">
                        <i class="fa fa-trash"></i>  Delete
                        </button>
                        <button type="button" title="reset session" class="btn btn-warning btn-xs" onclick="byid(' . "'" . $id . "', 'session'" . ')">
                        <i class="fa fa-trash"></i>  Session
                        </button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->User_m->count_all(),
                    "recordsFiltered" => $this->User_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function byid($id)
    {
    
        $decrypt_id = $this->encryption->decrypt(base64_decode($id));
        $query = $this->User_m->getdataById($decrypt_id);
        if (isset($query))
        {
            $data['query']['data'] = array(
                'user_id'    => base64_encode($this->encryption->encrypt($query['user_id'])),
                'username'   => htmlentities($query['username']),
                'name'      => htmlentities($query['name']),
                'address'     => htmlentities($query['address']),
                'level'      => htmlentities($query['level']),
            );
        }
        
        echo json_encode($data);

    }

    public function submit()
    {
        $key = getenv('ENCRYPT_PASSWORD');
        $data = array(
            'username' 	=> htmlentities($this->input->post('username')),
            'name' 	    => htmlentities($this->input->post('name')),
            'password'   => htmlentities(hash_hmac('sha256',$this->input->post('password'), $key)),
            'address'   => htmlentities($this->input->post('address')),
            'level' 	=> htmlentities($this->input->post('level')),
            // 'is_active' => 1
            );
        $get_username = $this->db->get_where('user', array('username' => $this->input->post('username')))->row_array();
        if(isset($get_username['username']) != $this->input->post('username')){
            $insert = $this->db->insert('user',$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil ditambahkan</div>');
            redirect('user');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>Username sudah terdaftar</div>');
            redirect('user');
        }
    }

    public function edit()
    {
        $key = getenv('ENCRYPT_PASSWORD');
        $data = array(
            'username' 	    => htmlentities($this->input->post('username-edit')),
            'name' 	        => htmlentities($this->input->post('name-edit')),
            'address'       => htmlentities($this->input->post('address-edit')),
            'updated_at'    => date("Y-m-d H:i:s"),
            );
            if(!empty($this->input->post('password-edit'))){
                $data['password'] = htmlentities(hash_hmac('sha256', $this->input->post('password-edit'), $key));
            }

            if ($this->User_m->update(array('user_id' => $this->encryption->decrypt(base64_decode($this->input->post('user_id-edit')))), $data) > 0){
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Update data berhasil</div>');
                redirect('user');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-info"></i>Update data gagal, tidak ada perubahan data</div>');
                redirect('user');
            }
    }

    public function coba()
    {
        $text = 'Dinas Sosial Karanganyar';
        $encrypt = base64_encode($this->encryption->encrypt($text));
        $decrypt = $this->encryption->decrypt(base64_decode("NTFmODc1ODJlNDBiZTQ0Mjg2N2U1M2JmNmU1MzY0OGI5ZGQxZGU5NmUxYzk3NmU3Y2E0NDgyN2FmNjQxMmEzNTk1OTFjNGNmYzA5N2M2Yzg0MmU4Y2NiNmViOTljOTQ1OWE1OTJkYWQ2MmE5MjMxYWQ2MWRhOGU2MWQzOTNlMTNDdTRWZDRVVnYwcFFGMFFMYmFEZkplRDd2eGRBYmljZEpNU0h2czFBNURVPQ=="));
        var_dump($decrypt);
        die();
    }

    public function del()
	{
		$id = $this->encryption->decrypt(base64_decode($this->input->post('user_id_delete')));
		$this->User_m->del($id);

		if($this->db->affected_rows()>0){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Data berhasil dihapus</div>');
            redirect('user');
        }
            
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>Gagal hapus data</div>');
        redirect('user');
		
	}

    public function del_session()
    {
        $data['remember_token'] = "";
        if ($this->User_m->update(array('user_id' => $this->encryption->decrypt(base64_decode($this->input->post('id-session')))), $data) > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Session berhasil direset</div>');
            redirect('user');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>Gagal reset session</div>');
        redirect('user');
    }

}
