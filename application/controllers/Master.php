<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends CI_Controller {
	public function __construct(){
		//$this->load->model('Crud');
		parent::__construct();
	}
	protected function cekadmin(){
		if(($this->session->userdata('user_login')!=true) || ($this->session->userdata('user_level')>=5)){
			redirect(site_url('Login/logout'));
		}	
	}
	protected function norm($param){
		//$nourut=$this->db->query("SELECT RIGHT(notest,4) AS kode from jual ORDER BY kode DESC LIMIT 1");
		$nourut=$param['norm'];
		if($nourut->num_rows()<>0){
			$nourut=$nourut->row();
			$nourut=intval($nourut->kode)+1;
		}else{
			$nourut=1;
		}
		$padnourut=str_pad($nourut,4,'0',STR_PAD_LEFT);
		$tahun=date('Y');
		$norm='RM'.substr($tahun, 2).$padnourut;
		return $norm;
	}
	protected function kodependaftaran($param){
		//$nourut=$this->db->query("SELECT RIGHT(notest,4) AS kode from jual ORDER BY kode DESC LIMIT 1");
		$nourut=$param['kode'];
		if($nourut->num_rows()<>0){
			$nourut=$nourut->row();
			$nourut=intval($nourut->kode)+1;
		}else{
			$nourut=1;
		}
		$padnourut=str_pad($nourut,4,'0',STR_PAD_LEFT);
		$tahun=date('Y');
		$kodependaftaran='D'.$param['kodedokter'].substr($tahun, 2).$padnourut;
		return $kodependaftaran;
	}		
	protected function notifiaksi($param){
		if($param==1){
			$this->session->set_flashdata('success','proses berhasil');
		}else{
			$this->session->set_flashdata('error',$param);
		}		
	}
	protected function ping($data){
		$tB=microtime(true);
		$fP=fsockopen($data['hostname'],$data['port'],$errno,$errstr,$data['timeout']);
		if(!$fP){
			return "down";
			echo $errstr($errno);
		}
		$tA=microtime(true);
		$hasil=round((($tA-$tB)*10),0)." ms";
		$data=array(
			'hasil'=>$hasil,
			'tA'=>$tA,
			'tB'=>$tB,
			'nil'=>$tA-$tB,
		);
		return 	$data;	
	}
	protected function testping($data){
		$ip = $data;
		exec("ping -n 1 $ip 2>&1", $output, $retval);
		if ($retval != 0) { 
			// echo "no!"; 
			return false;
		} 
		else 
		{ 
			// echo "yes!";
			return true; 
		}			
	}
	protected function fileupload($path,$file){
		$config=array(
			'upload_path'=>$path,
			'allowed_types'=>'pdf',
			'max_size'=>5000, //5MN
			'encrypt_name'=>true, //ENCTYPT
		);
		$this->load->library('upload',$config);
		return $this->upload->do_upload($file);
	}
	protected function fotoupload($path,$file){
		$config=array(
			'upload_path'=>$path,
			'allowed_types'=>'jpg|png|jpeg',
			'max_size'=>5000, //5MN
			'encrypt_name'=>true, //ENCTYPT
		);
		$this->load->library('upload',$config);
		return $this->upload->do_upload($file);
	}
	protected function downloadfile($path,$file){
		$link=$path.$file;
		if(file_exists($link)){
			$url=file_get_contents($link);
			force_download($file,$url);
		}else{
			$this->session->set_flashdata('error','File tidak ditemukan');
		}						
	}
	protected function matauang($param){
		$level1=str_replace('Rp ', '', $param);
		$level2=str_replace('.', '', $level1);
		return $level2;
	}
	protected function viewdata($data){
		echo "<pre>";
		print_r($data);
	}
	protected function prosescetak($data){
		$nama_dokumen=$data['judul']; //Beri nama file PDF hasil.
		$headline="DATA DIRI PASIEN";
		require_once('./asset/mPDF/mpdf.php');
		$mpdf= new mPDF('c','A4-Pa','',0,20,20,30,20);	
		// $mpdf->SetHTMLHeader('
		// <div style="text-align: left; font-weight: bold;">
		//     <img src="./asset/dist/img/avatar6.png" width="60px" height="60px">'.$headline.'
		// </div>');
		$mpdf->SetHTMLHeader('
		<div style="text-align: center; font-weight: bold;">
		    <h3>'.$headline.'</h3>
		</div>');		
		$mpdf->SetHTMLFooter('
		<table width="100%">
		    <tr>
		        <td width="33%">{DATE j-m-Y}</td>
		        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
		        <td width="33%" style="text-align: right;">'.$nama_dokumen.'</td>
		    </tr>
		</table>');		
		$mpdf->WriteHTML($data['view']);
		$mpdf->Output($nama_dokumen.".pdf",'I');		
	}	
	protected function menu($levelakses){
		$main_menu=array(
			'tabel'=>'menu',
			'where'=>array(array('menu_is_mainmenu'=>'0'),array('menu_status'=>'1'),array('menu_akses_level'=>$levelakses)),
			'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
		);
		$menu_akhir=array();
		$menu=$this->Crud->read($main_menu)->result();
		if(count($menu)>0){
			foreach ($menu as $index => $row) {
				$menu_akhir[$index]=$row;
				$sub_menu=array(
					'tabel'=>'menu',
					'where'=>array(array('menu_is_mainmenu '=>$row->menu_id),array('menu_status'=>'1')),
					'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
				);
				$submenu=$this->Crud->read($sub_menu)->result();
				if(count($submenu)>0){
					$menu_akhir[$index]->status=1;
					//$submenu=array();
					$menu_akhir[$index]->submenu=$submenu;
				}else{
					$menu_akhir[$index]->status=0;
					$menu_akhir[$index]->submenu=0;
				}				
			}
		}
		return $menu_akhir;		
	}
	protected function menubackend($levelakses){
		//AMBIL DATA MENU MASTER(PARENT)
		$menu_getall=array(
			'tabel'=>'menu',
			'where'=>array(array('menu_is_mainmenu'=>'0'),array('menu_status'=>'1')),
			'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
		);
		$menu_all=$this->Crud->read($menu_getall)->result();
		//LOOPING MENU MASTER, UNTUK AMBIL MENU AKSES LEVEL
		//EXPLODE KE BENTUK ARRAY MENU AKSES LEVEL YG SEBELUMNY STRING
		$menu=array();	//DEKLARASI ARRAY UNTUK MENAMPUNG MENU
		foreach ($menu_all as $index => $row) {
			$cek_menu[$index]=explode(',', $row->menu_akses_level);	 //BUAT ARRAY DARI STRING
			foreach ($cek_menu[$index] as $val) { //LOOPING LEVEL AKSES
				if($val==$levelakses){
					$menu[$index]=$row; //TAMPUNG DATA MASTER
					$sub_menu=array(
						'tabel'=>'menu',
						'where'=>array(array('menu_is_mainmenu'=>$row->menu_id),array('menu_status'=>'1')),
						'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
					); //JIKA LEVEL AKSES COCOK, AMBIL DATA SUBMENU JIKA ADA
					$get_submenu=$this->Crud->read($sub_menu)->result();
					if($get_submenu){ //JIKA TERDAPAT SUBMENU
						$menu[$index]->status=1;
						$submenu=array(); //DEKLARASI VAR SUBMENU
						foreach ($get_submenu as $indexsubmenu => $valsubmenu) { //LOOPING SUBMENU
							$cek_submenu[$indexsubmenu]=explode(',', $valsubmenu->menu_akses_level);
							foreach ($cek_submenu[$indexsubmenu] as $vals) { //LOOPING MENU AKSES LEVEL
								if($vals==$levelakses){
									$submenu[$indexsubmenu]=$valsubmenu;
								}
							}
							$menu[$index]->submenu=$submenu;
						}
					}else{
						$menu[$index]->status=0;
						$menu[$index]->submenu=0;
					}	
				}
			}
		}
		return $menu;	
	}	
	protected function menubackend_old($levelakses){
		$main_menu=array(
			'tabel'=>'menu',
			'where'=>array(array('menu_is_mainmenu'=>'0'),array('menu_status'=>'1'),array('menu_akses_level'=>$levelakses)),
			'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
		);
		$menu_akhir=array();
		$menu=$this->Crud->read($main_menu)->result();
		if(count($menu)>0){
			foreach ($menu as $index => $row) {
				$menu_akhir[$index]=$row;
				$sub_menu=array(
					'tabel'=>'menu',
					'where'=>array(array('menu_is_mainmenu '=>$row->menu_id),array('menu_status'=>'1'),array('menu_akses_level'=>$levelakses)),
					'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
				);
				$submenu=$this->Crud->read($sub_menu)->result();
				if(count($submenu)>0){
					$menu_akhir[$index]->status=1;
					//$submenu=array();
					$menu_akhir[$index]->submenu=$submenu;
				}else{
					$menu_akhir[$index]->status=0;
					$menu_akhir[$index]->submenu=0;
				}				
			}
		}
		return $menu_akhir;		
	}
	protected function barcode($param){
		include "./asset/phpqrcode/qrlib.php"; 
		$tempdir = "./barcode/";
		#parameter inputan
		$isi_teks = $param['id'];
		$namafile = $param['id'].'.png';
		$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
		$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
		$padding = 0;
		QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
		$path="barcode/".$namafile;
		return base_url($path);		
	}				
}
