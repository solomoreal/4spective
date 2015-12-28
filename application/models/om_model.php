<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Om_model extends CI_Model {
	/////////////
	// OBJECT //
	/////////////

	/**
	 * [Count OM Object]
	 * @param  array  $type  [description]
	 * @param  string $begin [yyyy-mm-dd]
	 * @param  string $end   [yyyy-mm-dd]
	 * @return [type]        [description]
	 */
	public function count_obj($type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
		$type = strtoupper($type);
		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj o');

		if (is_array($type)) {
			$this->db->where_in('o.obj_type', $type);
		} else {
			$this->db->where('o.obj_type', $type);
		}
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		return $this->db->get()->row()->val;
	}

	/**
	 * [Count OM Object's attribute ]
	 * @param  integer $obj_id [description]
	 * @param  string  $begin  [yyyy-mm-dd]
	 * @param  string  $end    [yyyy-mm-dd]
	 * @return [type]          [description]
	 */
	public function count_obj_atr($obj_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
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

	/**
	 * [Count OM Object's relation ] 
	 * @param  integer $obj_id    [description]
	 * @param  string  $direction [A/B/all]
	 * @param  array   $rel_type  [in String]
	 * @param  string  $begin     [description]
	 * @param  string  $end       [description]
	 * @return [type]             [description]
	 */
	public function count_obj_rel($obj_id=0,$direction='all',$rel_type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->select('COUNT(*) AS val');
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
		return $this->db->get()->row()->val;
	}

	/**
	 * [Obtain OM Object records ]
	 * @param  array  $type  [description]
	 * @param  string $begin [description]
	 * @param  string $end   [description]
	 * @return [type]        [description]
	 */
	public function get_obj_list($type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
				
		$this->db->from('om_obj o');

		$this->db->where_in('o.obj_type', $type);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		
		return $this->db->get()->result();
	}

	/**
	 * [Obtain OM Object's Attribute records]
	 * @param  integer $obj_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_obj_attr_list($obj_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->from('om_obj_attr a');
		$this->db->where_in('a.obj_id', $obj_id);
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");

		return $this->db->get()->result();
	}

	/**
	 * [Obtain OM Object's Relation records]
	 * @param  integer $obj_id    [description]
	 * @param  string  $direction [description]
	 * @param  array   $rel_type  [description]
	 * @param  string  $begin     [description]
	 * @param  string  $end       [description]
	 * @return [type]             [description]
	 */
	public function get_obj_rel_list($obj_id=0,$direction='all',$rel_type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
		$sub_1 = "(SELECT a.short_name FROM om_obj_attr a WHERE a.obj_id = r.obj_from AND ((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end')) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS code_from ";
		$sub_2 = "(SELECT a.long_name FROM om_obj_attr a WHERE a.obj_id = r.obj_from AND ((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end')) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS name_from ";
		$sub_3 = "(SELECT a.short_name FROM om_obj_attr a WHERE a.obj_id = r.obj_to AND ((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end')) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS code_to ";
		$sub_4 = "(SELECT a.long_name FROM om_obj_attr a WHERE a.obj_id = r.obj_to AND ((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end')) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS name_to ";
		$this->db->select('r.*');
		$this->db->select($sub_1);
		$this->db->select($sub_2);
		$this->db->select($sub_3);
		$this->db->select($sub_4);
		$this->db->from('om_obj_rel r');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		if (is_array($rel_type)) {
			$this->db->where_in('rel_type', $rel_type);
		}

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

	/**
	 * [Obtain a record OM Object]
	 * @param  integer $obj_id [description]
	 * @return [type]          [description]
	 */
	public function get_obj_row($obj_id=0)
	{
		$this->db->from('om_obj o');
		$this->db->where('o.obj_id', $obj_id);
		return $this->db->get()->row();
	}

	/**
	 * [get_obj_attr_row description]
	 * @param  integer $attr_id [description]
	 * @return [type]           [description]
	 */
	public function get_obj_attr_row($attr_id=0)
	{
		$this->db->from('om_obj_attr a');
		$this->db->where('a.attr_id', $attr_id);
		return $this->db->get()->row();
	}

	/**
	 * [get_obj_rel_row description]
	 * @param  integer $rel_id [description]
	 * @return [type]          [description]
	 */
	public function get_obj_rel_row($rel_id=0)
	{
		$sub_1 = "(SELECT a.short_name FROM om_obj_attr a WHERE a.obj_id = r.obj_from AND ((a.begin >= r.begin AND a.end <=r.end) OR 
					(a.end >= r.begin AND a.end <= r.end) OR 
					(a.begin >= r.begin AND a.begin <=r.end ) OR
					(a.begin <= r.begin AND a.end >= r.end)) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS code_from ";
		$sub_2 = "(SELECT a.long_name FROM om_obj_attr a WHERE a.obj_id = r.obj_from AND ((a.begin >= r.begin AND a.end <=r.end) OR 
					(a.end >= r.begin AND a.end <= r.end) OR 
					(a.begin >= r.begin AND a.begin <=r.end ) OR
					(a.begin <= r.begin AND a.end >= r.end)) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS name_from ";
		$sub_3 = "(SELECT a.short_name FROM om_obj_attr a WHERE a.obj_id = r.obj_to AND ((a.begin >= r.begin AND a.end <=r.end) OR 
					(a.end >= r.begin AND a.end <= r.end) OR 
					(a.begin >= r.begin AND a.begin <=r.end ) OR
					(a.begin <= r.begin AND a.end >= r.end)) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS code_to ";
		$sub_4 = "(SELECT a.long_name FROM om_obj_attr a WHERE a.obj_id = r.obj_to AND ((a.begin >= r.begin AND a.end <=r.end) OR 
					(a.end >= r.begin AND a.end <= r.end) OR 
					(a.begin >= r.begin AND a.begin <=r.end ) OR
					(a.begin <= r.begin AND a.end >= r.end)) ORDER BY a.end DESC, a.begin DESC, a.obj_id DESC LIMIT 1) AS name_to ";
		$this->db->select('r.*');
		$this->db->select($sub_1);
		$this->db->select($sub_2);
		$this->db->select($sub_3);
		$this->db->select($sub_4);
		$this->db->from('om_obj_rel r');
		$this->db->where('r.rel_id', $rel_id);
		return $this->db->get()->row();
	}

	/**
	 * [Obtain the lastest record of OM Object]
	 * @param  array  $type  [description]
	 * @param  string $begin [description]
	 * @param  string $end   [description]
	 * @return [type]        [description]
	 */
	public function get_obj_last($type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
		
		$this->db->from('om_obj o');

		$this->db->where_in('o.obj_type', $type);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->order_by('o.end', 'desc');
		$this->db->order_by('o.begin', 'desc');
		$this->db->order_by('o.obj_id', 'desc');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	/**
	 * [Obtain  the lastest record of OM Object's Attribute]
	 * @param  integer $obj_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_obj_attr_last($obj_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
		$this->db->from('om_obj_attr a');
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

	/**
	 * [Obtain  the lastest record of OM Object's Relation]
	 * @param  integer $obj_id    [description]
	 * @param  string  $direction [description]
	 * @param  array   $rel_type  [description]
	 * @param  string  $begin     [description]
	 * @param  string  $end       [description]
	 * @return [type]             [description]
	 */
	public function get_obj_rel_last($obj_id=0,$direction='all',$rel_type=array(),$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
		$this->db->from('om_obj_rel r');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		if (is_array($rel_type)) {
			$this->db->where_in('rel_type', $rel_type);
			
		} else if ($rel_type !='') {
			$this->db->where('rel_type', $rel_type);
		}

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

		return $this->db->get()->row();
	}

	/**
	 * [Adding OM Object record]
	 * @param string $obj_type [description]
	 * @param string $begin    [description]
	 * @param string $end      [description]
	 */
	public function add_obj($obj_type='',$begin='2008-01-01',$end='$end')
	{
		$object = array(
			'obj_type' => $obj_type,
			'begin'    => $begin,
			'end'      => $end
		);
		$this->db->insert('om_obj', $object);
		return $this->get_obj_last(array($obj_type),$begin,$end)->obj_id;
	}

	/**
	 * [Editing OM Object record]
	 * @param  integer $obj_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function edit_obj($obj_id=0,$begin='2008-01-01',$end='$end')
	{
		$object = array(
			'begin'    => $begin,
			'end'      => $end
		);
		$this->db->where('obj_id', $obj_id);
		$this->db->update('om_obj', $object);
	}

	public function delimit_obj($obj_id=0,$end='$end')
	{
		$object = array(
			'end'      => $end
		);
		$this->db->where('obj_id', $obj_id);
		$this->db->update('om_obj', $object);
	}

	/**
	 * [Removing OM Object record]
	 * @param  integer $obj_id [description]
	 * @return [type]          [description]
	 */
	public function remove_obj($obj_id=0)
	{
		$this->db->where('obj_id', $obj_id);
		$this->db->delete('om_obj');
	}

	/**
	 * [Adding OM Object's Attribut record]
	 * @param integer $obj_id     [description]
	 * @param string  $short_name [description]
	 * @param string  $long_name  [description]
	 * @param string  $begin      [description]
	 * @param string  $end        [description]
	 */
	public function add_obj_attr($obj_id=0,$short_name='',$long_name='',$begin='2008-01-01',$end='$end')
	{
		$object = array(
			'obj_id'     => $obj_id,
			'short_name' => $short_name,
			'long_name'  => $long_name,
			'begin'      => $begin,
			'end'        => $end
		);
		$this->db->insert('om_obj_attr', $object);
		return $this->get_obj_attr_last($obj_id,$begin,$end)->attr_id;
	}

	/**
	 * [Editing OM Object's Attribute record]
	 * @param  integer $attr_id    [description]
	 * @param  string  $short_name [description]
	 * @param  string  $long_name  [description]
	 * @param  string  $begin      [description]
	 * @param  string  $end        [description]
	 * @return [type]              [description]
	 */
	public function edit_obj_attr($attr_id=0,$short_name='',$long_name='',$begin='2008-01-01',$end='$end')
	{
		$object = array(
			'short_name' => $short_name,
			'long_name'  => $long_name,
			'begin'      => $begin,
			'end'        => $end
		);
		$this->db->where('attr_id', $attr_id);
		$this->db->update('om_obj_attr', $object);
	}

	public function delimit_obj_attr($attr_id=0,$end='$end')
	{
		$object = array(
			'end'        => $end
		);
		$this->db->where('attr_id', $attr_id);
		$this->db->update('om_obj_attr', $object);
	}

	/**
	 * [Removing OM Object's Attribute record]
	 * @param  integer $attr_id [description]
	 * @return [type]           [description]
	 */
	public function remove_obj_attr($attr_id=0)
	{
		$this->db->where('attr_id', $attr_id);
		$this->db->delete('om_obj_attr');
	}

	public function add_obj_rel($rel_type='',$obj_from=0,$obj_to=0,$begin='2008-01-01',$end='$end',$value=NULL)
	{
		$object = array(
			'rel_type'  => $rel_type,
			'obj_from'  => $obj_from,
			'obj_to'    => $obj_to,
			'begin'     => $begin,
			'end'       => $end
		);

		if (!is_null($value)) {
			$object['value'] = $value;
		}

		$this->db->insert('om_obj_rel', $object);
	}

	public function edit_obj_rel($rel_id=0,$begin='2008-01-01',$end='$end',$value=NULL)
	{
		$object = array(
			'begin'     => $begin,
			'end'       => $end
		);

		if (!is_null($value)) {
			$object['value'] = $value;
		}
		$this->db->where('rel_id', $rel_id);
		$this->db->update('om_obj_rel', $object);
	}

	public function delimit_obj_rel($rel_id=0,$end='$end')
	{
		$object = array(
			'end'       => $end
		);
		$this->db->where('rel_id', $rel_id);
		$this->db->update('om_obj_rel', $object);
	}

	public function remove_obj_rel($rel_id=0)
	{
		$this->db->where('rel_id', $rel_id);
		$this->db->delete('om_obj_rel', $object);
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
			$end = $begin;
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
			$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_to');
			$this->db->where('r.obj_from', $parent);

			$this->db->where('r.rel_type', '002');
		} 
		return $this->db->get()->row()->val;
	}

	/**
	 * [Obtain Organization Records]
	 * @param  integer $parent [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_org_list($parent=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
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
			$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_to');
			$this->db->where('r.obj_from', $parent);
			$this->db->where('r.rel_type', '002');
		} 

		return $this->db->get()->result();
	}


	/**
	 * [get_org_parent_row description]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_org_parent_row($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
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
		
		$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
		$this->db->where('r.obj_to', $org_id);
		$this->db->where('r.rel_type', '002');
		
		return $this->db->get()->row();
	}

	/**
	 * [get_org_post_row description]
	 * @param  integer $post_id [description]
	 * @param  string  $begin   [description]
	 * @param  string  $end     [description]
	 * @return [type]           [description]
	 */
	public function get_org_post_row($post_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
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
		
		$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
		$this->db->where('r.obj_to', $post_id);
		$this->db->where('r.rel_type', '003');
		
		return $this->db->get()->row();
	}

	/**
	 * [Obtain Organization record]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_org_row($org_id=1,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
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

	/**
	 * [Adding Organization ]
	 * @param string  $post_code   [description]
	 * @param string  $post_name   [description]
	 * @param integer $post_parent [description]
	 * @param string  $begin      [description]
	 * @param string  $end        [description]
	 */
	public function add_org($org_code='',$org_name='',$org_parent=0,$begin='2008-01-01',$end='$end')
	{
		$obj_id = $this->add_obj('O',$begin,$end);
		$this->add_obj_attr($obj_id,$org_code,$org_name,$begin,$end);

		if ($org_parent>0) {
			$this->add_obj_rel('002',$org_parent,$obj_id,$begin,$end);
		}

		return $obj_id;
	}

	/**
	 * [Editing the lastest Organization Attribute]
	 * @param  integer $org_id   [description]
	 * @param  string  $org_code [description]
	 * @param  string  $org_name [description]
	 * @param  string  $begin    [description]
	 * @param  string  $end      [description]
	 * @return [type]            [description]
	 */
	public function correct_org($org_id=0,$org_code='',$org_name='',$begin='',$end='$end')
	{
		$attr = $this->get_obj_attr_last($org_id,'2008-01-01','$end');
		$this->edit_obj_attr($attr->attr_id,$org_code,$org_name,$begin,$end);
	}

	/**
	 * [Delimit the lastest Organization Attribute and create new one ]
	 * @param  integer $org_id   [description]
	 * @param  string  $org_code [description]
	 * @param  string  $org_name [description]
	 * @param  string  $begin    [description]
	 * @param  string  $end      [description]
	 * @return [type]            [description]
	 */
	public function update_org($org_id=0,$org_code='',$org_name='',$begin='',$end='$end')
	{
		$attr = $this->get_obj_attr_last($org_id,'2008-01-01','$end');
		$prev_date = date('Y-m-d', strtotime($begin .' -1 day'));
		$this->delimit_obj_attr($attr->attr_id,$prev_date);

		$this->add_obj_attr($org_id,$org_code,$org_name,$begin,$end);
	}

	/**
	 * [Edit End date of Organization, their Atrribute and also Relation]
	 * @param  integer $org_id [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function delimit_org($org_id=0,$end='')
	{
		$this->delimit_obj($org_id,$end);
		$attr = $this->get_obj_attr_last($org_id,'2008-01-01','$end');
		$this->delimit_obj_attr($attr->attr_id,$end);

		$rel_types = array('002','003','011','012');
		foreach ($rel_types as $key => $rel_type) {
			
			$rel_A = $this->get_obj_rel_last($org_id,'A',$rel_type,'2008-01-01','$end');
			if (count($rel_A)) {
				$this->delimit_obj_rel($rel_A->rel_id,$end);
			}

			$rel_B = $this->get_obj_rel_last($org_id,'B',$rel_type,'2008-01-01','$end');
			if (count($rel_B)) {
				$this->delimit_obj_rel($rel_B->rel_id,$end);
			}
		}
	}

	public function remove_org($org_id=0)
	{
		// DO remove all relation
		$this->db->where('obj_to', $org_id);
		$this->db->or_where('obj_from', $org_id);
		$this->db->delete('om_obj_rel');

		// DO remove all Attrribute
		
		$this->db->where('obj_id', $org_id);
		$this->db->delete('om_obj_attr');

		// DO remove object
		$this->remove_obj($org_id);
	}

	///////////////
	// POSITION //
	///////////////
	
	public function count_post($org_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'S');
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
		$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
		$this->db->where('r.obj_to', $org_id);

		$this->db->where('r.rel_type', '003');
		return $this->db->get()->row()->val;
	}

	public function get_post_list($org_id=0,$begin='',$end='',$chief=2)
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		switch ($chief) {
			case 1:
				$rel = $this->get_obj_rel_last($org_id,'B','012',$begin,$end);
				return $this->get_post_row($rel->obj_to,$begin,$end);
				break;
			case 0:
				$rel      = $this->get_obj_rel_last($org_id,'B','012',$begin,$end);
				if (count($rel)){
					$chief_id = $this->get_obj_row($rel->obj_to,$begin,$end)->obj_id;
					
				} else {
					$chief_id = 0;
				}
				break;
		}

		$this->db->select('o.obj_id AS post_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS post_code');
		$this->db->select('a.long_name AS post_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS post_begin');
		$this->db->select('o.end AS post_end');

		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'S');
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
		$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_to');
		$this->db->where('r.obj_from', $org_id);

		$this->db->where('r.rel_type', '003');
		if ($chief==0) {
			$this->db->where('o.obj_id !=', $chief_id);
		}
		return $this->db->get()->result();
	}

	public function get_post_vacant_ls($org_id=0,$begin='',$end='',$old_post=NULL)
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}


		$this->db->select('r.obj_from');
		$this->db->from('om_obj_rel r');
		$this->db->where('r.rel_type', '008');
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		if (is_null($old_post)==FALSE) {
			$this->db->where('r.obj_from', $old_post);
		}
		$filled_ls = $this->db->get()->result();
		$filled_arr = array();
		foreach ($filled_ls as $row) {
			$filled_arr[] = $row->obj_from;
		}


		$this->db->select('o.obj_id AS post_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS post_code');
		$this->db->select('a.long_name AS post_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS post_begin');
		$this->db->select('o.end AS post_end');

		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'S');
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
		$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_to');
		$this->db->where('r.obj_from', $org_id);

		$this->db->where('r.rel_type', '003');
		if (count($filled_arr)) {
			$this->db->where_not_in('o.obj_id', $filled_arr);
		}

		return $this->db->get()->result();

	}

	public function get_post_row($post_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->select('o.obj_id AS post_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS post_code');
		$this->db->select('a.long_name AS post_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS post_begin');
		$this->db->select('o.end AS post_end');

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
		$this->db->where('o.obj_type', 'S');
		$this->db->where('o.obj_id', $post_id);
		$this->db->order_by('a.end', 'desc');
		$this->db->order_by('o.end', 'desc');
		$this->db->order_by('a.begin', 'desc');
		$this->db->order_by('o.begin', 'desc');
		return $this->db->get()->row();
	}

	/**
	 * [get_chief_row description]
	 * @param  integer $org_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_chief_row($org_id=0,$begin='',$end='')
	{
		$rel = $this->get_obj_rel_last($org_id,'B','012',$begin,$end);
		if (count($rel)) {
			return $this->get_post_row($rel->obj_to,$begin,$end);
		} else {
			return false;
		}
	}

	/**
	 * [Create new Position]
	 * @param integer $rel_obj_id [description]
	 * @param string  $post_code  [description]
	 * @param string  $post_name  [description]
	 * @param integer $is_chief   [description]
	 * @param string  $begin      [description]
	 * @param string  $end        [description]
	 */
	public function add_post($rel_obj_id=0,$post_code='',$post_name='',$is_chief=0,$begin='',$end='$end')
	{
		$post_id = $this->add_obj('S',$begin,$end);
		$this->add_obj_attr($post_id,$post_code,$post_name,$begin,$end);

		$rel_obj = $this->get_obj_row($rel_obj_id);
		switch ($rel_obj->obj_type) {
			case 'O':
				$this->add_obj_rel('003',$rel_obj_id,$post_id,$begin,$end);
				if ($is_chief==1) {
					$this->add_obj_rel('012',$rel_obj_id,$post_id,$begin,$end);
					$org   = $this->get_org_parent_row($rel_obj_id,$begin,$end);
					$chief = $this->get_chief_row($org->org_id,$begin,$end);
					
				} else {
					$chief = $this->get_chief_row($rel_obj_id,$begin,$end);
				}
				$report_to = $chief->post_id;

				break;
			case 'S':
				$post_t    = $this->get_obj_rel_last($rel_obj_id,'A','003',$begin,$end);
				$this->add_obj_rel('003',$post_t->obj_from,$post_id,$begin,$end);

				$report_to = $rel_obj_id;
				break;
		}
		$this->add_obj_rel('002',$report_to,$post_id,$begin,$end);
	}

	/**
	 * [correct_post description]
	 * @param  integer $post_id   [description]
	 * @param  string  $post_code [description]
	 * @param  string  $post_name [description]
	 * @param  string  $begin     [description]
	 * @param  string  $end       [description]
	 * @return [type]             [description]
	 */
	public function correct_post($post_id=0,$post_code='',$post_name='',$begin='',$end='$end')
	{
		$attr = $this->get_obj_attr_last($post_id,'2008-01-01','$end');
		$this->edit_obj_attr($attr->attr_id,$post_code,$post_name,$begin,$end);
	}

	/**
	 * [update_post description]
	 * @param  integer $post_id   [description]
	 * @param  string  $post_code [description]
	 * @param  string  $post_name [description]
	 * @param  string  $begin     [description]
	 * @param  string  $end       [description]
	 * @return [type]             [description]
	 */
	public function update_post($post_id=0,$post_code='',$post_name='',$begin='',$end='$end')
	{
		$attr = $this->get_obj_attr_last($post_id,'2008-01-01','$end');
		$prev_date = date('Y-m-d', strtotime($begin .' -1 day'));
		$this->delimit_obj_attr($attr->attr_id,$prev_date);

		$this->add_obj_attr($post_id,$post_code,$post_name,$begin,$end);
	}

	/**
	 * [delimit_post description]
	 * @param  integer $post_id [description]
	 * @param  string  $end     [description]
	 * @return [type]           [description]
	 */
	public function delimit_post($post_id=0,$end='')
	{
		$this->delimit_obj($post_id,$end);
		$attr = $this->get_obj_attr_last($post_id,'2008-01-01','$end');
		$this->delimit_obj_attr($attr->attr_id,$end);

		$rel_types = array('002','003','011','012');
		foreach ($rel_types as $key => $rel_type) {
			
			$rel_A = $this->get_obj_rel_last($post_id,'A',$rel_type,'2008-01-01','$end');
			$this->delimit_obj_rel($rel_A->rel_id,$end);

			$rel_B = $this->get_obj_rel_last($post_id,'B',$rel_type,'2008-01-01','$end');
			$this->delimit_obj_rel($rel_B->rel_id,$end);
		}
	}

	public function remove_post($post_id=0)
	{
		// DO remove all relation
		$this->db->where('obj_to', $post_id);
		$this->db->or_where('obj_from', $post_id);
		$this->db->delete('om_obj_rel');

		// DO remove all Attrribute
		
		$this->db->where('obj_id', $post_id);
		$this->db->delete('om_obj_attr');

		// DO remove object
		$this->remove_obj($post_id);
	}

	///////////////////////
	// PERSON / EMPLOYEE //
	///////////////////////

	public function count_emp($begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}
		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'P');
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		
		$this->db->join('om_obj_attr a', 'a.obj_id = o.obj_id');
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");

		return $this->db->get()->row()->val;
	}

	public function check_emp_code($code='')
	{
		$this->db->select('COUNT(*) AS val');
		$this->db->from('om_obj o');
		$this->db->join('om_obj_attr a', 'o.obj_id = a.obj_id');
		$this->db->where('o.obj_type', 'P');
		$this->db->where('a.short_name', $code);

		$result = $this->db->get()->row()->val;

		if ($result) {
			return true;
		} else {
			return false;

		}

	}

	public function get_emp_list($begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->select('o.obj_id AS obj_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS emp_code');
		$this->db->select('a.long_name AS fullname');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS emp_begin');
		$this->db->select('o.end AS emp_end');

		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'P');
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
	
		$this->db->join('om_obj_attr a', 'a.obj_id = o.obj_id');
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");

		
		return $this->db->get()->result();
	}

	public function get_hold_list($emp_code='',$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->select('obj_id');
		$this->db->from('om_obj_attr');
		$this->db->where('short_name', $emp_code);
		$emp_id = $this->db->get()->row()->obj_id;

		$this->db->select('o.obj_id AS post_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS post_code');
		$this->db->select('a.long_name AS post_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS post_begin');
		$this->db->select('o.end AS post_end');
		$this->db->select('r.begin AS rel_begin');
		$this->db->select('r.end AS rel_end');
		$this->db->select('r.value AS rel_value');
		$this->db->select('r.rel_id');

		$this->db->from('om_obj_rel r');
		$this->db->join('om_obj o', 'o.obj_id = r.obj_from');
		$this->db->join('om_obj_attr a', 'a.obj_id = o.obj_id');

		$this->db->where('r.rel_type', '008');
		$this->db->where('o.obj_type', 'S');
		$this->db->where('r.obj_to', $emp_id);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		$this->db->order_by('r.value', 'desc');
		$this->db->order_by('r.end', 'desc');
		$this->db->order_by('r.begin', 'desc');

		
		return $this->db->get()->result();
		
	}

	public function get_org_chief_ls($emp_code='',$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$temp = $this->get_hold_list($emp_code,$begin,$end);
		$org = array();
		// var_dump($temp);
		foreach ($temp as $row) {
			$is_chief = $this->count_obj_rel($row->post_id,'A',array('012'),$begin,$end);

			if ($is_chief) {
				$org_id = $this->get_obj_rel_last($row->post_id,'A',array('012'),$begin,$end)->obj_from;
				
				$org[]  = $this->get_org_row($org_id,$begin,$end);
			}
		}

		return $org;
	}

	public function get_emp_row($emp_code=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->select('o.obj_id AS obj_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS emp_code');
		$this->db->select('a.long_name AS fullname');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS emp_begin');
		$this->db->select('o.end AS emp_end');
		$this->db->select('su.email AS email');
		$this->db->select('su.phone AS phone');

		$this->db->from('om_obj_attr a');
		$this->db->join('om_obj o', 'a.obj_id = o.obj_id');
		$this->db->join('sys_user su', 'a.short_name = su.username');
		$this->db->limit(1);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");
		$this->db->where('o.obj_type', 'P');
		$this->db->where('a.short_name', $emp_code);
		$this->db->order_by('a.end', 'desc');
		$this->db->order_by('o.end', 'desc');
		$this->db->order_by('a.begin', 'desc');
		$this->db->order_by('o.begin', 'desc');
		return $this->db->get()->row();
	}

	public function add_emp($fullname='',$emp_code='',$begin='',$end='$end')
	{
		$emp_id = $this->add_obj('P',$begin,$end);
		$this->add_obj_attr($emp_id,$emp_code,$fullname,$begin,$end);
		// $this->add_obj_rel('008',$post_id,$emp_id,$begin,$end);
		
	}

	public function correct_emp($emp_code='',$fullname='',$join_date='',$end_date='')
	{
		$this->db->select('obj_id');
		$this->db->where('short_name', $emp_code);
		$obj_id = $this->db->get('om_obj_attr', 1)->row()->obj_id;

		$attr = array(
			'long_name' => $fullname,
			'begin'     => $join_date,
			'end'       => $end_date
		);

		$this->db->where('short_name', $emp_code);
		$this->db->update('om_obj_attr', $attr);

		$attr = array(
			'begin'     => $join_date,
			'end'       => $end_date
		);
		$this->db->where('obj_id', $obj_id);
		$this->db->update('om_obj', $attr);
		
	}

	public function add_emp_post($emp_code=0,$post_id=0,$begin='',$end='',$value=1)
	{
		$this->db->select('obj_id');
		$this->db->from('om_obj_attr');
		$this->db->where('short_name', $emp_code);
		$emp_id = $this->db->get()->row()->obj_id;
		$this->add_obj_rel('008',$post_id,$emp_id,$begin,$end,$value);

	}

	public function correct_emp_post($emp_id=0,$old_post_id=0,$new_post_id=0,$begin='',$end='$end')
	{
		$object = array(
			'r.obj_to' => $new_post_id,
			'begin'    => $begin,
			'end'      => $end
		);

		$this->db->where("((r.begin >= '1900-01-01' AND r.end <='$end') OR 
					(r.end >= '1900-01-01' AND r.end <= '$end') OR 
					(r.begin >= '1900-01-01' AND r.begin <='$end' ) OR
					(r.begin <= '1900-01-01' AND r.end >= '$end'))");
		
		$this->db->where('rel_type', '008');

		$this->db->where('r.obj_from', $emp_id);
		$this->db->where('r.obj_to', $old_post_id);

		$this->db->update('om_obj_rel', $object);

	}

	public function update_emp_post($emp_id=0,$old_post_id=0,$new_post_id=0,$begin='',$end='$end')
	{
		$this->db->select('r.rel_id');
		$this->db->from('om_obj_rel r');
		$this->db->where("((r.begin >= '1900-01-01' AND r.end <='$end') OR 
					(r.end >= '1900-01-01' AND r.end <= '$end') OR 
					(r.begin >= '1900-01-01' AND r.begin <='$end' ) OR
					(r.begin <= '1900-01-01' AND r.end >= '$end'))");
		
		$this->db->where('rel_type', '008');

		$this->db->where('r.obj_from', $emp_id);
		$this->db->where('r.obj_to', $post_id);
				
		$this->db->order_by('r.end', 'desc');
		$this->db->order_by('r.begin', 'desc');

		$rel_id    = $this->db->get()->row()->rel_id;
		$prev_date = date('Y-m-d', strtotime($begin .' -1 day'));

		$this->delimit_obj_rel($rel_id,$prev_date);

		$this->add_emp_post($emp_id,$new_post_id,$begin,$end);
	}

	public function delimit_emp_post($emp_id=0,$post_id=0,$end='$end')
	{
		$this->db->select('r.rel_id');
		$this->db->from('om_obj_rel r');
		$this->db->where("((r.begin >= '1900-01-01' AND r.end <='$end') OR 
					(r.end >= '1900-01-01' AND r.end <= '$end') OR 
					(r.begin >= '1900-01-01' AND r.begin <='$end' ) OR
					(r.begin <= '1900-01-01' AND r.end >= '$end'))");
		
		$this->db->where('rel_type', '008');

		$this->db->where('r.obj_from', $emp_id);
		$this->db->where('r.obj_to', $post_id);
				
		$this->db->order_by('r.end', 'desc');
		$this->db->order_by('r.begin', 'desc');

		$rel_id = $this->db->get()->row()->rel_id;

		$this->delimit_obj_rel($rel_id,$end);
	}

	public function delimit_emp($emp_id=0,$end='$end')
	{
		$object = array('end' => $end);

		$attr = $this->get_obj_attr_last($emp_id,'2008-01-01','$end');
		$this->db->where('attr_id', $attr->attr_id);
		$this->db->update('om_obj_attr', $object);

		$post_ls = $this->get_hold_list($emp_id);
		foreach ($post_ls as $post) {
			$this->db->where('r.obj_from', $emp_id);
			$this->db->where('r.obj_to', $post->post_id);
			$this->db->update('om_obj_rel', $object);

		}

		$this->db->where('obj_id', $emp_id);
		$this->db->update('om_obj', $object);

	}

	public function remove_emp($emp=0,$type='id')
	{
		switch (strtolower($type)) {
			case 'id':
				$id = $emp;
				break;
			case 'code':
				$this->db->select('a.obj_id');
				$this->db->from('om_obj o');
				$this->db->join('om_obj_attr a', 'o.obj_id = a.obj_id');
				$this->db->where('o.obj_type', 'P');
				$this->db->where('a.short_name', $emp);

				$id = $this->db->get()->row()->obj_id;
				break;
			default:
				$this->db->select('a.obj_id');
				$this->db->from('om_obj o');
				$this->db->join('om_obj_attr a', 'o.obj_id = a.obj_id');
				$this->db->where('o.obj_type', 'P');
				$this->db->where('a.short_name', $emp);

				$id = $this->db->get()->row()->obj_id;
				break;	
		}
		// DO remove all relation
		$this->db->where('obj_to', $id);
		$this->db->or_where('obj_from', $id);
		$this->db->delete('om_obj_rel');

		// DO remove all Attrribute
		
		$this->db->where('obj_id', $id);
		$this->db->delete('om_obj_attr');

		// DO remove object
		$this->remove_obj($id);
	}

	/////////////////////////
	// REPORTING STRUCTURE //
	/////////////////////////
	
	public function count_superior($sub_post=0,$begin='',$end='')
	{

		$this->db->from('om_obj_rel r1');
		$this->db->join('om_obj_attr a1', 'r1.obj_from = a1.obj_id');
		$this->db->join('om_obj_rel r2', 'r1.obj_from = r2.obj_from');
		$this->db->join('om_obj_attr a2', 'r2.obj_to = a2.obj_id');

		$this->db->where('r1.rel_type', '002');
		$this->db->where('r2.rel_type', '008');
		$this->db->where('r1.obj_to', $sub_post);
		$this->db->where("((r1.begin >= '$begin' AND r1.end <='$end') OR 
					(r1.end >= '$begin' AND r1.end <= '$end') OR 
					(r1.begin >= '$begin' AND r1.begin <='$end' ) OR
					(r1.begin <= '$begin' AND r1.end >= '$end'))");
		$this->db->where("((a1.begin >= '$begin' AND a1.end <='$end') OR 
					(a1.end >= '$begin' AND a1.end <= '$end') OR 
					(a1.begin >= '$begin' AND a1.begin <='$end' ) OR
					(a1.begin <= '$begin' AND a1.end >= '$end'))");
		$this->db->where("((r2.begin >= '$begin' AND r2.end <='$end') OR 
					(r2.end >= '$begin' AND r2.end <= '$end') OR 
					(r2.begin >= '$begin' AND r2.begin <='$end' ) OR
					(r2.begin <= '$begin' AND r2.end >= '$end'))");
		$this->db->where("((a2.begin >= '$begin' AND a2.end <='$end') OR 
					(a2.end >= '$begin' AND a2.end <= '$end') OR 
					(a2.begin >= '$begin' AND a2.begin <='$end' ) OR
					(a2.begin <= '$begin' AND a2.end >= '$end'))");
		

		return $this->db->count_all_results();
	}
	
	public function get_superior_list($sub_post=0,$begin='',$end='')
	{
		$check = $this->count_superior($sub_post,$begin,$end);

		if ($check == TRUE) {
			// ADA Pejabatnya
			$this->db->select('r2.begin AS begin');
			$this->db->select('r2.end AS end');
			$this->db->select('r1.obj_from AS post_id');
			$this->db->select('a1.short_name AS post_code');
			$this->db->select('a1.long_name AS post_name');
			$this->db->select('r2.obj_from AS emp_id');
			$this->db->select('a2.short_name AS emp_code');
			$this->db->select('a2.long_name AS emp_name');
			$this->db->select('u.email AS email');
			$this->db->from('om_obj_rel r1');
			$this->db->join('om_obj_attr a1', 'r1.obj_from = a1.obj_id');
			$this->db->join('om_obj_rel r2', 'r1.obj_from = r2.obj_from');
			$this->db->join('om_obj_attr a2', 'r2.obj_to = a2.obj_id');
			$this->db->join('sys_user u', 'a2.short_name = u.username');

			$this->db->where('r1.rel_type', '002');
			$this->db->where('r2.rel_type', '008');
			$this->db->where('r1.obj_to', $sub_post);
			$this->db->where("((r1.begin >= '$begin' AND r1.end <='$end') OR 
						(r1.end >= '$begin' AND r1.end <= '$end') OR 
						(r1.begin >= '$begin' AND r1.begin <='$end' ) OR
						(r1.begin <= '$begin' AND r1.end >= '$end'))");
			$this->db->where("((a1.begin >= '$begin' AND a1.end <='$end') OR 
						(a1.end >= '$begin' AND a1.end <= '$end') OR 
						(a1.begin >= '$begin' AND a1.begin <='$end' ) OR
						(a1.begin <= '$begin' AND a1.end >= '$end'))");
			$this->db->where("((r2.begin >= '$begin' AND r2.end <='$end') OR 
						(r2.end >= '$begin' AND r2.end <= '$end') OR 
						(r2.begin >= '$begin' AND r2.begin <='$end' ) OR
						(r2.begin <= '$begin' AND r2.end >= '$end'))");
			$this->db->where("((a2.begin >= '$begin' AND a2.end <='$end') OR 
						(a2.end >= '$begin' AND a2.end <= '$end') OR 
						(a2.begin >= '$begin' AND a2.begin <='$end' ) OR
						(a2.begin <= '$begin' AND a2.end >= '$end'))");
			$this->db->order_by('r1.end', 'desc');
			$this->db->order_by('r2.end', 'desc');
			$this->db->order_by('a1.end', 'desc');
			$this->db->order_by('a2.end', 'desc');

			return $this->db->get()->result();

		} else {

			$this->db->select('r1.obj_from AS post_id');
			
			$this->db->from('om_obj_rel r1');
			$this->db->join('om_obj_attr a1', 'r1.obj_from = a1.obj_id');
			

			$this->db->where('r1.rel_type', '002');

			$this->db->where('r1.obj_to', $sub_post);
			$this->db->where("((r1.begin >= '$begin' AND r1.end <='$end') OR 
						(r1.end >= '$begin' AND r1.end <= '$end') OR 
						(r1.begin >= '$begin' AND r1.begin <='$end' ) OR
						(r1.begin <= '$begin' AND r1.end >= '$end'))");
			$this->db->where("((a1.begin >= '$begin' AND a1.end <='$end') OR 
						(a1.end >= '$begin' AND a1.end <= '$end') OR 
						(a1.begin >= '$begin' AND a1.begin <='$end' ) OR
						(a1.begin <= '$begin' AND a1.end >= '$end'))");
			
			$this->db->order_by('r1.end', 'desc');

			$this->db->order_by('a1.end', 'desc');

			$temp_post = $this->db->get()->row()->post_id;
			return $this->get_superior_ls($temp_post,$begin,$end);
		}
	}

	
	public function get_subordinate_filled_list($sup_post=0,$begin='',$end='')
	{
		$this->db->select('r1.obj_to AS post_id');
		$this->db->select('a1.short_name AS post_code');
		$this->db->select('a1.long_name AS post_name');
		$this->db->select('r2.begin AS begin');
		$this->db->select('r2.end AS end');
		$this->db->select('r2.obj_from AS emp_id');
		$this->db->select('a2.short_name AS emp_code');
		$this->db->select('a2.long_name AS emp_name');
		$this->db->select('u.email AS email');
		$this->db->from('om_obj_rel r1');
		$this->db->where('r1.rel_type', '002');
		$this->db->where('r1.obj_from', $sup_post);
		$this->db->where("((r1.begin >= '$begin' AND r1.end <='$end') OR 
						(r1.end >= '$begin' AND r1.end <= '$end') OR 
						(r1.begin >= '$begin' AND r1.begin <='$end' ) OR
						(r1.begin <= '$begin' AND r1.end >= '$end'))");

		$this->db->join('om_obj_attr a1', 'r1.obj_to = a1.obj_id');
		$this->db->where("((a1.begin >= '$begin' AND a1.end <='$end') OR 
						(a1.end >= '$begin' AND a1.end <= '$end') OR 
						(a1.begin >= '$begin' AND a1.begin <='$end' ) OR
						(a1.begin <= '$begin' AND a1.end >= '$end'))");

		$this->db->join('om_obj_rel r2', 'r1.obj_to = r2.obj_from');
		$this->db->where('r2.rel_type', '008');
		$this->db->where("((r2.begin >= '$begin' AND r2.end <='$end') OR 
						(r2.end >= '$begin' AND r2.end <= '$end') OR 
						(r2.begin >= '$begin' AND r2.begin <='$end' ) OR
						(r2.begin <= '$begin' AND r2.end >= '$end'))");

		$this->db->join('om_obj_attr a2', 'r2.obj_to = a2.obj_id');
		$this->db->where("((a2.begin >= '$begin' AND a2.end <='$end') OR 
						(a2.end >= '$begin' AND a2.end <= '$end') OR 
						(a2.begin >= '$begin' AND a2.begin <='$end' ) OR
						(a2.begin <= '$begin' AND a2.end >= '$end'))");

		$this->db->join('sys_user u', 'a2.short_name = u.username');

		$this->db->order_by('r1.end', 'desc');
		$this->db->order_by('a1.end', 'desc');
		$this->db->order_by('r2.end', 'desc');
		$this->db->order_by('a2.end', 'desc');

		return $this->db->get()->result();
	}

	public function get_subordinate_vacant_list($sup_post=0,$begin='',$end='')
	{
		$this->db->select('r1.obj_to AS post_id');
		$this->db->from('om_obj_rel r1');
		$this->db->where('r1.rel_type', '002');
		$this->db->where('r1.obj_from', $sup_post);
		$this->db->where("((r1.begin >= '$begin' AND r1.end <='$end') OR 
						(r1.end >= '$begin' AND r1.end <= '$end') OR 
						(r1.begin >= '$begin' AND r1.begin <='$end' ) OR
						(r1.begin <= '$begin' AND r1.end >= '$end'))");

		$this->db->join('om_obj_attr a1', 'r1.obj_to = a1.obj_id');
		$this->db->where("((a1.begin >= '$begin' AND a1.end <='$end') OR 
						(a1.end >= '$begin' AND a1.end <= '$end') OR 
						(a1.begin >= '$begin' AND a1.begin <='$end' ) OR
						(a1.begin <= '$begin' AND a1.end >= '$end'))");
		$this->db->join('om_obj_rel r2', 'r1.obj_to = r2.obj_from');
		$this->db->where('r2.rel_type', '008');
		$this->db->where("((r2.begin >= '$begin' AND r2.end <='$end') OR 
						(r2.end >= '$begin' AND r2.end <= '$end') OR 
						(r2.begin >= '$begin' AND r2.begin <='$end' ) OR
						(r2.begin <= '$begin' AND r2.end >= '$end'))");
		$this->db->order_by('r1.end', 'desc');
		$this->db->order_by('a1.end', 'desc');
		$this->db->order_by('r2.end', 'desc');

		$filled_ls = $this->db->get()->result();
		$filled_arr = array();
		foreach ($filled_ls as $row) {
			$filled_arr[] = $row->post_id;
		}

		$this->db->select('r1.obj_to AS post_id');
		$this->db->select('a1.short_name AS post_code');
		$this->db->select('a1.long_name AS post_name');

		$this->db->from('om_obj_rel r1');
		$this->db->where('r1.rel_type', '002');
		$this->db->where('r1.obj_from', $sup_post);
		$this->db->where("((r1.begin >= '$begin' AND r1.end <='$end') OR 
						(r1.end >= '$begin' AND r1.end <= '$end') OR 
						(r1.begin >= '$begin' AND r1.begin <='$end' ) OR
						(r1.begin <= '$begin' AND r1.end >= '$end'))");

		$this->db->join('om_obj_attr a1', 'r1.obj_to = a1.obj_id');
		$this->db->where("((a1.begin >= '$begin' AND a1.end <='$end') OR 
						(a1.end >= '$begin' AND a1.end <= '$end') OR 
						(a1.begin >= '$begin' AND a1.begin <='$end' ) OR
						(a1.begin <= '$begin' AND a1.end >= '$end'))");
		$this->db->where_not_in('r1.obj_to', $filled_arr);

		$this->db->order_by('r1.end', 'desc');

		$this->db->order_by('a1.end', 'desc');


		return $this->db->get()->result();
	}

	

	/**
	 * [get_sup_post_row description]
	 * @param  integer $post_id [description]
	 * @param  string  $begin   [description]
	 * @param  string  $end     [description]
	 * @return [type]           [description]
	 */
	public function get_sup_post_row($post_id=0,$begin='',$end='')
	{
		$rel = $this->get_obj_rel_last($post_id,'A','002',$begin,$end);
		return $this->get_post_row($rel->obj_from,$begin,$end);
	}

	/**
	 * [get_sub_post_list description]
	 * @param  integer $post_id [description]
	 * @param  string  $begin   [description]
	 * @param  string  $end     [description]
	 * @return [type]           [description]
	 */
	public function get_sub_post_list($post_id=0,$begin='',$end='',$is_chief=2)
	{

		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->select('o.obj_id AS post_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS post_code');
		$this->db->select('a.long_name AS post_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS post_begin');
		$this->db->select('o.end AS post_end');

		$this->db->from('om_obj o');
		$this->db->where('o.obj_type', 'S');
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
		$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_to');
		$this->db->where('r.obj_from', $post_id);

		$this->db->where('r.rel_type', '002');


		$ls     = $this->db->get()->result();
		switch ($is_chief) {
			case 0:
				$result = array();
				foreach ($ls as $row) {
					$temp = $this->count_obj_rel($row->post_id,'A','012',$begin,$end);
					if (!$temp) {
						$result[] = $row;
					}
				}
				break;
			case 1:
				$result = array();
				foreach ($ls as $row) {
					$temp = $this->count_obj_rel($row->post_id,'A','012',$begin,$end);
					if ($temp) {
						$result[] = $row;
					}
				}
				break;
			default:
				$result = $ls;
				break;
		}
		return $result;
	}
}

/* End of file om_model.php */
/* Location: ./application/models/om_model.php */