<?php

namespace App\Models;

use CodeIgniter\Model;

class FitnessCenterModel extends Model
{
	protected $primaryKey = 'id_fitness_center';
	protected $table = 'fitness_center';
	protected $allowedFields = [
		'id_fitness_center',
		'nama_fitness_center',
		'alamat',
		'latitude',
		'longitude',
		'no_hp',
		'email',
		'logo',
		'create_datetime',
		'update_datetime'
	];

	public function getCustomer($id_fitness_center = false)
	{
		if ($id_fitness_center == false) {
			return $this->orderBy('id_fitness_center', 'desc')->findAll();
		}
		return $this->where(['id_fitness_center' => $id_fitness_center])->first();
	}

	public function getCustomerByStatus($status)
	{
		return $this->where([
			'status' => $status
		])->orderBy('id_fitness_center', 'DESC')->findAll();
	}

	public function updateCustomer($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_fitness_center' => $id));
		return $query;
	}

	public function deleteCustomer($id)
	{
		return $this->db->table($this->table)->delete(['id_fitness_center' => $id]);
	}
}
