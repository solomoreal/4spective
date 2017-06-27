<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

  public function login($input='',$password='')
  {
    $count = $this->count_login($input,$password);
    if ($count == 1) {
      $this->db->from('sys_user');
      $this->db->where("(username = '$input' OR email = '$input')");
      $this->db->where('password', md5($password));
      $user = $this->db->get()->row();

      $this->db->select('long_name');
      $this->db->select('obj_id');
      $this->db->from('om_obj_attr');
      $this->db->where('short_name', $user->username);
      $emp = $this->db->get()->row();

      $sess = array(
        'login_user' => $user->user_id,
        'username'   => $user->username
      );

      if ($emp) {
        $sess['emp_name'] = $emp->long_name;
      } else {
        $sess['emp_name'] = $user->username;
        
      }

      if($this->count_privilege($user->user_id) == 1 && $this->check_privilege($user->user_id,'SA') == TRUE) {
        $sess['sidemenu'] = 'admin_menu';
      } else {
        $sess['sidemenu'] = 'emp_menu';
      }


      $this->session->set_userdata($sess);
      return TRUE;

    } else {
      return FALSE;
    }
  }

  public function count_login($input='',$password='')
  {
    $this->db->select('count(*) as val');
    $this->db->from('sys_user');
    $this->db->where("(username = '$input' OR email = '$input')");
    $this->db->where('password', md5($password));
    return $this->db->get()->row()->val;
  }

  public function count_username($username='')
  {
    $this->db->select('count(*) as val');
    $this->db->from('sys_user');
    $this->db->where('username',$username );
    return $this->db->get()->row()->val;
  }

  public function count_email($email='')
  {
    $this->db->select('count(*) as val');
    $this->db->from('sys_user');
    $this->db->where('email',$email );
    return $this->db->get()->row()->val;
  }

  public function get_list($is_active=2)
  {
    $this->db->from('sys_user u');

    if ($is_active == 0 OR $is_active == 1) {
      $this->db->where('u.is_active', $is_active);
    }
    return $this->db->get()->result();
  }

  public function get_row($user_id=0)
  {
    $this->db->from('sys_user');
    $this->db->where('user_id', $user_id);
    return $this->db->get()->row();
  }

  public function get_username_row($username='')
  {
    $this->db->from('sys_user');
    $this->db->where('username', $username);
    return $this->db->get()->row();

  }

  public function add($username='',$password='',$email='',$phone='',$is_active=1)
  {
    $c_user  = $this->count_username($username);
    $c_email = $this->count_email($email);

    if ($c_user == 0 && $c_email == 0) {
      $object = array(
        'username'  => $username,
        'password'  => md5($password),
        'email'     => $email,
        'phone'     => $phone,
        'is_active' => $is_active);
      $this->db->insert('sys_user', $object);

      $user_id = $this->db->insert_id();

      return $user_id;
    } else {
      return FALSE;
    }
  }

  public function edit_contact($user_id=0,$email='',$phone='')
  {
    $old = $this->get_row($user_id);
    $c_email = $this->count_email($email);

    if ($old->email != $email && $c_email > 0) {
      return false;
    } else {
      $object = array(
        'email'     => $email,
        'phone'     => $phone);
      $this->db->where('user_id', $user_id);
      $this->db->update('sys_user', $object);
      return true;
    }
  }

  public function edit_status($user_id=0,$is_active=1)
  {
    $object = array(
        'is_active' => $is_active);
    $this->db->update('sys_user', $object);
    $this->db->where('user_id', $user_id);
    return true;

  }

  public function edit_password($user_id=0,$new_pass)
  {
    $object = array(
      'password'  => md5($new_pass));
    $this->db->update('sys_user', $object);
    $this->db->where('user_id', $user_id);
    return true;

  }

  public function edit_username($user_id=0,$username)
  {
    $c_user  = $this->count_username($username);
    if ($c_user) {
      return false;
    } else {
      $object = array(
        'username'  => $username);
      $this->db->update('sys_user', $object);
      $this->db->where('user_id', $user_id);
      return true;
    }
  }

  /**
   * [remove_user description]
   * @param  string $user [description]
   * @param  string $type [user_id or user_code]
   * @return [type]       [description]
   */
  public function remove_user($user='',$type='id')
  {
    // remove all all privilege
    switch (strtolower($type)) {
      case 'id':
        $this->db->where('user_id', $user);
        break;

      case 'username':
        $this->db->select('user_id');
        $this->db->where('username', $user);
        $user_id = $this->db->get('sys_user')->row()->user_id;

        $this->db->where('user_id', $user_id);

        break;
      
      default:
        $this->db->select('user_id');
        $this->db->where('username', $user);
        $user_id = $this->db->get('sys_user')->row()->user_id;

        break;
    }
    $this->db->delete('sys_user_privilege');

    // remove username
    switch (strtolower($type)) {
      case 'id':
        $this->db->where('user_id', $user);
        break;

      case 'username':
        $this->db->where('username', $user);
        
        break;
      
      default:
        // $this->db->where('user_id', $user);
        $this->db->where('username', $user);
      
        break;
    }

    $this->db->delete('sys_user');
    
  }

  public function count_privilege($user_id=0,$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = $begin;
    }
    $this->db->select('count(*) as val');
    $this->db->from('sys_user_privilege up');
    $this->db->where('user_id', $user_id);
    $this->db->where("((up.begin >= '$begin' AND up.end <='$end') OR 
      (up.end >= '$begin' AND up.end <= '$end') OR 
      (up.begin >= '$begin' AND up.begin <='$end' ) OR
      (up.begin <= '$begin' AND up.end >= '$end'))");
    return $this->db->get()->row()->val;
  }

  public function check_privilege($user_id=0,$role_code='',$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = $begin;
    }
    $this->db->select('count(*) as val');
    $this->db->from('sys_user_privilege up');
    $this->db->where('user_id', $user_id);
    $this->db->where('role_code', $role_code);
    $this->db->where("((up.begin >= '$begin' AND up.end <='$end') OR 
      (up.end >= '$begin' AND up.end <= '$end') OR 
      (up.begin >= '$begin' AND up.begin <='$end' ) OR
      (up.begin <= '$begin' AND up.end >= '$end'))");

    $count = $this->db->get()->row()->val;
    if ($count) {
      return true;
    } else {
      return false;
    }

  }

  public function get_privilege_list($user_id=0,$begin='',$end='')
  {
    if ($begin == '') {
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = date('Y-m-d');
    }

    $this->db->from('sys_user_privilege up');
    $this->db->where('user_id', $user_id);
    $this->db->where("((up.begin >= '$begin' AND up.end <='$end') OR 
      (up.end >= '$begin' AND up.end <= '$end') OR 
      (up.begin >= '$begin' AND up.begin <='$end' ) OR
      (up.begin <= '$begin' AND up.end >= '$end'))");
    return $this->db->get()->result();
  }

  public function get_privilege_user_list($role_code=array(),$begin='',$end='')
  {

    $this->db->from('sys_user_privilege up');
    if (is_array($role_code)) {
      $this->db->where_in('up.role_code', $role_code);
    } else {
      $this->db->where('up.role_code', $role_code);
    }
    $this->db->where("((up.begin >= '$begin' AND up.end <='$end') OR 
      (up.end >= '$begin' AND up.end <= '$end') OR 
      (up.begin >= '$begin' AND up.begin <='$end' ) OR
      (up.begin <= '$begin' AND up.end >= '$end'))");
    return $this->db->get()->result();

  }

  public function get_privilege_row($privilege_id=0)
  {
    $this->db->from('sys_user_privilege up');
    $this->db->where('privilege_id', $privilege_id);
    return $this->db->get()->row();

  }

  public function add_privilege($user_id=0,$role_code='USER',$begin='',$end='9999-12-31')
  {
    $object = array(
      'user_id'   => $user_id,
      'role_code' => $role_code,
      'begin'     => $begin,
      'end'       => $end);
    $this->db->insert('sys_user_privilege', $object);
    return $this->db->insert_id();
  }

  public function delimit_privilege($privilege_id=0,$end='9999-12-31')
  {
    $object = array(
      'end'       => $end);
    $this->db->insert('sys_user_privilege', $object);
    $this->db->where('privilege_id', $privilege_id);

  }

  public function delimit_all_privilege($user_id=0,$end='9999-12-31')
  {
    $object = array(
      'end'       => $end);
    $this->db->insert('sys_user_privilege', $object);
    $this->db->where('user_id', $user_id);
  }

  public function remove_privilege($privilege_id=0)
  {
    $this->db->where('privilege_id', $privilege_id);
    $this->db->delete('sys_user_privilege');
  }

  public function is_chief($emp_code='',$begin='',$end='')
  {
    if($begin==''){
      $begin = date('Y-m-d');
    }

    if ($end == '') {
      $end = $begin;
    }

    $this->db->select('obj_id');
    $this->db->from('om_obj_attr');
    $this->db->where('short_name', $emp_code);
    $temp = $this->db->get()->row();
    if ($temp) {
      $emp_id = $temp->obj_id;
      $this->db->from('om_obj_rel r');
      $this->db->join('om_obj o', 'o.obj_id = r.obj_from');
      $this->db->join('om_obj_attr a', 'a.obj_id = o.obj_id');
      $this->db->join('om_obj_rel r2', 'o.obj_id = r2.obj_to');

      $this->db->where('r.rel_type', '008');
      $this->db->where('r2.rel_type', '012');
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
      $this->db->where("((r2.begin >= '$begin' AND r2.end <='$end') OR 
            (r.end >= '$begin' AND r.end <= '$end') OR 
            (r.begin >= '$begin' AND r.begin <='$end' ) OR
            (r.begin <= '$begin' AND r.end >= '$end'))");
     
      return $this->db->count_all_results();
      
    } else {
      return false;
    }

  }

  public function is_spv($emp_code='',$begin='',$end='')
  {
    if($begin==''){
      $begin = date('Y-m-d');
    }    

    if ($end == '') {
      $end = $begin;
    }

    $this->db->select('obj_id');
    $this->db->from('om_obj_attr');
    $this->db->where('short_name', $emp_code);
    $temp = $this->db->get()->row();
    if ($temp) {
      $emp_id = $temp->obj_id;
      $this->db->select('obj_id');
      $this->db->from('om_obj_attr');
      $this->db->where('short_name', $emp_code);
      $emp_id = $this->db->get()->row()->obj_id;

      $this->db->from('om_obj_rel r');
      $this->db->join('om_obj o', 'o.obj_id = r.obj_from');
      $this->db->join('om_obj_attr a', 'a.obj_id = o.obj_id');
      $this->db->join('om_obj_rel r2', 'o.obj_id = r2.obj_from');

      $this->db->where('r.rel_type', '008');
      $this->db->where('r2.rel_type', '002');
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
      $this->db->where("((r2.begin >= '$begin' AND r2.end <='$end') OR 
            (r.end >= '$begin' AND r.end <= '$end') OR 
            (r.begin >= '$begin' AND r.begin <='$end' ) OR
            (r.begin <= '$begin' AND r.end >= '$end'))");
      return $this->db->count_all_results();
      
    } else {
      return false;
    }


  }


}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */