<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('login_user') == FALSE) {
      redirect('account/login');
    }

  }

	public function index()
	{
		if ($this->user_model->check_privilege($this->session->userdata('login_user'),'ADMIN') == TRUE) {
			$data['sidemenu'] = 'admin_menu';	
			
		} else {
			$data['sidemenu'] = 'admin_menu';	
			
		}
		$this->load->view('home_view',$data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */