<?php
class Maintenance_m extends CI_Model
{
	public function maintenance()
    {
        $query = $this->db->get('maintenance')->row_array();
        $query['status'] == "0" ? $maintenance = false : $maintenance = true;
        return $maintenance;
    }
}