<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Logout extends Controller
{
	public function fitness_center()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url() . '/fitness-center/sign-in');
	}

	public function personal_trainer()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url() . '/personal-trainer/sign-in');
	}

	public function customer()
	{
		$session = session();
		$session->destroy();

		return redirect()->to(base_url() . '/customer/sign-in');
	}
}
