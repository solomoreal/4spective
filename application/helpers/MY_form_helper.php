<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Text Input Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_input'))
{
	function form_input($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'text', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value, 'id'=>(( ! is_array($data)) ? $data : ''));

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

// ------------------------------------------------------------------------


