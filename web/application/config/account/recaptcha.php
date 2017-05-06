<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| reCAPTCHA
|--------------------------------------------------------------------------
|
| reCAPTCHA PHP Library - http://recaptcha.net/plugins/php/
|
| recaptcha_theme	'red' | 'white' | 'blackglass' | 'clean' | 'custom'
*/
$config['recaptcha_public_key'] = "XXX";
$config['recaptcha_private_key'] = "XXX";
$config['recaptcha_theme'] = "white";

if ($_SERVER['SERVER_NAME'] == "www.android-feedback.com")
{
	$config['recaptcha_public_key'] = "XXX";
	$config['recaptcha_private_key'] = "XXX";

}

/* End of file recaptcha.php */
/* Location: ./application/modules/account/config/recaptcha.php */
