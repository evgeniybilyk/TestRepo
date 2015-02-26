<?php

	/**
	 * Функция для проверки, авторизован ли пользователь
	 * @return bool
	 */
	function Access_AdminAuthorized()
	{
		$login = $_SESSION["login"];
		$pass = $_SESSION["pass"];
        if($login == ADMIN_USERNAME && $pass == ADMIN_PASSWORD)
            return true;

		return false;
	}

    /**
     * Авторизация админа
     *
     * @param $strLogin
     * @param $strPassword
     * @return bool
     */
	function AccessAdm_Login($strLogin, $strPassword)
	{
        if($strLogin == ADMIN_USERNAME && $strPassword == ADMIN_PASSWORD) {

            $_SESSION["login"] = $strLogin;
            $_SESSION["pass"] = $strPassword;
            $_SESSION["admin_auth"] = 1;

            return true;
        }

        return false;
	}

	/**
	 * Функция для де-авторизации пользователя
	 * @return void
	 */
	function Access_Logout()
	{
        unset($_SESSION["login"]);
        unset($_SESSION["pass"]);
        unset($_SESSION["admin_auth"]);
    }