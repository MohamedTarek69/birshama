<?php
class LoginUser
{
	// class properties
	private $username;
	private $password;
	public $error;
	public $success;
	private $storage = "data.json";
	private $stored_users;

	// class methods
	public function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
		$this->login();
	}


	private function login()
	{
		foreach ($this->stored_users as $user) {
			if ($user['username'] == $this->username) {
				if (password_verify($this->password, $user['password'])) {
					session_start();
					$_SESSION['user'] = $this->username;
					$_SESSION['user_id'] = $user['id'];

					if ($user['role'] == 'admin') {
						header("location: Admin.php");
						exit();
					} else {
						header("location: customar_view.php");
						exit();
					}
				}
			}
		}
		return $this->error = "Wrong username or password";
	}
}
