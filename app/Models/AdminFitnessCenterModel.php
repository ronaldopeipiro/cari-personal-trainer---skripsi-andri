<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminFitnessCenterModel extends Model
{
	protected $primaryKey = 'id_admin';
	protected $table = 'admin_fitness_center';
	protected $allowedFields = [
		'id_admin',
		'username',
		'password',
		'nama_lengkap',
		'email',
		'no_hp',
		'foto',
		'jenis_kelamin',
		'latitude',
		'longitude',
		'status',
		'token_reset_password',
		'create_datetime',
		'update_datetime',
		'last_login'
	];

	public function getCustomer($id_admin = false)
	{
		if ($id_admin == false) {
			return $this->orderBy('id_admin', 'desc')->findAll();
		}
		return $this->where(['id_admin' => $id_admin])->first();
	}

	public function getCustomerByStatus($status)
	{
		return $this->where([
			'status' => $status
		])->orderBy('id_admin', 'DESC')->findAll();
	}

	public function updateCustomer($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_admin' => $id));
		return $query;
	}

	public function deleteCustomer($id)
	{
		return $this->db->table($this->table)->delete(['id_admin' => $id]);
	}
}
