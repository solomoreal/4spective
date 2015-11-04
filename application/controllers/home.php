<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['sidemenu'] = 'admin_menu';	
		$this->load->view('home_view',$data);
	}

	public function admin()
	{
		$data['sidemenu'] = 'admin_menu';	
		$this->load->view('home_view',$data);
	}

	public function man()
	{
		$data['sidemenu'] = 'man_menu';	
		$this->load->view('home_view',$data);
	}

	public function hr()
	{
		$data['sidemenu'] = 'hr_menu';	
		$this->load->view('home_view',$data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */