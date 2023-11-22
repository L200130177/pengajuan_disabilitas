<?php
class Laporan_m extends CI_Model{


        // start datatables
    var $column_order = array(null, 'nomor_kk', 'nik', 'nama_lengkap', 'hubkel', 'tmpt_lahir', 'tgl_lahir','jenis_kelamin', 'status_kawin', 'alamat', 'rt', 'rw', 'kode_pos','kode_kecamatan', 'nama_kecamatan','kode_desa', 'nama_desa', 'nama_faskes', 'nama_faskes_dokter_gigi','nomor_telepon_peserta', 'email', 'npp', 'jabatan', 'status', 'kelas_rawat','tmt_kerja', 'gaji_pokok', 'kewarganegaraan', 'no_polis', 'nama_asuransi', 'no_npwp','no_passport'); //set column field database for datatable orderable
    var $column_search = array('nik','nama_lengkap'); //set column field database for datatable searchable
    var $order = array('nik' => 'asc'); // default order 
 
    private function _get_datatables_query() {
      
        $this->db->select('laporan.*,kecamatan.kode_kecamatan,kecamatan.nama_kecamatan,desa.kode_desa, desa.nama_desa');
        $this->db->from('laporan');
        $this->db->join('kecamatan','kecamatan.id_kecamatan = laporan.kecamatan_id');
        $this->db->join('desa','desa.id_desa = laporan.desa_id');

        $i = 0;
        foreach ($this->column_search as $nik) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($nik, $_POST['search']['value']);
                } else {
                    $this->db->or_like($nik, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables($laporan) {
        $this->_get_datatables_query();
        // var_dump($laporan);
        // die();
        $this->db->where('jenis_laporan', $laporan);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function laporan_bulanan(){
        $this->db->select('laporan.*,kecamatan.id_kecamatan, kecamatan.kode_kecamatan, kecamatan.nama_kecamatan,desa.id_desa, desa.kode_desa, desa.nama_desa');
        $this->db->from('laporan');
        $this->db->join('kecamatan','kecamatan.id_kecamatan = laporan.kecamatan_id');
        $this->db->join('desa','desa.id_desa = laporan.desa_id');
        $this->db->where('jenis_laporan' ,$this->input->post('export_laporan'));
        $this->db->where('created_at >=' ,$this->input->post('awal'));
        $this->db->where('created_at <=' ,$this->input->post('akhir'));
        $query = $this->db->get();
        return $query;
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('laporan');
        return $this->db->count_all_results();
    }
    // end datatables

    public function add($post)
    {
        $data = array(
            "jenis_laporan"             => $post['jenis_laporan'],
            "nomor_kk"                  => $post['no_kk'],
            "nik"                       => $post['nik'],
            "nama_lengkap"              => $post['nama'],
            "hubkel"                    => $post['hubungan'],
            "tmpt_lahir"                => $post['tempat'],
            "tgl_lahir"                 => $post['tanggal'],
            "jenis_kelamin"             => $post['jk'],
            "status_kawin"              => $post['status'],
            "alamat"                    => $post['alamat'],
            "rt"                        => $post['rt'],
            "rw"                        => $post['rw'],
            "kecamatan_id"              => $post['kecamatan'],
            "desa_id"                   => $post['desa'],
            "skor"                      => $post['nilai'],
            "created_by"                => $post['created'],
        );
        $this->db->insert('laporan', $data);
    }


	public function get($nik = null)
    {
        $this->db->from('laporan');
        if($nik != null) {
            $this->db->where('nik', $nik);
        }
        $query = $this->db->get();
        return $query;
    }

}