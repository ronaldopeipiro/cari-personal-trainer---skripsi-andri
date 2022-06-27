<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonalTrainerModel extends Model
{
	protected $primaryKey = 'id_personal_trainer';
	protected $table = 'personal_trainer';
	protected $allowedFields = [
		'id_personal_trainer',
		'username',
		'password',
		'nama_lengkap',
		'email',
		'no_hp',
		'jenis_kelamin',
		'foto',
		'latitude',
		'longitude',
		'aktif_mengajar',
		'status_akun',
		'create_datetime',
		'update_datetime',
		'last_login',
		'token_reset_password',
	];

	public function getPersonalTrainer($id_personal_trainer = false)
	{
		if ($id_personal_trainer == false) {
			return $this->orderBy('id_personal_trainer', 'desc')->findAll();
		}
		return $this->where(['id_personal_trainer' => $id_personal_trainer])->first();
	}

	public function getPersonalTrainerByStatus($status)
	{
		return $this->where([
			'status' => $status
		])->orderBy('id_personal_trainer', 'DESC')->findAll();
	}

	public function updatePersonalTrainer($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_personal_trainer' => $id));
		return $query;
	}

	public function deletePersonalTrainer($id)
	{
		return $this->db->table($this->table)->delete(['id_personal_trainer' => $id]);
	}
}
