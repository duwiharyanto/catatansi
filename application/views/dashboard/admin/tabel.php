<div class="card">
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
						<th width="80%">Catatan</th>
						<th width="15%" class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1;foreach($data AS $row):?>
						<tr>
							<td><?=$i?></td>
							<td>
								<b><a href="javascript:void()" onclick="detail(<?=$row->catatan_id?>)" url="<?=base_url($global->url.'detail')?>" class="detail"><?= ucwords($row->catatan_judul)?></a></b><br>
								<small>Tersimpan : <?= date('d-m-Y',strtotime($row->catatan_tersimpan))?></small>
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
<?php include 'action.php';?>