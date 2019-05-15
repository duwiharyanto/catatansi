<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/Master.php';
class Admin extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');

		$this->cekadmin();
	}
	//VARIABEL
	private $master_tabel="catatan";
	private $default_url="dashboard/Admin/";
	private $default_view="dashboard/Admin/";
	private $view="template/backend";
	private $id="catatan_id";

	private function global_set($data){
		$data=array(
			'menu'=>'Crud',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tasks",
			'view'=>"views/dashboard/admin/index.php",
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
			'headline'=>'daftar catatan',
			'url'=>'dashboard/admin/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'catatan_judul'=>$this->input->post('catatan_judul'),
				'catatan_tersimpan'=>date('Y-m-d'),
				'catatan_isi'=>$this->input->post('catatan_isi'),
			);
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
				'where'=>array('status'=>'lulus')
			);
			$insert=$this->Crud->insert($query);
			$this->notifiaksi($insert);
			redirect(base_url($this->default_url));
			//print_r($data);
		}else{

			$data=array(
				'global'=>$global,
			);			
			$this->load->view($this->view,$data);
			//print_r($data['data']);
		}
	}
	public function tabel(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'catatan',
			'url'=>'dashboard/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query=array(
			'tabel'=>$this->master_tabel,
			'order'=>array('kolom'=>'catatan_judul','orderby'=>'DESC'),
			);
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->read($query)->result(),
		);
		//print_r($data['data']);
		$this->load->view($this->default_view.'tabel',$data);		
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'tambah data',
			'url'=>'dashboard/admin/', //AKAN DIREDIRECT KE INDEX
		);
		$user=array(
			'tabel'=>"user",
			'order'=>array('kolom'=>'user_id','orderby'=>'DESC'),
			);		
		$global=$this->global_set($global_set);
		$data=array(
			//'user'=>$this->Crud->read($user)->result(),
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}	
	public function update(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'crud/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		$data=array(
			'catatan_judul'=>$this->input->post('catatan_judul'),
			'catatan_terupdate'=>date('Y-m-d'),
			'catatan_isi'=>$this->input->post('catatan_isi'),
		);			
		$query=array(
			'data'=>$data,
			'where'=>array($this->id=>$id),
			'tabel'=>$this->master_tabel,
			);
		$update=$this->Crud->update($query);
		$this->notifiaksi($update);
		redirect(site_url($this->default_url));
	}	
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail catatan',
			'url'=>'dashboard/admin/',
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array(array('catatan_id'=>$id)),
		);
		$data=array(
			'data'=>$this->Crud->read($query)->row(),
			'global'=>$global,
		);
		$this->load->view($this->default_view.'detail',$data);		
	}
	public function hapus($id){
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array($this->id=>$id),
		);
		$delete=$this->Crud->delete($query);
		$this->notifiaksi($delete);
		redirect(site_url($this->default_url));
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
