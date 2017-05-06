<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Iraklis-500R
 * Date: 18/02/13
 * Time: 19:33
 * To change this template use File | Settings | File Templates.
 */

class Service extends CI_Controller {

	function Service()
	{
		parent::__construct();
		$this->load->model('FeedbackItems_model');
		$this->load->model('ResponseItems_model');
		$this->load->model('Api_model');
	}

	public function index()
	{
		$APIVER = $this->uri->segment(2, 0);
		$COMMAND = $this->uri->segment(3, 0);

		switch ($APIVER)
		{
			case 1:
				if (! ($COMMAND == NULL))
				{
					if ($COMMAND == "getPending")
					{
						$UUID = $this->uri->segment(4, 0);
						if (! ($UUID == NULL))
						{
							$responseItem = $this->ResponseItems_model->getPendingResponseByUUID($UUID);
							if(!($responseItem==NULL)){
								$this->output->set_content_type('application/json');
								$this->ResponseItems_model->updateResponseStatus($responseItem->UID, 'delivered');
								//echo json_encode(array('response' => $responseItem->text));
								echo $responseItem->text;
//								$this->output->set_content_type('application/json');
//								$this->output->set_header('Cache-Control: no-cache, must-revalidate');
//								$this->output->set_header('Expires: '.date('r', time()+(86400*365)));
//								$this->output
//									->set_content_type('application/json')
//									->set_output(json_encode(array('response' => $responseItem->text)));
							} else die("");


						}
						else die("UUID not set");
					}
					else die("Unknown Command");


				}
				else
				{
					$raw_json = $this->input->post("json");
					$remote_ip = $ip = $_SERVER['REMOTE_ADDR'];
					$json = json_decode($raw_json);
					//$json = json_decode($myStr);

					if ((! (isset($json->APPUID))) || (! (isset($json->feedback))))
					{

						exit('No direct script access allowed');
					}

					$apikey = $json->APPUID;

					if ($this->Api_model->isValid($apikey))
					{

					}
					else
					{
						exit('Invalid API key');
					}


					foreach ($json->feedback as $feedItem)
					{
						$comment = $feedItem->comment;
						$type = $feedItem->type;
						$ts = $feedItem->ts;
						$model = $feedItem->model;
						$manufacturer = $feedItem->manufacturer;
						$sdk = $feedItem->sdk;
						$pname = $feedItem->pname;
						$uuid = $feedItem->UUID;

						$valid_package_name = $this->Api_model->getPackageName($apikey);
						if ($valid_package_name != NULL)
						{
							if (! ((strtoupper($valid_package_name) == strtoupper($pname))))
							{
								exit('Package name mismatch');
							}
						}
						else exit('Error retrieving package name for specified API key');


						require('application/third_party/PasswordHash.php');

						$pwdHasher = new PasswordHash(8, FALSE);
						$msg_hash = $pwdHasher->HashPassword($ts.$pname.$remote_ip);

						$this->FeedbackItems_model->insert_item($comment, $type, $ts, $model, $manufacturer, $sdk, $pname, $remote_ip, $apikey, $msg_hash, $uuid);
						$this->Api_model->incrementCount($apikey);


					}


					echo "OK";
				}
				break;
			case 2:
				if (! ($COMMAND == NULL))
				{
					if ($COMMAND == "getPending")
					{
						$UUID = $this->uri->segment(4, 0);
						if (! ($UUID == NULL))
						{
							$responseItem = $this->ResponseItems_model->getPendingResponseByUUID($UUID);
							if(!($responseItem==NULL)){
								$this->output->set_content_type('application/json');
								$this->ResponseItems_model->updateResponseStatus($responseItem->UID, 'delivered');
								//echo json_encode(array('response' => $responseItem->text));
								echo $responseItem->text;
								//								$this->output->set_content_type('application/json');
								//								$this->output->set_header('Cache-Control: no-cache, must-revalidate');
								//								$this->output->set_header('Expires: '.date('r', time()+(86400*365)));
								//								$this->output
								//									->set_content_type('application/json')
								//									->set_output(json_encode(array('response' => $responseItem->text)));
							} else die("");


						}
						else die("UUID not set");
					}
					else die("Unknown Command");


				}
				else
				{
					$raw_json = $this->input->post("json");
					$remote_ip = $ip = $_SERVER['REMOTE_ADDR'];
					$json = json_decode($raw_json);
					//$json = json_decode($myStr);

					if ((! (isset($json->APPUID))) || (! (isset($json->feedback))))
					{

						exit('No direct script access allowed');
					}

					$apikey = $json->APPUID;

					if ($this->Api_model->isValid($apikey))
					{

					}
					else
					{
						exit('Invalid API key');
					}


					foreach ($json->feedback as $feedItem)
					{
						$comment = $feedItem->comment;
						$type = $feedItem->type;
						$ts = $feedItem->ts;
						$model = $feedItem->model;
						$manufacturer = $feedItem->manufacturer;
						$sdk = $feedItem->sdk;
						$pname = $feedItem->pname;
						$uuid = $feedItem->UUID;
						$libver = $feedItem->libver;
						$vname = $feedItem->versionname;
						$vcode = $feedItem->versioncode;
						$dmessage = $feedItem->custommessage;


						$valid_package_name = $this->Api_model->getPackageName($apikey);
						if ($valid_package_name != NULL)
						{
							if (! ((strtoupper($valid_package_name) == strtoupper($pname))))
							{
								exit('Package name mismatch');
							}
						}
						else exit('Error retrieving package name for specified API key');


						require('application/third_party/PasswordHash.php');

						$pwdHasher = new PasswordHash(8, FALSE);
						$msg_hash = $pwdHasher->HashPassword($ts.$pname.$remote_ip);

						$this->FeedbackItems_model->insert_item_v2($comment, $type, $ts, $model, $manufacturer, $sdk, $pname, $remote_ip, $apikey, $msg_hash, $uuid,$libver,$vname,$vcode,$dmessage);
						$this->Api_model->incrementCount($apikey);
					}

					echo "OK";
				}
				break;
			case 3:
				echo "API v3 is not yet implemented";
				break;
		}
		exit('');
	}
}
