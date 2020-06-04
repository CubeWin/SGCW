<?php

require "./models/data/Token.IDao.php";

class TokenDao extends Models implements TokenIDao
{

	public function validToken()
	{
		if (isset($_COOKIE['user']) && isset($_COOKIE['token'])) {
			$user = $_COOKIE['user'];
			$token = $_COOKIE['token'];
			$new_token = md5(uniqid(mt_rand(), true)) . (microtime(true));

			try {
				$sql = "UPDATE usuario set token = :newtoken WHERE user = :user AND token = :token";
				$query = $this->modelsData->connect()->prepare($sql);
				$query->execute([
					"user" => $user,
					"token" => $token,
					"newtoken" => $new_token
				]);
				if ($query->rowCount() > 0) {
					setcookie("token", $new_token, time() + 600, '/');
					setcookie("user", $user, time() + 600, '/');
					return true;
				} else {
					return false;
				}
			} catch (PDOException $e) {
				return false;
			} finally {
				$query = null;
			}
		} else {
			return false;
		}
	}
}
