<?php

namespace App\Controllers\Customer;

use CodeIgniter\Controller;
use App\Models\CustomerModel;

class Login extends Controller
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();
		$this->request = \Config\Services::request();

		$this->CustomerModel = new CustomerModel();
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
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
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

	public function index()
	{
		$session = session();
		$waktu_input = date("Y-m-d H:i:s");

		require_once APPPATH . 'Libraries/vendor/autoload.php';
		$google_client = new \Google_Client();

		// if (base_url() == "http://localhost:9090") {
		// 	// Localhost
		// 	$google_client->setClientId('851560113698-5gocvm900lb6n4358055mbj0hcodm347.apps.googleusercontent.com');
		// 	$google_client->setClientSecret('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');
		// } else {
		// 	// Hosting
		// 	$google_client->setClientId('851560113698-opv5e5dee74tc3un8nrqq61um6unni3j.apps.googleusercontent.com');
		// 	$google_client->setClientSecret('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');
		// }

		// $google_client->setPrompt('select_account');
		$google_client->setClientId('636381636364-mvpac938uq73uqaa9uk5p4qam10s40g6.apps.googleusercontent.com');
		$google_client->setClientSecret('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');
		$google_client->setRedirectUri(base_url() . '/customer/sign-in');
		$google_client->addScope('email');
		$google_client->addScope('profile');
		$google_client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));

		if ($this->request->getVar('code')) {

			$token = $google_client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));

			if (!isset($token['error'])) {

				$google_client->setAccessToken($token['access_token']);
				$session->set('access_token', $token['access_token']);
				$google_service = new \Google_Service_Oauth2($google_client);
				$gdata = $google_service->userinfo->get();

				// print_r($gdata);
				$google_id_user = $gdata['id'];
				$email_user = $gdata['email'];
				$nama_user = $gdata['given_name'] . " " . $gdata['family_name'];
				$picture_user = $gdata['picture'];
				$gender_user = $gdata['gender'];

				$cek_data = $this->CustomerModel->getCustomerByGoogleId($google_id_user);

				if (!$cek_data) {
					$this->CustomerModel->save([
						'google_id' => $google_id_user,
						'nama_lengkap' => $nama_user,
						'email' => $email_user,
						'foto' => $picture_user,
						'status' => '1',
						'last_login' => $waktu_input,
						'create_datetime' => $waktu_input,
						'update_datetime' => $waktu_input
					]);
				}

				$session_data = [
					'google_id' => $google_id_user,
					'logged_in_customer'  => TRUE
				];
				$session->set($session_data);
			}
			return redirect()->to(base_url() . '/customer');
		}

		if (!$session->get('access_token')) {
			$tombol_login = $google_client->createAuthUrl();
		} else {
			$tombol_login = "";
		}

		$data = [
			'request' => $this->request,
			'title' => 'Login Customer',
			'validation' => \Config\Services::validation(),
			'tombol_login' => $tombol_login
		];

		return view('customer/auth/sign-in', $data);
	}
}
