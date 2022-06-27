<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= $title; ?> | CARI PERSONAL TRAINER | ANDRI KURNIAWAN</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url() ?>/img/pt-vector.png" rel="icon">
	<link href="<?= base_url() ?>/img/pt-vector.png" rel="apple-touch-icon">

	<link rel="shortcut icon" href="<?= base_url() ?>/img/pt-vector.png">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>/assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">

</head>

<body>

	<header id="header" class="fixed-top d-flex align-items-center header-transparent">
		<div class="container d-flex align-items-center justify-content-between">

			<div class="logo d-flex align-items-center">
				<img src="<?= base_url() ?>/img/pt-vector.png" alt="logo" style="height: 50px;">
				<h1 style="font-size: 20px;"><a href="index.html"><span>FITNESS & TRAINERKU</span></a></h1>
			</div>

			<nav id="navbar" class="navbar">
				<ul>
					<li>
						<a class="nav-link scrollto active" href="<?= base_url(); ?>">
							Dashboard
						</a>
					</li>
					<li>
						<a class="nav-link scrollto" href="#about">
							Fitness Center
						</a>
					</li>
					<li>
						<a class="nav-link scrollto" href="<?= base_url(); ?>/personal-trainer">
							Personal Trainer
						</a>
					</li>
					<li>
						<a class="nav-link scrollto" href="<?= base_url(); ?>/">
							Gallery
						</a>
					</li>

				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav>

		</div>
	</header>


	<?= $this->renderSection('content'); ?>


	<footer id="footer">
		<div class="container">
			<div class="copyright">
				Copyright &copy;
				<a href="https://www.instagram.com/">ANDRI KURNIAWAN</a>
			</div>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	<div id="preloader"></div>

	<!-- Vendor JS Files -->
	<script src="<?= base_url() ?>/assets/vendor/aos/aos.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/php-email-form/validate.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/purecounter/purecounter.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>

	<!-- Template Main JS File -->
	<script src="<?= base_url() ?>/assets/js/main.js"></script>

</body>

</html>