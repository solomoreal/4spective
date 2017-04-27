<?php
class Preload {

  public function languageLoader()
  {
    $_ci = &get_instance();
    $_ci->load->helper('language');
    $langArr = array('act','basic','menu','notif','om','time','number','sc');
    $idiom = $_ci->session->userdata('site_lang');
    if ($idiom == '') {
      $idiom ='en';
    }
    foreach ($langArr as $key => $value) {
      $_ci->lang->load($value,$idiom);
    }
  }
}
