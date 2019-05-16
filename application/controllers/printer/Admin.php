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
	private $master_tabel="printer";
	private $default_url="printer/Admin/";
	private $default_view="printer/Admin/";
	private $view="template/backend";
	private $id="printer_id";

	private function global_set($data){
		$data=array(
			'menu'=>'Crud',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tasks",
			'view'=>"views/printer/admin/index.php",
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
			'headline'=>'daftar printer',
			'url'=>'printer/admin/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'printer_tipe'=>$this->input->post('printer_tipe'),
				'printer_tersimpan'=>date('Y-m-d',strtotime($this->input->post('printer_tersimpan'))),
				'printer_lokasi'=>$this->input->post('printer_lokasi'),
				'printer_catatan'=>$this->input->post('printer_catatan'),
			);
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
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
			'headline'=>'Printer',
			'url'=>'printer/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query=array(
			'tabel'=>$this->master_tabel,
			'order'=>array('kolom'=>'printer_tersimpan','orderby'=>'DESC'),
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
			'url'=>'printer/admin/', //AKAN DIREDIRECT KE INDEX
		);
		$type=array(
			'tabel'=>"printer",
			'order'=>array('kolom'=>'printer_tipe','orderby'=>'DESC'),
			);		
		$global=$this->global_set($global_set);
		$data=array(
			'type'=>$this->Crud->read($type)->result(),
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}	
	public function update(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'printer/admin/',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		$data=array(
			'printer_tipe'=>$this->input->post('printer_tipe'),
			'printer_terupdate'=>date('Y-m-d'),
			'printer_lokasi'=>$this->input->post('printer_lokasi'),
			'printer_catatan'=>$this->input->post('printer_catatan'),
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
			'headline'=>'detail printer',
			'url'=>'printer/admin/',
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array(array('printer_id'=>$id)),
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
	// public function downloadberkas($file){
	// 	$path=$this->path;
	// 	$this->downloadfile($path,$file);
	// }
}
