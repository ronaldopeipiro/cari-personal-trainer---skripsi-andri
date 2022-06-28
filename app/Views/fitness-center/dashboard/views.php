<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main id="main" style="padding: 80px 0; background-color: #0C0E64;">

	<section class="section-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title" data-aos="fade-up">
						<h2>
							Selamat Datang
						</h2>
						<h2 class="mt-3">
							Administrator Fitness Center
						</h2>
						<p>
							<?= $fitness_center['nama_fitness_center']; ?>
						</p>

						<div class="row mt-4 align-items-center">
							<div class="col-lg-2 text-lg-start text-center">
								<img src="<?= $user_foto; ?>" style="width: 180px; height: 180px; border-radius: 10px; object-fit: cover; object-position: center;">
							</div>

							<div class="col-lg-10 pt-3">
								<span><?= $fitness_center['alamat']; ?></span>
								<div class="alert alert-info">
									<table class="table-sm table-responsive">
										<tr>
											<td>Nama Lengkap</td>
											<td>:</td>
											<td>
												<?= $user_nama_lengkap; ?>
											</td>
										</tr>
										<tr>
											<td>Username</td>
											<td>:</td>
											<td>
												<?= $user_username; ?>
											</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>:</td>
											<td>
												<?= $user_email; ?>
											</td>
										</tr>
										<tr>
											<td>No. Handphone</td>
											<td>:</td>
											<td>
												<?= $user_no_hp; ?>
											</td>
										</tr>
										<tr>
											<td>Lokasi saat ini</td>
											<td>:</td>
											<td>
												<small class="text-muted mb-2" id="textposisisaya"></small>
											</td>
										</tr>
									</table>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">

			<div class="section-title" data-aos="fade-up">
				<h2>Lokasi Saya</h2>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div id="map" style="height: 68vh; width: 100%; border-radius: 20px;"></div>
				</div>
			</div>

		</div>

</main>


<script>
	let map,
		class_kategori_laporan,
		marker,
		accuracyStatus;
	let gmarkers = [];

	function initMap() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				if (position.coords.accuracy < 100) {
					accuracyStatus = `
							<strong style="color: green;">
								<span class="fa fa-check"></span>
								` + position.coords.accuracy.toFixed(2) + ` m (Baik)
							</strong>`;
				} else {
					accuracyStatus = `
							<strong style="color: red;">
								` + position.coords.accuracy.toFixed(2) + ` m (Lemah)
							</strong>`;
				}

				var infowindow = new google.maps.InfoWindow();
				var bounds = new google.maps.LatLngBounds();
				var geocoder = new google.maps.Geocoder();

				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var styleMaps = [{
					featureType: "administrative",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}, {
					featureType: "poi",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}, {
					featureType: "water",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}, {
					featureType: "road",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}];

				map = new google.maps.Map(document.getElementById('map'), {
					zoom: 14,
					center: pos,
					mapTypeControlOptions: {
						mapTypeIds: ['mystyle', google.maps.MapTypeId.SATELLITE]
					},
					mapTypeId: 'mystyle',
					location_type: google.maps.GeocoderLocationType.ROOFTOP
				});

				map.mapTypes.set('mystyle', new google.maps.StyledMapType(styleMaps, {
					name: 'Maps'
				}));

				map.panTo(pos);

				geocoder.geocode({
					'latLng': pos
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {

						var icon_saya = {
							url: "<?= base_url() ?>/img/pin.png", // url
							scaledSize: new google.maps.Size(50, 50), // scaled size
							origin: new google.maps.Point(0, 0), // origin
							// anchor: new google.maps.Point(0, 0) // anchor
						};

						marker = new google.maps.Marker({
							position: pos,
							map: map,
							icon: icon_saya,
							animation: google.maps.Animation.DROP,
						});

						var infowindowText = `
							<div class='text-center'>
								<strong>Posisi Saya</strong>
							</div>`;

						$('#textposisisaya').html(`` + results[3].formatted_address + `. (` + pos.lat.toFixed(5) + `, ` + pos.lng.toFixed(5) + `) - Akurasi : ` + accuracyStatus + `
						`);

						infowindow.setContent(infowindowText);
						infowindow.open(map, marker);
						marker.addListener('click', function() {
							infowindow.open(map, marker);
						});

					}

				});
			}, function() {
				handleLocationError(true, infowindow, map.getCenter());
			});
		} else {
			handleLocationError(false, infowindow, map.getCenter());
		}
	}

	function handleLocationError(browserHasGeolocation, infowindow, pos) {
		infowindow.setPosition(pos);
		infowindow.setContent(browserHasGeolocation ?
			`<span class="alert alert-danger"> Error: The Geolocation service failed. </span>` :
			`<span class="alert alert-danger">Error: Your browser doesnt support geolocation. </span>`);
		infowindow.open(map);
	}
</script>
<?= $this->endSection('content'); ?>