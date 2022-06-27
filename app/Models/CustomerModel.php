<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
	protected $primaryKey = 'id_customer';
	protected $table = 'customer';
	protected $allowedFields = [
		'id_customer',
		'google_id',
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

	public function getCustomer($id_customer = false)
	{
		if ($id_customer == false) {
			return $this->orderBy('id_customer', 'desc')->findAll();
		}
		return $this->where(['id_customer' => $id_customer])->first();
	}

	public function getCustomerByGoogleId($google_id)
	{
		return $this->where(['google_id' => $google_id])->first();
	}

	public function getCustomerByStatus($status)
	{
		return $this->where([
			'status' => $status
		])->orderBy('id_customer', 'DESC')->findAll();
	}

	public function updateCustomer($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id_customer' => $id));
		return $query;
	}

	public function deleteCustomer($id)
	{
		return $this->db->table($this->table)->delete(['id_customer' => $id]);
	}
}
