<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/Facebook/autoload.php";
class Login extends CI_Controller {

	public function __construct() {
               parent::__construct();
               $this->load->model('userdetails_model');
        }

	public function index()
	{
		$data=array();
		$data['title']="Home";

		$fb = new Facebook\Facebook([
		'app_id' => '192708577758141',
		  'app_secret' => '779e6e9f299be76341a729f97e9dff79',
		  'default_graph_version' => 'v2.5',
		]);

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['public_profile','email']; // optional
		$loginUrl = $helper->getLoginUrl( base_url().'login/loggedin', $permissions);
		$data['loginUrl']=$loginUrl;
		$this->load->view('header',$data);
		$this->load->view('login_view',$data);
		$this->load->view('footer');
	}
	public function loggedin()
	{
		$fb = new Facebook\Facebook([
		'app_id' => '192708577758141',
		'app_secret' => '779e6e9f299be76341a729f97e9dff79',
		'default_graph_version' => 'v2.5',
		]);

		$helper = $fb->getRedirectLoginHelper();
		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (isset($accessToken)) {
		  // Logged in!
		  $_SESSION['facebook_access_token'] = (string) $accessToken;

		$fb->setDefaultAccessToken($accessToken);
		try {
		  $response = $fb->get('/me?fields=picture,id,first_name,last_name,email');
		  $userNode = $response->getGraphNode();
		  
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		$data=array();
		$data['id']=$userNode->getField('id');
		$data['fname']=$userNode->getField('first_name');
		$data['lname']=$userNode->getField('last_name');
		$data['email']=$userNode->getField('email');
		$data['picture']=$userNode->getField('picture');
		$data['pic']=$data['picture']['url'];
		$_SESSION['name'] = $data['fname'];
		$_SESSION['pic'] = $data['pic'];
		if($this->userdetails_model->check($data)){
			redirect('home', 'refresh');
                    }
                    else{
                        echo'<div class="alert alert-dismissable alert-danger"><small>Please Check Username or Password</small></div>';
                    }		
		}
	}

	public function logout()
	{
		
		$this->session->sess_destroy();
		redirect(base_url().'login', 'refresh');
	}
}
