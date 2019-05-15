<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/Master.php';
class Login extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		// if(($this->session->userdata('login')!=true) || ($this->session->userdata('level')!=1) ){
		// 	redirect(site_url('login/logout'));
		// }
	}
	//VARIABEL
	private $master_tabel="user";
	private $default_url="Login";
	private $default_view="template/login";
	private $view="template/login";
	private $id="user_id";

	private function global_set($data){
		$data=array(
			'menu'=>'Crud',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tasks",
			'view'=>"views/tempalte/login",
			'detail'=>false,
			'edit'=>false,
			'delete'=>false,
		);
		return (object)$data;
	}			
	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'login user',
			'url'=>'login',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'user_username'=>$this->input->post('user_username'),
				'user_password'=>$this->input->post('user_password'),
			);
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array(array('user_username'=>$data['user_username']),array('user_password'=>$data['user_password'])),
				'limit'=>1,
			);
			$cek_user=$this->Crud->read($query);
			if($cek_user->num_rows()==1){
				$user=$cek_user->row();
				$dt_session=array(
					'user_id'=>$user->user_id,
					'user_username'=>$user->user_username,
					'user_nama'=>$user->user_nama,
					'user_level'=>$user->user_level,
					'user_login'=>true,
				);
				$this->session->set_userdata($dt_session);				
				if($this->session->userdata('user_level')<=5){
				  redirect(site_url("dashboard/admin"));
				 //echo "login";
				}else{
					echo "FORBIDEN PAGE";
					exit();
				}
			}else{
				$this->session->set_flashdata('error','username tidak ditemukan');
				redirect(base_url('Login'));
			}
		}else{			
			$data=array(
				'global'=>$global,
			);
			if($this->session->userdata('user_login')==true AND $this->session->userdata('user_level')<=5 ){
				redirect(site_url('dashboard/admin'));
			}else{
				$this->load->view($this->view,$data);
			}						
			//print_r($data['data']);
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}		
}
