<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header card-primary">
				<div class="card-title ">Add Data</div>
			</div>
			<div class="card-body">
				<form action="<?= base_url($global->url)?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Type</label>
						<input required type="text" name="printer_tipe" class="form-control">
					</div>
					<div class="form-group">
						<label>Tanggal Pengantian</label>
						<input required type="text" name="printer_tersimpan" class="datepicker form-control">
					</div>					
					<div class="form-group">
						<label>Lokasi</label>
						<textarea required rows="8" class="form-control" name="printer_lokasi"></textarea>
					</div>					
					<div class="form-group">
						<label>Catatan</label>
						<textarea required rows="8" class="form-control" name="printer_catatan"></textarea>
						<small><i>Jika tidak ada catatan isikan '-'</i></small>
					</div>	
					<div class="form-group">
						<textarea required rows="8" id="ttd" class="form-control" name="printer_ttd"></textarea>
					</div>		
					<div class="form-group">
						<label>Penerima</label>
						<input required type="text" name="printer_penerima" id="printerpenerima" class="form-control">
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
					<label>Penerima</label>
					<input type="text" class="form-control" id="penerima">
				</div>
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
<?php include 'action.php';?>
<script type="text/javascript">
	var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
		backgroundColor: 'rgba(255, 255, 255, 0)',
		penColor: 'rgb(0, 0, 0)'
	});
	var saveButton = document.getElementById('save');
	var cancelButton = document.getElementById('clear');

	saveButton.addEventListener('click', function (event) {
		var data = signaturePad.toDataURL('image/png');
		var penerima = document.getElementById('penerima').value;
		// Send data to server instead...
		//window.open(data);
		document.getElementById("printerpenerima").value = penerima; 
		document.getElementById("ttd").value = data; 
		console.log(data);
	});

	cancelButton.addEventListener('click', function (event) {
		signaturePad.clear();
	});	
</script>