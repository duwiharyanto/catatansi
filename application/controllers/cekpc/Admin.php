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
	private $master_tabel="cekpc";
	private $default_url="cekpc/Admin/";
	private $default_view="cekpc/admin/";
	private $view="template/backend";
	private $id="cekpc_id";
	private $path='./signature/cekpc/';

	private function global_set($data){
		$data=array(
			'menu'=>'Crud',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-tasks",
			'view'=>"views/cekpc/admin/index.php",
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
			'headline'=>'daftar cekpc',
			'url'=>'cekpc/admin/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			//TABEL CEKPC
			// $dt=$this->input->post('switch');
			// echo $dt;
			// exit();
			$data=array(
				'cekpc_alias'=>$this->input->post('cekpc_alias'),
				'cekpc_tersimpan'=>date('Y-m-d'),
				'cekpc_ipaddress'=>$this->input->post('cekpc_ipaddress'),
				'cekpc_user'=>$this->input->post('cekpc_user'),
				'cekpc_lokasi'=>$this->input->post('cekpc_lokasi'),
				'cekpc_catatan'=>$this->input->post('cekpc_catatan'),

			);
			$data_uri = $this->input->post('ttd');
			$encoded_image = explode(",", $data_uri)[1];
			$decoded_image = base64_decode($encoded_image);
			$ttd=$this->randomstring(20);
			$file=$ttd.'.png';
			file_put_contents($this->path.$file, $decoded_image);
			$data['cekpc_signature']=$file;	

			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
			);
			$insertreturnid=$this->Crud->insert_returnid($query);	
					
			//list
			$listinput=$this->input->post('pcceklist_idceklist');
			foreach($listinput As $index => $row){
				$list=array(
					'pcceklist_idpc'=>$insertreturnid,
					'pcceklist_idceklist'=>$listinput[$index],
				);
				$query=array(
					'data'=>$list,
					'tabel'=>'pcceklist',
				);
				$insert=$this->Crud->insert($query);							
			}
			// $list=array(
			// 	'pcceklist_idceklist'=>$this->input->post('pcceklist_idceklist'),
			// );				
			// $query=array(
			// 	'data'=>$data,
			// 	'tabel'=>$this->master_tabel,
			// );
			$this->notifiaksi($insert);
			redirect(base_url($this->default_url));
			// print_r($list);
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
			'headline'=>'Cek PC/Komputer',
			'url'=>'cekpc/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query=array(
			'tabel'=>$this->master_tabel,
			'order'=>array('kolom'=>'cekpc_alias','orderby'=>'DESC'),
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
			'url'=>'cekpc/admin/', //AKAN DIREDIRECT KE INDEX
		);
		$ceklist=array(
			'tabel'=>"ceklist",
			'order'=>array('kolom'=>'ceklist_id','orderby'=>'DESC'),
			);		
		$global=$this->global_set($global_set);
		$data=array(
			'ceklist'=>$this->Crud->read($ceklist)->result(),
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}	
	public function update(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'cekpc/admin/',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		$data=array(
			'cekpc_alias'=>$this->input->post('cekpc_alias'),
			'cekpc_tersimpan'=>date('Y-m-d'),
			'cekpc_ipaddress'=>$this->input->post('cekpc_ipaddress'),
			'cekpc_user'=>$this->input->post('cekpc_user'),
			'cekpc_lokasi'=>$this->input->post('cekpc_lokasi'),
			'cekpc_catatan'=>$this->input->post('cekpc_catatan'),
		);
		$q_updatecekpc=array(
			'data'=>$data,
			'tabel'=>'cekpc',
			'where'=>array('cekpc_id'=>$id),
		);
		$updatecekpc=$this->Crud->update($q_updatecekpc);	
		if($updatecekpc){
			$q_delpcceklist=array(
				'tabel'=>'pcceklist',
				'where'=>array('pcceklist_idpc'=>$id),
			);
			$delete=$this->Crud->delete($q_delpcceklist);
		}		
		//list
		$listinput=$this->input->post('pcceklist_idceklist');
		foreach($listinput As $index => $row){
			$list=array(
				'pcceklist_idpc'=>$id,
				'pcceklist_idceklist'=>$listinput[$index],
			);
			$query=array(
				'data'=>$list,
				'tabel'=>'pcceklist',
			);
			$insert=$this->Crud->insert($query);								
		}
		$this->notifiaksi($update);
		redirect(site_url($this->default_url));
	}	
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail cekpc',
			'url'=>'cekpc/admin/',
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$cekpc=array(
			'tabel'=>'cekpc',
			'where'=>array(array('cekpc_id'=>$id)),
		);
		$ceklist=array(
			'tabel'=>"ceklist",
			'order'=>array('kolom'=>'ceklist_id','orderby'=>'DESC'),
		);
		$ceklist=$this->Crud->read($ceklist)->result();
		foreach($ceklist AS $index => $row){
			$arrceklist[$index]=$row;
			$query="SELECT * FROM pcceklist WHERE pcceklist_idpc=$id AND pcceklist_idceklist=$row->ceklist_id";
			$list=$this->Crud->hardcode($query)->row();
			if($list){
				$arrceklist[$index]->status=true;
			}else{
				$arrceklist[$index]->status=false;
			}
		}
		$data=array(
			'data'=>$this->Crud->read($cekpc)->row(),
			'ceklist'=>$arrceklist,
			'global'=>$global,
		);
		$this->load->view($this->default_view.'detail',$data);	
		//print_r($data);	
	}
	public function hapus($id){
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array($this->id=>$id),
		);
		$delete=$this->Crud->delete($query);
		if($delete){
			$ceklist=array(
			'tabel'=>'pcceklist',
			'where'=>array('pcceklist_idpc'=>$id),
			);
			$delete=$this->Crud->delete($ceklist);		
		}		
		$this->notifiaksi($delete);
		redirect(site_url($this->default_url));
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
