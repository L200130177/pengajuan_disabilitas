<?php

class Pengajuan_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	var $column_order = array(null, 'username', 'name', 'address'); //set column field database for datatable orderable
    var $column_search = array('username','name','address'); //set column field database for datatable searchable
    var $order = array('user_id' => 'desc'); // default order 

	private function _get_datatables_query() 
    {

        $this->db->select('user_id, username, name, address, level');
        $this->db->from('user');

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
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    public function getdataById($decrypt_id)
    {
		return $this->db->get_where('user', ['user_id'=>$decrypt_id])->row_array();
	}

    public function update($where, $data)
    {
        $this->db->update('user', $data, $where);
        return $this->db->affected_rows();
    }

    public function del($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('user');
	}
}