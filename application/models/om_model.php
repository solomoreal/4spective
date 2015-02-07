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
			$end = date('Y-m-d');
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

	/**
	 * [Obtain OM Object records ]
	 * @param  array  $type  [description]
	 * @param  string $begin [description]
	 * @param  string $end   [description]
	 * @return [type]        [description]
	 */
	public function get_obj_list($type=array(),$begin='',$end='',$limit=0,$offset=0,$search='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$columns = array('o.obj_id','o.begin','o.end');
		
		$this->db->from('om_obj o');

		$this->db->where_in('o.obj_type', $type);
		$this->db->where("((o.begin >= '$begin' AND o.end <='$end') OR 
					(o.end >= '$begin' AND o.end <= '$end') OR 
					(o.begin >= '$begin' AND o.begin <='$end' ) OR
					(o.begin <= '$begin' AND o.end >= '$end'))");
		
		if ($limit>0) {
			$this->db->limit($limit,$offset);
		}

		if ($search!='') {
			$this->db->or_like($columns,$search);
		}
		return $this->db->get()->result();
	}

	/**
	 * [Obtain OM Object's Attribute records]
	 * @param  integer $obj_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_obj_attr_list($obj_id=0,$begin='',$end='',$limit=0,$offset=0,$search='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$columns = array('a.attr_id','a.obj_id','a.short_name','a.long_name','a.begin','a.end');

		$this->db->from('om_obj a');
		$this->db->where_in('a.obj_id', $obj_id);
		$this->db->where("((a.begin >= '$begin' AND a.end <='$end') OR 
					(a.end >= '$begin' AND a.end <= '$end') OR 
					(a.begin >= '$begin' AND a.begin <='$end' ) OR
					(a.begin <= '$begin' AND a.end >= '$end'))");

		if ($limit>0) {
			$this->db->limit($limit,$offset);
		}

		if ($search!='') {
			$this->db->or_like($columns,$search);
		}
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
	public function get_obj_rel_list($obj_id=0,$direction='all',$rel_type=array(),$begin='',$end='',$limit=0,$offset=0,$search='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$columns = array('r.rel_id','r.direction','r.rel_type','r.obj_from','r.obj_to','r.value','r.begin','r.end');
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

		if ($limit>0) {
			$this->db->limit($limit,$offset);
		}

		if ($search!='') {
			$this->db->or_like($columns,$search);
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
			$end = date('Y-m-d');
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
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	/**
	 * [Adding OM Object record]
	 * @param string $obj_type [description]
	 * @param string $begin    [description]
	 * @param string $end      [description]
	 */
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

	/**
	 * [Editing OM Object record]
	 * @param  integer $obj_id [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function edit_obj($obj_id=0,$begin='2008-01-01',$end='9999-12-31')
	{
		$object = array(
			'begin'    => $begin,
			'end'      => $end
		);
		$this->db->where('obj_id', $obj_id);
		$this->db->update('om_obj', $object);
	}

	public function delimit_obj($obj_id=0,$end='9999-12-31')
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
	public function add_obj_attr($obj_id=0,$short_name='',$long_name='',$begin='2008-01-01',$end='9999-12-31')
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
	public function edit_obj_attr($attr_id=0,$short_name='',$long_name='',$begin='2008-01-01',$end='9999-12-31')
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

	public function delimit_obj_attr($attr_id=0,$end='9999-12-31')
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

	public function add_obj_rel($direction='',$rel_type='',$obj_from=0,$obj_to=0,$begin='2008-01-01',$end='9999-12-31',$value=NULL)
	{
		$object = array(
			'direction' => $direction,
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

	public function edit_obj_rel($rel_id=0,$begin='2008-01-01',$end='9999-12-31',$value=NULL)
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

	public function delimit_obj_rel($rel_id=0,$end='9999-12-31')
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

	/**
	 * [Obtain Organization Records]
	 * @param  integer $parent [description]
	 * @param  string  $begin  [description]
	 * @param  string  $end    [description]
	 * @return [type]          [description]
	 */
	public function get_org_list($parent=0,$begin='',$end='',$limit=0,$offset=0,$search='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$columns = array('o.obj_id','o.obj_type','a.attr_id','a.short_name','a.long_name','a.begin','a.end','o.begin','o.end');

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

		if ($limit>0) {
			$this->db->limit($limit,$offset);
		}

		if ($search!='') {
			$this->db->or_like($columns,$search);
		}
		return $this->db->get()->result();
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

	/**
	 * [Adding Organization ]
	 * @param string  $post_code   [description]
	 * @param string  $post_name   [description]
	 * @param integer $post_parent [description]
	 * @param string  $begin      [description]
	 * @param string  $end        [description]
	 */
	public function add_org($org_code='',$org_name='',$org_parent=0,$begin='2008-01-01',$end='9999-12-31')
	{
		$obj_id = $this->add_obj('O',$begin,$end);
		$this->add_obj_attr($obj_i,$org_code,$org_name,$begin,$end);

		if ($org_parent>0) {
			$this->add_obj_rel('A','002',$obj_id,$obj_parent,$begin,$end);
			$this->add_obj_rel('B','002',$obj_parent,$ob_id,$begin,$end);
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
	public function correct_org($org_id=0,$org_code='',$org_name='',$begin='',$end='9999-12-31')
	{
		$attr = $this->get_obj_attr_last($org_id,'2008-01-01','9999-12-31');
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
	public function update_org($org_id=0,$org_code='',$org_name='',$begin='',$end='9999-12-31')
	{
		$attr = $this->get_obj_attr_last($org_id,'2008-01-01','9999-12-31');
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
		$attr = $this->get_obj_attr_last($org_id,'2008-01-01','9999-12-31');
		$this->delimit_obj_attr($attr->attr_id,$end);

		$rel_types = array('002','003','011','012');
		foreach ($rel_types as $key => $rel_type) {
			
			$rel_A = $this->get_obj_rel_last($org_id,'A',$rel_type,'2008-01-01','9999-12-31');
			$this->delimit_obj_rel($rel_A->rel_id,$end);

			$rel_B = $this->get_obj_rel_last($org_id,'B',$rel_type,'2008-01-01','9999-12-31');
			$this->delimit_obj_rel($rel_B->rel_id,$end);
		}
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
			$end = date('Y-m-d');
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
		$this->db->where('r.direction', 'A');
		$this->db->where('r.rel_type', '003');
		return $this->db->get()->row()->val;
	}

	public function get_post_list($org_id=0,$begin='',$end='',$limit=0,$offset=0,$search='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$columns = array('o.obj_id','o.obj_type','a.attr_id','a.short_name','a.long_name','a.begin','a.end','o.begin','o.end');		
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
		$this->db->join('om_obj_rel r', 'o.obj_id = r.obj_from');
		$this->db->where('r.obj_to', $org_id);
		$this->db->where('r.direction', 'A');
		$this->db->where('r.rel_type', '003');
		if ($limit>0) {
			$this->db->limit($limit,$offset);
		}
		if ($search!='') {
			$this->db->or_like($columns,$search);
		}
		return $this->db->get()->result();
	}

	public function get_post_row($post_id=0,$begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
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
		return $this->get_post_row($rel->obj_to,$begin,$end);
	}

	/**
	 * [get_superior_row description]
	 * @param  integer $post_id [description]
	 * @param  string  $begin   [description]
	 * @param  string  $end     [description]
	 * @return [type]           [description]
	 */
	public function get_superior_row($post_id=0,$begin='',$end='')
	{
		$rel = $this->get_obj_rel_last($post_id,'B','002',$begin,$end);
		return $this->get_post_row($rel->obj_to,$begin,$end);
	}

	/**
	 * [get_subordinate_list description]
	 * @param  integer $post_id [description]
	 * @param  string  $begin   [description]
	 * @param  string  $end     [description]
	 * @return [type]           [description]
	 */
	public function get_subordinate_list($post_id=0,$begin='',$end='',$limit=0,$offset=0,$search='')
	{

		$rel_ls = $this->get_obj_rel_list($post_id,'A','002',$begin,$end,$limit,$offset,$search);
		$result = array();
		foreach ($rel_ls as $row) {
			$result[] = $this->get_post_row($row->obj_from,$begin,$end);
		}
		return $result;
	}

	/**
	 * [Create new Position]
	 * @param integer $org_id    [description]
	 * @param string  $post_code [description]
	 * @param string  $post_name [description]
	 * @param integer $is_chief  [description]
	 * @param string  $begin     [description]
	 * @param string  $end       [description]
	 * @param integer $report_to [description]
	 */
	public function add_post($org_id=0,$post_code='',$post_name='',$is_chief=0,$begin='',$end='9999-12-31',$report_to=0)
	{
		$post_id = $this->add_obj('S',$begin,$end);
		$this->add_obj_attr($post_id,$post_code,$post_name,$begin,$end);
			
		// Relation Belong to
		$this->add_obj_rel('A','003',$post_id,$org_id,$begin,$end);
		$this->add_obj_rel('B','003',$org_id,$post_id,$begin,$end);

		if ($is_chief == 1) {
			//Relation Chief Of			
			$this->add_obj_rel('A','012',$post_id,$org_id,$begin,$end);
			$this->add_obj_rel('B','012',$org_id,$post_id,$begin,$end);

		}

		if ($report_to == 0) {
			if ($is_chief == 1) {
				$org_t = $this->get_obj_rel_last($org_id,'B','002',$begin,$end);
				$org   = $this->get_org_row($org_t->obj_to,$begin,$end);
				$chief = $this->get_chief_row($org->org_id,$begin,$end);

			} else {
				$chief = $this->get_chief_row($org_id,$begin,$end);
			}
			$report_to = $chief->post_id;
		}
		// Relation Report to
		$this->add_obj_rel('A','002',$post_id,$report_to,$begin,$end);
		$this->add_obj_rel('B','002',$report_to,$post_id,$begin,$end);
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
	public function correct_post($post_id=0,$post_code='',$post_name='',$begin='',$end='9999-12-31')
	{
		$attr = $this->get_obj_attr_last($post_id,'2008-01-01','9999-12-31');
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
	public function update_post($post_id=0,$post_code='',$post_name='',$begin='',$end='9999-12-31')
	{
		$attr = $this->get_obj_attr_last($org_id,'2008-01-01','9999-12-31');
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
		$attr = $this->get_obj_attr_last($post_id,'2008-01-01','9999-12-31');
		$this->delimit_obj_attr($attr->attr_id,$end);

		$rel_types = array('002','003','011','012');
		foreach ($rel_types as $key => $rel_type) {
			
			$rel_A = $this->get_obj_rel_last($post_id,'A',$rel_type,'2008-01-01','9999-12-31');
			$this->delimit_obj_rel($rel_A->rel_id,$end);

			$rel_B = $this->get_obj_rel_last($post_id,'B',$rel_type,'2008-01-01','9999-12-31');
			$this->delimit_obj_rel($rel_B->rel_id,$end);
		}
	}

	/////////////
	// HOLDER //
	/////////////
	
	public function get_holder_list($post_id=0,$begin='',$end='',$limit=0,$offset=0,$search='')
	{
		$columns = array('e.firstname','e.middlename','e.lastname','e.nickname','e.emp_id','r.begin','r.end','r.value');
		$this->db->select('e.firstname');
		$this->db->select('e.middlename');
		$this->db->select('e.lastname');
		$this->db->select('e.nickname');
		$this->db->select('e.emp_id');
		$this->db->select('r.begin AS hold_begin');
		$this->db->select('r.end AS hold_end');
		$this->db->select('r.value');
		$this->db->from('pa_employee e');
		$this->db->join('om_obj_rel r', 'r.obj_to = e.emp_id', 'inner');
		$this->db->where('r.direction', 'B');
		$this->db->where('r.rel_type', '008');
		$this->db->where('r.obj_from', $post_id);
		$this->db->where("((e.begin >= '$begin' AND e.end <='$end') OR 
					(e.end >= '$begin' AND e.end <= '$end') OR 
					(e.begin >= '$begin' AND e.begin <='$end' ) OR
					(e.begin <= '$begin' AND e.end >= '$end'))");
		$this->db->where("((r.begin >= '$begin' AND r.end <='$end') OR 
					(r.end >= '$begin' AND r.end <= '$end') OR 
					(r.begin >= '$begin' AND r.begin <='$end' ) OR
					(r.begin <= '$begin' AND r.end >= '$end'))");
		if ($limit>0) {
			$this->db->limit($limit,$offset);
		}
		if ($search!='') {
			$this->db->or_like($columns,$search);
		}
		return $this->db->get()->result();
	}

	public function get_holding_list($emp_id=0,$begin='',$end='',$limit=0,$offset=0,$search='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}

		$columns = array('o.obj_id','o.obj_type','a.attr_id','a.short_name','a.long_name','a.begin','a.end','o.begin','o.end','r.begin','r.end');		
		$this->db->select('o.obj_id AS post_id');
		$this->db->select('o.obj_type as type');
		$this->db->select('a.attr_id');
		$this->db->select('a.short_name AS post_code');
		$this->db->select('a.long_name AS post_name');
		$this->db->select('a.begin AS attr_begin');
		$this->db->select('a.end AS attr_end');
		$this->db->select('o.begin AS post_begin');
		$this->db->select('o.end AS post_end');
		$this->db->select('r.begin AS hold_begin');
		$this->db->select('r.end AS hold_end');
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
		$this->db->where('r.obj_to', $emp_id);
		$this->db->where('r.direction', 'A');
		$this->db->where('r.rel_type', '008');

		if ($limit>0) {
			$this->db->limit($limit,$offset);
		}
		if ($search!='') {
			$this->db->or_like($columns,$search);
		}
		return $this->db->get()->result();
	}
}

/* End of file om_model.php */
/* Location: ./application/models/om_model.php */