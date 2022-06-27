<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use \App\Models\CustomerModel;

class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->CustomerModel = new CustomerModel();

		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();

		$this->session = session();
		$this->google_id = $this->session->get('google_id');
		$data_user = $this->CustomerModel->getCustomerByGoogleId($this->google_id);

		$this->user_id_customer = $data_user['id_customer'];
		$this->user_nama_lengkap = $data_user['nama_lengkap'];
		$this->user_jenis_kelamin = $data_user['jenis_kelamin'];
		$this->user_username = $data_user['email'];
		$this->user_no_hp = $data_user['no_hp'];
		$this->user_email = $data_user['email'];
		$this->user_level = "pelapor";

		$foto_user = explode(':', $data_user['foto']);
		if ($foto_user[0] == 'https') {
			$this->user_foto =	$data_user['foto'];
		} else {
			$this->user_foto = base_url() . "/img/customer/" . $data_user['foto'];
		}
		$this->user_status = $data_user['status'];
	}

	public function index()
	{
		$data = [
			'request' => $this->request,
			'db' => $this->db,
			'title' => 'Dashboard Customer',
			'user_google_id' => $this->google_id,
			'user_id_customer' => $this->user_id_customer,
			'user_nama_lengkap' => $this->user_nama_lengkap,
			'user_username' => $this->user_username,
			'user_no_hp' => $this->user_no_hp,
			'user_email' => $this->user_email,
			'user_level' => $this->user_level,
			'user_foto' => $this->user_foto,
			'user_status' => $this->user_status,
		];
		return view('customer/dashboard/views', $data);
	}

	public function update_posisi()
	{
		$latitude = $this->request->getPost('latitude');
		$longitude = $this->request->getPost('longitude');

		$this->CustomerModel->updateCustomer([
			'latitude' => $latitude,
			'longitude' => $longitude
		], $this->user_id_customer);
	}
}
