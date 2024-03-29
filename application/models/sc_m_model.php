<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_m_model extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////
// PERIOD                                                                        //
// ----------------------------------------------------------------------------- //
///////////////////////////////////////////////////////////////////////////////////

	public function count_period($begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->select('COUNT(*) AS val');
		$this->db->from('sc_m_period p');
		$this->db->where("((p.begin >= '$begin' AND p.end <='$end') OR 
					(p.end >= '$begin' AND p.end <= '$end') OR 
					(p.begin >= '$begin' AND p.begin <='$end' ) OR
					(p.begin <= '$begin' AND p.end >= '$end'))");

		return $this->db->get()->row()->val;

	}

	public function get_period_list($begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = $begin;
		}

		$this->db->from('sc_m_period p');
		$this->db->where("((p.begin >= '$begin' AND p.end <='$end') OR 
					(p.end >= '$begin' AND p.end <= '$end') OR 
					(p.begin >= '$begin' AND p.begin <='$end' ) OR
					(p.begin <= '$begin' AND p.end >= '$end'))");

		return $this->db->get()->result();
	}

	public function get_period_row($code='')
	{
		$this->db->from('sc_m_period p');
		$this->db->where('p.period_code', $code);
		return $this->db->get()->row();
	}	

	public function add_period($code='',$begin='',$end='')
	{
		$object = array(
			'period_code' => $code,
			'begin'       => $begin,
			'end'         => $end);
		$this->db->insert('sc_m_period', $object);
		return $this->db->insert_id();
	}

	public function edit_period($code='',$begin='',$end='')
	{
		$object = array(
			'begin'       => $begin,
			'end'         => $end);
		$this->db->where('period_code', $code);
		$this->db->update('sc_m_period', $object);
	}

	public function remove_period($code='')
	{
		$this->db->where('period_code', $code);
		$this->db->delete('sc_m_period');
	}
// -----------------------------------------------------------------------------

///////////////////////////////////////////////////////////////////////////////////
// PERSPECTIVE                                                                   //
// ----------------------------------------------------------------------------- //
///////////////////////////////////////////////////////////////////////////////////
	
	public function get_perspective_list()
	{
		$this->db->select('perspective_code as persp_code');
		$this->db->select('icon as persp_icon');
		$this->db->select('description as persp_desc');
		$this->db->from('sc_m_perspective per');
		$this->db->order_by('order_val');
		return $this->db->get()->result();
	}

	public function get_perspective_row($code='')
	{
		$this->db->select('perspective_code as persp_code');
		$this->db->select('icon as persp_icon');
		$this->db->select('description as persp_desc');
		$this->db->from('sc_m_perspective per');
		$this->db->where('per.perspective_code', $code);
		return $this->db->get()->row();
	}

	public function add_perspective($code='',$desc='')
	{
		$object = array(
			'perspective_code' => $code,
			'description'      => $desc);
		$this->db->insert('sc_m_perspective', $object);
		return $this->db->insert_id();
	}

	public function edit_perspective($code='',$desc='')
	{
		$object = array(
			'description'      => $desc);
		$this->db->where('per.perspective_code', $code);
		$this->db->update('sc_m_perspective', $object);
	}

	public function remove_perspective($code='')
	{
		$this->db->where('per.perspective_code', $code);
		$this->db->delete('sc_m_perspective', $object);
	}

// -----------------------------------------------------------------------------

///////////////////////////////////////////////////////////////////////////////////
// MEASURE                                                                       //
// ----------------------------------------------------------------------------- //
///////////////////////////////////////////////////////////////////////////////////

	public function get_measure_list()
	{
		$this->db->from('sc_m_measure m');
		return $this->db->get()->result();
	}

	public function get_measure_row($id=0)
	{
		$this->db->where('m.measure_id', $id);
		$this->db->from('sc_m_measure m');
		return $this->db->get()->row();
	}

	public function add_measure($short_name='',$long_name='',$desc='',$real_num=0,$has_min=0,$min_val=NULL,$has_max=0,$max_val=NULL)
	{
		$object = array(
			'short_name' => $short_name,
			'long_name' => $long_name,
			'description' => $desc,
			'has_min' => $has_min,
			'has_max' => $has_max,
			'real_num' => $real_num);
		if ($has_min) {
			$object['min_val'] = $min_val;
		}
		if ($has_max) {
			$object['max_val'] = $max_val;
		}
		$this->db->insert('sc_m_measure', $object);
		return $this->db->insert_id();
	}

	public function edit_measure($id=0,$short_name='',$long_name='',$desc='',$real_num=0,$has_min=0,$min_val=NULL,$has_max=0,$max_val=NULL)
	{
		$object = array(
			'short_name' => $short_name,
			'long_name' => $long_name,
			'description' => $desc,
			'has_min' => $has_min,
			'has_max' => $has_max,
			'real_num' => $real_num);
		if ($has_min) {
			$object['min_val'] = $min_val;
		}
		if ($has_max) {
			$object['max_val'] = $max_val;
		}
		$this->db->where('measure_id', $id);
		$this->db->update('sc_m_measure', $object);
	}

	public function remove_measure($id=0)
	{
		$this->db->where('measure_id', $id);
		$this->db->delete('sc_m_measure');
	}
// -----------------------------------------------------------------------------

