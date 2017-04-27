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

  public function switch_lang($url='')
  {
		$idiom = $this->session->userdata('site_lang');
		if ($idiom == 'en') {
			$this->session->set_userdata('site_lang','id');
		} else {
			$this->session->set_userdata('site_lang','en');

		}
		redirect(str_replace('%7C','/',$url));
  }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
