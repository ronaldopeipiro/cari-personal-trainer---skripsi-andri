<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminFitnessCenterModel extends Model
{
	protected $primaryKey = 'id_admin';
	protected $table = 'admin_fitness_center';
	protected $allowedFields = [
		'id_admin',
		'id_fitness_center',
		'username',
		'password',
		'nama_lengkap',
		'email',
		'no_hp',
		'foto',
		'status',
		'last_login',
		'create_datetime',
		'update_datetime',
		'token_reset_password',
	];

	public function getAdminFitnessCenter($id_admin = false)
	{
		if ($id_admin == false) {
			return $this->orderBy('id_admin', 'desc')->findAll();
		}
		return $this->where(['id_admin' => $id_admin])->first();
	}

	public function getAdminFitnessCenterByStatus($status)
	{
		return $this->where([
			'status' => $status
		])->orderBy('id_admin', 'DESC')->findAll();
	}

	public function updateAdminFitnessCenter($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_admin' => $id));
		return $query;
	}

	public function deleteAdminFitnessCenter($id)
	{
		return $this->db->table($this->table)->delete(['id_admin' => $id]);
	}
}
