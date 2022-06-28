<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section id="hero">
	<div class="container" style="padding: 90px 0;">
		<div class="row justify-content-between">
			<div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 p-4">
				<div data-aos="zoom-out">
					<h1 style="font-size: 20px;" class="mb-5">Daftar sebagai pengelola <span>Fitness Center</span></h1>
				</div>

				<div class="card">
					<div class="card-body py-5">

						<form id="formInput" method="post">

							<div class="form-group row mb-3">
								<label for="nama_fitness_center" class="col-form-label col-sm-3">
									Nama Fitness Center
								</label>
								<div class="col-sm-9">
									<input type="text" name="nama_fitness_center" class="form-control" placeholder="Masukkan nama fitness center ...">
								</div>
							</div>

							<div class="form-group row mb-3">
								<label for="nama_lengkap_admin" class="col-form-label col-sm-3">
									Nama Lengkap Administrator
								</label>
								<div class="col-sm-9">
									<input type="text" name="nama_lengkap_admin" class="form-control" placeholder="Masukkan nama fitness center ...">
								</div>
							</div>

							<div class="form-group row mb-3">
								<label for="email" class="col-form-label col-sm-3">
									Email
								</label>
								<div class="col-sm-9">
									<input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email ..." oninput="validasiEmail()">
									<span id="validasiEmailConfirm"></span>
								</div>
							</div>

							<div class="form-group row mb-3">
								<label for="username" class="col-form-label col-sm-3">
									Username
								</label>
								<div class="col-sm-9">
									<input type="text" name="username" class="form-control" placeholder="Masukkan username ...">
								</div>
							</div>

							<div class="form-group row mb-3">
								<label for="password" class="col-form-label col-sm-3">
									Password
								</label>
								<div class="col-sm-9">
									<input type="password" name="password" class="form-control" placeholder="Password ...">
								</div>
							</div>

							<div class="form-group row mb-3">
								<label for="konfirmasi_password" class="col-form-label col-sm-3">
									Konfirmasi Password
								</label>
								<div class="col-sm-9">
									<input type="password" name="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password ...">
									<span id="confirm_password_message"></span>
								</div>
							</div>

							<div class="form-group row mt-5">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<div class="d-flex justify-content-between">
										<button type="submit" class="btn btn-success btn-block" id="buttonSignUp" disabled>
											<i class="fa fa-arrow-right"></i> Buat Akun
										</button>

										<a href="<?= base_url(); ?>" class="btn btn-secondary">
											<i class="fa fa-arrow-left"></i> Dashboard
										</a>
									</div>
								</div>
							</div>

							<div class="row mt-5">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<span>
										Sudah punya akun ? silahkan
									</span>
									<a href="<?= base_url(); ?>/fitness-center/sign-in">Masuk</a>
								</div>
							</div>
						</form>

					</div>
				</div>

			</div>
			<div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
				<img src="<?= base_url() ?>/img/pt-vector.png" class="img-fluid animated" alt="">
			</div>
		</div>
	</div>

	<svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
		<defs>
			<path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
		</defs>
		<g class="wave1">
			<use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
		</g>
		<g class="wave2">
			<use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
		</g>
		<g class="wave3">
			<use xlink:href="#wave-path" x="50" y="9" fill="#fff">
		</g>
	</svg>

</section>

<script>
	function validasiEmail() {
		var form = document.getElementById("formInput");
		var email = document.getElementById("email").value;
		var text = document.getElementById("validasiEmailConfirm");
		var pattern = /^[^ ]+@[^ ]+.[a-z]{2,3}$/;

		if (email.match(pattern)) {
			form.classList.add("valid");
			form.classList.remove("invalid");
			text.innerHTML = "Email valid";
			text.style.color = "green";
		} else {
			form.classList.remove("valid");
			form.classList.add("invalid");
			text.innerHTML = "Email tidak valid !";
			text.style.color = "#ff0000";
		}
		if (email == "") {
			form.classList.remove("valid");
			form.classList.remove("invalid");
			text.innerHTML = "";
			text.style.color = "#00ff00";
		}
	}

	$('#formInput input[name=konfirmasi_password]').on('keyup', function() {
		if (($('#formInput input[name=password]').val() != "") && ($('#formInput input[name=password]').val() != "")) {
			if ($('#formInput input[name=password]').val() == $('#formInput input[name=konfirmasi_password]').val()) {
				$('#confirm_password_message').html('Password cocok !').css('color', 'green');
				document.getElementById('buttonSignUp').disabled = false;
			} else {
				$('#confirm_password_message').html('Password tidak cocok !').css('color', 'red');
				document.getElementById('buttonSignUp').disabled = true;
			}
		}
	});

	$(document).ready(function() {
		$(function() {
			$("#formInput").submit(function(e) {
				e.preventDefault();

				var nama_fitness_center = $('#formInput input[name=nama_fitness_center]').val();
				var username = $('#formInput input[name=username]').val();
				var password = $('#formInput input[name=password]').val();
				var konfirmasi_password = $('#formInput input[name=konfirmasi_password]').val();
				var nama_lengkap_admin = $('#formInput input[name=nama_lengkap_admin]').val();
				var email = $('#formInput input[name=email]').val();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/AdminFitnessCenter/Auth/daftar_akun",
					dataType: "JSON",
					data: {
						nama_fitness_center: nama_fitness_center,
						username: username,
						password: password,
						konfirmasi_password: konfirmasi_password,
						nama_lengkap_admin: nama_lengkap_admin,
						email: email
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							Swal.fire(
								'Berhasil',
								data.pesan,
								'success'
							).then(function() {
								window.location = base_url + "/fitness-center/sign-in";
							});
						} else if (data.success == "0") {
							Swal.fire(
								'Gagal',
								data.pesan,
								'error'
							)
						}
					},
					complete: function(data) {
						$("#loader").hide();
					}
				});

			});

		});
	});
</script>

<?= $this->endSection('content'); ?>