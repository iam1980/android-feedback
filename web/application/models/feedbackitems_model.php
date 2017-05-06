<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Iraklis-500R
 * Date: 18/02/13
 * Time: 18:55
 * To change this template use File | Settings | File Templates.
 */
class FeedbackItems_model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert_item($comment, $questionType, $ts, $model, $manufacturer, $sdk, $pname, $ip, $apikey, $msg_hash, $uuid)
	{

		$this->db->set('comment', $comment);
		$this->db->set('question_type', $questionType);
		$this->db->set('user_ts', '(FROM_UNIXTIME('.$ts.'))', FALSE);
		$this->db->set('model', $model);
		$this->db->set('manufacturer', $manufacturer);
		$this->db->set('sdk', $sdk);
		$this->db->set('package_name', $pname);
		$this->db->set('ip', $ip);
		$this->db->set('api_key', $apikey);
		$this->db->set('msg_hash', $msg_hash);
		$this->db->set('UUID', $uuid);

		$this->db->insert('feedback_items');

		//		echo "<PRE>";
		//		echo $this->db->last_query();
		//		echo "</PRE>";
	}

	function insert_item_v2($comment, $questionType, $ts, $model, $manufacturer, $sdk, $pname, $ip, $apikey, $msg_hash, $uuid,$libver,$versionname,$versioncode,$custommessage)
	{

		$this->db->set('comment', $comment);
		$this->db->set('question_type', $questionType);
		$this->db->set('user_ts', '(FROM_UNIXTIME('.$ts.'))', FALSE);
		$this->db->set('model', $model);
		$this->db->set('manufacturer', $manufacturer);
		$this->db->set('sdk', $sdk);
		$this->db->set('package_name', $pname);
		$this->db->set('ip', $ip);
		$this->db->set('api_key', $apikey);
		$this->db->set('msg_hash', $msg_hash);
		$this->db->set('UUID', $uuid);
		$this->db->set('libver',$libver);
		$this->db->set('versionname',$versionname);
		$this->db->set('versioncode',$versioncode);
		$this->db->set('custommessage',$custommessage);

		$this->db->insert('feedback_items');

		//		echo "<PRE>";
		//		echo $this->db->last_query();
		//		echo "</PRE>";
	}

	function getPending()
	{
		$query = $this->db->get_where('feedback_items', array('email_status' => 'pending'));
		if ($query->num_rows() > 0) return $query->result();
		else return NULL;
	}

	function getItem($UID){
		$query = $this->db->get_where('feedback_items', array('UID' => $UID));
		if ($query->num_rows() > 0) return $query->row();
		else return NULL;
	}

	function updateEmailStatus($UID, $status)
	{
		$data = array('email_status' => $status);

		$this->db->where('UID', $UID);
		$this->db->update('feedback_items', $data);
	}

}
