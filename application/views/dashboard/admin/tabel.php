<div class="card">
	<div class="card-header card-primary">
		<div class="card-title "><?= ucwords($global->headline)?></div>
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