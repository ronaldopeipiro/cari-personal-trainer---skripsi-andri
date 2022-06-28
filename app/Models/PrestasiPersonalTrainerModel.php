<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiPersonalTrainerModel extends Model
{
	protected $primaryKey = 'id_prestasi';
	protected $table = 'prestasi_personal_trainer';
	protected $allowedFields = [
		'id_prestasi',
		'id_personal_trainer',
		'nama_prestasi',
		'deskripsi',
		'aktif',
		'create_datetime',
		'update_datetime',
	];

	public function getPrestasiPersonalTrainer($id_prestasi = false)
	{
		if ($id_prestasi == false) {
			return $this->orderBy('id_prestasi', 'desc')->findAll();
		}
		return $this->where(['id_prestasi' => $id_prestasi])->first();
	}

	public function updatePrestasiPersonalTrainer($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_prestasi' => $id));
		return $query;
	}

	public function deletePrestasiPersonalTrainer($id)
	{
		return $this->db->table($this->table)->delete(['id_prestasi' => $id]);
	}
}
