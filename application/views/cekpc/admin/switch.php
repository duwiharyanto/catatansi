	<!-- Bootstrap Toggle -->
	<script src="<?= base_url();?>vendor/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<div class="row">
<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Radio</h4>
								</div>
								<div class="card-body">
									<div class="form-check form-check-inline">
										<div class="custom-control custom-radio">
											<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
											<label class="custom-control-label" for="customRadio1">Unchecked</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" checked>
											<label class="custom-control-label" for="customRadio2">Checked</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" id="customRadio3" name="customRadioDisabled" class="custom-control-input" disabled>
											<label class="custom-control-label" for="customRadio3">Disabled</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" id="customRadio4" name="customRadioDisabled" class="custom-control-input" checked disabled>
											<label class="custom-control-label" for="customRadio4">Checked Disabled</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Bootstrap Switch</h4>
								</div>
								<div class="card-body">
									<p class="demo">
										<input type="checkbox" checked data-toggle="toggle" data-onstyle="default">
										<input type="checkbox" checked data-toggle="toggle" data-onstyle="primary">
										<input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
										<input type="checkbox" checked data-toggle="toggle" data-onstyle="info">
										<input type="checkbox" checked data-toggle="toggle" data-onstyle="warning">
										<input type="checkbox" checked data-toggle="toggle" data-onstyle="danger">
									</p>
									<p class="demo">
										<input type="checkbox" checked data-toggle="toggle" data-onstyle="default" data-style="btn-round">

									</p>
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
		
		// Send data to server instead...
		//window.open(data);
		document.getElementById("ttd").value = data; 
		console.log(data);
	});

	cancelButton.addEventListener('click', function (event) {
		signaturePad.clear();
	});	
</script>