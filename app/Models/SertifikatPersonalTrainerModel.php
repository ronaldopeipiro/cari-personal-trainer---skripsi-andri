<?php

namespace App\Models;

use CodeIgniter\Model;

class SertifikatPersonalTrainerModel extends Model
{
	protected $primaryKey = 'id_sertifikat';
	protected $table = 'sertifikat_personal_trainer';
	protected $allowedFields = [
		'id_sertifikat',
		'id_personal_trainer',
		'nama_sertifikat',
		'deskripsi',
		'aktif',
		'create_datetime',
		'update_datetime',
	];

	public function getSertifikatPersonalTrainer($id_sertifikat = false)
	{
		if ($id_sertifikat == false) {
			return $this->orderBy('id_sertifikat', 'desc')->findAll();
		}
		return $this->where(['id_sertifikat' => $id_sertifikat])->first();
	}

	public function updateSertifikatPersonalTrainer($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_sertifikat' => $id));
		return $query;
	}

	public function deleteSertifikatPersonalTrainer($id)
	{
		return $this->db->table($this->table)->delete(['id_sertifikat' => $id]);
	}
}
