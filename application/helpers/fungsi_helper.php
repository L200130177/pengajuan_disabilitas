<?php

function check_already_login() {
	$ci =& get_instance();
	$user_session = $ci->session->userdata('userid');
	if($user_session) {
		redirect ('dashboard_pengajuan');
	} 
}

function check_not_login() {
	$ci =& get_instance();
	$user_session = $ci->session->userdata('userid');
	if(!$user_session) {
		redirect ('auth_pengajuan');
	} 
}

function check_already_validate() {
	$ci =& get_instance();
	$validate_session = $ci->session->userdata('validation');
	if($validate_session == 'active') {
		redirect ('auth_pengajuan');
	} 
}

function check_not_validate() {
	$ci =& get_instance();
	$validate_session = $ci->session->userdata('validation');;
	if($validate_session != 'active') {
		redirect ('validasi_pengajuan');
	} 
}

function check_admin() {
	$ci =& get_instance();
	$ci->load->library('fungsi');
	if($ci->fungsi->user_login()-> level != 1) {
		redirect('dashboard_pengajuan');
	}
}