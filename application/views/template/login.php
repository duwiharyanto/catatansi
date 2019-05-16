<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="http://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?= base_url();?>vendor/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?= base_url();?>vendor/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url();?>vendor/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url();?>vendor/css/atlantis.min.css">

</head>
<body class="login">
	<div class="wrapper wrapper-login">
	
		<div class="container container-login animated fadeIn">
			<h1 class="text-center"><span class="icon icon-lock" style="font-size: 56px"></span></h1>
			<h3 class="text-center"><?= ucwords($global->headline)?></h3>
			<div class="login-form">
				<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
				<div class="form-group form-floating-label">
					<input id="username" name="user_username" type="text" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Username</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="user_password" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="icon-eye"></i>
					</div>
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="rememberme">
						<label class="custom-control-label" for="rememberme">Remember Me</label>
					</div>
				</div>
				<div class="form-action mb-3">
					<button type="submit" class="btn btn-primary btn-rounded btn-login" name="submit" value="submit">Sign In</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url();?>vendor/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url();?>vendor/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url();?>vendor/js/core/popper.min.js"></script>
	<!-- Bootstrap Notify -->
	<script src="<?= base_url();?>vendor/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>	
	<script src="<?= base_url();?>vendor/js/core/bootstrap.min.js"></script>
	<script src="<?= base_url();?>vendor/js/atlantis.min.js"></script>
</body>
</html>
<?php if($this->session->flashdata('success')):?>
	<script type="text/javascript">
		$.notify({
			icon: 'fa fa-bell',
			title: '<strong>Informasi</strong>',
			message: '<?= ucwords($this->session->flashdata('success'))?>',
			
		},{
			type: 'success',
			
		});
	</script>       
	<?php elseif($this->session->flashdata('error')):?>
		<script type="text/javascript">
			$.notify({
				icon: 'fa fa-bell',
				title: '<strong>Perhatian </strong>',
				message: '<?= ucwords($this->session->flashdata('error'))?>'
			},{
				type: 'danger'
			});
		</script>            
<?php endif;?> 	