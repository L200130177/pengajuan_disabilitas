<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner_m extends CI_model {

     // start datatables
    var $column_order = array(null, 'nik'); //set column field database for datatable orderable
    var $column_search = array('nik'); //set column field database for datatable searchable
    var $order = array('nik' => 'asc'); // default order 
 
    private function _get_datatables_query() {
      
        $this->db->from('kuesioner');
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
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('kuesioner');
        return $this->db->count_all_results();
    }
    // end datatables

    public function add($post)
    {
        $data = array(
            "nik"       => $post['nik'],
            "k1"       => $post['k1'],
            "k2"       => $post['k2'],
            "k3"       => $post['k3'],
            "k4"       => $post['k4'],
            "k5"       => $post['k5'],
            "k6"       => $post['k6'],
            "k7"       => $post['k7'],
            "k8"       => $post['k8'],
            "k9"       => $post['k9'],
            "k10"       => $post['k10'],
            "k11"       => $post['k11'],
            "k12"       => $post['k12'],
            "k13"       => $post['k13'],
            "k14"       => $post['k14'],
            "k15"       => $post['k15'],
            "k16"       => $post['k16'],
            "k17"       => $post['k17'],
            "k18"       => $post['k18'],
            "k19"       => $post['k19'],
            "k20"       => $post['k20'],
            "k21"       => $post['k21'],
            "k22"       => $post['k22'],
            "k23"       => $post['k23'],
            "k24"       => $post['k24'],
            "k25"       => $post['k25'],
            "k26"       => $post['k26'],
            "k27"       => $post['k27'],
            "k28"       => $post['k28'],
            "k29"       => $post['k29'],
        );
        $this->db->insert('kuesioner', $data);
    }

    function tampil_kuesioner($nik){
        $hsl=$this->db->query("SELECT nik,(k1+k2+k3+k4+k5+k6+k7+k8+k9+k10+k11+k12+k13+k14+k15+k16+k17+k18+k19+k20+k21+k22+k23+k24+k25+k26+k27+k28+k29) AS kuesioner_subtotal FROM kuesioner WHERE nik='$nik'");
        return $hsl;
    }

}