<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound404 extends CI_Controller {
	public function index()
	{
		$this->load->view('template/Notfound404');
	}
}
