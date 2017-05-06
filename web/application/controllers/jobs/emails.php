<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Iraklis-500R
 * Date: 24/02/13
 * Time: 12:41
 * To change this template use File | Settings | File Templates.
 */

class Emails extends CI_Controller {

	function Emails()
	{
		parent::__construct();
		$this->load->model('FeedbackItems_model');
		$this->load->model('Api_model');
		$this->load->model('account/Account_model');

		if (! ($this->input->is_cli_request())) exit('No direct script access allowed');
	}

	public function process()
	{
		$pending_emails = $this->FeedbackItems_model->getPending();
		if (! ($pending_emails == NULL))
		{
			foreach ($pending_emails as $row)
			{
				$UID = $row->UID;
				$comment = $row->comment;
				$question_type = $row->question_type;
				$user_ts = $row->user_ts;
				$received_ts = $row->received_ts;
				$model = $row->model;
				$manufacturer = $row->manufacturer;
				$sdk = $row->sdk;
				$pname = $row->package_name;
				$apikey = $row->api_key;
				$msg_hash = $row->msg_hash;
				$libver = $row->libver;
				$versionname = $row->versionname;
				$versioncode = $row->versioncode;
				$dmessage = $row->custommessage;

				$userID = $this->Api_model->getUserID($apikey);
				if($userID == NULL) break;
				$emailTo = $this->Account_model->get_by_id($userID)->email;
				$emailFrom = "mailbot@android-feedback.com";

				if (ENVIRONMENT == "testing") {

					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.gmail.com',
						'smtp_port' => 465,
						'smtp_user' => 'XXX',
						'smtp_pass' => 'XXX',
					);
					$emailFrom = "XXX";
					$this->load->library('email', $config);

				} else
					$this->load->library('email');

				$email_txt = $this->getFormattedEmail($comment, $question_type, $user_ts, $received_ts, $model, $manufacturer, $sdk, $pname,$UID,$msg_hash,$libver,$versionname,$versioncode,$dmessage);

				$this->email->set_newline("\r\n");

				$this->email->from($emailFrom, 'inApp Mailbot');
				$this->email->to($emailTo);

				$this->email->subject("inApp Feedback [#$UID]");
				$this->email->message($email_txt);

				if ($this->email->send())
				{
					$this->FeedbackItems_model->updateEmailStatus($UID, 'sent');

				}
				else
				{
					$this->FeedbackItems_model->updateEmailStatus($UID, 'pending');
					log_message('error', $this->email->print_debugger());
				}
			}

		}
	}

	public function getFormattedEmail($comment, $question_type, $user_ts, $received_ts, $model, $manufacturer, $sdk, $pname,$msgID,$msgHash,$libver,$versionname,$versioncode,$dmessage)
	{

		if ($libver < 6) {
			$libver_txt = "<6";

		} else {
			$libver_txt = $libver;
		}

		$email_txt = '{unwrap}INAPPIDx837029371'.$msgID.'EOID'.$msgHash.'EOHASH{/unwrap}'."\n";
		$email_txt .= "Do not remove the previous line and reply above it.\n\n";
		$email_txt .= "Feedback Library ver: $libver_txt\n";
		$email_txt .= "App: $pname $versionname $versioncode\n";
		$email_txt .= "Timestamp: $received_ts\n";
		$email_txt .= "Model: $model, Manufacturer: $manufacturer, SDK: $sdk\n";
		if ($dmessage != ""){
			$email_txt .= "Develper Message: $dmessage\n";
		}
		$email_txt .= "\n\n";
		$email_txt .= "$question_type: $comment";
		return $email_txt;

	}

	public function handleReplies(){

		log_message('error', 'Some variable was correctly set');
		$this->load->model('ResponseItems_model');

		$data = file_get_contents("php://stdin");
		$randFileName = time().rand(10000,99999);
		$tmprawemail = "/tmp/".$randFileName;
		$handle = @fopen($tmprawemail, "w");

		fwrite($handle, $data);
		fclose($handle);

		require_once('application/third_party/MimeMailParser.class.php');

		$Parser = new MimeMailParser();
		$Parser->setPath($tmprawemail);

		$to = $Parser->getHeader('to');
		$from = $Parser->getHeader('from');
		$subject = $Parser->getHeader('subject');
		$text = $Parser->getMessageBody('text');
		$html = $Parser->getMessageBody('html');



//		$logfile = "/tmp/text.log";
//		$handle = @fopen($logfile, "w");
//		$entry = $text;
//		fwrite($handle, $entry);
//		fclose($handle);



		$mystring = $text;

		$startOfID= strpos($mystring ,'INAPPIDx837029371');
		$start_of_id_found = FALSE;
		if ($startOfID  !== FALSE){
			$start_of_id_found = TRUE;
			echo $startOfID . "\n";
		}
		if(!start_of_id_found) die("Could not find start of ID");
		log_message('error', '1Some variable was correctly set');


		$endOfID = strpos($mystring ,'EOID',$startOfID+17);
		$end_of_id_found = FALSE;
		if ($endOfID !== FALSE){
			$end_of_id_found = TRUE;
		}
		if(!start_of_id_found) die("Could not find end of ID");
		log_message('error', '2Some variable was correctly set');

		$parsedID = 0;
		$parsedID = substr($mystring,$startOfID+17,($endOfID-($startOfID+17)));
		if ($parsedID == NULL || $parsedID == "") die("Could not parse ID");

		$endOfHash = strpos($mystring ,'EOHASH',$endOfID+4);
		$end_of_hash_found = FALSE;
		if ($endOfHash !== FALSE){
			$end_of_hash_found = TRUE;
		}
		if(!$end_of_hash_found) die("Could not find end of HASH");
		log_message('error', '3Some variable was correctly set');

		$parsedHASH = 0;
		$parsedHASH = substr($mystring,$endOfID+4,($endOfHash-($endOfID+4)));
		if ($parsedHASH == NULL || $parsedHASH == "") die("Could not parse HASH");

		unlink($tmprawemail);

		$fItem = $this->FeedbackItems_model->getItem($parsedID);
		if ($fItem == NULL) die("Could not get originated feedback Item");

		if(!($fItem->msg_hash == $parsedHASH))
			die ("Original HASH does not match parsed HASH");

		$UUID = $fItem->UUID;


		//Get only response from text without quoted


		$textArray = preg_split ('/$\R?^/m', $text);

		$i= 0;
		foreach ($textArray as &$line) {
			if (strpos($line,'mailbot@android-feedback.com') !== false) {
				break;
			}
			$i++;
		}


		$responseOnlyArray = array_slice($textArray, 0, $i);
		$responseOnlyString = implode("\n",$responseOnlyArray);
		$responseOnlyString = trim($responseOnlyString);



		$this->ResponseItems_model->insert_item($parsedID, $UUID, $responseOnlyString);

	}
}
