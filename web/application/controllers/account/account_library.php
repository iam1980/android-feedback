<?php
/*
 * Account_linked Controller
 */
class Account_library extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array(
			'language',
			'account/ssl',
			'url'
		));
		$this->load->library(array(
			'account/authentication',
			'form_validation'
		));
		$this->load->model(array(
			'account/account_model',
			'api_model'
		));
		$this->load->language(array(
		));
	}

	/**
	 * Linked accounts
	 */
	function index()
	{
		// Enable SSL?
		use_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if (! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'account/account_apiaccess'));
		}

		// Retrieve sign in user
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

		$this->load->view('account/account_library', isset($data) ? $data : NULL);
	}

}


/* End of file account_linked.php */
/* Location: ./application//account/controllers/account_apiaccess.php */