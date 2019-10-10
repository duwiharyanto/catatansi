<!-- Bootstrap Toggle -->
<script src="<?= base_url();?>vendor/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header card-primary">
				<div class="card-title ">Add Data</div>
			</div>
			<div class="card-body">
				<form action="<?= base_url($global->url)?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Alias</label>
						<input required type="text" name="cekpc_alias" class="form-control">
					</div>
					<div class="form-group">
						<label>IP Address</label>
						<input required type="text" name="cekpc_ipaddress" class="form-control" value="<?= $_SERVER['REMOTE_ADDR']?>">
					</div>
					<div class="form-group">
						<label>Pengguna</label>
						<input required type="text" name="cekpc_user" class="form-control">
					</div>
					<div class="form-group">
						<label>Lokasi PC</label>
						<input required type="text" name="cekpc_lokasi" class="form-control">
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
											<input type="checkbox" id="customCheck<?=$i?>"  data-toggle="toggle" data-onstyle="primary" data-style="btn-round" name="pcceklist_idceklist[]" value="<?=$row->ceklist_id?>">
											<label class="" for="customCheck<?=$i?>"><?= ucwords($row->ceklist_list)?></label>
										</div>
										
									</td>
								</tr>							
							<?php $i++;endforeach;?>
						</table>
					</div>
					<div class="form-group">
						<label>Catatan<br> <span class="badge badge-primary">Jika ada kendala dalam assesment</span></label>
						<textarea required rows="8" class="form-control" name="cekpc_catatan"></textarea>
					</div>
					<div class="form-group ">
						<textarea  required rows="8" id="ttd" class="form-control hide" name="ttd"></textarea>
					</div>						
					<div class="form-group">
						<button type="button" data-toggle="modal" data-target="#modalsignature" class="btn btn-block btn-success">Signature</button>						
						<button type="submit" name="submit" value="submit" class="btn btn-block btn-primary">Simpan</button>
						<a href="<?= site_url($global->url)?>" class="btn btn-block btn-danger">Kembali</a>

					</div>				
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalsignature">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-group">
					<label>Signature</label>
					<div class="wrappersignature">
						<canvas id="signature-pad"  width=400 height=200></canvas>
					</div>					
				</div>	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-md pull-left" id="clear">Clear</button>
				<button type="button" class="btn btn-primary btn-md" id="save" data-dismiss="modal">Ok</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script type="text/javascript">
	var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
		backgroundColor: 'rgba(255, 255, 255, 0)',
		penColor: 'rgb(0, 0, 0)'
	});
	var saveButton = document.getElementById('save');
	var cancelButton = document.getElementById('clear');

	saveButton.addEventListener('click', function (event) {
		var data = signaturePad.toDataURL('image/png');
		
		// Send data to server instead...
		//window.open(data);
		document.getElementById("ttd").value = data; 
		console.log(data);
	});

	cancelButton.addEventListener('click', function (event) {
		signaturePad.clear();
	});	
</script>
