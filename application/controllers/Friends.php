<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Friend");
		
	}
	public function index() {
		$results['userFriends'] = $this->Friend->getFriendsForUser(); 
		$results['otherFriends'] = $this->Friend->getFriendsForOthers();
		$this->load->view('/friends',$results);
	}
	
	public function addFriend($id) { 
		$this->Friend->addFriend($id);
		redirect('friends');
	}
	public function removeFriend($id) {
		$this->Friend->removeFriend($id);
		redirect('friends');
	}
	public function getProfile($id) {
		$results['profile'] = $this->Friend->getProfile($id);
		$this->load->view('profile',$results);
	}
}























