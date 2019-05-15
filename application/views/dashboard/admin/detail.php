<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header card-primary">
				<div class="card-title ">Add Data</div>
			</div>
			<div class="card-body">
				<form action="<?= base_url($global->url.'update')?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Id</label>
						<input type="text" name="id" class="form-control" readonly="readonly" value="<?=$data->catatan_id?>">
					</div>
					<div class="form-group">
						<label>Judul</label>
						<input required type="text" name="catatan_judul" class="form-control" value="<?=ucwords($data->catatan_judul)?>">
					</div>
					<div class="form-group">
						<label>Catatan</label>
						<textarea  required rows="8" class="form-control" name="catatan_isi"><?=ucwords($data->catatan_isi)?></textarea>
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