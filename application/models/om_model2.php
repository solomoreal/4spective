<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Om_model extends CI_Model {

	///////////////////
	// Organization //
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
		$this->db->from('om_o_org o');
		$this->db->join('om_a_org a', 'o.org_id = a.org_id', 'inner');
		$this->db->join('om_r_org r', 'o.org_id = r.child', 'left');
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");

		if ($parent == 0) {
			$this->db->where('r.parent IS NULL');
		} else {
			$this->db->where('r.parent', $parent);
			$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
						(r.end >= '$begin' AND r.end <= '$end') OR 
						(r.begin >= '$begin' AND r.begin <='$end' ) OR
						(r.begin <= '$begin' AND r.end >= '$end'))");
		}

		return $this->db->get()->row()->val;
	}

	/**
	 * [Count Attribute history of a Organization Object]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function count_atr_org($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_a_org a');
		$this->db->where('a.org_id', $org_id);
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		return $this->db->get()->row()->val;
	}

	/**
	 * [Count parent relation of Organization Object has been ]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function count_rel_org_parent($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_r_org r');
		$this->db->where('child', $org_id);
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		return $this->db->get()->row()->val;
	}

	/**
	 * [Count Child relation of Organization Object]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function count_rel_org_child($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_r_org r');
		$this->db->where('parent', $org_id);
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		return $this->db->get()->row()->val;
	}

	/**
	 * [Get Organization list under other organization]
	 * @param  integer $parent [0 = root]
	 * @param  string  $begin  [yyyy-mm-dd]
	 * @param  string  $end    [yyyy-mm-dd]
	 * @return [obj]           [description]
	 */
	public function get_org_list($parent=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->select('o.org_id');
		$this->db->select('a.org_code');
		$this->db->select('a.org_name');
		$this->db->select('r.parent');
		$this->db->select('o.begin AS org_begin');
		$this->db->select('o.end AS org_end');
		$this->db->select('a.begin AS atr_begin');
		$this->db->select('a.end AS atr_end');
		$this->db->select('r.begin AS rel_begin');
		$this->db->select('r.end AS rel_end');
		$this->db->from('om_o_org o');
		$this->db->join('om_a_org a', 'o.org_id = a.org_id', 'inner');
		$this->db->join('om_r_org r', 'o.org_id = r.child', 'left');

		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		if ($parent == 0) {
			$this->db->where('r.parent IS NULL');
		} else {

			$this->db->where('r.parent', $parent);
			$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		}
		
		

		return $this->db->get()->result();
	}

	/**
	 * [Get Attribute list of Organization]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_atr_org_list($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->from('om_a_org a');
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		return $this->db->get()->result();
	}

	/**
	 * [Get Relation list of Organization]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_rel_org_list($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->from('om_r_org r');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");

		return $this->db->get()->result();
	}

	/**
	 * [Get Organization record with their attribute]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [obj]          [one record]
	 */
	public function get_org_row($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->select('o.org_id');
		$this->db->select('a.org_code');
		$this->db->select('a.org_name');

		$this->db->select('o.begin AS org_begin');
		$this->db->select('o.end AS org_end');
		$this->db->select('a.begin AS atr_begin');
		$this->db->select('a.end AS atr_end');

		$this->db->from('om_o_org o');
		$this->db->join('om_a_org a', 'o.org_id = a.org_id', 'inner');

		$this->db->where('o.org_id', $org_id);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		$this->db->limit(1);
		
		return $this->db->get()->row();
	}

	/**
	 * [Get last Attribute of Organization Object]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_atr_org_last($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->from('om_a_org a');
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		$this->db->where('a.org_id', $org_id);
		$this->db->order_by('a.end', 'desc');
		$this->db->order_by('a.begin', 'desc');
		$this->db->limit(1);

		return $this->db->get()->row();
	}

	/**
	 * [Get last parent of Organization]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_rel_org_parent_last($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$this->db->from('om_r_org r');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		$this->db->where('r.child', $org_id);
		$this->db->order_by('r.end', 'desc');
		$this->db->order_by('r.begin', 'desc');
		$this->db->limit(1);

		return $this->db->get()->row();
	}

	/**
	 * [create Organization object]
	 * @param string $begin [description]
	 * @param string $end   [description]
	 */
	public function add_org($begin='',$end='9999-12-31')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		$data = array(
			'begin' => $begin, 
			'end'   => $end );
		$this->db->insert('om_o_org', $data);

		$this->db->select_max('org_id AS val');
		return $this->db->get('om_o_org')->row()->val;

	}

	/**
	 * [add Attribute of Organization Object]
	 * @param integer $org_id [description]
	 * @param string  $begin  [description]
	 * @param string  $end    [description]
	 */
	public function add_atr_org($org_id=0,$code='',$name='',$begin='',$end='9999-12-31')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}
		
		$data = array(
			'org_id'   => $org_id,
			'org_code' => $org_code,	
			'org_name' => $org_name,	
			'begin'    => $begin, 
			'end'      => $end );
		$this->db->insert('om_a_org', $data);

		$this->db->select_max('id AS val');
		return $this->db->get('om_a_org')->row()->val;
	}

	/**
	 * [create relation parent - child Organization]
	 * @param integer $parent [description]
	 * @param integer $child  [description]
	 * @param string  $begin  [description]
	 * @param string  $end    [description]
	 */
	public function add_rel_org($parent=0,$child=0,$begin='',$end='9999-12-31')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		$data = array(
			'parent' => $parent,
			'child'  => $child,
			'begin'  => $begin, 
			'end'    => $end );
		$this->db->insert('om_r_org', $data);

		$this->db->select_max('id AS val');
		return $this->db->get('om_r_org')->row()->val;
	}

	/**
	 * [Edit Organization Object]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function edit_org($org_id=0,$begin='',$end='9999-12-31')
	{
		if ($begin != '') {
			$this->db->set('begin', $begin); 
		}
		$this->db->set('end', $end); 
		$this->db->where('org_id', $org_id);
		$this->db->update('om_o_org');
	}

	/**
	 * [Edit Organization Attribute]
	 * @param  integer $id    [description]
	 * @param  string  $code  [description]
	 * @param  string  $name  [description]
	 * @param  string  $begin [description]
	 * @param  string  $end   [description]
	 * @return [type]         [description]
	 */
	public function edit_atr_org($id=0,$code='',$name='',$begin='',$end='9999-12-31')
	{
		if ($code != '') {
			$this->db->set('code', $code); 
		}
		
		if ($name != '') {
			$this->db->set('name', $name); 
		}

		if ($begin != '') {
			$this->db->set('begin', $begin); 
		}

		$this->db->set('end', $end); 
		$this->db->where('id', $id);
		$this->db->update('om_a_org');
	}

	/**
	 * [Edit Organization Relation]
	 * @param  integer $id     [description]
	 * @param  string  $parent [description]
	 * @param  string  $child  [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function edit_rel_org($id=0,$parent='',$child='',$begin='',$end='9999-12-31')
	{
		if ($parent != '') {
			$this->db->set('parent', $parent); 
		}
		
		if ($child != '') {
			$this->db->set('child', $child); 
		}

		if ($begin != '') {
			$this->db->set('begin', $begin); 
		}
		$this->db->set('end', $end); 
		$this->db->where('id', $id);
		$this->db->update('om_r_org');
	}

	/**
	 * [Remove a Organization Object with its Attributes & Relations from database]
	 * @param  integer $org_id [description]
	 * @return [type]          [description]
	 */
	public function remove_org($org_id=0)
	{
		$child = $this->count_rel_org_child($org_id);
		if ($child == 0) {
			$this->db->where('child', $org_id);
			$this->db->or_where('parent', $org_id);
			$this->db->delete('om_r_org');
			
			$this->db->where('org_id', $org_id);
			$this->db->delete('om_a_org');
		
			$this->db->where('org_id', $org_id);
			$this->db->delete('om_o_org');

			return true;
		} else {
			return false;
		}
	}

	/**
	 * [Remove Organization Atribute record from table]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function remove_atr_org($id=0)
	{
		$this->db->where('id', $id);
		$this->db->delete('om_a_org');
	}

	/**
	 * [Change end date of Organization Object]
	 * @param  integer $org_id [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function delimit_org($org_id=0,$end='')
	{
		$this->edit_org($org_id,'',$end);
	}

	/**
	 * [Change end date of Organization Attribute]
	 * @param  integer $id  [description]
	 * @param  string  $end [description]
	 * @return [type]       [description]
	 */
	public function delimit_atr_org($id=0,$end='')
	{
		$this->edit_atr_org($id,'','','',$end);
	}

	/**
	 * [Change end date of Organization Relation]
	 * @param  integer $id  [description]
	 * @param  string  $end [description]
	 * @return [type]       [description]
	 */
	public function delimit_rel_org($id=0,$end='')
	{
		$this->edit_rel_org($id,'','','',$end);
	}

	/**
	 * [Remove a Organization Parent-Child Relation record]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	public function remove_rel_org($id=0)
	{
		$this->db->where('id', $id);
		$this->db->delete('om_r_org');
	}

	/**
	 * [Update Organization attribute]
	 * @param  integer $org_id [description]
	 * @param  string  $code   [description]
	 * @param  string  $name   [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function update_atr_org($org_id=0,$code='',$name='',$begin='',$end='9999-12-31')
	{
		$c_atr = $this->count_atr_org($org_id,'1945-01-01','9999-12-31');
		if ($c_atr) {
			// DO delimit last Org attribute
			$atr_id = $this->get_atr_org_last($org_id,'1945-01-01','9999-12-31')->id;
			list($year,$month,$day) = explode('-', $begin);
			$unix_time  = mktime(0, 0, 0, $month, $day, $year);
			$day_before = strtotime("yesterday", $unix_time);
			$del_date   = date('Y-m-d', $day_before);
			$this->delimit_atr_org($atr_id,$del_date);

		}
		// DO create new org attribute
		return $this->add_atr_org($org_id,$code,$name,$begin,$end);
	}

	public function update_rel_org_parent($parent=0,$child=0,$begin='',$end='9999-12-31')
	{
		$c_rel = $this->count_rel_org_parent($child,'1945-01-01','9999-12-31');
		if ($c_rel) {
			// DO delimit last Org relation 
			$rel_id = $this->get_rel_org_parent_last($child,'1945-01-01','9999-12-31')->id;
			list($year,$month,$day) = explode('-', $begin);
			$unix_time  = mktime(0, 0, 0, $month, $day, $year);
			$day_before = strtotime("yesterday", $unix_time);
			$del_date   = date('Y-m-d', $day_before);
			$this->delimit_rel_org($atr_id,$del_date);
		}
		// DO create new org relation
		return $this->add_rel_org($parent,$child,$begin,$end);
	}


//------------------------------------------------------------------------------

	///////////////
	// Position //
	///////////////

	public function get_post_list($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->select('o.post_id');
		$this->db->select('a.post_code');
		$this->db->select('a.post_name');
		$this->db->select('r.parent');
		$this->db->select('o.begin AS post_begin');
		$this->db->select('o.end AS post_end');
		$this->db->select('a.begin AS atr_begin');
		$this->db->select('a.end AS atr_end');
		$this->db->select('r.begin AS rel_begin');
		$this->db->select('r.end AS rel_end');
		$this->db->from('om_o_post o');
		$this->db->join('om_a_post a', 'o.post_id = a.post_id', 'inner');
		$this->db->join('om_r_post_org r', 'o.post_id = r.post_id', 'inner');
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		$this->db->where('r.org_id', $org_id);
		return $this->db->get()->result();
	}
}

/* End of file om_model.php */
/* Location: ./application/models/om_model.php */