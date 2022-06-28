<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section id="hero">
	<div class="container" style="padding: 90px 0;">
		<div class="row justify-content-between">
			<div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
				<div data-aos="zoom-out" <h1 class="mb-5">Daftar sebagai pengelola <span>Fitness Center</span></h1>
					<div class="text-center text-lg-start">
						<h2>Masuk dengan</h2>
						<a href="<?= $tombol_login ?>/customer" class="btn btn-secondary px-5">
							<img src="<?= base_url() ?>/img/google.png" style="width: 50px; height: 50px;"> Akun Google
						</a>
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


<?= $this->endSection('content'); ?>