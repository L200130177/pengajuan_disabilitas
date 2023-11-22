<?php

class Manage_m extends CI_Model
{
        public function get_data($nik)
        {
            $this->db->select('laporan.*,kecamatan.id_kecamatan, kecamatan.kode_kecamatan, kecamatan.nama_kecamatan,desa.id_desa, desa.kode_desa, desa.nama_desa');
            $this->db->from('laporan');
            $this->db->join('kecamatan','kecamatan.id_kecamatan = laporan.kecamatan_id');
            $this->db->join('desa','desa.id_desa = laporan.desa_id');
            $this->db->where('nik', $nik);
            $query = $this->db->get();
            return $query->row_array();
        }

        public function get_desa_id($nik)
        {
            $this->db->select('desa_id');
            $this->db->from('laporan');
            $this->db->where('nik', $nik);
            $query = $this->db->get();
            return $query->row_array();
        }

    }