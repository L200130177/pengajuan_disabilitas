<?php
class Kecdesa_m extends CI_Model{

    public function get_kecamatan(){
        $query = $this->db->get('kecamatan');
        return $query;  
    }

    public function get_desa($id_kecamatan){
        $query = $this->db->get_where('desa', array('kecamatan_id' => $id_kecamatan));
        return $query;
    }

}