<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Iraklis-500R
 * Date: 18/02/13
 * Time: 18:55
 * To change this template use File | Settings | File Templates.
 */
class ResponseItems_model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert_item($fiUID, $UUID, $text)
	{

		$this->db->set('fiUID', $fiUID);
		$this->db->set('UUID', $UUID);
		$this->db->set('text', $text);

		$this->db->insert('response_items');

		//		echo "<PRE>";
		//		echo $this->db->last_query();
		//		echo "</PRE>";
	}

	function updateResponseStatus($UID, $status)
	{

		$data = array('response_status' => $status);

		$this->db->where('UID', $UID);
		$this->db->update('response_items', $data);
	}

	function getPendingResponseByUUID($UUID){
		$query = $this->db->get_where('response_items', array('UUID' => $UUID,'response_status' => 'pending'));
		if ($query->num_rows() > 0) return $query->row();
		else return NULL;

	}

}