///////////////////////////////////////////////////////////////////////////////////
// YEAR TO DATE                                                                  //
// ----------------------------------------------------------------------------- //
///////////////////////////////////////////////////////////////////////////////////

	public function get_ytd_list()
	{
		$this->db->from('sc_m_ytd');
		return $this->db->get()->result();
	}

	public function get_ytd_row($code='')
	{
		$this->db->from('sc_m_ytd');
		$this->db->where('ytd_code', $code);
		return $this->db->get()->row();
	}

// -----------------------------------------------------------------------------

///////////////////////////////////////////////////////////////////////////////////
// Refrence Type                                                                 //
// ----------------------------------------------------------------------------- //
///////////////////////////////////////////////////////////////////////////////////

	public function get_ref_list()
	{
		$this->db->from('sc_m_ref');
		return $this->db->get()->result();
	}

	public function get_ref_row($code='')
	{
		$this->db->from('sc_m_ref');
		$this->db->where('ytd_code', $code);
		return $this->db->get()->row();
	}

// -----------------------------------------------------------------------------


///////////////////////////////////////////////////////////////////////////////////
// FORMULA                                                                       //
// ----------------------------------------------------------------------------- //
///////////////////////////////////////////////////////////////////////////////////

	public function get_formula_list($begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->from('sc_m_formula f');
		$this->db->where("((f.begin >= '$begin' AND f.end <='$end') OR 
					(f.end >= '$begin' AND f.end <= '$end') OR 
					(f.begin >= '$begin' AND f.begin <='$end' ) OR
					(f.begin <= '$begin' AND f.end >= '$end'))");
		return $this->db->get()->result();
	}

	public function get_formula_row($id=0)
	{
		$this->db->from('sc_m_formula f');
		$this->db->where('f.formula_id', $id);
		return $this->db->get()->row();
	}

	public function add_formula($formula_name='',$description='',$type=0,$begin='',$end='9999-12-31')
	{
		$object = array(
			'formula_name' => $formula_name,
			'description'  => $description,
			'type'         => $type,
			'begin'        => $begin,
			'end'          => $end);
		$this->db->insert('sc_m_formula', $object);

		return $this->db->insert_id();
	}

	public function edit_formula($id='',$formula_name='',$description='',$type=0,$begin='',$end='9999-12-31')
	{
		$object = array(
			'formula_name' => $formula_name,
			'description'  => $description,
			'type'         => $type,
			'begin'        => $begin,
			'end'          => $end);
		$this->db->where('formula_id', $id);
		$this->db->update('sc_m_formula', $object);
	}

	public function delimit_formula($id=0,$end='9999-12-31')
	{
		$object = array('end' => $end);
		$this->db->where('formula_id', $id);
		$this->db->update('sc_m_formula ', $object);
	}

	public function remove_formula($id=0)
	{
		$this->db->where('formula_id', $id);
		$this->db->delete('sc_m_formula');
	}

	public function get_formula_score_list($formula_id=0)
	{
		$this->db->select('fs.*');
		$this->db->select('s.color');
		$this->db->from('sc_m_formula_score fs');
		$this->db->join('sc_m_score s', 'fs.pc_score = s.pc_score', 'inner');
		$this->db->where('fs.formula_id', $formula_id);
		$this->db->order_by('fs.lower', 'asc');
		return $this->db->get()->result();
	}

	public function get_formula_score_row($id=0)
	{
		$this->db->select('fs.*');
		$this->db->select('s.color');
		$this->db->from('sc_m_formula_score fs');
		$this->db->join('sc_m_score s', 'fs.pc_score = s.pc_score', 'inner');
		$this->db->where('fs.score_id', $id);
		return $this->db->get()->row();

	}

	public function add_formula_score($formula_id=0,$pc_score=0,$lower=NULL,$upper=NULL)
	{
		$object = array(
			'formula_id' => $formula_id,
			'pc_score' => $pc_score,
			'lower' => $lower,
			'upper' => $upper);
		$this->db->insert('sc_m_formula_score', $object);
		return $this->db->insert_id();
	}

	public function edit_formula_score($id=0,$pc_score=0,$lower=NULL,$upper=NULL)
	{
		$object = array(
			'pc_score' => $pc_score,
			'lower' => $lower,
			'upper' => $upper);
		$this->db->where('fs.score_id', $id);
		$this->db->update('sc_m_formula_score fs', $object);
	}

	public function remove_formula_score($id=0)
	{
		$this->db->where('fs.score_id', $id);
		$this->db->delete('sc_m_formula_score fs');

	}

// -----------------------------------------------------------------------------

///////////////////////////////////////////////////////////////////////////////////
// PC SCORE                                                                      //
// ----------------------------------------------------------------------------- //
///////////////////////////////////////////////////////////////////////////////////

	public function count_score($formula_id=0)
	{
		$this->db->select('COUNT(*) AS val');
		$this->db->where('formula_id', $formula_id);
		$this->db->from('sc_m_score');
		return $this->db->get()->row()->val;	
	}

	public function count_score_pc($formula_id=0,$pc_score)
	{
		$this->db->select('COUNT(*) AS val');
		$this->db->where('formula_id', $formula_id);
		$this->db->where('pc_score', $pc_score);
		$this->db->from('sc_m_score');
		return $this->db->get()->row()->val;
	}

	public function get_score_list()
	{
		$this->db->from('sc_m_score');
		return $this->db->get()->result();
	}

	public function get_score_row($pc_score=0)
	{
		$this->db->where('pc_score', $pc_score);
		$this->db->from('sc_m_score');
		return $this->db->get()->row();	
	}

// -----------------------------------------------------------------------------

}

/* End of file sc_m_model.php */
/* Location: ./application/models/sc_m_model.php */