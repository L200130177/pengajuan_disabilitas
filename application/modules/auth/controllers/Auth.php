<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Maintenance_m', 'user/User_m']);
        $this->load->library('session');
    }

	public function index()
	{
        check_not_validate();
        check_already_login();
        $maintenance = $this->Maintenance_m->maintenance();
        if($maintenance != true){
            $this->load->view('login');
        }else{
            $this->load->view('maintenance');
        }
	}

    public function validate_login()
    {
        // $this->encryption->decrypt(base64_decode($id));
        $key = getenv('ENCRYPT_PASSWORD');
        $username = htmlentities($this->input->post('username'));
        $password = htmlentities($this->input->post('password'));

        $check = $this->db->get_where('user', array('username' => $username))->row_array();
        // var_dump($check);
        // die();
        if($check){
            if (hash_hmac('sha256',$password, $key) == $check['password']){
                if(empty($check['remember_token'])){
                    $params = array (
                        'userid' => base64_encode($this->encryption->encrypt($check['user_id'])),
                        'level' => $check['level'],
                        'name' => $check['name'],
                        'alamat' => $check['address'],
                        'session_id'   => md5($check['userid'] . "_" . date_format(new DateTime(), "ymd.His")),
                    );
                    $this->session->set_userdata($params);
                    $this->db->set('remember_token', $this->session->userdata('session_id'));
                    $this->db->where('username', $username);
                    $this->db->update('user');
                    // $this->session->set_userdata($params);
                    redirect('dashboard');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>User sudah login</div>');
                    redirect('auth');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>Password salah !</div>');
                redirect('auth');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-ban"></i>Username tidak terdaftar</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $name = $this->session->userdata('name');
        $this->db->set('remember_token', null);
        $this->db->where('name', $name);
        $this->db->update('user');
		redirect('pengajuan');
    }

}
