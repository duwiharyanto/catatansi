<!-- Bootstrap Toggle -->
<script src="<?= base_url();?>vendor/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header card-primary">
				<div class="card-title ">Add Data</div>
			</div>
			<div class="card-body">
				<form action="<?= base_url($global->url.'/update')?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Param</label>
						<input required type="hidden" readonly name="id" class="form-control" value="<?=$data->cekpc_id?>">
					</div>					
					<div class="form-group">
						<label>Alias</label>
						<input required type="text" name="cekpc_alias" class="form-control" value="<?=$data->cekpc_alias?>">
					</div>
					<div class="form-group">
						<label>IP Address</label>
						<input required type="text" name="cekpc_ipaddress" class="form-control" value="<?=$data->cekpc_ipaddress?>">
					</div>
					<div class="form-group">
						<label>Pengguna</label>
						<input required type="text" name="cekpc_user" class="form-control" value="<?=$data->cekpc_user?>">
					</div>
					<div class="form-group">
						<label>Lokasi PC</label>
						<input required type="text" name="cekpc_lokasi" class="form-control" value="<?=$data->cekpc_lokasi?>">
					</div>															
					<div class="form-group table-responsive">
						<table class="table" width="100%">
							<tr>
								<th>Assesment</th>
							</tr>
							<?php $i=1;foreach($ceklist AS $row):?>
								<tr>
									<td>
										<div class="form-group">
											<input type="checkbox" id="customCheck<?=$i?>" <?= $row->status==true ? 'checked':''?> data-toggle="toggle" data-onstyle="primary" data-style="btn-round" name="pcceklist_idceklist[]" value="<?=$row->ceklist_id?>">
											<label class="" for="customCheck<?=$i?>"><?= ucwords($row->ceklist_list)?></label>
										</div>										
									</td>
								</tr>							
							<?php $i++;endforeach;?>
						</table>
					</div>
					<div class="form-group">
						<label>Catatan<br> <span class="badge badge-primary">Jika ada kendala dalam assesment</span></label>
						<textarea required rows="8" class="form-control" name="cekpc_catatan"><?=$data->cekpc_catatan?></textarea>
					</div>
					<div class="form-group">
						<label>Tanda Tangan</label><br>
						<?php if($data->cekpc_signature):?>
							<img src="<?=base_url('./signature/cekpc/'.$data->cekpc_signature)?>">
						<?php else :?>
							<span class="text-danger">Tidak ditemukan</span>
						<?php endif;?>	
					</div>
					<div class="form-group">
						<button type="submit" name="submit" value="submit" class="btn btn-block btn-primary">Simpan</button>
						<a href="<?= site_url($global->url)?>" class="btn btn-block btn-danger">Kembali</a>

					</div>				
				</form>
			</div>
		</div>
	</div>
</div>