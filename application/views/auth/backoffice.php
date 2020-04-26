<body class="backoffice-body">
	<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-12 col-sm-10 col-md-6">
				<form class="form-login" method="post" action="<?= base_url('Auth/backoffice'); ?>">
					<h1>Login Backoffice</h1>
					<?= $this->session->flashdata('message'); ?>
					<div class="form-group">
						<label for="usernamegs">Username</label>
						<input type="text" class="form-control" id="usernamegs" name="usernamegs" placeholder="Masukan username">
						<?= form_error('usernamegs', '<small class="pesan-error-form">', "</small>") ?>
					</div>
					<div class="form-group">
						<label for="passwordgs">Password</label>
						<input type="password" class="form-control" id="passwordgs" name="passwordgs" placeholder="Password">
						<?= form_error('passwordgs', '<small class="pesan-error-form">', "</small>") ?>
					</div>
					<button type="submit" class="btn btn-primary btn-block" name="login" id="login">Login</button>
					<p class="punyaakun">Belum punya akun? <a href="<?= base_url(); ?>Auth/backofficesignup">Daftar!</a></p>
				</form>
			</section>
		</section>
	</section>