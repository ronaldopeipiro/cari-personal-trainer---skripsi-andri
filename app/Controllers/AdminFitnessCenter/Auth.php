<?php

namespace App\Controllers\AdminFitnessCenter;

use CodeIgniter\Controller;
use App\Models\FitnessCenterModel;
use App\Models\AdminFitnessCenterModel;

class Auth extends Controller
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();
		$this->request = \Config\Services::request();
		$this->FitnessCenterModel = new FitnessCenterModel();
		$this->AdminFitnessCenterModel = new AdminFitnessCenterModel();

		$this->namaAkunEmailSMTP = "CARI PERSONAL TRAINER APP";
		$this->akunEmailSMTP = "caripersonaltrainer2022@gmail.com";
		$this->passwordEmailSMTP = "gxbqzgsarcvxpqmx";
	}

	public function encrypt_openssl($string)
	{
		$ciphering = "AES-256-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		$encryption_iv = '1234567891011121';
		$encryption_key = "#*CustomerCariPTAndri#@";

		$encryption = openssl_encrypt(
			$string,
			$ciphering,
			$encryption_key,
			$options,
			$encryption_iv
		);

		return $encryption;
	}

	public function decrypt_openssl($string_encrypt)
	{
		$ciphering = "AES-256-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;

		$decryption_iv = '1234567891011121';
		$decryption_key = "#*CustomerCariPTAndri#@";

		$decryption = openssl_decrypt(
			$string_encrypt,
			$ciphering,
			$decryption_key,
			$options,
			$decryption_iv
		);

		return $decryption;
	}

	function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min;
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1;
		$bits = (int) $log + 1;
		$filter = (int) (1 << $bits) - 1;
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}

	function getToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i = 0; $i < $length; $i++) {
			$token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
		}

		return $token;
	}

	public function sign_in()
	{
		helper(['form']);
		$data = [
			'title' => 'LOGIN - FITNESS CENTER',
			'db' => $this->db,
			'validation' => $this->validation
		];
		return view('fitness-center/auth/sign-in', $data);
	}

	public function sign_up()
	{
		helper(['form']);
		$data = [
			'title' => 'DAFTAR AKUN - FITNESS CENTER',
			'db' => $this->db,
			'validation' => $this->validation
		];
		return view('fitness-center/auth/sign-up', $data);
	}

	public function login()
	{
		$session = session();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$data = ($this->db->query("SELECT * FROM admin_fitness_center WHERE username='$username' OR email='$username' LIMIT 1"))->getRow();

		if ($data) {
			$pass = $data->password;
			$status = $data->status;

			if ($status != "2") {
				$verify_pass = password_verify($password, $pass);
				if ($verify_pass) {
					$ses_data = [
						'id_user' => $data->id_admin,
						'login_admin_fc_cari_pt_andri_kurniawan'  => TRUE
					];

					$waktu_login = date("Y-m-d H:i:s");
					$this->AdminFitnessCenterModel->updateAdminFitnessCenter([
						'last_login' => $waktu_login
					], $data->id_admin);

					$session->set($ses_data);
					echo json_encode(array(
						'success' => '1',
						'pesan' => 'Hai, ' . $data->nama_lengkap
					));
				} else {
					echo json_encode(array(
						'success' => '0',
						'pesan' => 'Password Salah !'
					));
				}
			} elseif ($status == "0") {
				echo json_encode(array(
					'success' => '0',
					'pesan' => 'Akun anda telah dinonaktifkan !'
				));
			}
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Username/Email tidak ditemukan !'
			));
		}
	}

	public function daftar_akun()
	{
		$session = session();
		$nama_fitness_center = $this->request->getPost('nama_fitness_center');
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$nama_lengkap_admin = $this->request->getPost('nama_lengkap_admin');
		$email = $this->request->getPost('email');

		$cek_username = ($this->db->query("SELECT * FROM admin_fitness_center WHERE username='$username' LIMIT 1"))->getRow();
		if ($cek_username) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Username telah digunakan !'
			));

			return false;
		}

		$cek_email = ($this->db->query("SELECT * FROM admin_fitness_center WHERE email='$email' LIMIT 1"))->getRow();
		if ($cek_email) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Email telah digunakan !'
			));

			return false;
		}

		$querySaveFC = $this->FitnessCenterModel->save([
			'nama_fitness_center' => $nama_fitness_center
		]);
		$id_fitness_center = $this->FitnessCenterModel->getInsertID();

		$password_hash = password_hash($password, PASSWORD_DEFAULT);

		$querySaveAkun = $this->AdminFitnessCenterModel->save([
			'id_fitness_center' => $id_fitness_center,
			'username' => $username,
			'password' => $password_hash,
			'nama_lengkap' => $nama_lengkap_admin,
			'email' => $email
		]);

		if ($querySaveAkun) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Akun berhasil dibuat, silahkan login untuk mulai menggunakan aplikasi !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Akun gagal dibuat, mohon periksa kembali data anda !'
			));
		}
	}

	public function lupa_password()
	{
		helper(['form']);
		$data = [
			'title' => 'LUPA PASSWORD AKUN - ADMIN FITNESS CENTER',
			'db' => $this->db,
			'validation' => $this->validation
		];
		return view('fitness-center/auth/lupa-password', $data);
	}

	public function reset_password($token_reset_password)
	{
		helper(['form']);
		$data = [
			'title' => 'RESET PASSWORD AKUN - ADMIN FITNESS CENTER',
			'db' => $this->db,
			'validation' => $this->validation,
			'token' => $token_reset_password
		];
		return view('fitness-center/auth/reset-password', $data);
	}

	public function submit_lupa_password()
	{
		$session = session();
		$username = $this->request->getVar('username');

		if ($username == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom Email/Username tidak boleh kosong !'
			));
			return false;
		}

		$cek_data = $this->db->query("SELECT * FROM admin_fitness_center WHERE email='$username' OR username='$username' ORDER BY id_admin DESC LIMIT 1");

		if ($row = $cek_data->getRow()) {
			$id_admin = $row->id_admin;
			$nama_lengkap = $row->nama_lengkap;
			$email = $row->email;
			$username = $row->username;

			$token = $this->getToken(197);

			$this->AdminFitnessCenterModel->updateAdminFitnessCenter([
				'token_reset_password' => $token
			], $id_admin);

			$this->kirim_email_reset_password($nama_lengkap, $username, $email, $token);

			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Tautan untuk melakukan reset password telah dikirimkan melalui email ' . $email . '. Silahkan cek email anda !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Email/Username yang anda masukkan tidak tertaut dengan akun manapun, mohon periksa kembali !'
			));
			return false;
		}
	}

	public function kirim_email_reset_password($nama_penerima, $username, $email_penerima, $token)
	{
		$email_smtp = \Config\Services::email();

		$config["protocol"] = "smtp";
		$config["mailType"] = 'html';
		$config["charset"] = 'utf-8';
		// $config["CRLF"] = 'rn';
		$config["priority"] = '5';
		$config["SMTPHost"] = "smtp.gmail.com"; //alamat email SMTP 
		$config["SMTPUser"] = $this->akunEmailSMTP; //password email SMTP 
		$config["SMTPPass"] = $this->passwordEmailSMTP;

		// $config["SMTPPort"] = 465;
		// $config["SMTPCrypto"] = "ssl";
		$config["SMTPPort"] = 587;
		$config["SMTPCrypto"] = "tls";
		$config["SMTPAuth"] = true;
		$email_smtp->initialize($config);
		$email_smtp->setFrom($this->akunEmailSMTP, $this->namaAkunEmailSMTP);

		$email_smtp->setTo($email_penerima);

		$email_smtp->setSubject("Permintaan Reset Password");
		$pesan = '
					<h3>Hallo, saudara/i <b>' . $nama_penerima . '</b> (username.' . $username . ')</h3>
					anda baru saja meminta untuk melakukan reset password akun anda pada aplikasi LAPOR LAKA LANTAS APP.
					<br>
					Jika benar bahwa anda yang meminta untuk melakukan reset password, silahkan lakukan reset password akun anda melalui tautan berikut.
					<br>
					<br>
					<a href="' . base_url() . '/fitness-center/reset-password/' . $token . '">
						' . base_url() . '/fitness-center/reset-password/' . $token . '
					</a>
					<br>
					<br>
					Tetapi, jika bukan anda yang meminta untuk melakukan reset password, silahkan abaikan pesan ini
					<br>
					<br>
					Terima Kasih 
					<br>
					<br>
					<br>
					<br>
					<br>
					<i><b>Pesan ini dikirimkan otomatis oleh sistem !</b></i>
					<br>
			';

		$email_smtp->setMessage($pesan);
		$email_smtp->send();
	}

	public function submit_reset_password()
	{
		$session = session();
		$token_reset_password = $this->request->getVar('token_reset_password');
		$password_baru = $this->request->getVar('password_baru');
		$konfirmasi_password = $this->request->getVar('konfirmasi_password');

		if ($token_reset_password == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Token tidak ditemukan !'
			));
			return false;
		}

		if ($password_baru == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom password tidak boleh kosong !'
			));
			return false;
		}

		if ($konfirmasi_password == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom konfirmasi password tidak boleh kosong !'
			));
			return false;
		}

		if ($password_baru == $konfirmasi_password) {

			$cek_data = $this->AdminFitnessCenterModel->getAdminFitnessCenterByTokenResetPassword($token_reset_password);
			if ($cek_data) {
				$id_admin = $cek_data['id_admin'];
				$nama_lengkap = $cek_data['nama_lengkap'];
				$username = $cek_data['username'];
				$email = $cek_data['email'];

				$password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);

				$this->AdminFitnessCenterModel->updateAdminFitnessCenter([
					'password' => $password_baru_hash,
					'token_reset_password' => '',
				], $id_admin);

				$this->kirim_email_konfirmasi_update_password($nama_lengkap, $username, $email, $password_baru);

				echo json_encode(array(
					'success' => '1',
					'pesan' => 'Password akun anda berhasil diubah, silahkan masuk kembali !'
				));
			} else {
				echo json_encode(array(
					'success' => '0',
					'pesan' => 'Token tidak valid !'
				));
				return false;
			}
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Password tidak sesuai dengan konfirmasi !'
			));
			return false;
		}
	}

	public function kirim_email_konfirmasi_update_password($nama_penerima, $username, $email_penerima, $password_baru)
	{
		$email_smtp = \Config\Services::email();

		$config["protocol"] = "smtp";
		$config["mailType"] = 'html';
		$config["charset"] = 'utf-8';
		// $config["CRLF"] = 'rn';
		$config["priority"] = '5';
		$config["SMTPHost"] = "smtp.gmail.com"; //alamat email SMTP 
		$config["SMTPUser"] = $this->akunEmailSMTP; //password email SMTP 
		$config["SMTPPass"] = $this->passwordEmailSMTP;

		// $config["SMTPPort"] = 465;
		// $config["SMTPCrypto"] = "ssl";
		$config["SMTPPort"] = 587;
		$config["SMTPCrypto"] = "tls";
		$config["SMTPAuth"] = true;
		$email_smtp->initialize($config);
		$email_smtp->setFrom($this->akunEmailSMTP, $this->namaAkunEmailSMTP);

		$email_smtp->setTo($email_penerima);

		$email_smtp->setSubject("Berhasil Reset Password Akun Personil");
		$pesan = '
					<h3>Hallo, saudara/i <b>' . $nama_penerima . '</b> (username.' . $username . ')</h3>
					Password akun anda berhasil diubah.
					<br>
					<br>
					Berikut informasi akun anda :
					<table>
						<tr>
							<td>Nama Lengkap</td>
							<td>:</td>
							<td>' . $nama_penerima . '</td>
						</tr>
						<tr>
							<td>username</td>
							<td>:</td>
							<td>' . $username . '</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>' . $email_penerima . '</td>
						</tr>
						<tr>
							<td>Password baru</td>
							<td>:</td>
							<td>' . $password_baru . '</td>
						</tr>
					</table>
					<br>
					<br>
					Silahkan login aplikasi melalui tautan berikut ini
					<br>
					<a href="' . base_url() . '/fitness-center/sign-in">
						' . base_url() . '/fitness-center/sign-in
					</a>
					<br>
					<br>
						Jika ini bukan anda, silahkan lakukan permintaan reset password akun anda melalui tautan berikut :
					<br>
					<a href="' . base_url() . '/fitness-center/lupa-password">
						' . base_url() . '/fitness-center/lupa-password
					</a>
					<br>
					<br>
					Terima Kasih 
					<br>
					<br>
					<br>
					<br>
					<i><b>Pesan ini dikirimkan otomatis oleh sistem !</b></i>
					<br>
			';

		$email_smtp->setMessage($pesan);
		$email_smtp->send();
	}
}
