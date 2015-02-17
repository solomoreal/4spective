<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Org extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('om_model');
	}

	public function index()
	{
		redirect('admin/org_struc');
	}

	public function add()
	{
		$parent_id = $this->input->post('parent');
	}

	public function add_process()
	{
		# code...
	}

	public function edit()
	{
		$org_id = $this->input->post('org_id');

	}

	public function edit_process()
	{
		# code...
	}

	public function delete()
	{
		$org_id = $this->input->post('org_id');
		
	}

	public function delete_process()
	{
		# code...
	}

}

/* End of file org.php */
/* Location: ./application/controllers/admin/org.php */