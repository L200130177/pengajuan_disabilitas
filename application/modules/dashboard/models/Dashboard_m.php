<?php

class Dashboard_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	var $column_order = array(null, 'nama', 'nik'); //set column field database for datatable orderable
    var $column_search = array('nama','nik'); //set column field database for datatable searchable
    var $order = array('id_pengajuan' => 'desc'); // default order 

	private function _get_datatables_query() 
    {

        $this->db->select('id_pengajuan, nama, nik, ref_file, created_at, is_rekomendasi');
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

	public function get_datatables() 
    {
        $this->_get_datatables_query();
        $this->db->where('is_rekomendasi', 0);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	public function count_filtered() 
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() 
    {
        $this->db->from('pengajuan_disabilitas');
        return $this->db->count_all_results();
    }

    public function getdataById($decrypt_id)
    {
		return $this->db->get_where('pengajuan_disabilitas', ['nik'=>$decrypt_id])->row_array();
	}

    public function update($where, $data)
    {
        $this->db->update('pengajuan_disabilitas', $data, $where);
        return $this->db->affected_rows();
    }

    public function del($id)
	{
		$this->db->where('nik', $id);
		$this->db->delete('pengajuan_disabilitas');
	}

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