
<div class="card hidden-xs">
	<div class="card-header ">
		<div class="card-title "><?= ucwords($global->headline)?>
		<div class="pull-right">
			<button id="add"  type="button" class="btn btn-icon btn-round btn-primary"  url="<?= base_url($global->url.'add')?>" onclick="add()">
				<i class="fa fa-plus"></i>
			</button>
		</div>	
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="" class="basic-datatables display table table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="80%">Type</th>
						<th width="15%" class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1;foreach($data AS $row):?>
						<tr>
							<td><?=$i?></td>
							<td>
								<b><a href="javascript:void()" onclick="detail(<?=$row->printer_id?>)" url="<?=base_url($global->url.'detail')?>" class="detail"><?= ucwords($row->printer_tipe)?></a></b><br>
								<small>Tersimpan : <?= date('d-m-Y',strtotime($row->printer_tersimpan))?></small><br>
								<i><?= ucwords($row->printer_lokasi)?></i>
							</td>
							<td class="text-center"> 
								<?php include 'button.php';?>
							</td>
						</tr>
					<?php $i++;endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="card hidden-md hidden-lg hidden-sm">
	<div class="card-header ">
		<div class="card-title "><?= ucwords($global->headline)?>
		<div class="pull-right">
			<button id="add"  type="button" class="btn btn-icon btn-round btn-primary"  url="<?= base_url($global->url.'add')?>" onclick="add()">
				<i class="fa fa-plus"></i>
			</button>
		</div>	
		</div>
	</div>
	<div class="card-body">
		<div class="card-list">
			<div id="name-list" data-toggle="lists" data-lists-values='["name"]'>
			<input class="form-control search mb-2" type="search" placeholder="Cari...">
				<ul class="list-group list-group-bordered list">
					<?php foreach($data AS $row):?>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<span class="name">
						<span>
							<b><a href="javascript:void()" onclick="detail(<?=$row->printer_id?>)" url="<?=base_url($global->url.'detail')?>" class="detail"><?= ucwords($row->printer_tipe)?></a></b><br>
							<small>Tersimpan : <?= date('d-m-Y',strtotime($row->printer_tersimpan))?></small><br>
							<i><?= ucwords($row->printer_lokasi)?></i>	
						</span>
						</span>
						<button url="<?= base_url($global->url.'hapus/')?>"  onclick="hapus(<?=$row->printer_id?>)" type="button" class="hapus btn btn-md btn-icon btn-round btn-danger">
							<i class="icon icon-trash"></i>
						</button>
					</li>					
					<?php endforeach;?>
				</ul>
				<ul class="pagination">
				</ul>
			</div>
		</div>
	</div>
</div>
<?php include 'action.php';?>
