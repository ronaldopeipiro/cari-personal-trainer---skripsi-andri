<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\PersonalTrainerModel;
use App\Models\AdminFitnessCenterModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();

        $this->CustomerModel = new CustomerModel();
        $this->PersonalTrainerModel = new PersonalTrainerModel();
        $this->AdminFitnessCenterModel = new AdminFitnessCenterModel();
    }

    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function dashboard()
    {
        $data = [
            'request' => $this->request,
            'db' => $this->db,
            'title' => 'BERANDA',
        ];
        return view('landing/dashboard/views', $data);
    }

    public function fitness_center()
    {
        $data = [
            'request' => $this->request,
            'db' => $this->db,
            'title' => 'BERANDA',
        ];
        return view('landing/fitness-center/views', $data);
    }

    public function personal_trainer()
    {
        $data = [
            'request' => $this->request,
            'db' => $this->db,
            'title' => 'PERSONAL TRAINER',
        ];
        return view('landing/personal-trainer/views', $data);
    }

    public function tentang()
    {
        $data = [
            'request' => $this->request,
            'db' => $this->db,
            'title' => 'TENTANG',
        ];
        return view('landing/tentang/views', $data);
    }
}
