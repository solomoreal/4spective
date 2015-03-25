<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bsc_m_model extends CI_Model {

	/////////////
	// PERIOD //
	/////////////

	public function count_period($begin='',$end='')
	{
		if ($begin == '') {
			$begin = date('Y-m-d');
		}

		if ($end == '') {
			$end = date('Y-m-d');
		}
		$this->db->select('COUNT(*) AS val');
		$this->db->from('bsc_m_period p');
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
			$end = date('Y-m-d');
		}

		$this->db->from('bsc_m_period p');
		$this->db->where("((p.begin >= '$begin' AND p.end <='$end') OR 
					(p.end >= '$begin' AND p.end <= '$end') OR 
					(p.begin >= '$begin' AND p.begin <='$end' ) OR
					(p.begin <= '$begin' AND p.end >= '$end'))");

		return $this->db->get()->result();
	}

	public function get_period_row($code='')
	{
		$this->db->from('bsc_m_period p');
		$this->db->where('p.period_code', $code);
		return $this->db->get()->row();
	}	

	public function add_period($code='',$begin='',$end='')
	{
		$object = array(
			'period_code' => $code,
			'begin'       => $begin,
			'end'         => $end);
		$this->db->insert('bsc_m_period', $object);
		return $this->db->insert_id();
	}

	public function edit_period($code='',$begin='',$end='')
	{
		$object = array(
			'begin'       => $begin,
			'end'         => $end);
		$this->db->where('period_code', $code);
		$this->db->update('bsc_m_period', $object);
	}

	public function remove_period($code='')
	{
		$this->db->where('period_code', $code);
		$this->db->delete('bsc_m_period');
	}
// -----------------------------------------------------------------------------

	////////////////
	// PERSPECTIVE //
	////////////////
	
	public function get_perspective_list()
	{
		$this->db->from('bsc_m_perspective per');
		return $this->db->get()->result();
	}

	public function get_perspective_row($code='')
	{
		$this->db->from('bsc_m_perspective per');
		$this->db->where('per.perspective_code', $code);
		return $this->db->get()->row();
	}

	public function add_perspective($code='',$desc='')
	{
		$object = array(
			'perspective_code' => $code,
			'description'      => $desc);
		$this->db->insert('bsc_m_perspective', $object);
	}

	public function edit_perspective($code='',$desc='')
	{
		$object = array(
			'description'      => $desc);
		$this->db->where('per.perspective_code', $code);
		$this->db->update('bsc_m_perspective', $object);
	}

	public function remove_perspective($code='')
	{
		$this->db->where('per.perspective_code', $code);
		$this->db->delete('bsc_m_perspective', $object);
	}

// -----------------------------------------------------------------------------

	//////////////
	// MEASURE //
	//////////////

	public function get_measure_list()
	{
		$this->db->from('bsc_m_measure m');
		return $this->db->get()->result();
	}

	public function get_measure_row($id=0)
	{
		$this->db->where('m.measure_id', $id);
		$this->db->from('bsc_m_measure m');
		return $this->db->get()->row();
	}

	public function add_measure($short_name='',$long_name='',$desc='',$real_num=0,$has_min=0,$min_val=NULL,$has_max=0,$max_val=NULL)
	{
		$object = array(
			'short_name' => $short_name,
			'long_name' => $long_name,
			'description' => $description,
			'has_min' => $has_min,
			'min_val' => $min_val,
			'has_max' => $has_max,
			'max_val' => $max_val,
			'real_num' => $real_num);
		$this->db->insert('bsc_m_measure', $object);
	}

	public function edit_measure($id=0,$short_name='',$long_name='',$desc='',$real_num=0,$has_min=0,$min_val=NULL,$has_max=0,$max_val=NULL)
	{
		$object = array(
			'short_name' => $short_name,
			'long_name' => $long_name,
			'description' => $description,
			'has_min' => $has_min,
			'min_val' => $min_val,
			'has_max' => $has_max,
			'max_val' => $max_val,
			'real_num' => $real_num);
		$this->db->where('m.measure_id', $id);
		$this->db->update('bsc_m_measure', $object);
	}

	public function remove_measure($id=0)
	{
		$this->db->where('m.measure_id', $id);
		$this->db->delete('bsc_m_measure');
	}
// -----------------------------------------------------------------------------

}

/* End of file bsc_m_model.php */
/* Location: ./application/models/bsc_m_model.php */