<?php
/*
 * Account_linked Controller
 */
class Account_apiaccess extends CI_Controller {

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

		$account_id = $data['account']->id;

		// Get user api keys
		$data['api_keys'] = $this->api_model->getKeysByID($account_id);


		### Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'api_package_name',
				'label' => 'Package name',
				'rules' => 'trim|required|min_length[3]|max_length[255]|callback_package_name_check'
			)
		));


		### Run form validation
		if ($this->form_validation->run())
		{
			// Add_key
			$this->api_model->addKey($data['account']->id, $this->input->post('api_package_name', TRUE), $this->get_unique_guid());
			$this->session->set_flashdata('api_info', "API key added successfully");
			redirect('account/account_apiaccess');
		}


		$this->load->view('account/account_apiaccess', $data);
	}

	function delete()
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

		$account_id = $data['account']->id;

		### Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'api_key_id',
				'rules' => 'trim|required|integer'
			)
		));


		### Run form validation
		if ($this->form_validation->run())
		{
			// Add_key
			//$this->api_model->addKey($data['account']->id, $this->input->post('api_package_name', TRUE), $this->get_unique_guid());

			$this->api_model->removeKey($data['account']->id, $this->input->post('api_key_id', TRUE));
			$this->session->set_flashdata('api_info', "API key added successfully deleted");
			//echo "API KEY ".$this->input->post('api_key_id', TRUE);
			redirect('account/account_apiaccess');
		}
	}

	public function package_name_check($str)
	{
		$account_id = $this->account_model->get_by_id($this->session->userdata('account_id'))->id;

		if ($this->api_model->checkIfExists($account_id,$str))
		{
			$this->form_validation->set_message('package_name_check', 'This package name already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function create_guid($namespace = '') {
		static $guid = '';
		$uid = uniqid("", true);
		$data = $namespace;
		$data .= $_SERVER['REQUEST_TIME'];
		$data .= $_SERVER['HTTP_USER_AGENT'];
		$data .= $_SERVER['REMOTE_ADDR'];
		$data .= $_SERVER['REMOTE_PORT'];
		$hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
		$guid = 'AF-' .
			substr($hash,  0,  12) .
			'-' .
			substr($hash,  12,  2);
		return $guid;
	}

	public function get_unique_guid(){
		$is_unique = FALSE;
		$unique_key = '';
		while(!$is_unique){
			$the_key = $this->create_guid('Android Feedback');
			if($this->api_model->checkIfKeyExists($the_key)){

			} else {
				$is_unique = TRUE;
				$unique_key = $the_key;
			}
		}
		return $unique_key;
	}
}


/* End of file account_linked.php */
/* Location: ./application//account/controllers/account_apiaccess.php */