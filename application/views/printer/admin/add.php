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
						<button type="submit" name="submit" value="submit" class="btn btn-block btn-primary">Simpan</button>
						<a href="<?= site_url($global->url)?>" class="btn btn-block btn-danger">Kembali</a>
					</div>				
				</form>
			</div>
		</div>
	</div>
</div>
<?php include 'action.php';?>