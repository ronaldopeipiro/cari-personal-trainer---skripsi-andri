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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

	<link rel="stylesheet" href="<?= base_url(); ?>/assets/custom/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/custom/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/custom/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/custom/datatables-responsive/css/responsive.bootstrap4.min.css">

	<link rel="stylesheet" href="<?= base_url(); ?>/assets/custom/dropify/dist/css/dropify.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/custom/fancybox/jquery.fancybox.min.css">

	<link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/fontawesome.min.js" integrity="sha512-xs1el+uLI2T4QTvRIv3kFBWvjQiPVAvKQM4kzZrJoLVZ1tSz1E0fkZch0cjd1f+sTk2MtBCHbP3PiVTdoFKAJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

	<script src="<?= base_url(); ?>/assets/custom/select2/js/select2.min.js"></script>
	<script src="<?= base_url(); ?>/assets/custom/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>/assets/custom/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>/assets/custom/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>/assets/custom/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>


	<script src="<?= base_url(); ?>/assets/custom/fancybox/jquery.fancybox.min.js"></script>
	<script src="<?= base_url(); ?>/assets/custom/dropify/dist/js/dropify.min.js"></script>

	<script>
		const base_url = "<?= base_url() ?>";
	</script>

</head>

<body>
	<div id="loading_text_animation" style="display: none;">
		<div id="textLoading">Mohon tunggu ...</div>
		<span><i></i><i></i></span>
	</div>

	<div id="loader" style="display: none;">
		<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
			<img src="<?= base_url(); ?>/img/loader.gif" style="width: 200px; object-fit: cover; object-position: center;">
		</div>
	</div>

	<?php if (session()->getFlashdata('pesan_berhasil')) : ?>
		<script>
			Swal.fire(
				'Berhasil !',
				'<?= session()->getFlashdata('pesan_berhasil'); ?>',
				'success'
			)
		</script>
	<?php elseif (session()->getFlashdata('pesan_gagal')) : ?>
		<script>
			Swal.fire(
				'Gagal !',
				'<?= session()->getFlashdata('pesan_gagal'); ?>',
				'error'
			)
		</script>
	<?php endif; ?>


	<header id="header" class="fixed-top d-flex align-items-center header-transparent">
		<div class="container d-flex align-items-center justify-content-between">

			<div class="logo d-flex align-items-center">
				<img src="<?= base_url() ?>/img/pt-vector.png" alt="logo" style="height: 50px;">
				<h1 style="font-size: 20px;"><a href="index.html"><span>FITNESS & TRAINERKU</span></a></h1>
			</div>

			<nav id="navbar" class="navbar">
				<?php if (session()->get('login_admin_fc_cari_pt_andri_kurniawan')) : ?>
					<ul>
						<li>
							<a class="nav-link active" href="<?= base_url(); ?>/fitness-center">
								Dashboard
							</a>
						</li>
						<li>
							<a class="nav-link" href="<?= base_url(); ?>/fitness-center/customer">
								Customer
							</a>
						</li>
						<li>
							<a class="nav-link" href="<?= base_url(); ?>/fitness-center/personal-trainer">
								Personal Trainer
							</a>
						</li>
						<li>
							<a class="nav-link" href="<?= base_url(); ?>/fitness-center/data-booking">
								Data Booking
							</a>
						</li>
						<li>
							<a class="nav-link" href="<?= base_url(); ?>/fitness-center/pengaturan">
								Pengaturan
							</a>
						</li>
						<li>
							<a class="nav-link btn-logout" href="<?= base_url(); ?>/fitness-center/logout">
								<i class="fa fa-sign-out-alt me-2"></i> Keluar
							</a>
						</li>

					</ul>
				<?php else : ?>
					<ul>
						<li>
							<a class="nav-link active" href="<?= base_url(); ?>">
								Dashboard
							</a>
						</li>
						<li>
							<a class="nav-link" href="<?= base_url(); ?>/fitness-center">
								Fitness Center
							</a>
						</li>
						<li>
							<a class="nav-link" href="<?= base_url(); ?>/personal-trainer">
								Personal Trainer
							</a>
						</li>

					</ul>
				<?php endif; ?>
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

	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpc-W4SSnb8kM3cNDK9MYNCucHZdS7Els&callback=initMap&language=id-ID"></script>

	<!-- Template Main JS File -->
	<script src="<?= base_url() ?>/assets/js/main.js"></script>

	<script>
		$(document).ready(function() {
			$(".js-select-2").select2();

			$("#data-table").DataTable({
				paging: true,
				responsive: true,
				searching: true,
			});

			$(".btn-hapus").on("click", function(e) {
				event.preventDefault(); // prevent form submit

				Swal.fire({
					title: "Hapus Data",
					text: "Pilih ya, jika anda ingin menghapus data !",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Ya, hapus data !",
					cancelButtonText: "Batal",
				}).then((result) => {
					if (result.isConfirmed) {
						var form = $(this).parents("form");
						form.submit();
					}
				});
			});

			$(".btn-logout").on("click", function(e) {
				event.preventDefault(); // prevent form submit

				Swal.fire({
					title: "Logout",
					text: "Apakah anda yakin ingin keluar dari aplikasi ?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Ya",
					cancelButtonText: "Tidak",
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = $(".btn-logout").attr("href");
					}
				});
			});
		});
	</script>

</body>

</html>