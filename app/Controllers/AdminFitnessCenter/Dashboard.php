<?php

namespace App\Controllers\AdminFitnessCenter;

use App\Controllers\BaseController;
use \App\Models\FitnessCenterModel;
use \App\Models\AdminFitnessCenterModel;
use \App\Models\PersonalTrainerModel;
use \App\Models\PrestasiPersonalTrainerModel;
use \App\Models\SertifikatPersonalTrainerModel;

class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->FitnessCenterModel = new FitnessCenterModel();
		$this->AdminFitnessCenterModel = new AdminFitnessCenterModel();
		$this->PersonalTrainerModel = new PersonalTrainerModel();
		$this->PrestasiPersonalTrainerModel = new PrestasiPersonalTrainerModel();
		$this->SertifikatPersonalTrainerModel = new SertifikatPersonalTrainerModel();

		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();

		$this->session = session();
		$this->id_user = $this->session->get('id_user');
		$data_user = $this->AdminFitnessCenterModel->getAdminFitnessCenter($this->id_user);

		$this->user_id_fitness_center = $data_user['id_fitness_center'];
		$this->user_nama_lengkap = $data_user['nama_lengkap'];
		$this->user_username = $data_user['username'];
		$this->user_no_hp = $data_user['no_hp'];
		$this->user_email = $data_user['email'];
		$this->user_level = "admin-fitness-center";

		if ($data_user['foto'] != "") {
			$this->user_foto = base_url() . "/img/admin-fitness-center/" .	$data_user['foto'];
		} else {
			$this->user_foto = base_url() . "/img/noimg.png";
		}

		$this->user_status = $data_user['status'];
	}

	public function index()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Dashboard Admin Fitness Center',
			'user_id' => $this->id_user,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
			'fitness_center' => $this->FitnessCenterModel->getFitnessCenter($this->user_id_fitness_center)
		];
		return view('fitness-center/dashboard/views', $data);
	}

	public function update_posisi()
	{
		$latitude = $this->request->getPost('latitude');
		$longitude = $this->request->getPost('longitude');

		$this->AdminFitnessCenterModel->updateAdminFitnessCenter([
			'latitude' => $latitude,
			'longitude' => $longitude
		], $this->id_user);
	}
}
