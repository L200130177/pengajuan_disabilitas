<?php
class Laporan_m extends CI_Model{


        // start datatables
    var $column_order = array(null, 'nama', 'nik'); //set column field database for datatable orderable
    var $column_search = array('nama','nik'); //set column field database for datatable searchable
    var $order = array('id_pengajuan' => 'desc'); // default order 
 
    private function _get_datatables_query() {
      
        $this->db->select('id_pengajuan, nama, nik, status, created_at');
        $this->db->from('pengajuan_disabilitas');

        $i = 0;
        foreach ($this->column_search as $usr) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($usr, $_POST['search']['value']);
                } else {
                    $this->db->or_like($usr, $_POST['search']['value']);
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
    public function get_datatables($laporan) 
        {
            $this->_get_datatables_query();
            $this->db->where('status', $laporan);
            if(@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

    function get_status($nik){
        $query = $this->db->get_where('pengajuan_disabilitas', array('nik' => $nik));
        return $query->row();
    }

    public function update_status($nik, $data) {
        $this->db->where('nik', $nik);
        $this->db->update('pengajuan_disabilitas', $data);
    }

    // function laporan_bulanan(){
    //     $this->db->select('laporan.*,kecamatan.id_kecamatan, kecamatan.kode_kecamatan, kecamatan.nama_kecamatan,desa.id_desa, desa.kode_desa, desa.nama_desa');
    //     $this->db->from('laporan');
    //     $this->db->join('kecamatan','kecamatan.id_kecamatan = laporan.kecamatan_id');
    //     $this->db->join('desa','desa.id_desa = laporan.desa_id');
    //     $this->db->where('jenis_laporan' ,$this->input->post('export_laporan'));
    //     $this->db->where('created_at >=' ,$this->input->post('awal'));
    //     $this->db->where('created_at <=' ,$this->input->post('akhir'));
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all() {
        $this->db->from('pengajuan_disabilitas');
        return $this->db->count_all_results();
    }
    // end datatables

    // public function add($post)
    // {
    //     $data = array(
    //         "jenis_laporan"             => $post['jenis_laporan'],
    //         "nomor_kk"                  => $post['no_kk'],
    //         "nik"                       => $post['nik'],
    //         "nama_lengkap"              => $post['nama'],
    //         "hubkel"                    => $post['hubungan'],
    //         "tmpt_lahir"                => $post['tempat'],
    //         "tgl_lahir"                 => $post['tanggal'],
    //         "jenis_kelamin"             => $post['jk'],
    //         "status_kawin"              => $post['status'],
    //         "alamat"                    => $post['alamat'],
    //         "rt"                        => $post['rt'],
    //         "rw"                        => $post['rw'],
    //         "kecamatan_id"              => $post['kecamatan'],
    //         "desa_id"                   => $post['desa'],
    //         "skor"                      => $post['nilai'],
    //         "created_by"                => $post['created'],
    //     );
    //     $this->db->insert('laporan', $data);
    // }


	public function get($id = null)
	{
		$this->db->select("id_pengajuan, nama, nik, created_at");
		$this->db->from('pengajuan_disabilitas');
		if($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

}