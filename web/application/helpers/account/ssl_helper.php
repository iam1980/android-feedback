<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SSL Helpers
 *
 * @author         Choy Peng Kong (pengkong@gmail.com)
 * @credit        Inspired by nevercraft - http://codeigniter.com/forums/viewthread/83154/#454992@package
 * @version        1.0
 * @license        MIT License Copyright (c) 2010
 */

// ------------------------------------------------------------------------


if (! function_exists('is_https_on'))
{
	function is_https_on()
	{
		if (! isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on')
		{
			return FALSE;
		}

		return TRUE;
	}
}

if (! function_exists('use_ssl'))
{
	function use_ssl($turn_on = TRUE)
	{
		$url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$CI =& get_instance();
		if ($turn_on)
		{
			if (! is_https_on() && $_SERVER['HTTP_HOST'] != 'localhost')
			{
				$CI->load->library('session');
				$CI->session->keep_flashdata();
				redirect('https://'.$url, 'location', 301);
				exit;
			}
		}
		else
		{
			if (is_https_on())
			{
				$CI->load->library('session');
				$CI->session->keep_flashdata();
				redirect('http://'.$url, 'location', 301);
				exit;
			}
		}
	}
}


/* End of file ssl_helper.php */
/* Location: ./application/modules/account/helpers/ssl_helper.php */