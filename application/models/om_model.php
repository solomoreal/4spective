<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Om_model extends CI_Model {
	/////////////
	// OBJECT //
	/////////////

	public function count_obj($type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$type = strtoupper($type);
		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj o');

		$this->db->where_in('o.obj_type', $type);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		return $this->db->get()->row()->val;
	}

	public function count_obj_atr($obj_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj_attr a');
		$this->db->where('a.obj_id', $obj_id);
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		return $this->db->get()->row()->val;
	}

	public function count_obj_rel($obj_id=0,$direction='all',$rel_type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj_rel r');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		$this->db->where_in('rel_type', $Value);

		switch ($direction) {
			case 'A':
				$this->db->where('r.obj_to', $obj_id);
				break;
			case 'B':
				$this->db->where('r.obj_from', $obj_id);
				break;
			default:
				$this->db->where("(r.obj_to = $obj_id OR r.obj_from = $obj_id)");
				break;
		}
		return $this->db->get()->row()->val;
	}

	public function get_obj_list($type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		
		$this->db->from('om_obj o');

		$this->db->where_in('o.obj_type', $type);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		return $this->db->get()->result();
	}

	public function get_obj_attr_list($obj_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->from('om_obj a');
		$this->db->where_in('a.obj_id', $obj_id);
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		return $this->db->get()->result();
	}

	public function get_obj_rel_list($obj_id=0,$direction='all',$rel_type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->from('om_obj_rel r');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		$this->db->where_in('rel_type', $rel_type);

		switch ($direction) {
			case 'A':
				$this->db->where('r.obj_to', $obj_id);
				break;
			case 'B':
				$this->db->where('r.obj_from', $obj_id);
				break;
			default:
				$this->db->where("(r.obj_to = $obj_id OR r.obj_from = $obj_id)");
				break;
		}
		return $this->db->get()->result();
	}

	public function get_obj_row($obj_id=0)
	{
		$this->db->from('om_obj o');
		$this->db->where('o.obj_id', $obj_id);
		return $this->db->get()->row();
	}

	public function get_obj_last($type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		
		$this->db->from('om_obj o');

		$this->db->where_in('o.obj_type', $type);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->order_by('o.end', 'desc');
		$this->db->order_by('o.begin', 'desc');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	public function get_obj_attr_last($obj_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->from('om_obj a');
		$this->db->where_in('a.obj_id', $obj_id);
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		$this->db->order_by('a.end', 'desc');
		$this->db->order_by('a.begin', 'desc');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	public function get_obj_rel_last($obj_id=0,$direction='all',$rel_type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->from('om_obj_rel r');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		$this->db->where_in('rel_type', $rel_type);

		switch ($direction) {
			case 'A':
				$this->db->where('r.obj_to', $obj_id);
				break;
			case 'B':
				$this->db->where('r.obj_from', $obj_id);
				break;
			default:
				$this->db->where("(r.obj_to = $obj_id OR r.obj_from = $obj_id)");
				break;
		}
		$this->db->order_by('r.end', 'desc');
		$this->db->order_by('r.begin', 'desc');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	public function add_obj($obj_type='',$begin='2008-01-01',$end='9999-12-31')
	{
		$object = array(
			'obj_type' => $obj_type,
			'begin'    => $begin,
			'end'      => $end
		);
		$this->db->insert('om_obj', $object);
		return $this->get_obj_last(array($obj_type),$begin,$end)->obj_id;
	}

	public function edit_obj($obj_id=0,$begin='2008-01-01',$end='9999-12-31')
	{
		$object = array(
			'begin'    => $begin,
			'end'      => $end
		);
		$this->db->where('obj_id', $obj_id);
		$this->db->update('om_obj', $object);
	}

	public function remove_obj($obj_id=0)
	{
		$this->db->where('obj_id', $obj_id);
		$this->db->delete('om_obj');
	}

	///////////////////
	// ORGANIZATION //
	///////////////////

	/**
	 * [Counting Organization under other organization]
	 * @param  integer $parent [0 = root ]
	 * @param  string  $begin  [yyyy-mm-dd]
	 * @param  string  $end    [yyyy-mm-dd]
	 * @return [int]           []
	 */
	public function count_org($parent=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'O');
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		if ($parent > 0) {
			$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
			$this->db->where('r.obj_to', $parent);
			$this->db->where('r.direction', 'A');
			$this->db->where('r.rel_type', '002');
		} else {
			$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
			$this->db->where('r.obj_to', $parent);
			$this->db->where('r.direction', 'A');
			$this->db->where('r.rel_type', '002');
		}
		return $this->db->get()->row()->val;
	}

	public function get_org_list($parent=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('o.obj_id AS org_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS org_code');
		$this->db->select('a.long_name AS org_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS org_begin');
		$this->db->select('o.end AS org_end');

		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'O');
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		$this->db->join('om_obj_attr a', 'a.obj_id = o.obj_id');
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		if ($parent > 0) {
			$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
			$this->db->where('r.obj_to', $parent);
			$this->db->where('r.direction', 'A');
			$this->db->where('r.rel_type', '002');
		} else {
			$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
			$this->db->where('r.obj_to', $parent);
			$this->db->where('r.direction', 'A');
			$this->db->where('r.rel_type', '002');
		}

		return $this->db->get()->result();

	}

	public function get_org_row($org_id=1,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('o.obj_id AS org_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS org_code');
		$this->db->select('a.long_name AS org_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS org_begin');
		$this->db->select('o.end AS org_end');

		$this->db->from('om_obj_attr a');
		$this->db->join('om_obj o', 'a.obj_id = o.obj_id');
		$this->db->limit(1);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		$this->db->where('o.obj_type', 'O');
		$this->db->where('o.obj_id', $org_id);
		$this->db->order_by('a.end', 'desc');
		$this->db->order_by('o.end', 'desc');
		$this->db->order_by('a.begin', 'desc');
		$this->db->order_by('o.begin', 'desc');
		return $this->db->get()->row();

	}

}

/* End of file om_model.php */
/* Location: ./application/models/om_model.php */