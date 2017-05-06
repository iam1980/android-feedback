<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Iraklis-500R
 * Date: 24/02/13
 * Time: 12:05
 * To change this template use File | Settings | File Templates.
 */
class Api_model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function isValid($key)
	{
		$this->db->where('key', $key);
		$query = $this->db->get('api_keys');
		$res_count = $query->num_rows();
		if ($res_count == 1) return TRUE;
		else return FALSE;
	}

	function getPackageName($key)
	{
		$this->db->where('key', $key);
		$query = $this->db->get('api_keys');
		$res_count = $query->num_rows();
		if ($res_count == 1)
		{
			return $query->row()->pname;
		}
		else return NULL;
	}

	function getUserID($key)
	{
		$this->db->where('key', $key);
		$query = $this->db->get('api_keys');
		$res_count = $query->num_rows();
		if ($res_count == 1)
		{
			return $query->row()->account;
		}
		else return NULL;
	}

	function getKeysByID($userID)
	{
		$this->db->where('account', $userID);
		$query = $this->db->get('api_keys');
		$res_count = $query->num_rows();
		if ($res_count > 0)
		{
			return $query->result();
		}
		else return NULL;
	}

	function incrementCount($key)
	{
		$this->db->where('key', $key);
		$this->db->set('counter', 'counter+1', FALSE);
		$this->db->update('api_keys');
	}

	function checkIfExists($userID, $pname)
	{
		$this->db->where('account', $userID);
		$this->db->where('pname', $pname);
		$query = $this->db->get('api_keys');
		$res_count = $query->num_rows();
		if ($res_count > 0)
		{
			return TRUE;
		}
		else return FALSE;
	}

	function checkIfKeyExists($key)
	{
		$this->db->where('key', $key);
		$query = $this->db->get('api_keys');
		$res_count = $query->num_rows();
		if ($res_count > 0)
		{
			return TRUE;
		}
		else return FALSE;
	}

	function addKey($userID, $pname, $key)
	{
		$this->db->set('account', $userID);
		$this->db->set('counter', 0);
		$this->db->set('pname', $pname);
		$this->db->set('key', $key);

		$this->db->insert('api_keys');

	}

	function removeKey($usedID, $keyID)
	{
		$this->db->where('account', $usedID);
		$this->db->where('UID', $keyID);
		$this->db->delete('api_keys');
	}

}